<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-image: url('{{ asset('imagenes/1234.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: row;
            overflow: hidden;
        }

        .illustration {
            flex: 1.9;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .illustration img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-section h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #008c9e;
        }

        .login-section h2 {
            font-size: 1rem;
            margin-bottom: 20px;
            color: #888;
            text-align: center;
        }

        .login-section label {
            font-size: 0.9rem;
            margin-bottom: 5px;
            color: #444;
            width: 100%;
        }

        .login-section input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-section button {
            padding: 10px;
            width: 100%;
            background-color: #008c9e;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-section button:hover {
            background-color: #00757f;
        }

        .login-section .create-account {
            text-align: center;
            margin-top: 10px;
        }

        .login-section .create-account a {
            color: #008c9e;
            text-decoration: none;
        }

        /* Media Query para pantallas más grandes (versión web) */
        @media (min-width: 769px) {
            .login-section {
                padding: 60px; /* Ajusta el padding para mayor altura */
                min-height: 425px; /* Establece un alto mínimo */
            }
        }

        /* Media Query para cambiar a diseño vertical en móviles */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .illustration {
                width: 100%;
            }

            .login-section {
                width: 100%;
                padding: 10px; /* Este padding se mantiene para móviles */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <img src="{{ asset('imagenes/login1.png') }}" alt="Illustration">
        </div>
        <div class="login-section">
            <h1>Inicio de Sesión</h1>
            <h2>Centro de Idiomas Aprendiendo Bolivia</h2>

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="username">Registro o Código</label>
                <input type="text" id="username" name="username" placeholder="Introduce tu Registro o Código" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Introduce tu Contraseña" required>
                
                <!-- Checkbox para mostrar contraseña -->
                <div style="display: flex; flex-direction: column; align-items: center; margin-top: 10px;">
                    <div style="display: flex; align-items: center;">
                        <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()" style="margin-right: 5px;">
                        <label for="show-password"></label>
                    </div>
                </div>

                <button type="submit">Iniciar</button>
            </form>

            <script>
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById('password');
                    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
                }
            </script>

            <div class="create-account">
                <p><a href="{{ url('/CambiarContraseña') }}">Cambiar contraseña</a></p>
            </div>
        </div>
    </div>
</body>
</html>
