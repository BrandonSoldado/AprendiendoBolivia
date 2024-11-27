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
use App\Models\Historial;

use App\Models\Parcial;
use App\Models\tarea;
use App\Models\Asistencia;



class AcademicoController extends Controller
{
     // Mostrar la vista con los historiales registrados
    // Mostrar todos los grupos activos
    public function MostrarPAT($id_grupo = null)
    {
        $query = Grupo::where('estado', 'Activo')
                      ->with(['parciales', 'asistencias', 'tareas']); // Cargar parciales, asistencias y tareas

        // Filtrar por grupo si se pasa el id_grupo
        if ($id_grupo) {
            $query->where('id', $id_grupo);
        }

        $grupos = $query->get(); // Obtener grupos activos con sus relaciones
        return view('Academico.MostrarPAT', compact('grupos')); // Pasar los grupos a la vista
    }

    // Mostrar los parciales de un grupo específico
    public function mostrarParciales($id_grupo)
    {
        $parciales = Parcial::where('id_grupo', $id_grupo)->get(); // Obtener parciales de un grupo
        return view('Academico.MostrarParciales', compact('parciales')); // Pasar los parciales a la vista
    }

    // Mostrar las asistencias de un grupo específico
    public function mostrarAsistencias($id_grupo)
    {
        $asistencias = Asistencia::where('id_grupo', $id_grupo)->get(); // Obtener asistencias de un grupo
        return view('Academico.MostrarAsistencias', compact('asistencias')); // Pasar las asistencias a la vista
    }

    // Mostrar las tareas de un grupo específico
    public function mostrarTareas($id_grupo)
    {
        $tareas = Tarea::where('id_grupo', $id_grupo)->get(); // Obtener tareas de un grupo
        return view('Academico.MostrarTareas', compact('tareas')); // Pasar las tareas a la vista
    }

    // Registrar nuevo parcial
    public function crearParcial(Request $request)
    {
        $request->validate([
            'id_grupo' => 'required|exists:grupos,id',
            'nota' => 'required|numeric|min:0|max:10',
            'tipo' => 'required|string',
            'fecha' => 'required|date',
            'nombre_estudiante' => 'required|string|max:255',
        ]);

        Parcial::create($request->all());
        return redirect()->route('MostrarPAT');
    }

    // Registrar nueva asistencia
    public function crearAsistencia(Request $request)
    {
        $request->validate([
            'id_grupo' => 'required|exists:grupos,id',
            'estado' => 'required|string',
            'fecha' => 'required|date',
            'nombre_estudiante' => 'required|string|max:255',
        ]);

        Asistencia::create($request->all());
        return redirect()->route('MostrarPAT');
    }

    // Registrar nueva tarea
    public function crearTarea(Request $request)
    {
        $request->validate([
            'id_grupo' => 'required|exists:grupos,id',
            'estado' => 'required|string',
            'fecha' => 'required|date',
            'nombre_estudiante' => 'required|string|max:255',
        ]);

        Tarea::create($request->all());
        return redirect()->route('MostrarPAT');
    }


    
 // Mostrar la vista con los historiales registrados
 public function MostrarHistoriales()
 {
     // Obtener todos los historiales desde la base de datos
     $historiales = Historial::all();
     
     // Pasar los historiales a la vista
     return view('Academico.MostrarHistoriales', compact('historiales'));
 }

 // Mostrar el formulario para registrar un nuevo historial
 public function RegistrarHistorial()
 {
     return view('Academico.RegistrarHistorial');
 }

 // Guardar un nuevo historial en la base de datos
 public function GuardarHistorial(Request $request)
 {
     $request->validate([
         'modalidad_aprobacion' => 'required|string|max:255',
         'nota' => 'required|numeric',
         'modulo' => 'required|string|max:255',
         'nombre_estudiante' => 'required|string|max:255',
     ]);

     Historial::create([
         'modalidad_aprobacion' => $request->modalidad_aprobacion,
         'nota' => $request->nota,
         'modulo' => $request->modulo,
         'nombre_estudiante' => $request->nombre_estudiante,
     ]);

     return redirect()->route('MostrarHistoriales')->with('success', 'Historial registrado correctamente.');
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
  
}
