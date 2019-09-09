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
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

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
                    </thead>
                    <tbody>
                `;
                data.forEach(e => {
                    html += `
                    <tr>
                        <td>${e.name}</td>
                        <td>
                            <ul>
                    `;
                    e.task.forEach(i => {
                        html += `
                        <li>${i.task}</li>
                        `;
                    });
                    html += `</ul></td></tr>`
                });
                $('#index').html(html);

            }

            //AJAX: View Tasks
            $.ajax({
                url: "/show",
                method: "GET",
                dataType: "json",
            }).done(function(data) {
                showTable(data);
            });
            

            //AJAX: Add New Task
            $('#addBtn').click(function(e){
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
                    $.ajax({
                        url: "/show",
                        method: "GET",
                        dataType: "json",
                    }).done(function(data) {
                        showTable(data);
                    });
                });
            });
        });
        </script>
    </body>
</html>