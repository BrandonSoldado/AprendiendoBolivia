<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla Restaurante</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #00bcd4;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
        }

        header .logo {
            font-size: 1.7rem;
        }

        nav {
            background-color: white;
            padding: 5px;
            overflow-x: auto; /* Permitir el desplazamiento horizontal */
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center; /* Menú centrado */
            align-items: center; /* Centrar verticalmente las opciones */
            gap: 20px; /* Espacio entre las opciones */
            margin: 0;
            padding: 0;
            font-size: 1.0rem; /* Tamaño de la fuente */
        }

        nav ul li a {
            color: black; /* Color del texto */
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        nav ul li:hover {
            background-color: #00bcd4; /* Cambia el color al pasar el mouse */
        }

        nav li form {
            display: inline; /* Mantiene el botón en línea con el texto */
            margin: 0;
            padding: 0;
            color: black;
        }

        nav li form button {
            background: none; /* Sin fondo */
            border: none; /* Sin borde */
            color: black; /* Color del texto del botón */
            cursor: pointer; /* Cambiar cursor al pasar por encima */
            font-size: inherit; /* Hereda el tamaño de la fuente */
            padding: 10px; /* Padding para alinear */
        }

        nav li form button:hover {
            background-color: #00bcd4; /* Color de fondo al pasar el mouse */
            color: white; /* Cambiar el color del texto al pasar el mouse */
        }

        /* Estilos para dispositivos móviles */
        @media (max-width: 768px) {
            header .logo {
                font-size: 1.5rem; /* Tamaño de fuente más pequeño en móvil */
            }

            nav ul {
                flex-direction: row; /* Menú horizontal */
                justify-content: flex-start; /* Espacio uniforme entre elementos */
            }
        }
        /* Estilos para la tabla */
table {
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
    background-color: #f9f9f9;
}

th, td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

th {
    background-color: #00bcd4;
    color: white;
    font-size: 1.1rem;
}

td {
    font-size: 1rem;
}

tr:nth-child(even) {
    background-color: #f2f2f2; /* Fila de color alterno */
}

tr:hover {
    background-color: #e0f7fa; /* Resaltar fila al pasar el mouse */
}

/* Agregar espaciado a la tabla */
table {
    margin-top: 20px;
}

/* Estilo para los encabezados de la tabla */
thead {
    background-color: #00bcd4;
    color: white;
}

        /* Estilos para el Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
        }

        .modal-content input, .modal-content select, .modal-content button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 1rem;
        }

        .modal-content button {
            background-color: #00bcd4;
            color: white;
            border: none;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #0097a7;
        }

        .modal-content .cancelar {
            background-color: #f44336;
        }

    </style>
</head>
<body>

    <!-- Encabezado -->
    <header>
        <div class="logo">Aprendiendo Bolivia</div>
    </header>

    <!-- Menú de navegación -->
    <nav>
        <ul>
            <li><a href="{{ url('/PrincipalA') }}">Inicio</a></li>
            <li><a href="#">Grupos</a></li>
            <li><a href="#">Pago</a></li>
            <li><a href="{{ url('/MostrarUsuario') }}">Usuarios</a></li>
            <li><a href="{{ url('/RegistroUsuario') }}">Registrar Usuario</a></li>
            <li><a href="{{ url('/PerfilA') }}">Perfil</a></li>
            <li><a href="#">Idiomas</a></li>
            <li><a href="{{ url('/Convenio') }}">Convenios</a></li>
            <li><a href="javascript:void(0);" id="btnRegistrarHistorial">Registrar Historial</a></li>

            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Modal para registrar historial -->
    <div class="modal" id="modalHistorial">
        <div class="modal-content">
            <h3>Registrar Historial</h3>
            <form action="{{ route('RegistrarHistorial.store') }}" method="POST">
    @csrf
    <input type="text" name="nombre_estudiante" placeholder="Nombre Estudiante" required>
    <input type="text" name="modalidad_aprobacion" placeholder="Modalidad Aprobación" required>
    <input type="text" name="modulo" placeholder="Módulo" required>
    <input type="number" name="nota" step="0.1" placeholder="Nota" required>
    <button type="submit">Registrar</button>
    <button type="button" class="cancelar" id="btnCancelar">Cancelar</button>
</form>
        </div>
    </div>

    <script>
        // Obtener los elementos
        const modal = document.getElementById('modalHistorial');
        const btnRegistrarHistorial = document.getElementById('btnRegistrarHistorial');
        const btnCancelar = document.getElementById('btnCancelar');

        // Mostrar el modal
        btnRegistrarHistorial.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        // Cerrar el modal
        btnCancelar.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Cerrar el modal si se hace clic fuera del contenido
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
    <table>
    <thead>
        <tr>
            <th>Nombre Estudiante</th>
            <th>Modalidad Aprobación</th>
            <th>Módulo</th>
            <th>Nota</th>
        </tr>
    </thead>
    <tbody>
        @foreach($historiales as $historial)
            <tr>
                <td>{{ $historial->nombre_estudiante }}</td>
                <td>{{ $historial->modalidad_aprobacion }}</td>
                <td>{{ $historial->modulo }}</td>
                <td>{{ $historial->nota }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
