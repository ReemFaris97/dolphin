<?php

namespace App\Http\Controllers\admin;


use App\Answer;
use App\Banner;
use App\Category;
use App\Client;
use App\Contact;
use App\Department;
use App\Employe;
use App\News;
use App\Product;
use App\Service;
use App\Structure;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=Client::count();
        $structures=Structure::count();
        $contacts=Contact::count();
        $services=Service::count();

        $clients17=Client::whereYear('created_at', '=', '2017')->count();
        $clients18=Client::whereYear('created_at', '=', '2018')->count();
        $clients19=Client::whereYear('created_at', '=', '2019')->count();

        return view('admin.home.home',compact('clients','structures','contacts','services','clients17','clients18','clients19'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $depart=Department::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
