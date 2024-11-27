<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenios;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora; // Asegúrate de importar el modelo de Bitacora
use Carbon\Carbon; // Asegúrate de importar Carbon
use App\Models\Grupo; 
use App\Models\Horario;
use Illuminate\Http\JsonResponse;
use App\Models\Idioma;
use App\Models\Modulo;
use App\Models\Nivel;
use App\Models\Texto;

class Ciclo2Controller extends Controller
{
    
    public function mostrarIdiomasYModulos()
    {
        // Obtener todos los idiomas y cargar los niveles relacionados
        $idiomas = Idioma::with('niveles')->get();
        $modulos = Modulo::all();

        // Retornar la vista con los datos
        return view('IdiomasYNiveles.IdiomaModulo', compact('idiomas', 'modulos'));
    }
    
    public function eliminarIdioma($id)
    {
        $idioma = Idioma::findOrFail($id);
        $idioma->delete();

        return redirect()->back()->with('success', 'Idioma eliminado con éxito.');
    }

    public function eliminarModulo($id)
    {
        $modulo = Modulo::findOrFail($id);
        $modulo->delete();

        return redirect()->back()->with('success', 'Módulo eliminado con éxito.');
    }
    public function registrarIdioma(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Idioma::create(['nombre' => $request->nombre]);

        return redirect()->back()->with('success', 'Idioma registrado exitosamente.');
    }

    public function registrarModulo(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:500',
        ]);

        Modulo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->back()->with('success', 'Módulo registrado exitosamente.');
    }
    


    // Método para mostrar textos asociados a un nivel específico
    public function verTextoPorNivel($id_nivel)
    {
        $textos = Texto::where('id_nivel', $id_nivel)->get();

        // Devuelve una vista o JSON con los textos para el nivel
        return response()->json(['textos' => $textos]);
    }

    
    
    public function Grupo()
    {
        $grupos = Grupo::all(); // Obtiene todos los grupos
        $horarios = Horario::all(); // Obtiene todos los horarios

        return view('Academico.Grupo', compact('grupos', 'horarios')); // Pasa los grupos y horarios a la vista
    }

    public function eliminarGrupo($id)
    {
        $grupo = Grupo::findOrFail($id); // Encuentra el grupo por ID o lanza un error 404
        $grupo->delete(); // Elimina el grupo
        return redirect()->route('Grupo')->with('success', 'Grupo eliminado exitosamente.'); // Redirige a la lista de grupos
    }
      // Registra un nuevo grupo
      // Registra un nuevo grupo
      public function registrarGrupo(Request $request)
      {
          // Validación de datos
          $validatedData = $request->validate([
              'nombre' => 'required|string|max:255',
              'estado' => 'required|string|max:255',
              'nombre_docente' => 'required|string|max:255',
              'idioma' => 'required|string|max:255',
              'fecha_creacion' => 'required|date',
          ]);
  
          // Crea un nuevo grupo
          $grupo = Grupo::create($validatedData);
  
          // Obtener la hora actual en Bolivia
          $horaBolivia = Carbon::now('America/La_Paz');
  
          // Guardar el registro en la tabla bitacoras
          Bitacora::create([
              'actividad' => 'Registrar Grupo',
              'nombre_usuario' => auth::user()->nombre, // Suponiendo que el usuario está autenticado
              'fecha' => $horaBolivia->toDateString(), // Fecha en Bolivia
              'hora' => $horaBolivia->toTimeString(), // Hora en Bolivia
              'rol_usuario' => auth::user()->rol, // Rol del usuario autenticado
          ]);
  
          // Redirige con un mensaje de éxito
          return redirect()->route('Grupo')->with('success', 'Grupo registrado exitosamente.');
      }
  
    public function mostrarHorarios($id): JsonResponse
    {
        $horarios = Horario::where('idgrupo', $id)->get();
    
        if ($horarios->isEmpty()) {
            return response()->json(['message' => 'No se encontraron horarios para este grupo.'], 404);
        }
    
        return response()->json($horarios);
    }
    public function registrarHorario(Request $request)
    {
        $validatedData = $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'dia' => 'required|string',
            'hora' => 'required|date_format:H:i',
            'aula' => 'required|string',
        ]);
    
        // Crear el nuevo horario
        $horario = Horario::create([
            'idgrupo' => $validatedData['grupo_id'],
            'dia' => $validatedData['dia'],
            'hora' => $validatedData['hora'],
            'aula' => $validatedData['aula'],
        ]);
    
        // Obtener la hora actual en Bolivia
        $horaBolivia = Carbon::now('America/La_Paz');
    
        // Comprobar si el usuario está autenticado
        if (Auth::check()) {
            Bitacora::create([
                'actividad' => 'Registrar Horario',
                'nombre_usuario' => Auth::user()->nombre,
                'fecha' => $horaBolivia->toDateString(),
                'hora' => $horaBolivia->toTimeString(),
                'rol_usuario' => Auth::user()->rol,
            ]);
        } else {
            // Manejar el caso cuando no hay usuario autenticado
            // Puedes registrar una actividad como "Usuario no autenticado" o manejarlo de otra manera
        }
    
        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Horario registrado con éxito.');
    }
    public function store(Request $request)
{
    // Validar los datos recibidos
    $request->validate([
        'dia' => 'required|string',
        'hora' => 'required|date_format:H:i',
        'aula' => 'required|string',
        'grupo_id' => 'required|exists:grupos,id', // Asegúrate de que el grupo existe
    ]);

    // Crear el nuevo horario
    $horario = Horario::create([
        'dia' => $request->input('dia'),
        'hora' => $request->input('hora'),
        'aula' => $request->input('aula'),
        'idgrupo' => $request->input('grupo_id'),
    ]);

    // Obtener la hora actual en Bolivia
    $horaBolivia = Carbon::now('America/La_Paz');

    // Obtener usuario autenticado o usar un valor por defecto
    $usuario = Auth::user();
    $nombreUsuario = $usuario ? $usuario->nombre : 'Usuario no autenticado';
    $rolUsuario = $usuario ? $usuario->rol : 'Desconocido';

    // Guardar el registro en la tabla bitacoras
    Bitacora::create([
        'actividad' => 'Registrar Horario',
        'nombre_usuario' => $nombreUsuario,
        'fecha' => $horaBolivia->toDateString(),
        'hora' => $horaBolivia->toTimeString(),
        'rol_usuario' => $rolUsuario,
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('horarios.index')->with('success', 'Horario registrado con éxito.');
}




    public function ConvenioA(){
        $convenios = Convenios::all(); // Obtiene todos los convenios
        return view('Administracion.ConvenioA', compact('convenios')); // Pasa los convenios a la vista
    }
    public function Bitacora() {
        // Obtener todas las entradas de la tabla bitacora
        $bitacoras = Bitacora::all();
        // Retornar la vista y pasar los datos de la bitácora
        return view('Administracion.Bitacora', compact('bitacoras')); // Pasar la variable a la vista
    }
    public function ConvenioD(){
        $convenios = Convenios::all(); // Obtiene todos los convenios
        return view('Administracion.ConvenioD', compact('convenios')); // Pasa los convenios a la vista
    }
    public function ConvenioE(){
        $convenios = Convenios::all(); // Obtiene todos los convenios
        return view('Administracion.ConvenioE', compact('convenios')); // Pasa los convenios a la vista
    }
    

       // Cambia el nombre de la función a eliminarConvenio
       public function eliminarConvenio($id) {
        $convenio = Convenios::find($id); // Busca el convenio por ID

        if ($convenio) {
            $convenio->delete(); // Elimina el convenio
            return redirect()->route('ConvenioA')->with('success', 'Convenio eliminado correctamente.'); // Redirige a la lista de convenios
        }

        return redirect()->route('ConvenioA')->with('error', 'Convenio no encontrado.'); // Mensaje de error si no se encuentra
    }
    
    public function registrarConvenio(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'instituto' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'fecha' => 'required|date',
        ]);

        // Crea un nuevo convenio
        $convenio = new Convenios();
        $convenio->nombre = $request->nombre;
        $convenio->instituto = $request->instituto;
        $convenio->descripcion = $request->descripcion;
        $convenio->ubicacion = $request->ubicacion;
        $convenio->fecha = $request->fecha;
        $convenio->save();

        // Establecer la zona horaria de Bolivia
        $horaBolivia = Carbon::now('America/La_Paz');

        // Registrar la creación del convenio en la bitácora
        Bitacora::create([
            'actividad' => 'Registro de Convenio',
            'nombre_usuario' => Auth::user()->nombre, // Nombre del usuario que registra
            'fecha' => $horaBolivia->toDateString(), // Fecha en Bolivia
            'hora' => $horaBolivia->toTimeString(), // Hora en Bolivia
            'rol_usuario' => Auth::user()->rol, // Rol del usuario que registra
            'id_usuario' => Auth::user()->id, // ID del usuario que registra
        ]);

        return redirect()->route('ConvenioA')->with('success', 'Convenio registrado correctamente.');
    }
    public function index() {
        // Obtener todas las entradas de la tabla bitacora
        $bitacoras = Bitacora::all();
        // Retornar la vista y pasar los datos de la bitácora
        return view('Administracion.Bitacora', compact('bitacoras')); // Asegúrate de que la vista sea la correcta
    }
    
}
