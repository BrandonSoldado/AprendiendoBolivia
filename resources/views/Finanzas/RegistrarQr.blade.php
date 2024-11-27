<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Códigos QR</title>
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

        .qr-list {
            margin-top: 20px;
            padding: 0 20px;
        }

        .qr-item {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .qr-item img {
    width: 325px;   /* Nuevo tamaño de la imagen */
    height: 325px;  /* Nuevo tamaño de la imagen */
    object-fit: contain;
}

        .qr-item h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .qr-item p {
            margin: 5px 0;
        }

        .qr-item .monto {
            font-weight: bold;
            color: #00bcd4;
        }

        .qr-item .descripcion {
            font-style: italic;
        }

        /* Estilos para dispositivos móviles */
        @media (max-width: 768px) {
            header .logo {
                font-size: 1.5rem;
            }

            nav ul {
                flex-direction: row;
                justify-content: flex-start;
            }
        }

        /* Estilo para la ventana emergente */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 50px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
        }

        .modal-header {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .modal input, .modal textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal button {
            padding: 10px 20px;
            border: none;
            background-color: #00bcd4;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            margin: 5px;
        }

        .modal button:hover {
            background-color: #008c99;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            float: right;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
            <li><a href="#" id="btnRegisterQR">Registrar Código QR</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </nav>

     <!-- Lista de Códigos QR -->
    <div class="qr-list">
        @foreach($codigos as $codigo)
    <div class="qr-item">
        <h3>Código QR</h3>
        <!-- Mostrar la imagen a partir de base64 -->
        <img src="data:image/png;base64,{{ $codigo->codigo_qr }}" alt="Código QR">
        <p class="monto">Monto: Bs. {{ number_format($codigo->monto_dinero, 2) }}</p>
        <p class="descripcion">Descripción: {{ $codigo->descripcion }}</p>
    </div>
@endforeach
    </div>

    <!-- Ventana emergente para registrar código QR -->
    <div id="qrModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="modal-header">Registrar Código QR</div>
            <form action="{{ route('guardarCodigoQR') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="codigo_qr" required accept="image/*">
                <input type="number" name="monto_dinero" placeholder="Monto" required step="0.01">
                <textarea name="descripcion" placeholder="Descripción" required></textarea>
                <button type="submit">Registrar</button>
                <button type="button" id="btnCancel">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        // Obtener el modal
        var modal = document.getElementById("qrModal");

        // Obtener el botón que abre el modal
        var btn = document.getElementById("btnRegisterQR");

        // Obtener el <span> que cierra el modal
        var span = document.getElementsByClassName("close")[0];

        // Cuando el usuario hace clic en el botón, abrir el modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Cuando el usuario hace clic en <span> (x), cerrar el modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Cuando el usuario hace clic en el botón de cancelar
        document.getElementById("btnCancel").onclick = function() {
            modal.style.display = "none";
        }

        // Cuando el usuario hace clic fuera del modal, cerrarlo
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>
