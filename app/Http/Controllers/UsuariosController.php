<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Usuarios;

class UsuariosController extends Controller
{
    public function usuarios(Request $request)
    {
        $activo = $request->session()->get('activo');
        if ($activo) {
            $usuarios = Usuarios::all();
            $nombre = $request->session()->get('usuario');
            return view('usuarios')->with('usuarios', $usuarios)->with('rol', $request->session()->get('rol'))->with('nombre', $nombre);
        } else {
            return redirect("/");
        }
    }

    public function verEditar($id, Request $request)
    {
        $activo = $request->session()->get('activo');
        if ($activo) {
            try {
                $usuario = new Usuarios();
                $usuario = Usuarios::find($id);
                if ($usuario) {
                    if (request()->has('err')) {
                        $err = true;
                    } else {
                        $err = false;
                    }
                    return view('usuarios-edit')->with('usuario', $usuario)->with('err', $err);
                } else {
                    return redirect("usuarios");
                }
            } catch (\Throwable $th) {
                return redirect("usuarios");
            }
        } else {
            return redirect("/");
        }
    }

    public function editar(Request $request)
    {
        $usuario = new Usuarios();
        $usuario = Usuarios::find($request->id);
        if ($usuario) {
            try {

                if ($request->session()->get('rol') == 1) {
                    if ($request->clave != "") {
                        $usuario->fill([
                            'nombre' => $request->nombre,
                            'apellido' => $request->apellido,
                            'usuario' => $request->usuario,
                            'clave' => password_hash($request->clave, PASSWORD_BCRYPT)
                        ])->save();
                    } else {
                        $usuario->fill([
                            'nombre' => $request->nombre,
                            'apellido' => $request->apellido,
                            'usuario' => $request->usuario
                        ])->save();
                    }
                }
                if ($request->session()->get('rol') != 1) {

                    if ($request->clave != "") {
                        $usuario->fill([
                            'id_tipousuario' => $request->tipo_usuario,
                            'nombre' => $request->nombre,
                            'apellido' => $request->apellido,
                            'usuario' => $request->usuario,
                            'clave' => password_hash($request->clave, PASSWORD_BCRYPT)
                        ])->save();
                    } else {
                        $usuario->fill([
                            'id_tipousuario' => $request->tipo_usuario,
                            'nombre' => $request->nombre,
                            'apellido' => $request->apellido,
                            'usuario' => $request->usuario
                        ])->save();
                    }
                }
                return redirect("usuarios/$request->id");
            } catch (\Throwable $th) {
                return redirect("usuarios/$request->id?err");
            }

            return view('usuarios-edit')->with('usuario', $usuario);
        }
    }

    public function nuevo(Request $request)
    {

        $usuario = new Usuarios();
        $usuario->fill([
            'id_tipousuario' => $request->tipo_usuario,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'usuario' => $request->usuario,
            'clave' => password_hash($request->clave, PASSWORD_BCRYPT),
            'activo' => 1
        ])->save();
        return redirect("usuarios");
    }


    public function activar(Request $request)
    {
        try {
            $usuario = new Usuarios();
            $usuario = Usuarios::find($request->id);
            if ($usuario) {
                if ($usuario->activo == 0) {
                    $usuario->fill([
                        'activo' => 1
                    ])->save();
                } else {
                    $usuario->fill([
                        'activo' => 0
                    ])->save();
                }
            } else {
                return redirect("usuarios");
            }
        } catch (\Throwable $th) {
            echo $th;
        }
        return redirect("usuarios");
    }

    public function eliminar(Request $request)
    {

        try {
            $usuario = new Usuarios();
            $usuario = Usuarios::find($request->id);
            $usuario->delete();
            return redirect("usuarios");
        } catch (\Throwable $th) {
            return redirect("usuarios");
        }
    }

    public function entrar(Request $request)
    {

        try {
            $usuario = new Usuarios();
            $usuario = Usuarios::where('usuario', '=', $request->usuario)->first();
            if ($usuario) {
                if ($usuario->activo) {
                    # code...

                    if (password_verify($request->clave, $usuario['clave'])) {
                        $request->session()->put('activo', true);
                        $request->session()->put('rol', $usuario->id_tipousuario);
                        $request->session()->put('usuario', $usuario->usuario);
                        return redirect("usuarios");
                    } else {
                        return redirect("/?no");
                    }
                } else {
                    return redirect("/?no_activo");
                }
            } else {
                return redirect("/?no");
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function salir(Request $request)
    {

        $request->session()->forget('activo');
        return redirect('/');
    }

    public function verAgregar(Request $request)
    {
        $activo = $request->session()->get('activo');
        if ($activo) {
            return view('usuarios-add');
        } else {
            return redirect('/');
        }
    }
}
