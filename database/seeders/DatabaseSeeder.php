<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Convenio;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('parciales')->insert([
            [
                'id_grupo' => 6,
                'nota' => 85.50,
                'tipo' => 'Parcial 1',
                'fecha' => '2024-03-10',
                'nombre_estudiante' => 'Juan Pérez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 6,
                'nota' => 90.75,
                'tipo' => 'Parcial 2',
                'fecha' => '2024-03-15',
                'nombre_estudiante' => 'Juan Pérez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 6,
                'nota' => 78.00,
                'tipo' => 'Parcial 3',
                'fecha' => '2024-04-05',
                'nombre_estudiante' => 'María García',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 7,
                'nota' => 88.25,
                'tipo' => 'Parcial 1',
                'fecha' => '2024-04-20',
                'nombre_estudiante' => 'Carlos Rodríguez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 7,
                'nota' => 92.50,
                'tipo' => 'Parcial 1',
                'fecha' => '2024-04-22',
                'nombre_estudiante' => 'Carlos Rodríguez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 7,
                'nota' => 76.80,
                'tipo' => 'Parcial 1',
                'fecha' => '2024-05-01',
                'nombre_estudiante' => 'Ana Martínez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        

        DB::table('asistencias')->insert([
            [
                'id_grupo' => 6,
                'fecha' => '2024-03-10',
                'estado' => 'Presente',
                'nombre_estudiante' => 'Juan Pérez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 6,
                'fecha' => '2024-03-15',
                'estado' => 'Ausente',
                'nombre_estudiante' => 'Juan Pérez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 6,
                'fecha' => '2024-04-05',
                'estado' => 'Presente',
                'nombre_estudiante' => 'María García',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 7,
                'fecha' => '2024-04-20',
                'estado' => 'Presente',
                'nombre_estudiante' => 'Carlos Rodríguez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 7,
                'fecha' => '2024-04-22',
                'estado' => 'Ausente',
                'nombre_estudiante' => 'Carlos Rodríguez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 7,
                'fecha' => '2024-05-01',
                'estado' => 'Presente',
                'nombre_estudiante' => 'Ana Martínez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('tareas')->insert([
            [
                'id_grupo' => 7,
                'fecha' => '2024-03-10',
                'estado' => 'Pendiente',
                'nombre_estudiante' => 'Juan Pérez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 7,
                'fecha' => '2024-03-15',
                'estado' => 'Completada',
                'nombre_estudiante' => 'Juan Pérez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 7,
                'fecha' => '2024-04-05',
                'estado' => 'Pendiente',
                'nombre_estudiante' => 'María García',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 6,
                'fecha' => '2024-04-10',
                'estado' => 'Completada',
                'nombre_estudiante' => 'Juan Pérez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 6,
                'fecha' => '2024-04-15',
                'estado' => 'Pendiente',
                'nombre_estudiante' => 'María García',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_grupo' => 6,
                'fecha' => '2024-04-20',
                'estado' => 'Completada',
                'nombre_estudiante' => 'Juan Pérez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
        DB::table('historiales')->insert([
            [
                'modalidad_aprobacion' => 'Aprobado normal',
                'nota' => 85.5,
                'modulo' => 'A1 Ingles',
                'nombre_estudiante' => 'Juan Pérez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'modalidad_aprobacion' => 'Aprobado normal',
                'nota' => 92.0,
                'modulo' => 'A2 Ingles',
                'nombre_estudiante' => 'Ana Gómez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'modalidad_aprobacion' => 'Aprobado normal',
                'nota' => 78.5,
                'modulo' => 'A1 Frances',
                'nombre_estudiante' => 'Carlos Ramírez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'modalidad_aprobacion' => 'Aprobado normal',
                'nota' => 88.0,
                'modulo' => 'A1 Frances',
                'nombre_estudiante' => 'Ana Gómez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'modalidad_aprobacion' => 'Aprobado Placement Tests',
                'nota' => 74.5,
                'modulo' => 'B2 Frances',
                'nombre_estudiante' => 'Luis Martínez',
                'created_at' => now(),
                'updated_at' => now(),
            ],
]);
        


    }
       

}
