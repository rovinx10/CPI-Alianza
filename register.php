<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['register'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']); // Se asume que la contraseña se almacena como MD5 en la base de datos

    // Verificar si el usuario ya existe
    $check_user_sql = "SELECT id FROM admin WHERE UserName=:uname";
    $check_user_query = $dbh->prepare($check_user_sql);
    $check_user_query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $check_user_query->execute();
    $user_count = $check_user_query->rowCount();

    if ($user_count > 0) {
        echo "<script>alert('El usuario ya existe. Intente con otro nombre de usuario.');</script>";
    } else {
        // Insertar nuevo usuario
        $sql = "INSERT INTO admin(UserName, Password) VALUES (:uname, :password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':uname', $uname, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        if ($query) {
            echo "<script>alert('Registro exitoso. Ahora puede iniciar sesión con sus credenciales.');</script>";
        } else {
            echo "<script>alert('Ocurrió un error al registrar.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }

        .jumbotron {
            background-image: url('./assets/images/bg-imagee.jpg');
            background-size: cover;
            color: #fff;
            text-align: center;
            padding-top: 100px;
            padding-bottom: 100px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .card-header {
            border-bottom: none; /* Quita la línea negra debajo del header */
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4"></h1>
        </div>
    </div>

    <!-- Formulario de Registro -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Registro de Usuario</div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="username">USUARIO</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="password">CONTRASEÑA</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                            </div>
                            <button type="submit" name="register" class="btn btn-primary">REGISTRAR</button>
                            <a href="change-password.php" class="btn btn-secondary">VOLVER</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
