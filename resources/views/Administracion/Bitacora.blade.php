<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitácora de Actividades - Restaurante</title>
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

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0; /* Espaciado entre el encabezado y la tabla */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Contenedor para la tabla con desplazamiento */
        .table-container {
            overflow-y: auto; /* Permitir desplazamiento vertical */
            max-height: 400px; /* Altura máxima para el contenedor */
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
            <li><a href="{{ url('/Grupo') }}">Grupos</a></li>
            <li><a href="#">Pago</a></li>
            <li><a href="{{ url('/MostrarUsuario') }}">Usuarios</a></li>
            <li><a href="{{ url('/RegistroUsuario') }}">Registrar Usuario</a></li>
            <li><a href="{{ url('/PerfilA') }}">Perfil</a></li>
            <li><a href="#">Idiomas</a></li>
            <li><a href="{{ url('/ConvenioA') }}">Convenios</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Tabla de Bitácora -->
    <h2 style="text-align: center; margin: 20px 0;">Bitácora de Actividades</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Actividad</th>
                    <th>Nombre de Usuario</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Rol de Usuario</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bitacoras as $bitacora)
                    <tr>
                        <td>{{ $bitacora->id }}</td>
                        <td>{{ $bitacora->actividad }}</td>
                        <td>{{ $bitacora->nombre_usuario }}</td>
                        <td>{{ $bitacora->fecha }}</td>
                        <td>{{ $bitacora->hora }}</td>
                        <td>{{ $bitacora->rol_usuario }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
