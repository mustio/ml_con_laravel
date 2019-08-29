<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
    @include('head')
</head>
<body>

    <div class="container">
        <h2>Bienvenido a la integracion con Mercado Libre</h1>
        <div class="panel panel-default"> 
            <div class="panel-heading">Lista de Variables Devueltas</div>
            <div class="panel-body">
            @foreach ($store as $key => $item)
                {{ucfirst($key)}} : {{ $item }} <br>
            @endforeach
            </div>

            <div class="panel-footer"> Create by <a href="http://code-jr.com.ar">CODE-JR</a> </div>
        </div>        
    </div>
    
</body>
</html>