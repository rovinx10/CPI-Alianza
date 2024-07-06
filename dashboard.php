<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
?>
    <?php include('includes/topbar.php'); ?>
    <div class="content-wrapper">
        <div class="content-container">
            <?php include('includes/leftbar.php'); ?>
            <div class="main-page">
                <div class="container-fluid">
                    <div class="row page-title-div">
                        <div class="col-sm-6">
                            <h2 class="title">Dashboard</h2>
                        </div>
                        <!-- /.col-sm-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                <section class="section">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                                <a class="dashboard-stat bg-white" href="manage-students.php">
                                    <?php
                                    $sql1 = "SELECT StudentId from tblstudents ";
                                    $query1 = $dbh->prepare($sql1);
                                    $query1->execute();
                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                    $totalstudents = $query1->rowCount();
                                    ?>
                                    <span class="number counter"><?php echo htmlentities($totalstudents); ?></span>
                                    <span class="name">Usuarios Registrados</span>
                                </a>
                                <!-- /.dashboard-stat -->
                            </div>
                            <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                                <a class="dashboard-stat bg-white" href="manage-subjects.php">
                                    <?php
                                    $sql = "SELECT id from  tblsubjects ";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $totalsubjects = $query->rowCount();
                                    ?>
                                    <span class="number counter"><?php echo htmlentities($totalsubjects); ?></span>
                                    <span class="name">Listado de Materias</span>
                                </a>
                                <!-- /.dashboard-stat -->
                            </div>
                            <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
                                <a class="dashboard-stat bg-white" href="manage-classes.php">
                                    <?php
                                    $sql2 = "SELECT id from  tblclasses ";
                                    $query2 = $dbh->prepare($sql2);
                                    $query2->execute();
                                    $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                    $totalclasses = $query2->rowCount();
                                    ?>
                                    <span class="number counter"><?php echo htmlentities($totalclasses); ?></span>
                                    <span class="name">Total de Cursos</span>
                                </a>
                            </div>
                            <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.section -->
            </div>
            <!-- /.main-page -->
        </div>
        <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('includes/footer.php'); ?>
<?php } ?>
