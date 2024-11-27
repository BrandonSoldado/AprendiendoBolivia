<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla Restaurante</title>
    <style>
        /* Estilos generales */
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

        /* Estilos de la tabla */
        .table-container {
            overflow-x: auto;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Ventanas modales */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            header .logo {
                font-size: 1.5rem;
            }

            nav ul {
                flex-direction: row; /* Menú horizontal */
                justify-content: flex-start; /* Espacio uniforme entre elementos */
            }
        }
    </style>
    <script>
        function confirmDelete(event) {
            if (!confirm("¿Estás seguro de que deseas eliminar este grupo?")) {
                event.preventDefault();
            }
        }

        function openModal() {
            document.getElementById('myModal').style.display = 'block';
        }

        function openHorarioModal(grupoId) {
            fetch(`/grupos/${grupoId}/horarios`)
                .then(response => response.json())
                .then(data => {
                    const horarioList = document.getElementById('horarioList');
                    horarioList.innerHTML = '';
                    data.forEach(horario => {
                        const listItem = document.createElement('li');
                        listItem.textContent = `${horario.dia} - ${horario.hora} - Aula: ${horario.aula}`;
                        horarioList.appendChild(listItem);
                    });
                    document.getElementById('horarioModal').style.display = 'block';
                });
        }

        function openRegistrarHorarioModal() {
            document.getElementById('registrarHorarioModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
            document.getElementById('horarioModal').style.display = 'none';
            document.getElementById('registrarHorarioModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target === document.getElementById('myModal') || 
                event.target === document.getElementById('horarioModal') || 
                event.target === document.getElementById('registrarHorarioModal')) {
                closeModal();
            }
        }
    </script>
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
            <li><a href="#" onclick="openModal()">Registrar Grupo</a></li>
            <li><a href="#" onclick="openRegistrarHorarioModal()">Registrar Horario</a></li>
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

    <!-- Sección para mostrar grupos -->
    <main>
        <h2>Lista de Grupos</h2>

        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Nombre Docente</th>
                        <th>Idioma</th>
                        <th>Fecha de Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grupos as $grupo)
                        <tr>
                            <td>{{ $grupo->nombre }}</td>
                            <td>{{ $grupo->estado }}</td>
                            <td>{{ $grupo->nombre_docente }}</td>
                            <td>{{ $grupo->idioma }}</td>
                            <td>{{ $grupo->fecha_creacion }}</td>
                            <td>
                                <form action="{{ route('Grupo.eliminar', $grupo->id) }}" method="POST" style="display: inline;" onsubmit="confirmDelete(event);">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="color: red; border: none; background: none; cursor: pointer;">Eliminar</button>
                                </form>
                                <button type="button" onclick="openHorarioModal({{ $grupo->id }})" style="border: none; background: none; color: blue; cursor: pointer;">Horario</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <!-- Ventana Modal para Registrar Grupo -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <h3>Registrar Grupo</h3>
            <form action="{{ route('grupo.store') }}" method="POST">
                @csrf
                <label for="nombre">Nombre del Grupo:</label><br>
                <input type="text" id="nombre" name="nombre" required><br><br>
                <label for="nombre_docente">Nombre del Docente:</label><br>
                <input type="text" id="nombre_docente" name="nombre_docente" required><br><br>
                <label for="idioma">Idioma:</label><br>
                <input type="text" id="idioma" name="idioma" required><br><br>
                <label for="estado">Estado:</label><br>
                <input type="text" id="estado" name="estado" required><br><br>
                <label for="fecha_creacion">Fecha de Creación:</label><br>
                <input type="date" id="fecha_creacion" name="fecha_creacion" required><br><br>
                <input type="submit" value="Registrar">
                <button type="button" onclick="closeModal()">Cancelar</button>
            </form>
        </div>
    </div>

    <!-- Ventana Modal para Mostrar Horarios -->
    <div id="horarioModal" class="modal">
        <div class="modal-content">
            <h3>Horarios del Grupo</h3>
            <ul id="horarioList"></ul>
            <button type="button" onclick="closeModal()">Cerrar</button>
        </div>
    </div>

    <!-- Ventana Modal para Registrar Horario -->
    <div id="registrarHorarioModal" class="modal">
        <div class="modal-content">
            <h3>Registrar Horario</h3>
            <form action="{{ route('horario.store') }}" method="POST">
                @csrf
                <label for="grupo_id">Seleccionar Grupo:</label><br>
                <select name="grupo_id" id="grupo_id" required>
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                    @endforeach
                </select><br><br>
                <label for="dia">Día:</label><br>
                <input type="text" id="dia" name="dia" required><br><br>
                <label for="hora">Hora:</label><br>
                <input type="text" id="hora" name="hora" required><br><br>
                <label for="aula">Aula:</label><br>
                <input type="text" id="aula" name="aula" required><br><br>
                <input type="submit" value="Registrar">
                <button type="button" onclick="closeModal()">Cancelar</button>
            </form>
        </div>
    </div>

</body>
</html>
