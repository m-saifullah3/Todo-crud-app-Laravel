<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
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
        $tasks =  ['tasks' => Tasks::all()->where('user_id', auth()->user()->id)];
        return view('index', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => ['required']
        ]);

        $is_task_created = Tasks::create([
            'task' => $request->task,
            'user_id' => auth()->user()->id
        ]);

        if($is_task_created) {
            return back()->with('success', 'Task has been successfully created');
        } else {
            return back()->with('failed', 'Task has failed to create');
        }
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
    public function edit(Tasks $task)
    {
        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $task)
    {
        $request->validate([
            'task' => ['required']
        ]);

        $is_task_updated = Tasks::find($task->id)->update([
            'task' => $request->task
        ]);

        if($is_task_updated) {
            return back()->with('success', 'Task has been updated successfully');
        } else {
            return back()->with('failed', 'Task has failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {
        $is_task_deleted = Tasks::find($task->id)->delete();

        if($is_task_deleted) {
            return back()->with('success', 'Task has been deleted');
        } else {
            return back()->with('failed', 'Task has failed to delete');
        }
    }
}
