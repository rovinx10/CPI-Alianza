<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sistema de Calificaciones</title>
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
      <p class="lead"></p>
    </div>
  </div>

  <!-- Login de Admin -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">ALIANZA EDUCACIONAL | REGISTRO CURRICULAR</div>
          <div class="card-body">
            <form method="post">
              <div class="form-group">
                <label for="username">USUARIO</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su usuario">
              </div>
              <div class="form-group">
                <label for="password">CONTRASEÑA</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
              </div>
              <button type="submit" name="login" class="btn btn-primary">ACCEDER</button>
              <a href="admin-login.php" class="btn btn-success">INICIO DE ADMIN</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    
  </footer>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

  <?php
  session_start();
  error_reporting(0);
  include('includes/config.php');
  if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
  }
  if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $_SESSION['alogin'] = $_POST['username'];
      echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
      echo "<script>alert('Detalles inválidos');</script>";
    }
  }
  ?>
</body>

</html>
