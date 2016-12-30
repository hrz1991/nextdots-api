<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Task;
use App\User;
use App\Priority;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Task::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $_task = Task::find($id);

        if (!$_task) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
        }

        return response()->json($_task::with('user', 'priority')->get());
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
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'user_id' => 'required',
            'priority_id' => 'required'
        ]);

        $_new = new Task();

        $_new->title = $request->input('title');
        $_new->description = $request->input('description');
        $_new->due_date = $request->input('due_date');


        $_user = User::find($request->input('user_id'));
        $_priority = Priority::find($request->input('priority_id'));

        if($_user == null){
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        if($_priority == null){
            return response()->json([
                'message' => 'Priority not found',
            ], 404);
        }


        $_new->user()->associate($_user);
        $_new->priority()->associate($_priority);
        
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
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'user_id' => 'required',
            'priority_id' => 'required'
        ]);

        $_edit = Task::find($id);

        if (!$_edit) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
        }

        $_edit->title = $request->input('title');
        $_edit->description = $request->input('description');
        $_edit->due_date = $request->input('due_date');


        $_user = User::find($request->input('user_id'));
        $_priority = Priority::find($request->input('priority_id'));

        if($_user == null){
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        if($_priority == null){
            return response()->json([
                'message' => 'Priority not found',
            ], 404);
        }


        $_edit->user()->associate($_user);
        $_edit->priority()->associate($_priority);
        
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
        $_task = Task::find($id);

        if (!$_task) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
        }

        $_task->delete();

        return response()->json([
            'message' => 'Task was deleted',
        ], 200);
    }
}