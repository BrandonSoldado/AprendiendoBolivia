<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
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

        header, footer {
            background-color: #00bcd4;
            color: white;
            text-align: center;
            padding: 15px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            font-size: 1.7rem;
            color: white;
        }

        header .contact-info {
            display: flex;
            align-items: center;
        }

        header .contact-info span {
            margin-right: 14px;
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
        }

        .profile-box {
            background-color: #008c9e;
            padding: 20px;
            width: 600px;
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-box h2 {
            color: #fff;
            margin-bottom: 15px;
            font-size: 2rem;
        }

        .user-info {
            color: #fff;
            font-size: 1rem;
            text-align: left;
        }

        .user-info label {
            color: #fff;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .user-info input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            color: #000;
            font-size: 0.9rem;
        }

        .user-info input:disabled {
            background-color: #e0e0e0;
        }

        /* Estilos responsivos para móvil */
        @media (max-width: 768px) {
            .profile-box {
                width: 90%;
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
        <div class="contact-info">
            <span>Mayor Información</span>
            <span> (+591) 78057839</span>
            <div class="social-icons"></div>
        </div>
    </header>

    <!-- Menú de navegación -->
    <nav>
        <ul>
            <li><a href="{{ url('/PrincipalE') }}">Inicio</a></li>
            <li><a href="#">Grupos</a></li>
            <li><a href="#">Pago</a></li>
            <li><a href="#">Perfil</a></li>
            <li><a href="#">Idiomas</a></li>
            <li><a href="{{ url('/ConvenioE') }}">Convenios</a></li>
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
            <h2>Perfil de Usuario</h2>

            <div class="user-info">
                <label>Nombre:</label>
                <input type="text" value="{{ $user->nombre ?? 'No tiene valor' }}" disabled>

                <label>Correo:</label>
                <input type="email" value="{{ $user->correo ?? 'No tiene valor' }}" disabled>

                <label>CI:</label>
                <input type="text" value="{{ $user->ci ?? 'No tiene valor' }}" disabled>

                <label>Teléfono:</label>
                <input type="text" value="{{ $user->telefono ?? 'No tiene valor' }}" disabled>

                <label>Dirección:</label>
                <input type="text" value="{{ $user->direccion ?? 'No tiene valor' }}" disabled>

                <label>Fecha de Nacimiento:</label>
                <input type="text" value="{{ isset($user->fecha_nacimiento) && $user->fecha_nacimiento ? \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') : 'No tiene valor' }}" disabled>

                <label>Rol:</label>
                <input type="text" value="{{ $user->rol ?? 'No tiene valor' }}" disabled>

                <label>Registro:</label>
                <input type="text" value="{{ $user->registro ?? 'No tiene valor' }}" disabled>

                <label>Código:</label>
                <input type="text" value="{{ $user->codigo ?? 'No tiene valor' }}" disabled>
            </div>
        </div>
    </div>

</body>
</html>
