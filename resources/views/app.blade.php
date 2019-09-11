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
        <script src="/js/tasks.js"> 
        </script>
    </body>
</html>