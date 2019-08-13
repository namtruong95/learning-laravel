<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\StudentsSubjectClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentsSubjectClass\StoreStudentsSubjectClassRequest;

class StudentsSubjectClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StudentsSubjectClass::all();

        return response()->success([
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StudentsSubjectClass\StoreStudentsSubjectClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentsSubjectClassRequest $request)
    {
        $input = $request->validated();

        $studentsSubjectClass = new StudentsSubjectClass($input);

        $studentsSubjectClass->save();

        return response()->created([
            'success' => true,
        ]);
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
