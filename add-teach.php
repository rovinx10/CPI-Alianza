<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #3d85ed !important;
            color: white;
            text-align: center;
        }
    </style>
</head>

<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $teachname = $_POST['fullanme'];
        $roolid = $_POST['rollid'];
        $teachemail = $_POST['emailid'];
        $status = 1;
        $sql = "INSERT INTO  tblteaches(TeachName,RollId,TeachEmail,Status) VALUES(:teachname,:roolid,:teachemail,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':teachname', $teachname, PDO::PARAM_STR);
        $query->bindParam(':roolid', $roolid, PDO::PARAM_STR);
        $query->bindParam(':teachemail', $teachemail, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Información del Profesor agregada correctamente";
        } else {
            $error = "Algo salió mal. Inténtalo de nuevo";
        }
    }
?>


    <!-- ========== TOP NAVBAR ========== -->
    <?php include('includes/topbar.php'); ?>
    <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
    <div class="content-wrapper">
        <div class="content-container">

            <!-- ========== LEFT SIDEBAR ========== -->
            <?php include('includes/leftbar.php'); ?>
            <!-- /.left-sidebar -->

            <div class="main-page">

                <div class="container-fluid">
                    <div class="row page-title-div">
                        <div class="col-md-6">
                            <h2 class="title">Agregar Profesor</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>

                                <li class="active">Agregar Profesor</li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <section class="section">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Ingreso de Profesor</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                                <strong>Bien hecho! </strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Algo salió mal!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <form class="row" method="post">

                                            <div class="form-group col-md-6">
                                                <label for="default" class="control-label">Nombre Completo</label>
                                                <input type="text" name="fullanme" class="form-control" id="fullanme" required="required" autocomplete="off">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="default" class="control-label">RUT</label>
                                                <input type="text" name="rollid" class="form-control" id="rollid" maxlength="9" required="required" autocomplete="off">

                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="default" class="control-label">Correo</label>

                                                <input type="email" name="emailid" class="form-control" id="email" required="required" autocomplete="off">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <button type="submit" name="submit" class="btn btn-success">Agregar</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            
                        </div>

                    </div>
                </section>


            </div>

           
        </div>
        
        <?php include('includes/footer.php'); ?>

    <?PHP } ?>