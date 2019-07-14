<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body>
        <div id="app">

        <nav class="navbar navbar bg justify-content-center" style='background-color:#0062a9'>
            <a href="{{ url('/index') }}" style="color:white;text-decoration:none"><h2>Compagnie Fiduciaire</h2></a>
        </nav><br>
            
            <main>
                @yield('content')
            </main>

        </div>
    </body>
</html>

