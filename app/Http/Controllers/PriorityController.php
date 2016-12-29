<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Priority::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $_priority = Priority::find($id);

        if (!$_priority) {
            return response()->json([
                'message' => 'Priority not found',
            ], 404);
        }

        return response()->json($_priority);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $_new = new Priority();

        $_new->name = $request->input('name');
        $_new->save();

        return response()->json($_new);
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
        $this->validate($request, [
            'name' => 'required'
        ]);

        $_edit = Priority::find($id);

        if (!$_edit) {
            return response()->json([
                'message' => 'Priority not found',
            ], 404);
        }

        $_edit->name = $request->input('name');
        $_edit->save();

        return response()->json($_edit);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $_priority = Priority::find($id);

        if (!$_priority) {
            return response()->json([
                'message' => 'Priority not found',
            ], 404);
        }

        $_priority->delete();

        return response()->json([
            'message' => 'Priority was deleted',
        ], 200);
    }
}