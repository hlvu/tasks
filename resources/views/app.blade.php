<!DOCTYPE html>
<html>
    <head>
        <!-- csrf -->
        <meta name="_token" content="{{csrf_token()}}" />

        <title>Task List</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- CSS And JavaScript -->
    </head>

    <body>
        @yield('content')
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                    crossorigin="anonymous">
        </script>
        <script> 
            //Fn: show action's result
            function announce(response) {
                $('#result').html(response.result);
            };

            //Fn: render html from data
            function showTable(data) {
                //view data
                let html=`
                <table class="table">
                    <thead>
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
            function addTask(e){
                e.preventDefault();

                $.ajax({
                    url: "/task",
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: $('#name').val(),
                        task: $('#task').val(),
                    },
                }).done(function(result) {
                    announce(result);
                    //Refresh data table
                    index();
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

            //Fn:edit User
            function edit(id) {
                $('#'+id).append(`
                <input id="editTask"></input>
                <button id="saveBtn" onclick="update(${id})">Save</button>
                `);
            }
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

        $(document).ready(function(){
            //csrf
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //show data
            index();

            //AJAX: Add New Task
            $('#addBtn').click(function(e) {
                addTask(e);
            });
        });
        </script>
    </body>
</html>