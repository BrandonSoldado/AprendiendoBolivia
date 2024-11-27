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
            overflow-x: auto;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 0;
            padding: 0;
            font-size: 1.0rem;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        nav ul li:hover {
            background-color: #00bcd4;
        }

        nav li form {
            display: inline;
            margin: 0;
            padding: 0;
            color: black;
        }

        nav li form button {
            background: none;
            border: none;
            color: black;
            cursor: pointer;
            font-size: inherit;
            padding: 10px;
        }

        nav li form button:hover {
            background-color: #00bcd4;
            color: white;
        }

        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        h2 {
            margin-bottom: 10px;
            color: #00bcd4;
            border-bottom: 2px solid #00bcd4;
            padding-bottom: 5px;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .niveles {
            display: none; /* Ocultar inicialmente los niveles */
            margin-top: 10px;
            padding: 10px;
            background-color: #e0f7fa;
            border: 1px solid #00bcd4;
            border-radius: 5px;
        }

        /* Estilos del modal */
        .modal {
            display: none; /* Ocultar inicialmente el modal */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .button-group {
            display: flex;
            justify-content: space-between; /* Espaciado entre los botones */
            margin-top: 15px; /* Espacio arriba de los botones */
        }

        .button-group button {
            flex: 1; /* Cada botón ocupa el mismo espacio */
            margin-right: 10px; /* Espacio a la derecha entre botones */
        }

        .button-group button:last-child {
            margin-right: 0; /* Elimina el margen derecho del último botón */
        }

        @media (max-width: 768px) {
            header .logo {
                font-size: 1.5rem;
            }

            nav ul {
                flex-direction: row;
                justify-content: flex-start;
            }
        }
    </style>
    <script>
        function toggleNiveles(id) {
            const nivelesDiv = document.getElementById(`niveles-${id}`);
            nivelesDiv.style.display = nivelesDiv.style.display === 'none' ? 'block' : 'none';
        }

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
    </script>
</head>
<body>

    <header>
        <div class="logo">Aprendiendo Bolivia</div>
    </header>

    <nav>
        <ul>
            <li><a href="{{ url('/PrincipalA') }}">Inicio</a></li>
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
            <li><a href="javascript:void(0);" onclick="openModal('idiomaModal')">Registrar Idioma</a></li>
            <li><a href="javascript:void(0);" onclick="openModal('moduloModal')">Registrar Módulo</a></li>
        </ul>
    </nav>

    <!-- Modal para Registro de Idioma -->
    <div id="idiomaModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('idiomaModal')">&times;</span>
            <h2>Registrar Idioma</h2>
            <form action="{{ url('/RegistroIdioma') }}" method="POST">
                @csrf
                <label for="idiomaNombre">Nombre del Idioma:</label>
                <input type="text" id="idiomaNombre" name="nombre" required>

                <div class="button-group">
                    <button type="submit">Registrar</button>
                    <button type="button" onclick="closeModal('idiomaModal')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para Registro de Módulo -->
    <div id="moduloModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('moduloModal')">&times;</span>
            <h2>Registrar Módulo</h2>
            <form action="{{ url('/RegistroModulo') }}" method="POST">
                @csrf
                <label for="moduloNombre">Nombre del Módulo:</label>
                <input type="text" id="moduloNombre" name="nombre" required>

                <label for="moduloDescripcion">Descripción (opcional):</label>
                <textarea id="moduloDescripcion" name="descripcion"></textarea>

                <div class="button-group">
                    <button type="submit">Registrar</button>
                    <button type="button" onclick="closeModal('moduloModal')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sección para mostrar idiomas y módulos -->
    <div class="content">
        <h2>Idiomas</h2>
        <ul>
            @foreach($idiomas as $idioma)
                <li class="card">
                    <strong>{{ $idioma->nombre }}</strong>
                    <button onclick="toggleNiveles({{ $idioma->id }})">Mostrar Niveles</button>
                    <div id="niveles-{{ $idioma->id }}" class="niveles" style="display:none;">
                        <ul>
                            @foreach($idioma->niveles as $nivel)
                                <li>{{ $nivel->descripcion }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="{{ route('idiomas.destroy', $idioma->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este idioma?');">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h2>Módulos</h2>
        <ul>
            @foreach($modulos as $modulo)
                <li class="card">
                    <strong>{{ $modulo->nombre }}</strong> - {{ $modulo->descripcion }}
                    <form action="{{ route('modulos.destroy', $modulo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este módulo?');">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
    
</body>
</html>
