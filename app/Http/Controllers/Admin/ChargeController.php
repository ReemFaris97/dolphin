<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Traits\ChargeOperation;
use App\Traits\Viewable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChargeController extends Controller
{
    use Viewable, ChargeOperation;
    private $viewable = 'admin.charges.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->hasPermissionTo('view_charges')) {
            return abort(401);
        }

        $charges = Charge::where('destroyed_at',null)->get()->reverse();;

$page_title = 'كل العهد';

        return $this->toIndex(compact('charges', 'page_title'));
    }

    public function UserCharges()
    {
        $charges = Charge::where('worker_id', \Auth::id())->get()->reverse();;

        $page_title = 'العهد المسندة الى';
        return $this->toIndex(compact('charges', 'page_title'));
    }

    public function superVisorCharges()
    {

        $charges = Charge::where('supervisor_id', \Auth::id())->get()->reverse();;
        $page_title = 'العهد التى قمت بأسنادها';
        return $this->toIndex(compact('charges', 'page_title'));
    }

    public function getDestruct()
    {
        $charges = Charge::where('destroyed_at', '!=', null)->get()->reverse();;
        $page_title = 'التوالف';

        return $this->toIndex(compact('charges', 'page_title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermissionTo('assign_charges')) {
            return abort(401);
        }
        $users = User::pluck('name', 'id');
        return $this->toCreate(compact('users'));;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->request->add(['supervisor_id' => auth()->id()]);
        $rules = [
            'name' => 'required|string|max:191',
            'description' => 'required|string',
            'worker_id' => 'required|exists:users,id',
            'supervisor_id' => 'required|exists:users,id',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,jpeg,gif,png',
        ];
        $messages = [
            'name.required'=>"الإسم مطلوب",
            'description.required'=>"الوصف مطلوب",
            'worker_id.required'=>"إسم الموظف مطلوب",
            'supervisor_id.required'=>"الإسم مطلوب",
            'images.required'=>"الصور مطلوبة",
        ];
        $this->validate($request, $rules,$messages);
        $this->RegisterCharge($request);
        toast('تم الاضافه بنجاح', 'success', 'top-right');
        return redirect()->route('admin.charges.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->hasPermissionTo('edit_charges')) {
            return abort(401);
        }
        $charge = Charge::find($id);
        return $this->toShow(compact('charge'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $charge = Charge::find($id);
        $users = User::pluck('name', 'id');
        return $this->toEdit(compact('users', 'charge'));
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
        $charge = Charge::find($id);
        if (!$charge) return abort(404);

        $this->UpdateCharge($charge, $request);
        toast('تم التعديل بنجاح', 'success', 'top-right');
        return redirect()->route('admin.charges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function getAddLog($id)
    {
        if (!auth()->user()->hasPermissionTo('assign_charges')) {
            return abort(401);
        }

        $charge = Charge::find($id);
        if (!$charge) return abort(404);
        $users = User::pluck('name', 'id');
        return view('admin.charges.addLog', compact('charge', 'users'));
    }


    public function addLog(Request $request, $id)
    {

        $charge = Charge::find($id);
        if (!$charge) return abort(404);
        $rules = [
            'worker_id' => 'required|exists:users,id',
            'type' => 'required|string|in:transfer,receive',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,jpeg,gif,png',
        ];

        $messages = [
            'worker_id.required'=>"الإسم مطلوب",
            'type.required'=>"النوع مطلوب",
            'images.required'=>"الصور مطلوبة",
        ];

        $this->validate($request, $rules,$messages);
        $this->AddChargeLog($request, $charge);
        toast('تم اضافة تحديث جديد', 'success', 'top-right');
        return redirect()->route('admin.charges.index');

    }


    public function getAddNotes($id)
    {
        $charge = Charge::find($id);
        if (!$charge) return abort(404);
        if ($charge->worker_id != Auth::id() || $charge->supervisor_id != Auth::id()) {
            return abort(403);
        }
        return view('admin.charges.addNotes', compact('charge'));
    }


    public function addNotes(Request $request, $id)
    {
        $charge = Charge::find($id);
        if (!$charge) return abort(404);
        $rules = [
            'description' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,jpeg,gif,png',
        ];

        $messages = [
            'description.required'=>" الوصف مطلوب",
            'images.required'=>"الصور مطلوبة",
        ];

        $this->validate($request, $rules , $messages);
        $this->AddChargeNotes($request, $charge);
        toast('تم اضافة ملاحظه جديد', 'success', 'top-right');
        return redirect()->route('admin.charges.index');

    }

    public function confirmCharge(Request $request)
    {
        $rules = [
            'code' => 'required|integer|exists:charges,code',
        ];

        $this->validate($request, $rules);
        $charge = Charge::whereIdAndSupervisorId($request->id, auth()->user()->id)->whereCode($request->code)->first();
        if (!$charge) return abort(404);
        $charge->markAsConfirmed();

        toast('تم التفعيل بنجاح', 'success', 'top-right');
        return response()->json([
            'status' => true,
            'title' => "نجاح",
            'message' => "تم التفعيل بنجاح",
        ]);

    }


    public function destruct(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('destroy_charges')) {
            return abort(401);
        }

        $charge = Charge::find($request->id);
        if (!$charge) return abort(404);
        $charge->markAsDestroyed();
        toast('تم الإتلاف بنجاح', 'success', 'top-right');
        return response()->json([
            'status' => true,
            'title' => 'نجاح',
            'message' => "تم الإتلاف بنجاح",
        ]);
    }


    public function destroy($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_charges')) {
            return abort(401);
        }
        $charge = Charge::find($id);
        $charge->delete();
        toast('تم الحذف بنجاح', 'success', 'top-right');
        return redirect()->route('admin.charges.index');

    }
}



