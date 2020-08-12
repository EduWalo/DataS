
<?php
	require "controller/connection.php";

	$fg = new FormGenerator();

	// consult the existence or results
	$sql = "SELECT * FROM student_result WHERE id_student =".$_SESSION["id"];
	// echo $_SESSION["id"];
	$resultado = $mysqli->query($sql);
	$num = $resultado->num_rows;//extract the number of rows
	// echo $num;
	if($num >0){//probar si hay resultados de encuestas previas 
		// mostrar resultados
		$showForm=false;
		include "models/lsgraphics.php";
		
		
	}else {// si no dejar presentar la encuesta
		$showForm=true;

		if($_POST){
			//  var_dump($_POST);
			//serch the first fields 
			if(
				isset($_POST["pgenero"]) &&
				isset($_POST["grado"]) &&
				isset($_POST["edad"]) 
			){
				//test each question
				$revisarP = true;
				for ($i=1; $i <= 44; $i++) { 
					if(!(isset($_POST["pregunta".$i]))){
						$revisarP = false;
						break;
					}
				}

				//probe the error 
				if($revisarP){ //all questions send success
					//guardar valores 
					//personal data
					$sql = "INSERT INTO 
					personal_data (id_student, genero, grado, range_edad)
					VALUES ("
					."'".$_SESSION['id']."'".","
					."'".$_POST['pgenero']."'".","
					."'".$_POST['grado']."'".","
					."'".$_POST['edad']."'"
					.")";

					//guardar preguntas 
					//build sql and results
					
					$resultA= array(0,0,0,0);
					$resultB= array(0,0,0,0);

					

					//sql's
					$sqlT ="INSERT INTO student_answer ( id_student";
					$sqlB ="VALUE (".$_SESSION["id"];
					

					for ($i=1; $i <= 44; $i++) { 
						$sqlT = $sqlT.", p".$i;
						$sqlB = $sqlB.","."'".$_POST["pregunta".$i]."'";

						if($_POST["pregunta".$i] === 'A'){
							$resultA[(($i+3)%4)]++;
						}else {
							$resultB[(($i+3)%4)]++;
						}
					}
					// append sql
					$sql2 = $sqlT.") ".$sqlB.") ";

					//processs the data 

					//process
					if($resultA[0] >$resultB[0]){
						$process = 'ACT';
					}else {
						$process = 'REF';
					}
					$process_value = abs($resultA[0] - $resultB[0]);

					//Perception
					if($resultA[1] >$resultB[1]){
						$perception = 'SENS';
					}else {
						$perception = 'INT';
					}
					$perception_value = abs( $resultA[1] - $resultB[1] );

					//flume
					if($resultA[2] >$resultB[2]){
						$channel = 'VIS';
					}else {
						$channel = 'VERB';
					}
					$channel_value = abs($resultA[2] - $resultB[2]);

					//understand
					if($resultA[3] >$resultB[3]){
						$understand = 'SEC';
					}else {
						$understand = 'GLOB';
					}
					$understand_value = abs($resultA[3] - $resultB[3]);

					$sql3 = "INSERT INTO `student_result` 
					(`id_student`, 
					`process`, `process_value`, 
					`perception`, `perception_value`, 
					`channel`, `channel_value`, 
					`understand`, `understand_value`) 
					VALUES (".$_SESSION["id"].","
					."'".$process."'".",".$process_value.","
					."'".$perception."'".",".$perception_value.","
					."'".$channel."'".",".$channel_value.","
					."'".$understand."'".",".$understand_value.")";

					//execute fields 
					if($mysqli->query($sql) &&
					$mysqli->query($sql2) &&
					$mysqli->query($sql3)
					){
						echo '<div class="alertB success">',
						"<span class=\"closebtnB\" onclick=\"this.parentElement.style.display='none';\">&times;</span> ",
						'<strong>¡Exito!</strong> guardado los datos con exito',
						'</div>';
						
					}else {
						echo '<div class="alertB">',
						"<span class=\"closebtnB\" onclick=\"this.parentElement.style.display='none';\">&times;</span> ",
						'<strong>¡Cuidado!</strong> error con el server<br>', $sql, $sql2, $sql3 ,$mysqli->error,
						'</div>';    
					}
				}else{// error un question
					echo
					'<div class="alertB ">',
					"<span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> ",
					'HACE FALTA LA PREGUNTA '.$i,
					'</div>';	
				}

			}else {//error in first fields
				echo 
				'<div class="alertB ">',
				"<span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span> ",
				'HACE FALTA ALGUNO DE LOS CAMPOS POR LLENAR, POR FAVOR REVISAR',
				'</div>';
			}
		}

	}
	

	
	
?>
<?php if($showForm){?>
<div class=" mt-4 ml-n1"  >

	<div class="header col-lg-8" >
		<h1 class="page-header-title" >Encuesta Estilos de aprendizaje  </h1>
		<p class="page-header-text mt-2 mb-5" style="text-align: justify;">
		Este formulario busca utilizar el modelo teórico planteado por Modelo de Felder y Silverman para determinar las dimensiones de aprendizaje e inclinación en las cuales te desempeñas con un rendimiento más ameno y quizás accediendo y comprendiendo información de manera más eficaz.
		</p>
	
	</div>

	<!-- <form name="formls" method="POST" action="models/formValidation.php"> -->
	<!-- <form method="POST" action="<?php //echo $_SERVER['PHP_SELF'];?>"> -->
	<form name="F1" action="<?php echo "?action=frmls"?>"  method="POST" >
		<div class="col-lg-auto  mb-2">
			<div class="card">
				<!-- cabecera de ficha de formulario -->
				<div class="card-header">
					<h2 class="card-title">Modelo de Felder y Silverman</h2>
				</div>
				<div class="card-body">
					<h6 class="card-subtitle text-muted">
						Lee detenidamente y por favor responde
						<br/>
						Si alguna de las respuestas coinciden contigo, marca la que te represente mejor.
						<br/>
						<br/>
						<br/>
						<br/>
					</h6>


					<div class="card-header">
						<h5 class="card-title">Género</h5>
					</div>
					<div class="card-body" >
						<?php
						 if(isset($_POST["pgenero"])){
							if($_POST["pgenero"] === "Femenino"){
								echo 
								"<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pg1\" name=\"pgenero\" class=\"custom-control-input\"
									value=\"Femenino\"
									checked>
									<label class=\"custom-control-label\" for=\"pg1\">Femenino</label>
								</div>";
							}else{
								echo 
								"<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pg1\" name=\"pgenero\" class=\"custom-control-input\"
									value=\"Femenino\">
									<label class=\"custom-control-label\" for=\"pg1\">Femenino</label>
								</div>";
							}

							if($_POST["pgenero"] === "Masculino"){
								echo 
								"<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pg2\" name=\"pgenero\" class=\"custom-control-input\"
									value=\"Masculino\" checked>
									<label class=\"custom-control-label\" for=\"pg2\">Masculino</label>
								</div>";
							}else{
								echo 
								"<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pg2\" name=\"pgenero\" class=\"custom-control-input\"
									value=\"Masculino\">
									<label class=\"custom-control-label\" for=\"pg2\">Masculino</label>
								</div>";
							}

							if($_POST["pgenero"] === "NN"){
								echo 
								"<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pg5\" name=\"pgenero\" class=\"custom-control-input\"
									value=\"NN\" checked>
									<label class=\"custom-control-label\" for=\"pg5\">Prefiero no indicarlo</label>
								</div>";
							}else{
								echo 
								"<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pg5\" name=\"pgenero\" class=\"custom-control-input\"
									value=\"NN\">
									<label class=\"custom-control-label\" for=\"pg5\">Prefiero no indicarlo</label>
								</div>";
							}

						 }else{	
							echo 
							"<div class=\"mb-2 custom-radio custom-control\">
								<input type=\"radio\" id=\"pg1\" name=\"pgenero\" class=\"custom-control-input\"
								value=\"Femenino\">
								<label class=\"custom-control-label\" for=\"pg1\">Femenino</label>
							</div>
							<div class=\"mb-2 custom-radio custom-control\">
								<input type=\"radio\" id=\"pg2\" name=\"pgenero\" class=\"custom-control-input\"
								value=\"Masculino\">
								<label class=\"custom-control-label\" for=\"pg2\">Masculino</label>
							</div>
							<div class=\"mb-2 custom-radio custom-control\">
								<input type=\"radio\" id=\"pg5\" name=\"pgenero\" class=\"custom-control-input\"
								value=\"NN\">
								<label class=\"custom-control-label\" for=\"pg5\">Prefiero no indicarlo</label>
							</div>";
							
						 }
						?>
					</div>


					<div class="card-header">
						<h5 class="card-title">Grado cursado actualemente</h5>
					</div>
					<div class="card-body" ">

						<?php
							if(isset($_POST["grado"])){
								if($_POST["grado"] === "6" ){
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pgr1\" name=\"grado\" class=\"custom-control-input\"
										value=\"6\" checked>
										<label class=\"custom-control-label\" for=\"pgr1\">6°</label>
									</div>";
								}else{
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pgr1\" name=\"grado\" class=\"custom-control-input\"
										value=\"6\">
										<label class=\"custom-control-label\" for=\"pgr1\">6°</label>
									</div>";
								}

								if($_POST["grado"] === "7" ){
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pgr2\" name=\"grado\" class=\"custom-control-input\"
										value=\"7\" checked>
										<label class=\"custom-control-label\" for=\"pgr2\">7°</label>
									</div>";
								}else{
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pgr2\" name=\"grado\" class=\"custom-control-input\"
										value=\"7\">
										<label class=\"custom-control-label\" for=\"pgr2\">7°</label>
									</div>";
								}

								if($_POST["grado"] === "8" ){
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pgr3\" name=\"grado\" class=\"custom-control-input\"
										value=\"8\" checked>
										<label class=\"custom-control-label\" for=\"pgr3\">8°</label>
									</div>";
								}else{
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pgr3\" name=\"grado\" class=\"custom-control-input\"
										value=\"8\">
										<label class=\"custom-control-label\" for=\"pgr3\">8°</label>
									</div>";
								}

								if($_POST["grado"] === "9" ){
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pgr4\" name=\"grado\" class=\"custom-control-input\"
										value=\"9\" checked>
										<label class=\"custom-control-label\" for=\"pgr4\">9°</label>
									</div>";
								}else{
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pgr4\" name=\"grado\" class=\"custom-control-input\"
										value=\"9\">
										<label class=\"custom-control-label\" for=\"pgr4\">9°</label>
									</div>";
								}

							}else {
								echo
								"<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pgr1\" name=\"grado\" class=\"custom-control-input\"
									value=\"6\">
									<label class=\"custom-control-label\" for=\"pgr1\">6°</label>
								</div>
								<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pgr2\" name=\"grado\" class=\"custom-control-input\"
									value=\"7\">
									<label class=\"custom-control-label\" for=\"pgr2\">7°</label>
								</div>
								<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pgr3\" name=\"grado\" class=\"custom-control-input\"
									value=\"8\">
									<label class=\"custom-control-label\" for=\"pgr3\">8°</label>
								</div>
								<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pgr4\" name=\"grado\" class=\"custom-control-input\"
									value=\"9\">
									<label class=\"custom-control-label\" for=\"pgr4\">9°</label>
								</div>";
							}
						?>
						
					</div>

					<div class="card-header">
						<h5 class="card-title">Edad</h5>
					</div>
					<div class="card-body" ">
						<?php
							if(isset($_POST["edad"]) ){
								if($_POST["edad"] === "10-12" ){
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pe1\" name=\"edad\" class=\"custom-control-input\"
										value=\"10-12\" checked>
										<label class=\"custom-control-label\" for=\"pe1\">10-12</label>
									</div>";
								}else{
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pe1\" name=\"edad\" class=\"custom-control-input\"
										value=\"10-12\">
										<label class=\"custom-control-label\" for=\"pe1\">10-12</label>
									</div>";
								}

								if($_POST["edad"] === "13-15" ){
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pe2\" name=\"edad\" class=\"custom-control-input\"
										value=\"13-15\" checked>
										<label class=\"custom-control-label\" for=\"pe2\">13-15</label>
									</div>";
								}else{
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pe2\" name=\"edad\" class=\"custom-control-input\"
										value=\"13-15\">
										<label class=\"custom-control-label\" for=\"pe2\">13-15</label>
									</div>";
								}

								if($_POST["edad"] === "16-18" ){
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pe3\" name=\"edad\" class=\"custom-control-input\"
										value=\"16-18\" checked>
										<label class=\"custom-control-label\" for=\"pe3\">16-18</label>
									</div>";
								}else{
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pe3\" name=\"edad\" class=\"custom-control-input\"
										value=\"16-18\">
										<label class=\"custom-control-label\" for=\"pe3\">16-18</label>
									</div>";
								}

								if($_POST["edad"] === "mas de 18" ){
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pe4\" name=\"edad\" class=\"custom-control-input\"
										value=\"mas de 18\" checked>
										<label class=\"custom-control-label\" for=\"pe4\">Mayor de 18</label>
									</div>";
								}else{
									echo
									"<div class=\"mb-2 custom-radio custom-control\">
										<input type=\"radio\" id=\"pe4\" name=\"edad\" class=\"custom-control-input\"
										value=\"mas de 18\">
										<label class=\"custom-control-label\" for=\"pe4\">Mayor de 18</label>
									</div>";
								}

							}else {
								echo
								"<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pe1\" name=\"edad\" class=\"custom-control-input\"
									value=\"10-12\">
									<label class=\"custom-control-label\" for=\"pe1\">10-12</label>
								</div>
								<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pe2\" name=\"edad\" class=\"custom-control-input\"
									value=\"13-15\">
									<label class=\"custom-control-label\" for=\"pe2\">13-15</label>
								</div>
								<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pe3\" name=\"edad\" class=\"custom-control-input\"
									value=\"16-18\">
									<label class=\"custom-control-label\" for=\"pe3\">16-18</label>
								</div>
								<div class=\"mb-2 custom-radio custom-control\">
									<input type=\"radio\" id=\"pe4\" name=\"edad\" class=\"custom-control-input\"
									value=\"mas de 18\">
									<label class=\"custom-control-label\" for=\"pe4\">Mayor de 18</label>
								</div>";
							}
						?>
					</div>

					
					<?php
					$fg->generateTwoOptions(
						'1. Entiendo mejor algo cuando:',
						'Lo práctico',
						'Pienso en ello',
						1);
					$fg->generateTwoOptions(
						'2. ¿Qué tipo de enfoque crees que predomina más en ti?',
						'Realista',
						'Innovador',
						2);
					$fg->generateTwoOptions(
						'3. Cuando piensas en lo que hiciste el día anterior, lo haces basándote en:',
						'Imágenes',
						'Palabras',
						3);
					$fg->generateTwoOptions(
						'4. En el instante en el que entiendes algo lo haces:',
						'Entendiendo los detalles de un tema pero no viendo su estructura completa',
						'Entendiendo la estructura completa del tema pero no viendo claramente los detalles',
						4);
					$fg->generateTwoOptions(
						'5. Cuando intentas aprender algo nuevo, te ayuda:',
						'Hablar de ello',
						'Pensar en ello',
						5);
					$fg->generateTwoOptions(
						'6. Si fueses un profesor, preferirías dar un curso:',
						'Que trate más sobre hechos y situaciones reales de la vida',
						'Que trate con ideas y teorías',
						6);
					$fg->generateTwoOptions(
						'7. Prefiero obtener información nueva por medio de:',
						'Imágenes, diagramas, gráficas  mapas',
						'Instrucciones escritas o información verbal',
						7);
					$fg->generateTwoOptions(
						'8. ¿De qué maneras logras entender mejor un tema?',
						'Entiendo primero sus partes, luego su totalidad',
						'Comprendo su estructura total y luego como encajan sus partes',
						8);
					$fg->generateTwoOptions(
						'9. En un grupo de estudio que trabaja con un material difícil, es más probable que mi actitud sea:',
						'Participar y contribuir con ideas',
						'No participe y solo escuche',
						9);
					$fg->generateTwoOptions(
						'10. Se me facilita más ',
						'Aprender con hechos',
						'Aprender con conceptos',
						10);
					$fg->generateTwoOptions(
						'11. En un libro con muchas imágenes y gráficas es más probable que:',
						'Me enfoque más en revisar cuidadosamente las imágenes y las gráficas',
						'Me enfoque mas en leer todo el texto y el contenido escrito',
						11);
					$fg->generateTwoOptions(
						'12. Cuando resuelvo problemas de matemáticas',
						'IGeneralmente trabajo sobre soluciones con un paso a la vezmágenes',
						'Frecuentemente sé cuales son las soluciones, pero luego tengo dificultad para imaginarme los pasos para llegar a ellas',
						12);
					$fg->generateTwoOptions(
						'13. En las clases a las que he asistido',
						'He llegado a saber como son muchos de los estudiantes',
						'Raramente he llegado a saber como son muchos de los estudiantes',
						13);
					$fg->generateTwoOptions(
						'14. Cuando leo temas que no son de ficción, prefiero:',
						'Algo que me enseñe nuevos hechos o me diga como hacer algo',
						'Algo que me dé nuevas ideas para pensar',
						14);
					$fg->generateTwoOptions(
						'15. Me agrada más cuando un maestro ',
						'Utilizan muchos esquemas en el tablero',
						'Toman mucho tiempo en la explicación',
						15);
					$fg->generateTwoOptions(
						'16. Cuando estoy analizando un cuento o una novela',
						'Pienso en los incidentes y trato de acomodarlos para estructurar los temas',
						'Me doy cuenta de cuáles son los temas cuando termino de leer y luego tengo que regresar y encontrar los incidentes que los demuestran',
						16);
					$fg->generateTwoOptions(
						'17. Cuando comienzo a resolver un problema de tarea, es más probable que:',
						'Comience a trabajar en su solución inmediatamente',
						'Primero trate de entender completamente el problema',
						17);
					$fg->generateTwoOptions(
						'18. Prefiero la idea de:',
						'Certeza',
						'Teoría',
						18);
					$fg->generateTwoOptions(
						'19. Recuerdo mejor:',
						'Lo que veo',
						'Lo que oigo',
						19);
					$fg->generateTwoOptions(
						'20. Es más importante para mí que un profesor@:',
						'Exponga el material en pasos secuenciales claros',
						'Me dé un panorama general y relacione el material con otros temas',
						20);
					$fg->generateTwoOptions(
						'21. Prefiero estudiar de manera:',
						'Grupal (un grupo de estudio)',
						'Solo',
						21);
					$fg->generateTwoOptions(
						'22. Me considero:',
						'Cuidadoso en los detalles al realizar mi trabajo',
						'Creativo en la manera en la que realizo mi trabajo',
						22);
					$fg->generateTwoOptions(
						'23. Cuando alguien me da direcciones de nuevos lugares, prefiero usar:',
						'Un mapa',
						'Instrucciones escritas',
						23);
					$fg->generateTwoOptions(
						'24. Aprendo de manera:',
						'Constante, si estudio con empeño consigo lo deseado',
						'Con pausas y reinicios, me llego a confundir muchas veces pero súbitamente  lo entiendo',
						24);
					$fg->generateTwoOptions(
						'25. Prefiero primero',
						'Hacer algo y ver que sucede',
						'Pensar como voy a hacer algo',
						25);
					$fg->generateTwoOptions(
						'26. Cuando leo por diversión, me agradan más los escritores que ',
						'Dicen claramente lo que desean dar a entender',
						'Dicen las cosas en forma creativa e interesantes',
						26);
					$fg->generateTwoOptions(
						'Cuando veo un esquema o bosquejo en clase, es más probable que de él recuerde:',
						'Las imágenes que lo componen',
						'Lo que el profesor dijo acerca del mismo',
						27);
					$fg->generateTwoOptions(
						'28. Cuando me enfrento a una cantidad de información:',
						'Me concentro en los detalles y pierdo de vista de la misma',
						'Trato de entender el todo antes de concentrarme en los detalles',
						28);
					$fg->generateTwoOptions(
						'29. Recuerdo más fácilmente',
						'Algo que he hecho',
						'Algo en lo que he pensado mucho',
						29);
					$fg->generateTwoOptions(
						'30. Cuando tengo que hacer un trabajo, prefiero',
						'Dominar una manera de hacerlo',
						'Intentar nuevas formas de hacerlo',
						30);
					$fg->generateTwoOptions(
						'31. Cuando alguien me quiere mostrar datos, prefiero',
						'El uso de gráficas',
						'El uso de texto para resumir los resultados',
						31);
					$fg->generateTwoOptions(
						'32. Cuando escribo un trabajo, es más probable que lo haga (piense o escriba)',
						'Desde el inicio y avance poco a poco',
						'En distintas partes y luego las ordene',
						32);
					$fg->generateTwoOptions(
						'33. Cuando tengo que trabajar en un proyecto de grupo, primero quiero',
						'Realiza una "Lluvia de ideas" donde cada integrante contribuye con su opinión o ideas',
						'Realizar la "Lluvia de ideas", de manera individual y luego juntarme con el grupo para compararlas',
						33);
					$fg->generateTwoOptions(
						'34. Considero que el mejor elogio para alguien',
						'Sensible',
						'Imaginativo',
						34);
					$fg->generateTwoOptions(
						'35. Cuando conozco gente en una fiesta, es probable que recuerde',
						'Cómo es su apariencia',
						'Lo que dicen de sí mismos',
						35);
					$fg->generateTwoOptions(
						'36. Cuando estoy aprendiendo un tema, prefiero',
						'Mantenerme concentrado en ese tema, aprendiendo lo más que se pueda de él',
						'Hacer conexiones entre ese tema y temas relacionados',
						36);
					$fg->generateTwoOptions(
						'37. Me considero un ser:',
						'Abierto',
						'Reservado',
						37);
					$fg->generateTwoOptions(
						'38. Prefiero cursos que dan más importancia a ',
						'Material concreto (hechos, datos)',
						'Material abstracto (conceptos, teoría)',
						38);
					$fg->generateTwoOptions(
						'39. Para divertirme prefiero:',
						'Ver televisión',
						'Leer un libro',
						39);
					$fg->generateTwoOptions(
						'40. Algunos profesores inician sus clases haciendo un bosquejo de lo que enseñan, estos bosquejos para ti son:',
						'Algo útiles',
						'Muy útiles',
						40);
					$fg->generateTwoOptions(
						'41. La idea de hacer un trabajo grupal con una sola calificación para todos:',
						'Me parece bien o justa',
						'No me parece bien o injusta',
						41);
					$fg->generateTwoOptions(
						'42. Cuando hago grandes cálculos',
						'Tiendo a repetir todos mis pasos para revisar cuidadosamente mi trabajo',
						'Me cansa hacer su revisión y tengo que esforzarme para hacerlo',
						42);
					$fg->generateTwoOptions(
						'43. Tiendo a recordar lugares en los que he estado',
						'Con fácilmente y con bastante exactitud',
						'Con dificultad y sin mucho detalle',
						43);
					$fg->generateTwoOptions(
						'44. Cuando resuelvo problemas en grupo, es más probable que yo:',
						'Piense en los pasos para la solución de los problemas',
						'Piense en las posibles consecuencias o aplicaciones de la solución en un amplio rango de campos',
						44);
					?> 
				</div>
				
			</div>
			<button type="submit" class="btn btn-primary" >Ingresar</a>
		</div>

		


	</form>


</div>

<?php }?>