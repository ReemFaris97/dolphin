<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Clause;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ClauseOperation;
use App\Traits\Viewable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClausesController extends Controller
{
    use ClauseOperation, Viewable;
    protected $viewable = 'admin.clauses.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clauses = Clause::all()->reverse();;
        return $this->toIndex(compact('clauses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = \App\User::with('roles')->get();
        $users = $users->filter(function ($user, $key) {
            return $user->hasPermissionTo('insert_numbers');
        })->pluck('name','id');


        return $this->toCreate(compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:191',
            'amount' => "required|numeric|min:1",
            'user_id' => 'required|exists:users,id',
            'default_amount'=>'required|numeric|min:1',
        ];
        $messsage = [
            'name.required'=>"الإسم مطلوب",
            'amount.required'=>"الكمية مطلوبة",
            'amount.numeric'=>"الكمية يجب ان تكون رقم صحيح",
            'default_amount.required'=>"الكمية الإفتراضية مطلوبة",
            'default_amount.numeric'=>"الكمية الإفتراضية يجب ان تكون رقم صحيح",
        ];


        $this->validate($request, $rules,$messsage);
        $this->RegisterClause($request);
        toast('تم الحفظ بنجاح', 'success', 'top-right');

        return redirect()->route('admin.clauses.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clause = Clause::find($id)->load('logs');
//        return $clause->logs->load('user');
        if (!$clause) return abort(404);
        $users = User::pluck('name', 'id');
        return $this->toShow(compact('users','clause'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clause = Clause::find($id);
        $users = User::pluck('name', 'id');
        if (!$clause) return abort(404);
        return $this->toEdit(compact('clause','users'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clause = Clause::find($id);
        if (!$clause) return abort(404);

        $rules = [
            'name' => 'required|string|max:191',
            'amount' => "required|numeric|min:1",
            'user_id' => 'required|exists:users,id',
            'default_amount'=>'required|numeric|min:1',

        ];

        $this->validate($request, $rules);
        $this->UpdateClause($clause, $request);
        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->route('admin.clauses.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Clause::destroy($id);
        toast('تم الحذف بنجاح', 'success', 'top-right');
        return back();
    }

    public function getAddLog($id)
    {

        if (!auth()->user()->hasPermissionTo('insert_numbers')) {
            return abort(401);
        }

        $clause = Clause::find($id);
        if (!$clause) return abort(404);
        return view('admin.clauses.addLog', compact('clause'));
    }

    public function AddLog(Request $request, $id)
    {
        $clause = Clause::find($id);
        if (!$clause) return abort(404);
        $rules = ['amount' => "required|numeric|min:1"];

        $this->validate($request, $rules);
        $inputs = $request->all();
        $inputs['user_id'] = auth()->id();
        DB::beginTransaction();
        $clause->logs()->create($inputs);
        $clause->fill(['amount'=> $request->amount]);
        $clause->save();
        DB::commit();
        toast('تم اضافة تحديث جديد', 'success', 'top-right');
        return redirect()->route('admin.clauses.index');
    }

    public function userClauses(){

        $clauses = Clause::where('user_id',auth()->id())->where('blocked_at',null)->get()->reverse();
        $page_title = "البنود المسنده الى ";
        return $this->toIndex(compact('clauses', 'page_title'));
    }

    public function block($id){
        $clause = Clause::find($id);

        $blocked_at = $clause->blocked_at;
        if ($blocked_at == null) {
            $clause->fill(['blocked_at' => Carbon::now(env('TIME_ZONE','Africa/Cairo'))]);
        } else {
            $clause->fill(['blocked_at' => null]);
        }
        $clause->save();
        toast('تم التعديل', 'success', 'top-right');
        return back();

    }

    public function getEnterNumbersPage(){
        $clauses = Clause::where('user_id',auth()->id())->where('blocked_at',null)->get()->reverse();
        return view('admin.clauses.enter_numbers',compact('clauses'));
    }
    public function postChangeNunmbers(Request $request){

        $ids = $request->ids;
        $amounts = $request->amounts;
        for ($i=0;$i<count($request->ids);$i++){
            $clause = Clause::find($ids[$i]);
            if($clause){
                if($amounts[$i] != null){
                    $clause->logs()->create(['amount'=>$amounts[$i], 'user_id'=>auth()->id(),]);
                    Clause::find($ids[$i])->update([
                        'amount'=>$amounts[$i]
                    ]);
                }

            }
        }

        toast('تم التعديل', 'success', 'top-right');
        return back();
    }

}
