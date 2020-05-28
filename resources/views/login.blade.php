<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Login</h1>
        @if($err)
        <span class="text-danger text-center">{{$err}}</span>
        @endif
        {{ Form::open(array('url' => 'usuarios/entrar')) }}
        <div class="form-group">
            <label > <strong>Usuario</strong> </label><br>
            {{Form::text('usuario', '', array('class' => 'form-control'))}} 
            <label > <strong>Clave</strong> </label><br>
            {{Form::password('clave', array('class' => 'form-control'))}} 
            {{Form::submit('Ingresar',array('class' => 'btn btn-primary m-3'))}}
         {{ Form::close() }}

    </div>
    
</body>
</html>