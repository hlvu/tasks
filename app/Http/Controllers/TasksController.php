<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\addTaskRequest;
use App\User;
use App\Task;
class TasksController extends Controller
{
    public function index() {
        return view('Tasks.tasks');
    }

    public function show() {
        $users = User::with('task')->get();
        return response($users);
    }

    public function store(addTaskRequest $request) {

        $q_name = $request->name;
        $q_task = $request->task;
        
        //check if user's name-task pair exist
        $user = User::where('name', '=', $q_name)
        ->whereHas('task', function ($query) use ($q_task) {
            $query->where('task', '=', $q_task);
        })->first();
        if($user === null) {
            //retrieve user if exist
            $user = User::where('name', '=', $q_name)->first();
            //else create new user
            if ($user === null) {
                $user = new User;
                $user->name = $q_name;
                $user->save();
            }
            //new task
            $task = new Task;
            $task->task = $q_task;
            $user->task()->save($task);

            return response()->json(['result'=>'Added new task']);
        } else return response()->json(['result'=>'Existed task']);
    }

    public function deleteTask($id) {
        $task = Task::find($id)->delete(); 
        return response()->json(['result'=>'Deleted task']);
    }

    public function deleteUser($id) {
        $user = User::find($id)->delete(); 
        return response()->json(['result'=>'Deleted user']);
    }

    public function editTask($id, Request $request) {
        $task = Task::find($id);
        $task->task = $request->task;
        $task->save();
        return response()->json(['result'=>'Updated task']);
    }

    public function search(Request $request) {
        $q_name = $request->name;
        $q_task = $request->task;
        $user = User::where('name', 'LIKE', '%'.$q_name.'%')
        ->whereHas('task', function ($query) use ($q_task) {
            $query->where('task', 'LIKE', '%'.$q_task.'%');
        })
        ->with(['task' => function ($query) use ($q_task) {
            $query->where('task', 'LIKE', '%'.$q_task.'%');
        }])
        ->get();
        return response($user);
    }
}
