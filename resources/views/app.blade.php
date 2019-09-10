<!DOCTYPE html>
<html>
    <head>
        <!-- csrf -->
        <meta name="_token" content="{{csrf_token()}}" />

        <title>Tasks List</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- CSS And JavaScript -->
        <style>
        /* ul {
            list-style-type: none;
        } */
        body {
            background-color: lightyellow;
        }
        </style>
    </head>

    <body>
        @yield('content')
        <!-- jQuery -->
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                    crossorigin="anonymous">
        </script>
        <script> 
            //Fn: show action's result
            function announce(response) {
                $('#message').html(response.result);
            };

            //Fn: render html from data
            function showTable(data) {
                //view data
                let html=`
                <table class="table table-striped table-bordered">
                    <thead align="center">
                        <th>Name</th>
                        <th>Task</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                `;
                data.forEach(e => {
                    html += `
                    <tr>
                        <td>${e.name}<a href="#" onclick="deleteUser(${e.id})">X</a></td>
                        <td>
                            <ul>
                    `;
                    e.task.forEach(i => {
                        html += `
                        <li id="${i.id}">${i.task}</li>
                        `;
                    });
                    html += `</ul><td><ul>`
                    e.task.forEach(i => {
                        html += `
                        <li>
                        <a href="#" id="delete" style="margin:5px" onclick="deleteTask(${i.id})">Delete</a>

                        <a href="#" id="edit" style="margin:5px" onclick="edit(${i.id})">Edit</a>
                        </li>
                        `;
                    })
                    html += `</ul></td></tr>`;
                });
                $('#index').html(html);
            }

            //Ajax Request Data
            function index() {
                $.ajax({
                    url: "/show",
                    method: "GET",
                    dataType: "json",
                }).done(function(data) {
                    showTable(data);
                });
            };
            
            //Ajax Post New Task
            function addTask(){

                $.ajax({
                    url: "/task",
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: $('#name').val(),
                        task: $('#task').val(),
                    },
                })
                .done(function(response) {
                    announce(response);
                    // Refresh table
                    index();
                })
                .fail(function(response) {
                    let json = $.parseJSON(response.responseText);
                    // Show errors
                    let str="<ul>"
                    Object.keys(json.errors).forEach(e => {
                        str += "<li>" + json.errors[e] +"</li>";
                    })
                    str+="</ul>";
                    $('#errors').html(str);
                });
            };

            //Fn:delete Task
            function deleteTask(id) {
                $.ajax({
                    url: "/task/" + id,
                    method: "GET",
                    dataType: 'json',
                }).done(function(result) {
                    announce(result);
                    index();
                });
            };

            //Fn:delete User
            function deleteUser(id) {
                $.ajax({
                    url: "/user/" + id,
                    method: "GET",
                    dataType: 'json',
                }).done(function(result) {
                    announce(result);
                    index();
                });
            };

            //Fn:show edit form
            function edit(id) {
                $('#'+id).append(`
                <input id="editTask" class="form-control"></input>
                <button onclick="update(${id})" class="btn btn-primary">Save</button>
                `);
            }

            //Fn:save edited task
            function update(id) {
                $.ajax({
                    url: "/task/edit/" + id,
                    method: "GET",
                    dataType: 'json',
                    data: {
                        task: $('#editTask').val(),
                    }

                }).done(function(result){
                    announce(result);
                    index();
                });
            };

            //search
            function search() {
                $.ajax({
                    url: "/search",
                    method: "GET",
                    data: {
                        name: $('#name').val(),
                        task: $('#task').val(),
                    },
                }).done(function(data) {
                    $('#message').html('Search result');
                    showTable(data);
                });
            }
            //form validation
            function nameInvalid() {
                $('#userError').html('>=6 chars');
                $('#name').addClass('is-invalid');
                $('#userLabel').addClass('text-danger');
            }
            function nameValid() {
                $('#userError').html('');
                $('#name').removeClass('is-invalid').addClass('is-valid');
                $('#userLabel').removeClass('text-danger');
            }
            function taskInvalid() {
                $('#taskError').html('Required');
                $('#task').addClass('is-invalid');
                $('#taskLabel').addClass('text-danger');
            }
            function taskValid() {
                $('#taskError').html('');
                $('#task').removeClass('is-invalid').addClass('is-valid');
                $('#taskLabel').removeClass('text-danger');
            }
            
        $(document).ready(function(){
            //csrf
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //show data
            index();

            //Add New Task
            $('#addBtn').click(function() {
                //client-side validation
                    //validate username
                // if($('#name').val().length < 6) {
                //     nameInvalid();
                // } else {
                //     nameValid();
                // };
                //     //validate task
                // if($('#task').val() === '' ) {
                //     taskInvalid();
                // } else {
                //     taskValid();
                // };
                //     //add Task
                // if($('#name').val().length >= 6 && $('#task').val() !== '') 
                addTask();
            });

            //Search
            $('#search').click(function(){
                search();
            });

            //search + JS validation during typing
            $('#name, #task').keyup(function(){
                //live search
                search();
                    //validate name
                if($('#name').val().length < 6) {
                    nameInvalid();
                } else {
                    nameValid();
                };
                    //validate task
                if($('#task').val() === '' ) {
                    taskInvalid();
                } else {
                    taskValid();
                };
            });
        });
        </script>
    </body>
</html>