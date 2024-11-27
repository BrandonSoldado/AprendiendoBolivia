<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Asegúrate de importar el modelo User
use App\Models\Bitacora;
use Carbon\Carbon; // Asegúrate de importar Carbon

class AccesoController extends Controller
{
    public function InicioSesion(){
        return view('Acceso.InicioSesion');
    }
    public function Modificar(){
        return view('Acceso.Modificar');
    }
    
    public function PrincipalE(){
        return view('Acceso.PrincipalE');
    }
    
    public function PrincipalD(){
        return view('Acceso.PrincipalD');
    }
    
    public function PerfilE(){
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('Acceso.PerfilE', compact('user')); // Pasar el usuario a la vista
    }
    
    public function PerfilD(){
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('Acceso.PerfilD', compact('user')); // Pasar el usuario a la vista
    }
    
    public function PerfilA(){
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('Acceso.PerfilA', compact('user')); // Pasar el usuario a la vista
    }
    
    public function PrincipalA(){
        return view('Acceso.PrincipalA');
    }
    
    public function RegistroUsuario(){
        return view('Acceso.RegistroUsuario');
    }
    
    public function CambiarContraseña(){
        return view('Acceso.CambiarContraseña');
    }
    

    // Método para manejar el inicio de sesión
    public function login(Request $request)
    {
        // Validar la entrada del usuario
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Obtener el registro o código y la contraseña
        $codigo = $request->input('username');
        $password = $request->input('password');

        // Verificar si el código es un número
        if (is_numeric($codigo)) {
            // Buscar al usuario en la base de datos usando registro
            $user = DB::table('users')->where('registro', intval($codigo))->first();
        } else {
            // Buscar al usuario en la base de datos usando código
            $user = DB::table('users')->where('codigo', $codigo)->first();
        }

        // Verificar si el usuario existe y si la contraseña es correcta
        if ($user && password_verify($password, $user->password)) {
            // Autenticación exitosa
            Auth::loginUsingId($user->id);

            // Establecer la zona horaria de Bolivia
            $horaBolivia = Carbon::now('America/La_Paz');

            // Guardar el registro en la tabla bitacoras
            Bitacora::create([
                'actividad' => 'Iniciar Sesión',
                'nombre_usuario' => $user->nombre, // Se usa el campo 'nombre' de tu tabla
                'fecha' => $horaBolivia->toDateString(), // Fecha en Bolivia
                'hora' => $horaBolivia->toTimeString(), // Hora en Bolivia
                'rol_usuario' => $user->rol, // Se usa el campo 'rol' de tu tabla
            ]);

            // Redirigir según el rol del usuario
            switch ($user->rol) {
                case 'A':
                    return redirect()->intended('/PrincipalA');
                case 'D':
                    return redirect()->intended('/PrincipalD');
                case 'E':
                    return redirect()->intended('/PrincipalE');
                default:
                    return redirect()->intended('/default');
            }
        } else {
            // Si las credenciales son incorrectas
            return back()->withErrors([
                'username' => 'Registro o código y/o contraseña incorrectos.',
            ]);
        }
    }

    // Método para manejar el cierre de sesión
    public function logout(Request $request)
    {
        $user = Auth::user(); // Obtiene el usuario autenticado
        
        // Establecer la zona horaria de Bolivia
        $horaBolivia = Carbon::now('America/La_Paz');

        // Registrar en la bitácora antes de cerrar sesión
        if ($user) {
            Bitacora::create([
                'actividad' => 'Cerrar Sesión',
                'nombre_usuario' => $user->nombre,
                'fecha' => $horaBolivia->toDateString(), // Fecha en Bolivia
                'hora' => $horaBolivia->toTimeString(), // Hora en Bolivia
                'rol_usuario' => $user->rol,
            ]);
        }

        Auth::logout(); // Cierra la sesión del usuario
        return redirect('/InicioSesion'); // Redirige a la página de inicio de sesión
    }

    public function cambiarPassword(Request $request)
    {
        // Validar la entrada del usuario
        $request->validate([
            'codigo' => 'required|string',
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:3',
        ]);

        // Obtener los datos del formulario
        $codigo = $request->input('codigo');
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');

        // Inicializar la consulta
        $query = DB::table('users');

        // Verificar si el código es numérico
        if (is_numeric($codigo)) {
            // Si es numérico, buscar por "registro"
            $query->where('registro', $codigo);
        } else {
            // Si no es numérico, buscar por "codigo"
            $query->where('codigo', $codigo);
        }

        // Ejecutar la consulta
        $user = $query->first();

        // Verificar si el usuario existe y si la contraseña antigua es correcta
        if ($user && password_verify($oldPassword, $user->password)) {
            // Actualizar la contraseña con la nueva (encriptada)
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => bcrypt($newPassword)]);

            // Establecer la zona horaria de Bolivia
            $horaBolivia = Carbon::now('America/La_Paz');

            // Registrar el cambio de contraseña en la bitácora
            Bitacora::create([
                'actividad' => 'Cambio de Contraseña',
                'nombre_usuario' => $user->nombre, // Se asume que el campo 'nombre' existe
                'fecha' => $horaBolivia->toDateString(), // Fecha en Bolivia
                'hora' => $horaBolivia->toTimeString(), // Hora en Bolivia
                'rol_usuario' => $user->rol, // Se asume que el campo 'rol' existe
            ]);

            // Redirigir con éxito
            return redirect()->back()->with('success', 'Contraseña actualizada con éxito.');
        } else {
            // Si el usuario no existe o la contraseña antigua es incorrecta
            return redirect()->back()->withErrors(['old_password' => 'La contraseña antigua es incorrecta o el usuario no existe.']);
        }
    }

        


public function registrarUsuario(Request $request)
{
    // Validar la entrada del usuario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'correo' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'ci' => 'required|string|size:7',
        'telefono' => 'nullable|string|max:15', // Permitir vacío
        'direccion' => 'nullable|string|max:255', // Permitir vacío
        'fecha_nacimiento' => 'required|date',
        'rol' => 'nullable|string|max:10', // Permitir vacío
        'registro' => 'nullable|string|max:20', // Permitir vacío
        'codigo' => 'nullable|string|max:20', // Permitir vacío
    ]);

    // Crear un nuevo usuario
    $user = User::create([
        'nombre' => $request->input('nombre'),
        'correo' => $request->input('correo'),
        'password' => bcrypt($request->input('password')), // Encriptar la contraseña
        'ci' => $request->input('ci'),
        'telefono' => $request->input('telefono') ?: null, // Asignar null si está vacío
        'direccion' => $request->input('direccion') ?: null, // Asignar null si está vacío
        'fecha_nacimiento' => $request->input('fecha_nacimiento'),
        'rol' => $request->input('rol') ?: null, // Asignar null si está vacío
        'registro' => ($request->input('registro') === 'null' || $request->input('registro') === null) ? null : $request->input('registro'), // Asignar null si es 'null' o null
        'codigo' => ($request->input('codigo') === 'null' || $request->input('codigo') === null) ? null : $request->input('codigo'), // Asignar null si es 'null' o null
    ]);

    // Obtener el usuario autenticado
    $usuarioAutenticado = Auth::user();

    // Establecer la zona horaria de Bolivia
    $horaBolivia = Carbon::now('America/La_Paz');

    // Registro en la bitácora
    Bitacora::create([
        'actividad' => 'Registro de Usuario',
        'nombre_usuario' => $usuarioAutenticado->nombre, // Nombre del usuario que registra
        'fecha' => $horaBolivia->toDateString(), // Fecha en Bolivia
        'hora' => $horaBolivia->toTimeString(), // Hora en Bolivia
        'rol_usuario' => $usuarioAutenticado->rol, // Rol del usuario que registra
        'id_usuario' => $usuarioAutenticado->id, // ID del usuario que registra
    ]);

    // Redirigir a una página de éxito o al inicio de sesión
    return redirect('/InicioSesion')->with('success', 'Usuario registrado con éxito.');
}

    


    
    public function mostrarUsuarios()
    {
        // Obtener todos los usuarios de la base de datos
        $usuarios = DB::table('users')->get();

        // Retornar la vista y pasar los usuarios
        return view('Acceso.MostrarUsuario', compact('usuarios'));
    }
    public function eliminarUsuario($id)
{
    // Encuentra el usuario por ID
    $user = User::findOrFail($id);
    
    // Elimina al usuario
    $user->delete();
    
    // Redirige a la lista de usuarios con un mensaje de éxito
    return redirect()->route('mostrar.usuarios')->with('success', 'Usuario eliminado correctamente.');
}
        

public function modificarUsuario(Request $request, $id)
{
    // Validar la entrada del usuario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'correo' => 'required|string|email|max:255|unique:users,correo,' . $id, // Excluye el correo del usuario que se está modificando
        'ci' => 'required|string|size:7',
        'telefono' => 'nullable|string|max:15',
        'direccion' => 'nullable|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'rol' => 'nullable|string|max:10',
        'registro' => 'nullable|string|max:20',
        'codigo' => 'nullable|string|max:20',
    ]);

    // Buscar el usuario en la base de datos
    $user = User::findOrFail($id);

    // Actualizar los datos del usuario
    $user->update([
        'nombre' => $request->input('nombre'),
        'correo' => $request->input('correo'),
        'ci' => $request->input('ci'),
        'telefono' => $request->input('telefono') ?: null,
        'direccion' => $request->input('direccion') ?: null,
        'fecha_nacimiento' => $request->input('fecha_nacimiento'),
        'rol' => $request->input('rol') ?: null,
        'registro' => ($request->input('registro') === 'null' || $request->input('registro') === null) ? null : $request->input('registro'),
        'codigo' => ($request->input('codigo') === 'null' || $request->input('codigo') === null) ? null : $request->input('codigo'),
    ]);

    // Redirigir a la lista de usuarios con un mensaje de éxito
    return redirect()->route('mostrar.usuarios')->with('success', 'Usuario modificado correctamente.');
}
}
