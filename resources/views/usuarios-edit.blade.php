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

        <h1>Editar Usuario <strong> {{ $usuario->nombre}}</strong> </h1>
        <hr>
        {{ Form::open(array('url' => 'usuario/editar')) }}
        <div class="form-group">
            <label > <strong>Nombre</strong> </label><br>
            {{Form::hidden('id', $usuario->id_usuario, array('class' => 'form-control'))}} 
            {{Form::text('nombre', $usuario->nombre, array('class' => 'form-control'))}} 
            <label > <strong>Apellido</strong> </label><br>
            {{Form::text('apellido', $usuario->apellido, array('class' => 'form-control'))}} 
            <label > <strong>Usuario</strong> </label><br>
            {{Form::text('usuario', $usuario->usuario, array('class' => 'form-control'))}} 
            <label > <strong>Nueva Clave</strong> </label><br>
            {{Form::password('clave', array('class' => 'form-control'))}} <br>
            @if($usuario->id_tipousuario != 1)
            <label > <strong>Tipo Usuario</strong></label><br>
            @if($usuario->id_tipousuario == 2)
            {{Form::select('tipo_usuario', array(2 => 'Administrador', 3 => 'Operador'),'2',array('class'=> 'form-control','required'=>true))}}
            @endif
            @if($usuario->id_tipousuario == 3)
            {{Form::select('tipo_usuario', array(2 => 'Administrador', 3 => 'Operador'),'3',array('class'=> 'form-control','required'=>true))}}
            @endif
            @endif
            {{Form::submit('Editar',array('class' => 'btn btn-primary m-3'))}}
            @if($err)
            <span class="text-danger">Ese usuario ya existe.</span>
            @endif
         {{ Form::close() }}
    </div>
</body>
</html>