<?php
    require "controller/controller_nav.php";
    require_once 'controller/dompdf/autoload.inc.php';
    session_start();

    if(!isset($_SESSION['id'])){
        header("Location: 404.php");
    }
    
    $nombre = $_SESSION['username'];
    $type_user = $_SESSION['type_user'];

    $getor_de_contenido= new MVController();

    
?>


<!DOCTYPE html>
<!-- <html lang="en"> -->
<html lang="en"> <!-- change to spanish-->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Comp atible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Data student</title>
        <link rel="icon" href="models/img/fab.ico" />
        <link href="css/personalStyles.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        

    </head>

    <body class="sb-nav-fixed">

        <!-- nav bar -->
        <!-- <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" > -->
        <!-- <nav class="sb-topnav navbar navbar-expand navbar-dark " style="background-color: #222230;"> -->
        <!-- <nav class="sb-topnav navbar navbar-expand navbar-dark " style="background-color: #1D1F34;"> -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" >

            <a class="navbar-brand" href="principal.php?action=inicio">Data Student</a>  <!-- se le coloca la pagina inicial-->
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

            
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0" ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        //load the name
                            echo "$nombre ";
                        ?>
                        <i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <!--user options-->
                        <a class="dropdown-item" href="logout.php">Salir</a>
                    </div>
                </li>
            </ul>
        </nav>



        <!-- barra lateral -->
        <div id="layoutSidenav">
            
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu" >
                        <div class="nav" >


                            <div class="sb-sidenav-menu-heading">PRINCIPAL</div><!-- titulo divisor-->

                            <a class="nav-link" href="principal.php?action=inicio">
                                <div class="sb-nav-link-icon"><i class="fa fa-home"></i></div>
                                Inicio
                            </a>

                            <a class="nav-link" href="principal.php?action=estadisticaas">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Informes
                            </a>

                            <a class="nav-link" href="principal.php?action=graphics">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Resultados
                            </a>

                            <div class="sb-sidenav-menu-heading">DATOS</div><!-- titulo divisor-->
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                                Formularios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="principal.php?action=gen">General</a>
                                    <a class="nav-link" href="principal.php?action=frmls">Estilos de aprendizaje</a>
                                    <a class="nav-link" href="principal.php?action=frmtp">Tipos de jugador</a>
                                </nav>
                            </div>

                            
                        </div>
                    </div>

                    <!-- footer -->
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <!-- Start Bootstrap -->
                        <?php
                            if($type_user == 0){
                                echo "Estudiante";
                            }else {
                                echo "Administrador";
                            }
                        ?>
                    </div>
                </nav>
            </div>


            
            <div id="layoutSidenav_content" >
                <!-- contenido -->
                <main>
                    <div class="container-fluid " style="background-color: #EEF1F9">
                        
                        <?php
                        //gestor de contenido 
                            $getor_de_contenido->enrutar();
                        ?>
                    </div>
                </main>


                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Data student 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>



            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="assets/demo/datatables-demo.js"></script> -->
    </body>
</html>
