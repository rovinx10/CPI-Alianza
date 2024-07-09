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
      echo "<script>alert('Invalid Details');</script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Acceso Admin</title>
   <link rel="icon" type="image/x-icon" href="assets/images/ali.png">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
   <link rel="stylesheet" href="assets/css/font-awesome.min.css" media="screen">
   <link rel="stylesheet" href="assets/css/animate-css/animate.min.css" media="screen">
   <link rel="stylesheet" href="assets/css/prism/prism.css" media="screen">
   <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
   <link rel="stylesheet" href="assets/css/main.css" media="screen">
   <script src="assets/js/modernizr/modernizr.min.js"></script>
   <style>
      body {
         background-image: url(assets/images/bg-imagee.jpg);
         background-color: #3d85ed;
         background-size: cover;
         height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
         margin: 0;
      }
      .login-container {
         background: #3d86ed;
         padding: 20px;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
   </style>
</head>

<body>
   <div class="main-wrapper">
      <div class="login-container">
         <section class="section">
            <div class="text-center mb-4">
               <a href="#">
                  <img style="height: 70px" src="assets/images/alianza.png" alt="Logo">
               </a>
               <h5 style="color: white;"> <strong>Acceso Admin</strong></h5>
            </div>
            <form class="admin-login" method="post">
               <div class="form-group">
                  <label for="inputEmail3" class="control-label">USUARIO</label>
                  <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Correo">
               </div>
               <div class="form-group">
                  <label for="inputPassword3" class="control-label">CONTRASEÑA</label>
                  <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Contraseña">
               </div>
               <br>
               <div class="form-group mt-20">
                  <button type="submit" name="login" class="btn btn-primary">Acceder</button>
               </div>
               <br>
            </form>
            <a href="index.php" class="btn btn-secondary">Volver a Inicio</a>
         </section>
      </div>
   </div>
   <!-- ========== COMMON JS FILES ========== -->
   <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
   <script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
   <script src="assets/js/bootstrap/bootstrap.min.js"></script>
   <script src="assets/js/pace/pace.min.js"></script>
   <script src="assets/js/lobipanel/lobipanel.min.js"></script>
   <script src="assets/js/iscroll/iscroll.js"></script>
   <!-- ========== PAGE JS FILES ========== -->
   <!-- ========== THEME JS ========== -->
   <script src="assets/js/main.js"></script>
   <script>
      $(function() {

      });
   </script>
   <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
</body>

</html>
