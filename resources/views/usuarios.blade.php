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

        <h2>Bienvenido {{ $nombre }}</h2>
        @if($rol != 3)
        <a href="usuarios/agregar"> 
            <p class="btn btn-primary float-right text-center"> <strong>+</strong></p>
        </a>
        @endif
        <h1 class="mt-5">Usuarios ({{count($usuarios)}})</h1>
        <table class="table table-hover">
            <thead>
              <tr class="text-center">
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Usuario</th>
                <th scope="col">Tipo Usuario</th>
                @if($rol == 1 or $rol == 2)
                <th scope="col">Activar/Desactivar</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
                @endif
              </tr>
            </thead>
            <tbody>
                @forelse ($usuarios as $usuario)

                <tr class="text-center">
                    <td>{{ $usuario->nombre}}</td>
                    <td>{{ $usuario->apellido}}</td>
                    <td>{{ $usuario->usuario}}</td>	
                    <td>
                        @if($usuario->id_tipousuario == 1)
                        Super Usuario
                        @elseif($usuario->id_tipousuario == 2)
                        Administrador
                        @else
                        Operador
                        @endif
                    </td>
                    <td>
                        @if($usuario->id_tipousuario != 1)
                        
                        @if($rol != 3)
                        {{ Form::open(array('url' => 'usuarios/activar')) }}
                        {{ Form::hidden('id', $usuario->id_usuario)}} 
                        @if($usuario->activo)
                        {{ Form::submit('Activo',array('class' => 'btn btn-success'))}}
                        @else
                        {{ Form::submit('Desactivo',array('class' => 'btn btn-danger'))}}
                        @endif
                        {{ Form::close() }}
                        
                        @endif
                        
                        @else
                        @endif
                    </td>

                    	
                    @if($rol == 2 && $usuario->id_tipousuario != 1)
                    <td>
                    <a href="usuarios/{{$usuario->id_usuario}}"> 
                        <button  class="btn btn-outline-warning">
                            <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                            </svg> 
                    </button>
                    </a>
                    </td>
                    @endif
                    @if($rol == 1 )
                    <td>
                    <a href="usuarios/{{$usuario->id_usuario}}"> 
                        <button  class="btn btn-outline-warning">
                            <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
                            </svg> 
                    </button>
                    </a>
                    </td>
                    @endif
                   
                    @if($usuario->id_tipousuario != 1 && $rol == 2)
                    <td>
                    {{ Form::open(array('url' => 'usuarios/eliminar')) }}
                    {{ Form::hidden('id', $usuario->id_usuario)}} 
                    {{ Form::submit('Eliminar',array('class' => 'btn btn-outline-danger'))}}
                    {{ Form::close() }}
                    </td>
                    @endif

                    @if($rol == 1)
                    @if($usuario->id_tipousuario != 1)
                    <td>
                    {{ Form::open(array('url' => 'usuarios/eliminar')) }}
                    {{ Form::hidden('id', $usuario->id_usuario)}} 
                    {{ Form::submit('Eliminar',array('class' => 'btn btn-outline-danger'))}}
                    {{ Form::close() }}
                    </td>
                    @endif
                    @endif
                </tr>
                @empty
                <li>No hay usuarios registrados</li>
                @endforelse
            </tbody>
          </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
</body>
</html>