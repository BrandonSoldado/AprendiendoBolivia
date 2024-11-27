<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios Registrados</title>
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
            overflow-x: hidden;
        }

        header {
            background-color: #00bcd4;
            color: white;
            text-align: center;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.7rem;
        }

        header .contact-info {
            display: flex;
            align-items: center;
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
            background-color: #00bcd4;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin-top: 30px;
            padding: 0 10px;
        }

        .profile-box {
            background-color: #008c9e;
            padding: 20px;
            width: 100%;
            max-width: 1200px;
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-box h2 {
            color: #fff;
            margin-bottom: 15px;
            font-size: 2rem;
        }

        .table-responsive {
            overflow-x: auto; /* Agrega desplazamiento horizontal */
            margin-top: 20px; /* Espacio entre el encabezado y la tabla */
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        th, td {
            word-wrap: break-word;
            padding: 8px;
            text-align: left;
            border: 1px solid white;
        }

        th {
            background-color: #00bcd4;
            color: white;
        }

        td {
            background-color: #f9f9f9;
            color: #000;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #d32f2f;
        }

        /* Estilos para móviles */
        @media (max-width: 768px) {
            .profile-box {
                width: 100%;
            }
            nav ul {
                flex-direction: row; /* Menú horizontal */
                justify-content: flex-start; /* Espacio uniforme entre elementos */
            }
            /* Hacer que la tabla sea desplazable horizontalmente en móviles */
            .profile-box table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            /* Reducción del tamaño del texto en celdas */
            th, td {
                font-size: 0.9rem;
                padding: 6px;
            }
        }
    </style>
</head>
<body>

    <!-- Encabezado -->
    <header>
        <div class="logo">Aprendiendo Bolivia</div>
        <div class="contact-info">
            <span>Mayor Información</span>
            <span>(+591) 78057839</span>
        </div>
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
            <li><a href="{{ url('/IdiomaModulo') }}">Idiomas</a></li>
            <li><a href="{{ url('/ConvenioA') }}">Convenios</a></li>
            <li><a href="{{ url('/Bitacora') }}">Bitacora</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Contenedor del perfil -->
    <div class="container">
        <div class="profile-box">
            <h2>Lista de Usuarios Registrados</h2>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Fecha Nacimiento</th>
                            <th>Rol</th>
                            <th>Registro</th>
                            <th>Código</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->ci }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->correo }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->direccion }}</td>
                            <td>{{ \Carbon\Carbon::parse($usuario->fecha_nacimiento)->format('d/m/Y') }}</td>
                            <td>{{ $usuario->rol ?? 'No tiene valor' }}</td>
                            <td>{{ $usuario->registro ?? 'No tiene valor' }}</td>
                            <td>{{ $usuario->codigo ?? 'No tiene valor' }}</td>

                            <!-- Botón de eliminar -->
                            <td>
                                <form action="{{ route('usuario.eliminar', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Realmente desea eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
