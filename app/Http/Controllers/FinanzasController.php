<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Codigo;

class FinanzasController extends Controller
{
    public function MostrarCodigosQr(){
        $codigos = Codigo::all(); // Obtener todos los registros de codigos QR
        return view('Finanzas.RegistrarQr', compact('codigos'));
    }

// Función para guardar un nuevo código QR
public function GuardarCodigoQr(Request $request)
{
    // Validar los datos del formulario
    $validated = $request->validate([
        'codigo_qr' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
        'monto_dinero' => 'required|numeric',
        'descripcion' => 'required|string|max:255',
    ]);

    // Obtener el archivo de la imagen QR
    $image = $request->file('codigo_qr');

    // Leer el contenido de la imagen y convertirla a base64
    $imageData = file_get_contents($image); // Lee el contenido de la imagen
    $base64Image = base64_encode($imageData); // Convierte a base64

    // Crear el nuevo registro en la base de datos
    Codigo::create([
        'codigo_qr' => $base64Image, // Guardamos la cadena base64 en la base de datos
        'monto_dinero' => $request->monto_dinero,
        'descripcion' => $request->descripcion,
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('MostrarCodigosQr')->with('success', 'Código QR registrado exitosamente.');
}

}
