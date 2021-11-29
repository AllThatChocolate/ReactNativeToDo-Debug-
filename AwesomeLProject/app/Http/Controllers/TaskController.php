<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    //The following function returns the variable tasks and c_tasks with incomplete and complete tasks respectively
    public function index()
    {
        $tasks = Task::where("iscompleted", false)->orderBy("id", "DEC")->get();
        $c_tasks = Task::where("iscompleted", true)->get();
        return response()->json([
            'tasks' => $tasks, 
            'c_tasks' => $c_tasks
        ]);
    }

    //The following function stores the values that we post
    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json([
            "code" => 200,
            "message" => "Task added successfully"
        ]);
    }

    //The following function takes the row containing id as same as $id in function parameter, changes its is completed column value from false to true and saves
    public function complete($id)
    {
        $task = Task::find($id);
        $task->iscompleted = true;
        $task->save();
        return response()->json([
            "code" => 200,
            "message" => "Task listed as completed"
        ]);
    }

    //The follwoing function deletes the task and returns a JSON response
    public function destroy($id)
    {
        $task = Task::find($id);
        $task = $task->delete();
        return response()->json([
            "code" => 200,
            "message" => "Task deleted successfully"
        ]);
    }
}
