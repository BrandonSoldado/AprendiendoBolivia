<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupos Activos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f4f7f6;
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

        .container {
            padding: 20px;
            background-color: #fff;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .grupo {
            margin-bottom: 20px;
            border: 1px solid #00bcd4;
            padding: 15px;
            border-radius: 5px;
        }

        .grupo h2 {
            margin-bottom: 10px;
            color: #333;
        }

        .grupo button {
            background-color: #00bcd4;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .grupo button:hover {
            background-color: #0097a7;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 8px;
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
            cursor: pointer;
        }
        .modal-content form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modal-content input, .modal-content select {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal-content button {
            background-color: #00bcd4;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #0097a7;
        }

        @media (max-width: 768px) {
            header .logo {
                font-size: 1.5rem;
            }

            nav ul {
                flex-direction: row;
                justify-content: flex-start;
            }

            .grupo button {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">Aprendiendo Bolivia</div>
</header>

<nav>
    <ul>
        <li><a href="{{ url('/PrincipalD') }}">Inicio</a></li>
        <li><a href="#">Grupos</a></li>
        <li><a href="#">Pago</a></li>
        <li><a href="{{ url('/MostrarUsuario') }}">Usuarios</a></li>
        <li><a href="{{ url('/RegistroUsuario') }}">Registrar Usuario</a></li>
        <li><a href="{{ url('/PerfilD') }}">Perfil</a></li>
        <li><a href="#">Idiomas</a></li>
        <li><a href="{{ url('/ConvenioD') }}">Convenios</a></li>
        <li><button onclick="showModal('registrar-parcial-modal')">Registrar Parcial</button></li>
        <li><button onclick="showModal('registrar-asistencia-modal')">Registrar Asistencia</button></li>
        <li><button onclick="showModal('registrar-tarea-modal')">Registrar Tarea</button></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Cerrar Sesión</button>
            </form>
        </li>
    </ul>
</nav>

<!-- Modales -->
<div id="registrar-parcial-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('registrar-parcial-modal')">&times;</span>
        <h3>Registrar Parcial</h3>
        <form method="POST" action="{{ route('parcial.store') }}">
            @csrf
            <label for="id_grupo">ID del Grupo</label>
            <input type="text" id="id_grupo" name="id_grupo" required>

            <label for="nombreParcial">Nombre del Parcial</label>
            <input type="text" id="nombreParcial" name="nombreParcial" required>

            <label for="fechaParcial">Fecha del Parcial</label>
            <input type="date" id="fechaParcial" name="fechaParcial" required>

            <label for="notaParcial">Nota</label>
            <input type="number" id="notaParcial" name="notaParcial" step="0.1" required>

            <button type="submit">Registrar</button>
            <button type="button" onclick="closeModal('registrar-parcial-modal')">Cancelar</button>
        </form>
    </div>
</div>

<div id="registrar-asistencia-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('registrar-asistencia-modal')">&times;</span>
        <h3>Registrar Asistencia</h3>
        <form method="POST" action="{{ route('asistencia.store') }}">
            @csrf
            <label for="id_grupo">ID del Grupo</label>
            <input type="text" id="id_grupo" name="id_grupo" required>

            <label for="fechaAsistencia">Fecha de Asistencia</label>
            <input type="date" id="fechaAsistencia" name="fechaAsistencia" required>

            <label for="estadoAsistencia">Estado de Asistencia</label>
            <select id="estadoAsistencia" name="estadoAsistencia" required>
                <option value="Presente">Presente</option>
                <option value="Ausente">Ausente</option>
                <option value="Justificado">Justificado</option>
            </select>

            <button type="submit">Registrar</button>
            <button type="button" onclick="closeModal('registrar-asistencia-modal')">Cancelar</button>
        </form>
    </div>
</div>

<div id="registrar-tarea-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('registrar-tarea-modal')">&times;</span>
        <h3>Registrar Tarea</h3>
        <form method="POST" action="{{ route('tarea.store') }}">
            @csrf
            <label for="id_grupo">ID del Grupo</label>
            <input type="text" id="id_grupo" name="id_grupo" required>

            <label for="nombreTarea">Nombre de la Tarea</label>
            <input type="text" id="nombreTarea" name="nombreTarea" required>

            <label for="fechaEntrega">Fecha de Entrega</label>
            <input type="date" id="fechaEntrega" name="fechaEntrega" required>

            <button type="submit">Registrar</button>
            <button type="button" onclick="closeModal('registrar-tarea-modal')">Cancelar</button>
        </form>
    </div>
</div>

<div class="container">
    <h1>Grupos Activos</h1>
    @foreach($grupos as $grupo)
        <div class="grupo">
            <h2>{{ $grupo->nombre }}</h2>
            <button onclick="showModal('parciales-modal-{{ $grupo->id }}')">Parciales</button>
            <button onclick="showModal('asistencias-modal-{{ $grupo->id }}')">Asistencias</button>
            <button onclick="showModal('tareas-modal-{{ $grupo->id }}')">Tareas</button>
        </div>

        <!-- Modal para Parciales -->
        <div id="parciales-modal-{{ $grupo->id }}" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('parciales-modal-{{ $grupo->id }}')">&times;</span>
                <h3>Parciales del Grupo: {{ $grupo->nombre }}</h3>
                @foreach($grupo->parciales as $parcial)
                    <p>{{ $parcial->tipo }} - Nota: {{ $parcial->nota }} - Fecha: {{ $parcial->fecha }}</p>
                @endforeach
            </div>
        </div>

        <!-- Modal para Asistencias -->
        <div id="asistencias-modal-{{ $grupo->id }}" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('asistencias-modal-{{ $grupo->id }}')">&times;</span>
                <h3>Asistencias del Grupo: {{ $grupo->nombre }}</h3>
                @foreach($grupo->asistencias as $asistencia)
                    <p>Fecha: {{ $asistencia->fecha }} - Estado: {{ $asistencia->estado }}</p>
                @endforeach
            </div>
        </div>

        <!-- Modal para Tareas -->
        <div id="tareas-modal-{{ $grupo->id }}" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('tareas-modal-{{ $grupo->id }}')">&times;</span>
                <h3>Tareas del Grupo: {{ $grupo->nombre }}</h3>
                @foreach($grupo->tareas as $tarea)
                    <p>Fecha: {{ $tarea->fecha }} - Estado: {{ $tarea->estado }}</p>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<script>
    function showModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }
</script>

</body>
</html>
