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
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        nav ul li {
            position: relative;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
            padding: 10px;
            display: block;
        }

        /* Estilo para los submenús */
        nav ul li ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            padding: 0;
            list-style: none;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        nav ul li:hover ul {
            display: block;
        }

        nav ul li ul li {
            width: 200px;
        }

        nav ul li ul li a {
            padding: 10px;
            color: black;
            display: block;
        }

        nav ul li ul li a:hover {
            background-color: #00bcd4;
            color: white;
        }

        .illustration img {
            width: 50%;
            height: auto;
            object-fit: cover;
            margin: 20px auto;
            display: block;
        }

        footer {
            text-align: center;
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

        /* Estilo responsive para dispositivos móviles */
        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }

            nav ul li {
                width: 100%;
            }

            nav ul li a {
                padding: 10px 20px;
            }

            nav ul li ul {
                position: static;
                width: 100%;
            }

            nav ul li ul li a {
                padding: 10px;
            }

            header, footer {
                text-align: center;
            }

            .illustration img {
                width: 90%;
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
            <!-- Paquete 1: Acceso -->
            <li>
                <a href="#">Acceso</a>
                <ul>
                    <li><a href="#">CU1. Gestionar Usuarios</a></li>


                    <li><a href="#">CU15. Gestionar Roles y Permisos de Usuarios</a></li>
                    <li><a href="{{ url('/PerfilE') }}">Perfil</a></li>

                    <li><a href="#">CU24. Iniciar Sesión</a></li>
                    <li><a href="{{ url('/PrincipalE') }}">Inicio</a></li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">CU25. Cerrar Sesión</button>
                        </form>
                    </li>
                    <li><a href="{{ url('/CambiarContraseña') }}">CU26. Cambiar Contraseña</a></li>
                </ul>
            </li>

            <!-- Paquete 2: Académico -->
            <li>
                <a href="#">Académico</a>
                <ul>
                    <li><a href="#">CU2. Gestionar Inscripciones</a></li>
                    <li><a  href="#">CU3. Gestionar Grupos</a></li>
                    <li><a href="#">CU4. Gestionar Asistencias</a></li>
                    <li><a href="#">CU5. Gestionar Avances Académicos</a></li>
                    <li><a href="#">CU6. Gestionar Parciales</a></li>
                    <li><a href="#">CU19. Generar Reportes Académicos</a></li>
                    <li><a href="#">CU14. Registrar y Consultar Historiales Académicos</a></li>
                </ul>
            </li>

            <!-- Paquete 3: Idiomas y Niveles -->
            <li>
                <a href="#">Idiomas y Niveles</a>
                <ul>
                    <li><a  href="#">CU9. Gestionar Idiomas</a></li>
                    <li><a href="#">CU10. Gestionar Niveles de Idioma</a></li>
                    <li><a href="#">CU11. Gestionar Módulos</a></li>
                    <li><a href="#">CU12. Gestionar Prerrequisitos de Niveles</a></li>
                    <li><a href="#">CU13. Gestionar Textos para Niveles</a></li>
                    <li><a href="#">CU18. Gestionar Pruebas de Colocación</a></li>
                </ul>
            </li>

            <!-- Paquete 4: Administración -->
            <li>
                <a href="#">Administración</a>
                <ul>
                    <li><a href="{{ url('/ConvenioD') }}">CU8. Gestionar Instituciones y Convenios</a></li>
                    <li><a href="#">CU7. Gestionar Horarios</a></li>
                    <li><a href="#">CU20. Control de Caducidad de Inscripciones</a></li>
                    <li><a  href="#">CU23. Gestionar Bitácora de Actividades</a></li>
                </ul>
            </li>

            <!-- Paquete 5: Finanzas -->
            <li>
                <a href="#">Finanzas</a>
                <ul>
                    <li><a href="#">CU16. Consultar Historial de Pagos</a></li>
                    <li><a href="#">CU17. Generar Reportes Financieros</a></li>
                    <li><a href="#">CU21. Registrar Código QR</a></li>
                    <li><a href="#">CU22. Registrar Pago</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Imágenes -->
    <div class="illustration">
        <img src="{{ asset('imagenes/principal2.jpg') }}" alt="Illustration">
    </div>

    <div class="illustration">
        <img src="{{ asset('imagenes/principal3.jpg') }}" alt="Illustration">
    </div>

    <!-- Pie de página -->
    <footer>
        <p>Aprendiendo Bolivia es una organización de intercambios culturales y centro de idiomas...</p>
    </footer>

</body>
</html> 


