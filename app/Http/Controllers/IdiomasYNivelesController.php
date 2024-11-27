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

class IdiomasYNivelesController extends Controller
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

}
