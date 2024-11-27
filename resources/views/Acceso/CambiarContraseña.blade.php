<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-position: center; 
            background-image: url('{{ asset('imagenes/2.png') }}'); 
            background-size: cover; 
            background-repeat: no-repeat;
        }

        .container {
            width: 900px;
            height: 500px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            overflow: hidden;
        }

        .illustration {
            flex: 1; /* Aumentar el tamaño de la imagen */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .illustration img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            margin: 0; /* Elimina márgenes */
            padding: 0; /* Elimina padding */
        }

        .login-section {
            flex: 0.5; /* Reducir el tamaño de la sección de login */
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start; /* Alinea a la izquierda */
            text-align: left; /* Alineación del texto a la izquierda */
            margin-top: 10px;
        }

        .login-section h1,
        .login-section h2 {
            text-align: center; /* Centra los encabezados */
            margin-bottom: 10px;
            color: #008c9e;
            
        }

        .login-section h2 {
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: #888;
        }

        .login-section label {
            font-size: 0.9rem;
            margin-bottom: 10px;
            
            color: #444;
        }

        .login-section input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px; 
            width: 100%; /* Ancho completo */
            margin-bottom: 20px;
        }

        .btn {
            width: 120px;
            height: 35px;
            padding: 0;
            border: none;
            border-radius: 5px;
            font-size: 1rem; 
            cursor: pointer;
            background-color: #008c9e;
            color: #fff;
            transition: background-color 0.3s; 
        }

        .btn:hover {
            background-color: #007a8b;
        }

        /* Estilos para pantallas pequeñas (móviles) */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
                height: 90%; /* Puedes ajustar la altura si es necesario */
            }

            .illustration {
                flex: 1.5; /* Aumenta el tamaño de la imagen */
                width: 100%;
                padding: 0; /* Elimina padding */
            }

            .login-section {
                flex: 0.8; /* Reduce el tamaño de la sección de login */
                padding: 10px;
                align-items: flex-start; /* Alinea los elementos a la izquierda */
            }

            .login-section h1,
            .login-section h2 {
                text-align: center; /* Centra los encabezados en móviles también */
                 margin-bottom: 10px;
            }

            .login-section label {
                margin-bottom: 5px; /* Ajusta el margen inferior de las etiquetas */
            }

            .buttons {
                width: auto; /* Ajusta el ancho en móviles */
            }

            .btn {
                width: 120px; /* Reduce el ancho de los botones en móviles */
                height: 35px; /* Ajusta la altura */
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="illustration">
            <img src="{{ asset('imagenes/1.png') }}" alt="Illustration">
        </div>

        <div class="login-section">
            <h1>Cambiar Contraseña</h1>
            <h2>Centro de Idiomas Aprendiendo Bolivia</h2>

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cambiar.contraseña') }}" method="POST">
                @csrf
                <label for="codigo">Registro o Código</label>
                <input type="text" id="codigo" name="codigo" placeholder="Introduce tu Registro o Código" required>

                <label for="old_password">Contraseña antigua</label>
                <input type="password" id="old_password" name="old_password" placeholder="Introduce tu Contraseña antigua" required>

                <label for="new_password">Contraseña Nueva</label>
                <input type="password" id="new_password" name="new_password" placeholder="Introduce tu Contraseña Nueva" required>

                <div>
                    <input type="checkbox" id="show-passwords" onclick="togglePasswordVisibility()">
                    <label for="show-passwords"></label>
                </div>

                <div class="buttons">
                    <button type="submit" class="btn">Cambiar</button>
                    <button type="button" class="btn" onclick="window.location.href='{{ url('/InicioSesion') }}'">Cancelar</button>
                </div>
            </form>

            <script>
                function togglePasswordVisibility() {
                    const oldPasswordInput = document.getElementById('old_password');
                    const newPasswordInput = document.getElementById('new_password');
                    const checkbox = document.getElementById('show-passwords');
                    
                    oldPasswordInput.type = checkbox.checked ? 'text' : 'password';
                    newPasswordInput.type = checkbox.checked ? 'text' : 'password';
                }
            </script>
        </div>
    </div>

</body>
</html>
