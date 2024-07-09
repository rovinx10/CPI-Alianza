<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
    exit;
}
?>

<link rel="stylesheet" type="text/css" href="assets/js/DataTables/datatables.min.css" />
<!-- ========== TOP NAVBAR ========== -->
<?php include('includes/topbar.php'); ?>
<!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
<div class="content-wrapper">
    <div class="content-container">
        <?php include('includes/leftbar.php'); ?>

        <div class="main-page">
            <div class="container-fluid">
                <div class="row page-title-div">
                    <div class="col-md-6">
                        <h2 class="title">Gestión de Profesores</h2>
                    </div>
                </div>
                <div class="row breadcrumb-div">
                    <div class="col-md-6">
                        <ul class="breadcrumb">
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>
                            <li> Profesores</li>
                            <li class="active">Gestión de Profesores</li>
                        </ul>
                    </div>
                </div>
            </div>

            <section class="section">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h5>Ver Información de Profesores</h5>
                                    </div>
                                </div>
                                <div class="panel-body p-20">
                                    <?php if ($msg) { ?>
                                        <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Realizado </strong><?php echo htmlentities($msg); ?>
                                        </div>
                                    <?php } elseif ($error) { ?>
                                        <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Error </strong> <?php echo htmlentities($error); ?>
                                        </div>
                                    <?php } ?>

                                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre de Profesor</th>
                                                <th>RUT</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT TeachName, RollId, TeachId, Status FROM tblteaches";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            foreach ($results as $result) { ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($result->TeachName); ?></td>
                                                    <td><?php echo htmlentities($result->RollId); ?></td>
                                                    <td><?php echo ($result->Status == 1) ? 'Activo' : 'Bloqueado'; ?></td>
                                                    <td>
                                                        <a href="edit-teach.php?stid=<?php echo htmlentities($result->TeachId); ?>" class="btn btn-info"><i class="fa fa-edit" title="Editar Registro"></i> </a>
                                                    </td>
                                                </tr>
                                            <?php $cnt++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
