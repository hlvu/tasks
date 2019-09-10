@extends('app')
@section('content')
<div class="container-fluid">
    <div class="col-sm-4">
        <!-- Add Task Form -->
        <form id="addTaskForm">
            <div class="row">
                <div class="col-md-10">
                <b id="userLabel">User</b>
                <input id="name" type="text" class="form-control" placeholder="Name">
                <small id=userError class="text-danger"></small>
                
                <br>

                <b id="taskLabel">Task</b>
                <textarea id="task" type="text" class="form-control" rows="4" cols="50" placeholder="Description"></textarea>
                <small id=taskError class="text-danger"></small>
                </div>
                <div id="errors" class="col-md-8">
                <!-- Errors -->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                <button id="addBtn" type="button" class="btn btn-primary" style="margin:10px"> Add </button>
                </div>
                <div class="col-xs-4">
                <button id="search" type="button" class="btn btn-info" style="margin:10px">Search</button>
                </div>
                <div class="col-sm-5">
                <h4 id="message"></h4>
                </div>
            </div>
        </form>

        <!-- Table -->
        <div id="index"></div>
    </div>
</div>
@endsection