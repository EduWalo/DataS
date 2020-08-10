<?php

//  esta clase se encargará de mandar los respectivos contenidos a la pagina 
class MVController{
    // esta funcion enlaseará el contenido dentro de una section
    public function enrutar()
    {
        if(isset($_GET["action"])){
			$linkeded  = $_GET["action"];//load action

			if($linkeded === 'inicio'){
				$contenido = "models/inicio.php";    
			}else if($linkeded=="frmls"){
				$contenido = "models/formLS.php";    
			}else {
				$contenido = "404.php";    
			}
			// echo $linkeded  ;//load actionC
        }else {
            $contenido = "models/inicio.php";    
        }

        include $contenido;
    }
}

//  this class generathe some code
class FormGenerator
{
	public function generateTwoOptions($pregunta, $option1,$option2,$number){
		
		$code =
		"<div class=\"card-header\">
			<h5 class=\"card-title\">
				$pregunta
			</h5>
		</div>";

		if(isset($_POST["pregunta".$number])){
			if($_POST["pregunta".$number] === "A"){
				$code = $code.
				"<div class=\"card-body\">
					<div class=\"mb-2 custom-radio custom-control\">
						<input type=\"radio\" 
						id=\"p".$number."A\" name=\"pregunta".$number."\" value=\"A\" class=\"custom-control-input\" checked>
						<label class=\"custom-control-label\" for=\"p".$number."A\">
							$option1
						</label>
					</div>
					<div class=\"mb-2 custom-radio custom-control\">
						<input type=\"radio\" 
						id=\"p".$number."B\" name=\"pregunta".$number."\" value=\"B\" class=\"custom-control-input\">
						<label class=\"custom-control-label\" for=\"p".$number."B\">
							$option2
						</label>
					</div>
				</div>";;
			}else {
				$code = $code.
				"<div class=\"card-body\">
					<div class=\"mb-2 custom-radio custom-control\">
						<input type=\"radio\" 
						id=\"p".$number."A\" name=\"pregunta".$number."\" value=\"A\" class=\"custom-control-input\" >
						<label class=\"custom-control-label\" for=\"p".$number."A\">
							$option1
						</label>
					</div>
					<div class=\"mb-2 custom-radio custom-control\">
						<input type=\"radio\" 
						id=\"p".$number."B\" name=\"pregunta".$number."\" value=\"B\" class=\"custom-control-input\" checked>
						<label class=\"custom-control-label\" for=\"p".$number."B\">
							$option2
						</label>
					</div>
				</div>";
			}
		}else {
			$code =$code.
			"<div class=\"card-body\">
				<div class=\"mb-2 custom-radio custom-control\">
					<input type=\"radio\" 
					id=\"p".$number."A\" name=\"pregunta".$number."\" value=\"A\" class=\"custom-control-input\" >
					<label class=\"custom-control-label\" for=\"p".$number."A\">
						$option1
					</label>
				</div>
				<div class=\"mb-2 custom-radio custom-control\">
					<input type=\"radio\" 
					id=\"p".$number."B\" name=\"pregunta".$number."\" value=\"B\" class=\"custom-control-input\">
					<label class=\"custom-control-label\" for=\"p".$number."B\">
						$option2
					</label>
				</div>
			</div>";
		}
		
		//show question

		echo $code;
	}
}



?>