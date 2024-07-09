<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
    exit();
} else {
    if (isset($_POST['submit'])) {
        $teachname = $_POST['fullanme'];
        $roolid = $_POST['rollid'];
        $teachemail = $_POST['emailid'];
        $status = $_POST['status'];
        $sql = "UPDATE tblteaches SET TeachName=:teachname, RollId=:roolid, TeachEmail=:teachemail, Status=:status WHERE TeachId=:stid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':teachname', $teachname, PDO::PARAM_STR);
        $query->bindParam(':roolid', $roolid, PDO::PARAM_STR);
        $query->bindParam(':teachemail', $teachemail, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':stid', $stid, PDO::PARAM_INT); // stid debe ser INT según el contexto
        $query->execute();
        $msg = "Información de Profesor Actualizada Correctamente";
    }

    // Obtener el ID del profesor de la URL usando GET
    $stid = intval($_GET['stid']);

    // Consulta para obtener los datos del profesor específico
    $sql = "SELECT TeachName, RollId, TeachEmail, Status FROM tblteaches WHERE TeachId=:stid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':stid', $stid, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    // Verificación de existencia de resultados
    if (!$result) {
        // Manejar caso donde no se encuentra el profesor
        // Esto puede ser un redirect o mensaje de error según tu lógica de aplicación
        header("Location: dashboard.php");
        exit();
    }
?>

<!-- HTML y Formulario para la Edición de Profesor -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
    <!-- Agregar tus estilos y scripts -->
</head>
<body>
    <!-- Incluir tu barra de navegación y contenedor principal -->
    <?php include('includes/topbar.php'); ?>
    <div class="content-wrapper">
        <div class="content-container">
            <!-- Incluir tu barra lateral izquierda -->
            <?php include('includes/leftbar.php'); ?>
            <div class="main-page">
                <div class="container-fluid">
                    <h2 class="title">Editar Profesor</h2>
                    <!-- Mostrar mensajes de éxito o error aquí -->
                    <?php if (isset($msg)): ?>
                        <div class="alert alert-success" role="alert"><?php echo htmlentities($msg); ?></div>
                    <?php endif; ?>
                    <!-- Formulario de Edición -->
                    <form class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="fullanme" class="col-sm-2 control-label">Nombre Completo</label>
                            <div class="col-sm-10">
                                <input type="text" name="fullanme" class="form-control" id="fullanme" value="<?php echo htmlentities($result->TeachName); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rollid" class="col-sm-2 control-label">RUT</label>
                            <div class="col-sm-10">
                                <input type="text" name="rollid" class="form-control" id="rollid" value="<?php echo htmlentities($result->RollId); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emailid" class="col-sm-2 control-label">Correo</label>
                            <div class="col-sm-10">
                                <input type="email" name="emailid" class="form-control" id="emailid" value="<?php echo htmlentities($result->TeachEmail); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-10">
                                <input type="radio" name="status" value="1" <?php if ($result->Status == 1) echo 'checked'; ?>> Activo
                                <input type="radio" name="status" value="0" <?php if ($result->Status == 0) echo 'checked'; ?>> Inactivo
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
                                <a href="manage-teach.php" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>
</body>
</html>

<?php } ?>
