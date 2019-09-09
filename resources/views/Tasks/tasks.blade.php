@extends('app')
@section('content')
<div class="container-fluid">
    <div class="col-sm-4">
        <!-- Add Task Form -->
        <form id="addTaskForm">
            User<input id="name" type="text" class="form-control">
            Task<input id="task" type="text" class="form-control">

            <button id="addBtn" type="button" class="btn btn-primary" style="margin:10px"> Add Task </button>
            <h4 id="result"></h4>
        </form>

        <!-- Table -->
        <div id="index"></div>
    </div>
</div>
@endsection

