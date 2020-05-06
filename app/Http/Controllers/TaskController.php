<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::orderBy('name', 'asc')->get()->toJson();
    }
   
    public function store(Request $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->content,
            'status_id' => 1
        ]);        
    }

    public function show(Task $task, $id)
    {
        $task = Task::find($id);
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $task = Task::findOrFail($request->id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->content = $request->content;
        $task->status_id = $request->status_id;
        $task->save();
        return $task;
    }

    public function destroy(Task $task, $id)
    {
        $task = Task::find($id);
        $task->delete(); 
        return $task;
    }
}
