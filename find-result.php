<?php
session_start();
include('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado Estudiante</title>
    <link rel="icon" type="image/x-icon" href="assets/images/ali.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/icheck/skins/flat/blue.css">
    <link rel="stylesheet" href="assets/css/main.css" media="screen">
    <script src="assets/js/modernizr/modernizr.min.js"></script>
    <style>
        .login-bg-color {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .login-box {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background: #3d86ed;
            border-radius: 10px;
        }
    </style>
</head>

<body class="" style="background-image: url('path/to/your/background/image.jpg');">
    <div class="main-wrapper">
        <div class="login-bg-color">
            <div class="login-box">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <a href="#">
                            <img style="height: 70px" src="assets/images/ali.png">
                        </a>
                        <h3 class="text-white">Verifica tus Calificaciones</h3>
                    </div>
                </div>
                <div class="panel-body p-20">
                    <form action="result.php" method="post" class="admin-login">
                        <div class="form-group">
                            <label for="rollid" class="control-label">Ingresa tu RUT</label>
                            <input type="text" class="form-control" id="rollid" placeholder="Sin punto ni guión" autocomplete="off" name="rollid">
                        </div>
                        <div class="form-group">
                            <label for="default" class="control-label">Año</label>
                            <select name="class" class="form-control" id="default" required="required">
                                <option value="">Selecciona tu Curso</option>
                                <?php
                                $sql = "SELECT * from tblclasses";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { ?>
                                        <option value="<?php echo htmlentities($result->id); ?>">
                                            <?php echo htmlentities($result->ClassName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?>
                                        </option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group mt-20">
                            <button type="submit" class="btn btn-block" style="color: #172541;">Buscar</button>
                        </div>
                        <div class="form-group text-center">
                            <a href="manage-results.php" class="text-white">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== COMMON JS FILES ========== -->
    <script src="assets/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="assets/js/pace/pace.min.js"></script>
    <script src="assets/js/lobipanel/lobipanel.min.js"></script>
    <script src="assets/js/iscroll/iscroll.js"></script>
    <script src="assets/js/icheck/icheck.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        $(function() {
            $('input.flat-blue-style').iCheck({
                checkboxClass: 'icheckbox_flat-blue'
            });
        });
    </script>
</body>

</html>
