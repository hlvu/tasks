<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;
class TasksController extends Controller
{
    //
    public function index() {
        return view('Tasks.tasks');
    }

    public function show() {
        $users = User::with('task')->get();
        return response($users);
        // return response()->json([
        //     'name' => $users->name,
        //     'task' => $users->
        // ]);
    }
    public function store(Request $request) {
        //retrieve user if exist
        $user = User::where('name', '=', $request->name)->first();
        //else create new user
        if ($user === null) {
            $user = new User;
            $user->name = $request->name;
            $user->save();
        }
        //new task
        $task = new Task;
        $task->task = $request->task;
        $user->task()->save($task);

        return response()->json(['result'=>'Added new task']);
    }

    public function delete($id) {
        $task = Task::find($id)->delete(); 
        return response()->json(['result'=>'Deleted task']);
    }
}
