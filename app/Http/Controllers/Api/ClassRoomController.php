<?php

namespace App\Http\Controllers\Api;

use App\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoom\StoreClassRoomRequest;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ClassRoom::all();

        return response()->success([
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ClassRoom\StoreClassRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassRoomRequest $request)
    {
        $input = $request->validated();

        $classRoom = new ClassRoom();
        $classRoom->name = $input['name'];
        $classRoom->code = $input['code'];

        $classRoom->save();

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
