<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convenios Disponibles</title>
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

            /* Hacer que la tabla tenga desplazamiento en dispositivos móviles */
            .table-container {
                overflow-x: auto; /* Permitir desplazamiento horizontal */
            }
        }

        /* Estilos de tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* Espacio entre el menú y la tabla */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #00bcd4;
            color: white;
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

    <!-- Botón para abrir el modal -->
    <div style="margin-top: 20px; display: flex; justify-content: flex-start;">
        <button id="abrirModal" style="padding: 5px 10px;">Registrar Convenio</button>
    </div>

    <!-- Modal -->
<div id="modalRegistro" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background: white; padding: 20px; border-radius: 5px; width: 300px;">
        <h2>Registrar Convenio</h2>
        <form id="formRegistro" action="{{ url('/convenio/registrar') }}" method="POST">
            @csrf
            <label for="nombre" style="display: block; margin-bottom: 5px;">Nombre:</label>
            <input type="text" name="nombre" required style="width: 100%;"><br><br>
            <label for="instituto" style="display: block; margin-bottom: 5px;">Instituto:</label>
            <input type="text" name="instituto" required style="width: 100%;"><br><br>
            <label for="descripcion" style="display: block; margin-bottom: 5px;">Descripción:</label>
            <input type="text" name="descripcion" required style="width: 100%;"><br><br>
            <label for="ubicacion" style="display: block; margin-bottom: 5px;">Ubicación:</label>
            <input type="text" name="ubicacion" required style="width: 100%;"><br><br>
            <label for="fecha" style="display: block; margin-bottom: 5px;">Fecha:</label>
            <input type="date" name="fecha" required style="width: 100%;"><br><br>
            <div style="display: flex; justify-content: center; gap: 20px;"> <!-- Flex para centrar y gap para separación -->
                <button type="submit">Registrar</button>
                <button type="button" id="cerrarModal">Cancelar</button>
            </div>
        </form>
    </div>
</div>


    <!-- Script para manejar el modal -->
    <script>
        document.getElementById('abrirModal').onclick = function() {
            document.getElementById('modalRegistro').style.display = 'flex';
        };
        document.getElementById('cerrarModal').onclick = function() {
            document.getElementById('modalRegistro').style.display = 'none';
        };
    </script>

    <h1>Convenios Disponibles</h1>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Instituto</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Fecha</th>
                    <th>Acciones</th> <!-- Columna de acciones -->
                </tr>
            </thead>
            <tbody>
                @foreach($convenios as $convenio)
                <tr>
                    <td>{{ $convenio->nombre }}</td>
                    <td>{{ $convenio->instituto }}</td>
                    <td>{{ $convenio->descripcion }}</td>
                    <td>{{ $convenio->ubicacion }}</td>
                    <td>{{ $convenio->fecha }}</td>
                   <td>
    <form action="{{ route('convenio.eliminar', $convenio->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este convenio?');">Eliminar</button>
    </form>
</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
