<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Tasks = Todos::all()->where('group_name','Tasks');
        $Toughts = Todos::all()->where('group_name','Toughts');
        $titles=['Tasks','Toughts'];
        return view('index',compact('Toughts','Tasks','titles'));
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
        $storeData =  $request->validate([
            'date'=>'required | max:255',
            'data'=>'required | max:255',
            'group_name'=>'required | max:255'
        ]);

        Todos::create($storeData);
        return redirect('/todos')->with('success','Record saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $storeData =  $request->validate([
            'date'=>'required | max:255',
            'data'=>'required | max:255',
        ]);

        Todos::whereId($id)->update($storeData);
        return redirect('/todos')->with('success','Record Updated!');
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
        Todos::whereId($id)->delete();
        return redirect('/todos')->with('success','Record Deleted!');
    }
}
