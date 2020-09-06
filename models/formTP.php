<?php
    require "controller/connection.php";
    
    $fg = new FormGenerator();

    // consult the existence or results
	$sql = "SELECT * FROM quiz_type_players WHERE id_student =".$_SESSION["id"];
	// echo $_SESSION["id"];
	$resultado = $mysqli->query($sql);
	$num = $resultado->num_rows;//extract the number of rows
	// echo $num;
	if($num >0){//probar si hay resultados de encuestas previas 
		// mostrar resultados
		$showForm=false;
		
		echo "
		<script type=\"text/javascript\">
			window.location.href = \"principal.php?action=graphics\";
		</script>
		";
	}else{

        if($_POST){
            //vars
            $dimention= array(0,0,0,0,0,0); //dimenciones de evaluacion 
            $total_puntos=0;

            //consulta
            $sqltp = "INSERT INTO quiz_type_players VALUES(".$_SESSION["id"];
            $sqltp_rs = "INSERT INTO quiz_type_players_rs (id_student, philanthrop, socialiser, free_spirit, achiever, disruptor, player )  VALUES(".$_SESSION["id"];

            //recorrer puntos
            $total_puntos=0;
            for ($i=1; $i < 25; $i++) { 
                $pos = floor (($i - 1)/4) ;//posicion  en el array de dimenciones 
                $dimention[$pos] += $_POST["p".$i];//acomulacion de los puntos en cada dimencion
                $total_puntos +=$_POST["p".$i];//acomulacion de los puntos en total

                $sqltp .= ",".$_POST["p".$i];//build sql 
            }

            $sqltp .= ");";

            // porcents
            $philantrop_porcent = (100.0/$total_puntos)*$dimention[0];
            $socializer_porcent = (100.0/$total_puntos)*$dimention[1];
            $free_spirit_porcent = (100.0/$total_puntos)*$dimention[2];
            $archiver_porcent = (100.0/$total_puntos)*$dimention[3];
            $disruptor_porcent = (100.0/$total_puntos)*$dimention[4];
            $player_porcent = (100.0/$total_puntos)*$dimention[5];

            $sqltp_rs .= ",".$philantrop_porcent.",".$socializer_porcent
                        .",".$free_spirit_porcent.",".$archiver_porcent
                        .",".$disruptor_porcent.",".$player_porcent.");";
            var_dump($sqltp_rs);
            var_dump($sqltp);
            
            if(!($mysqli->query($sqltp) && $mysqli->query($sqltp_rs) )){
                echo '<div class="alertB">',
                "<span class=\"closebtnB\" onclick=\"this.parentElement.style.display='none';\">&times;</span> ",
                '<strong>¡Cuidado!</strong> error con el server<br>',$mysqli->error,
                '</div>';
            }else {
                echo "
                    <script type=\"text/javascript\">
                        window.location.href = \"principal.php?action=inicio\";
                    </script>
                    ";
            }
        }

        

    }
?>


<div class=" mt-4 ml-n1"  >

    <div class="header col-lg-8" >
        <h1 class="page-header-title" >Encuesta para: Tipos de jugador  </h1>
    </div>

    <form name="F3" action="<?php echo "?action=frmtp"?>"  method="POST" > 
        <div class="card  mb-2"> 

        <!-- Philantrop -->
            <?php $fg->generateSelect("Me siento feliz siendo capaz de ayudar a los demás.",1);?>
            <?php $fg->generateSelect("Me gusta guiar a los demás en situaciones nuevas.",2);?>
            <?php $fg->generateSelect("Me gusta compartir mi conocimiento con los demás.",3);?>
            <?php $fg->generateSelect("El bienestar de los demás es importante para mí.",4);?>
        <!-- socializer -->
            <?php $fg->generateSelect("Interactuar con los demás es importante para mí.",5);?>
            <?php $fg->generateSelect("Me gusta formar parte de un equipo.",6);?>
            <?php $fg->generateSelect("Sentir que formo parte de una comunidad es importante para mí.",7);?>
            <?php $fg->generateSelect("Disfruto participando en actividades grupales.",8);?>
        <!-- Free spirit -->
            <?php $fg->generateSelect("Seguir mi propio camino es importante para mí",9);?>
            <?php $fg->generateSelect("A menudo me dejo guiar por la curiosidad.",10);?>
            <?php $fg->generateSelect("Me gusta probar cosas nuevas.",11);?>
            <?php $fg->generateSelect("Ser independiente es importante para mí.",12);?>
        <!-- Archiver -->
            <?php $fg->generateSelect("Me gusta superar las dificultades.",13);?>
            <?php $fg->generateSelect("Realizar siempre por completo mis tareas es importante para mí.",14);?>
            <?php $fg->generateSelect("Me resulta difícil abandonar un problema antes de solucionarlo.",15);?>
            <?php $fg->generateSelect("Me gusta dominar tareas difíciles.",16);?>
        <!-- Disruptor -->
            <?php $fg->generateSelect("Me gusta provocar.",17);?>
            <?php $fg->generateSelect("Me gusta cuestionar el estado de las cosas.",18);?>
            <?php $fg->generateSelect("Me describo a mí mismo como un rebelde.",19);?>
            <?php $fg->generateSelect("No me gusta seguir las reglas.",20);?>
        <!-- Player -->
            <?php $fg->generateSelect("Me gustan las competiciones en las que se pueda ganar un premio.",21);?>
            <?php $fg->generateSelect("Los premios son una buena manera de motivarme.",22);?>
            <?php $fg->generateSelect("Recuperar lo invertido es importante para mí.",23);?>
            <?php $fg->generateSelect("Si el premio es adecuado, voy a hacer un esfuerzo.",24);?>

            
        </div>
        <button type="submit" class="btn btn-primary" >ENVIAR</a>
    </form>

</div>