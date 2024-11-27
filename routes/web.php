<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccesoController;
use App\Http\Controllers\AcademicoController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\IdiomasYNivelesController;
use App\Http\Controllers\Ciclo2Controller;
use App\Http\Controllers\FinanzasController;


Route::controller(FinanzasController::class)->group(function () {
    Route::get('/MostrarCodigosQr', 'MostrarCodigosQr')->name('MostrarCodigosQr');
    Route::post('/GuardarCodigoQr', 'GuardarCodigoQr')->name('guardarCodigoQR');
});



// Rutas de AcademicoController
Route::controller(AcademicoController::class)->group(function () {
    Route::get('/MostrarPAT', 'MostrarPAT')->name('MostrarPAT');
    Route::get('/mostrarParciales/{grupoId}', 'mostrarParciales')->name('mostrarParciales');
    Route::get('/mostrarAsistencias/{grupoId}', 'mostrarAsistencias')->name('mostrarAsistencias');
    Route::get('/mostrarTareas/{grupoId}', 'mostrarTareas')->name('mostrarTareas');
    Route::post('/crearParcial', 'crearParcial')->name('parcial.store');
    Route::post('/crearAsistencia', 'crearAsistencia')->name('asistencia.store');
    Route::post('/crearTarea', 'crearTarea')->name('tarea.store');


    Route::get('/MostrarHistoriales', 'MostrarHistoriales')->name('MostrarHistoriales'); // Ruta para mostrar los historiales
    Route::get('/RegistrarHistorial', 'RegistrarHistorial')->name('RegistrarHistorial'); // Ruta para mostrar el formulario de registro
    Route::post('/RegistrarHistorial', 'GuardarHistorial')->name('RegistrarHistorial.store'); // Ruta para guardar el historial


    Route::get('/Grupo', 'Grupo')->name('Grupo'); // Ruta para mostrar todos los grupos
    Route::post('/Grupo', 'registrarGrupo')->name('Grupo.store'); // Ruta para registrar un nuevo grupo
    Route::delete('/Grupo/{id}', 'eliminarGrupo')->name('Grupo.eliminar'); // Ruta para eliminar un grupo
    Route::get('/grupos', [Ciclo2Controller::class, 'Grupo'])->name('Grupo');
    Route::post('/grupo/store', [Ciclo2Controller::class, 'registrarGrupo'])->name('grupo.store');
    Route::delete('/grupo/{id}', [Ciclo2Controller::class, 'eliminarGrupo'])->name('Grupo.eliminar');
    
});

// Rutas de AdministracionController
Route::controller(AdministracionController::class)->group(function () {
    Route::get('/Grupo/{id}/horarios', 'mostrarHorarios')->name('Grupo.horarios'); // Ruta para obtener los horarios de un grupo
    Route::get('/grupos', [Ciclo2Controller::class, 'Grupo'])->name('Grupo');
    Route::post('/grupo/store', [Ciclo2Controller::class, 'registrarGrupo'])->name('grupo.store');
    Route::delete('/grupo/{id}', [Ciclo2Controller::class, 'eliminarGrupo'])->name('Grupo.eliminar');
    Route::get('/grupos/{id}/horarios', [Ciclo2Controller::class, 'mostrarHorarios']);
    Route::post('/horarios', [Ciclo2Controller::class, 'registrarHorario'])->name('horario.store');




    Route::get('/ConvenioA', 'ConvenioA')->name('ConvenioA'); // Añadir nombre a la ruta
    Route::get('/ConvenioD', 'ConvenioD')->name('ConvenioD'); // Opcional
    Route::get('/ConvenioE', 'ConvenioE')->name('ConvenioE'); // Opcional
    Route::delete('/convenio/{id}', 'eliminarConvenio')->name('convenio.eliminar'); // Ruta para eliminar un convenio
    Route::post('/convenio/registrar', [Ciclo2Controller::class, 'registrarConvenio'])->name('convenio.registrar');


    Route::get('/Bitacora', 'Bitacora')->name('Bitacora'); // Esta está llamando a la función Bitacora() que no pasa bitacoras
Route::get('/bitacora', [Ciclo2Controller::class, 'index'])->name('bitacora.index'); // Esta llama al método index() que sí pasa bitacoras
});

// Rutas de IdiomasYNivelesController
Route::controller(IdiomasYNivelesController::class)->group(function () {
    Route::get('/IdiomaModulo', [Ciclo2Controller::class, 'mostrarIdiomasYModulos']);
    Route::delete('/idiomas/{id}', 'eliminarIdioma')->name('idiomas.destroy');
    Route::delete('/modulos/{id}', 'eliminarModulo')->name('modulos.destroy');
    Route::post('/RegistroIdioma', 'registrarIdioma')->name('idioma.store'); // Ruta para registrar idioma
    Route::post('/RegistroModulo', 'registrarModulo')->name('modulo.store'); // Ruta para registrar módulo
    Route::get('/nivel/{id_nivel}/textos', [Ciclo2Controller::class, 'verTextoPorNivel'])->name('nivel.textos');
});



Route::controller(AccesoController::class)->group(function () {
    Route::get('/InicioSesion', 'InicioSesion');
    Route::post('/login', 'login')->name('login'); // Ruta para manejar el inicio de sesión
    Route::post('/logout', 'logout')->name('logout'); // Ruta para manejar el cierre de sesión
    Route::get('/PrincipalE', 'PrincipalE');
    Route::get('/PrincipalD', 'PrincipalD');
    Route::get('/Modificar', 'Modificar');
    Route::get('/PrincipalA', 'PrincipalA');
    Route::get('/PerfilE', 'PerfilE')->middleware('auth'); // Ruta para el perfil
    Route::get('/PerfilA', 'PerfilA')->middleware('auth'); // Ruta para el perfil
    Route::get('/PerfilD', 'PerfilD')->middleware('auth'); // Ruta para el perfil
    Route::get('/RegistroUsuario', 'RegistroUsuario');
    Route::get('/CambiarContraseña', 'CambiarContraseña');
    Route::post('/cambiar-contraseña', [AccesoController::class, 'cambiarPassword'])->name('cambiar.contraseña');
    Route::post('/registrar-usuario', [AccesoController::class, 'registrarUsuario'])->name('registrar.usuario');
    Route::get('/MostrarUsuario', [AccesoController::class, 'mostrarUsuarios'])->name('mostrar.usuarios');
    Route::delete('/usuario/eliminar/{id}', 'eliminarUsuario')->name('usuario.eliminar');
    Route::post('/usuario/modificar/{id}', [AccesoController::class, 'modificarUsuario'])->name('usuario.modificar');
});




















































Route::controller(Ciclo2Controller::class)->group(function () {
    Route::get('/IdiomaModulo', [Ciclo2Controller::class, 'mostrarIdiomasYModulos']);
    Route::delete('/idiomas/{id}', 'eliminarIdioma')->name('idiomas.destroy');
    Route::delete('/modulos/{id}', 'eliminarModulo')->name('modulos.destroy');
    Route::post('/RegistroIdioma', 'registrarIdioma')->name('idioma.store'); // Ruta para registrar idioma
    Route::post('/RegistroModulo', 'registrarModulo')->name('modulo.store'); // Ruta para registrar módulo
    Route::get('/nivel/{id_nivel}/textos', [Ciclo2Controller::class, 'verTextoPorNivel'])->name('nivel.textos');
    
    
    Route::get('/Grupo', 'Grupo')->name('Grupo'); // Ruta para mostrar todos los grupos
    Route::post('/Grupo', 'registrarGrupo')->name('Grupo.store'); // Ruta para registrar un nuevo grupo
    Route::delete('/Grupo/{id}', 'eliminarGrupo')->name('Grupo.eliminar'); // Ruta para eliminar un grupo
    
    Route::get('/Grupo/{id}/horarios', 'mostrarHorarios')->name('Grupo.horarios'); // Ruta para obtener los horarios de un grupo
    Route::get('/grupos', [Ciclo2Controller::class, 'Grupo'])->name('Grupo');
    Route::post('/grupo/store', [Ciclo2Controller::class, 'registrarGrupo'])->name('grupo.store');
    Route::delete('/grupo/{id}', [Ciclo2Controller::class, 'eliminarGrupo'])->name('Grupo.eliminar');
    Route::get('/grupos/{id}/horarios', [Ciclo2Controller::class, 'mostrarHorarios']);
    Route::post('/horarios', [Ciclo2Controller::class, 'registrarHorario'])->name('horario.store');




    Route::get('/ConvenioA', 'ConvenioA')->name('ConvenioA'); // Añadir nombre a la ruta
    Route::get('/ConvenioD', 'ConvenioD')->name('ConvenioD'); // Opcional
    Route::get('/ConvenioE', 'ConvenioE')->name('ConvenioE'); // Opcional
    Route::delete('/convenio/{id}', 'eliminarConvenio')->name('convenio.eliminar'); // Ruta para eliminar un convenio
    Route::post('/convenio/registrar', [Ciclo2Controller::class, 'registrarConvenio'])->name('convenio.registrar');


    Route::get('/Bitacora', 'Bitacora')->name('Bitacora'); // Esta está llamando a la función Bitacora() que no pasa bitacoras
Route::get('/bitacora', [Ciclo2Controller::class, 'index'])->name('bitacora.index'); // Esta llama al método index() que sí pasa bitacoras

});