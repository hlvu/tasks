@extends('app')
@section('content')
<!-- Add Task Form -->
<form id="addTaskForm">
    User<input id="name" type="text" class="form-control">
    Task<input id="task" type="text" class="form-control">
    <button id="addBtn" type="button" class="btn btn-primary"> Add Task </button>
</form>
<h1 id="result"></h1>

<!-- Index -->
<div id="index"></div>

@endsection

