<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
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

header .social-icons a {
    color: white;
    margin-left: 15px;
    text-decoration: none;
    font-size: 1.2rem;
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

nav ul li {
    position: relative;
}



nav ul li:hover {
    background-color: #00bcd4;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    margin-top: 70px;
}

.form-box {
    background-color: #008c9e;
    padding: 40px;
    width: 700px;
    border-radius: 15px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.form-box h2 {
    color: #fff;
    margin-bottom: 30px;
    font-size: 2.5rem;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.input-box {
    position: relative;
    width: 100%;
}

.input-box input {
    width: 100%;
    padding: 15px 15px 15px 50px;
    background: #fff;
    border: none;
    outline: none;
    color: #000;
    font-size: 1.2rem;
    border-radius: 5px;
}

.input-box label {
    position: absolute;
    top: 50%;
    left: 50px;
    transform: translateY(-50%);
    color: #000;
    pointer-events: none;
    transition: 0.5s;
}

.input-box input:focus ~ label,
.input-box input:not(:placeholder-shown) ~ label {
    top: -9.2px;
    left: 50px;
    color: #000;
    font-size: 0.9rem;
     left: 10px; /* Mantiene la etiqueta alineada a la izquierda cuando se enfoca o llena */
}

.buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.btn {
    width: 100px;
    height: 30px;
    padding: 10px;
    border: none;
    border-radius: 0;
    font-size: 1rem;
    cursor: pointer;
    background-color: #00bcd4;
    color: #fff;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0097a7;
}

.alert {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
}

/* Estilos responsivos para móvil */
/* Estilos responsivos para móvil */
@media (max-width: 768px) {
    .profile-box {
        width: 100%;
    }

    nav ul {
                flex-direction: row; /* Menú horizontal */
                justify-content: flex-start; /* Espacio uniforme entre elementos */
            }
    .container {
        margin-top: 10px; /* Elimina el margen superior entre el formulario y el menú */
    }

    .form-box {
        width: 90%; /* Ajusta el ancho del formulario en móviles */
        padding: 20px;
    }

    /* Centra el título "Registrar Usuario" */
    .form-box h2 {
        text-align: center;
    }

    .form-grid {
        grid-template-columns: 1fr; /* Cambia a una sola columna */
    }

    /* Ajusta los campos de entrada para alinear el texto a la izquierda */
    .input-box input {
        text-align: left; /* Alinea el texto a la izquierda */
        padding-left: 10px; /* Agrega un pequeño margen interno si es necesario */
    }

    .input-box label {
        left: 10px; /* Coloca la etiqueta ligeramente a la izquierda */
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
            <div class="social-icons">
               
            </div>
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

    <!-- Contenedor del formulario -->
    <div class="container">
        <div class="form-box">
            <h2>Registrar Usuario</h2>

            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('registrar.usuario') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="input-box">
                        <input type="text" name="nombre" required>
                        <label>Nombre</label>
                    </div>
                    <div class="input-box">
                        <input type="email" name="correo" required>
                        <label>Correo</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" required>
                        <label>Contraseña</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="ci" required>
                        <label>CI</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="telefono" required>
                        <label>Teléfono</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="direccion" required>
                        <label>Dirección</label>
                    </div>
                    <div class="input-box">
                        <input type="date" name="fecha_nacimiento" required>
                        <label>Fecha</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="rol" required>
                        <label>Rol</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="registro" required>
                        <label>Registro</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="codigo" required>
                        <label>Código</label>
                    </div>
                </div>

                <div class="buttons">
                    <button type="submit" class="btn register">Registrar</button>
                    <button type="button" class="btn" onclick="window.location.href='{{ url('/PrincipalA') }}'">Cancelar</button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
