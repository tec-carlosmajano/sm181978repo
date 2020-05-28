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
    @include('menu') 
    <div class="container mt-5">

        <h1>Agregar Usuario</h1>
        <hr>
        {{ Form::open(array('url' => 'usuarios/nuevo')) }}
        <div class="form-group">
            <label > <strong>Nombre</strong> </label><br>
            {{Form::text('nombre', '', array('class' => 'form-control'))}} 
            <label > <strong>Apellido</strong> </label><br>
            {{Form::text('apellido', '', array('class' => 'form-control'))}} 
            <label > <strong>Usuario</strong> </label><br>
            {{Form::text('usuario', '', array('class' => 'form-control'))}} 
            <label > <strong>Clave</strong> </label><br>
            {{Form::password('clave', array('class' => 'form-control'))}} <br>
            <label > <strong>Tipo Usuario</strong></label><br>
            {{Form::select('tipo_usuario', array(2 => 'Administrador', 3 => 'Operador'),'',array('class'=> 'form-control','required'=>true))}}

            {{Form::submit('Agregar',array('class' => 'btn btn-primary m-3'))}}
         {{ Form::close() }}
    </div>
</body>
</html>