
<div class="container">
        <div class="row align-items-center ">
            <div class="col-lg-4 aos-init text-left">
                <p class="lead">Debe llenar todos los formularios para poder revisar los resultados</p>

                
                <ul>
                    <?php if ( $resultadoGen->num_rows == 0 ) {?>
                    <li>
                        <a href="principal.php?action=gen">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Formulario: General.
                        </a>
                    </li>
                    <?php }?>

                    <?php if ( $resultadoLs->num_rows == 0 ) {?>
                    <li>
                        <a href="principal.php?action=frmls">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Formulario: Estilos de aprendizaje
                        </a>
                    </li>
                    <?php }?>

                    <?php if ( $resultadoTp->num_rows == 0 ) {?>
                    <li>
                        <a href="principal.php?action=frmtp">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Formulario: Tipos de jugador
                        </a>
                    </li>
                    <?php }?>

                </ul>
            </div>
            <img class="mb-4" height="500" width="500" src="models/img/No data-amico.png" />
            
            
        </div>
    </div>