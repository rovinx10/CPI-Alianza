<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informe de Notas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/modernizr/modernizr.min.js"></script>
    <link rel="stylesheet" href="./assets/css/resultados/style.css">
</head>

<body>
    <div class="main-wrapper">
        <div class="content-wrapper">
            <div class="content-container">


                <!-- /.left-sidebar -->

                <div class="main-page">
                    <div class="container-fluid">
                        <!-- /.row -->
                        <h1><span class="blue">&lt;</span>Informe de Notas<span class="blue">&gt;</span> <span class="yellow"></pan>
                        </h1>
                        <h2><a href="" target="_blank"></a></h2>

                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                    <div class="text-center">
                <button class="btn btn-primary" onclick="CallPrint()">IMPRIMIR</button>
            </div>

                    <section class="section" id="exampl">
                        <div class="container-fluid">

                            <div class="row">



                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <hr />
                                                <?php
                                                // code Student Data
                                                $rollid = $_POST['rollid'];
                                                $classid = $_POST['class'];
                                                $_SESSION['rollid'] = $rollid;
                                                $_SESSION['classid'] = $classid;
                                                $qery = "SELECT   tblstudents.StudentName,tblstudents.RollId,tblstudents.RegDate,tblstudents.StudentId,tblstudents.Status,tblclasses.ClassName,tblclasses.Section from tblstudents join tblclasses on tblclasses.id=tblstudents.ClassId where tblstudents.RollId=:rollid and tblstudents.ClassId=:classid ";
                                                $stmt = $dbh->prepare($qery);
                                                $stmt->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                                $stmt->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $resultss = $stmt->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($stmt->rowCount() > 0) {
                                                    foreach ($resultss as $row) {   ?>
                                                        <p><b>Nombre:</b> <?php echo htmlentities($row->StudentName); ?></p>
                                                        <p><b>RUT:</b> <?php echo htmlentities($row->RollId); ?>
                                                        <p><b>Curso:</b> <?php echo htmlentities($row->ClassName); ?>(<?php echo htmlentities($row->Section); ?>)
                                                        <?php }

                                                        ?>
                                            </div>
                                            <div class="panel-body p-20">







                                                <table class="table table-hover table-bordered" border="1" width="100%">
                                                    <thead>
                                                        <tr style="text-align: center">
                                                            <th style="text-align: center">#</th>
                                                            <th style="text-align: center ">Materia</th>
                                                            <th style="text-align: center">Notas</th>
                                                        </tr>
                                                    </thead>




                                                    <tbody>
                                                        <?php
                                                        // Code for result

                                                        $query = "select t.StudentName,t.RollId,t.ClassId,t.marks,SubjectId,tblsubjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,SubjectId from tblstudents as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
                                                        $query = $dbh->prepare($query);
                                                        $query->bindParam(':rollid', $rollid, PDO::PARAM_STR);
                                                        $query->bindParam(':classid', $classid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($countrow = $query->rowCount() > 0) {
                                                            foreach ($results as $result) {

                                                        ?>

                                                                <tr>
                                                                    <th scope="row" style="text-align: center"><?php echo htmlentities($cnt); ?></th>
                                                                    <td style="text-align: center"><?php echo htmlentities($result->SubjectName); ?></td>
                                                                    <td style="text-align: center"><?php echo htmlentities($totalmarks = $result->marks); ?></td>
                                                                </tr>
                                                            <?php
                                                                $totlcount += $totalmarks;
                                                                $cnt++;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th scope="row" colspan="2" style="text-align: center">Total</th>
                                                                <td style="text-align: center"><b><?php echo htmlentities($totlcount); ?></b> de <b><?php echo htmlentities($outof = ($cnt - 1) * 100); ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" colspan="2" style="text-align: center">Porcentaje</th>
                                                                <td style="text-align: center"><b><?php echo  htmlentities($totlcount * (100) / $outof); ?> %</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" align="center"><i class="fa fa-print fa-2x" aria-hidden="true" style="cursor:pointer" OnClick="CallPrint(this.value)"></i></td>
                                                            </tr>

                                                        <?php } else { ?>
                                                            <div class="alert alert-warning left-icon-alert" role="alert">
                                                                <strong>Realizado</strong> Aun no se han declarado tus resultados
                                                            <?php }
                                                            ?>
                                                            </div>
                                                        <?php
                                                    } else { ?>

                                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                                <strong>Error</strong>
                                                            <?php
                                                            echo htmlentities("ID Roll inválido");
                                                        }
                                                            ?>
                                                            </div>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                    <div class="form-group">

                                        <div class="col-sm-6">
                                            <a href="find-result.php" style="color:white;">Volver</a>
                                        </div>
                                    </div>
                                    

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

    </div>
    <!-- /.main-wrapper -->

    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>

    <!-- ========== PAGE JS FILES ========== -->
    <script src="js/prism/prism.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>
    <script>
        $(function($) {

        });


        function CallPrint(strid) {
            var prtContent = document.getElementById("exampl");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
    </script>



    <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

</body>

</html>