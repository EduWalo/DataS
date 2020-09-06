<?php
    require "controller/connection.php";
    
    
    #fsearch values in database for result
    $sql = "SELECT * FROM quiz_general WHERE id_student=".$_SESSION["id"];
    $resultado = $mysqli->query($sql);# execute uerry
    $num = $resultado->num_rows;# count rows
    if($num>0){
        $showForm=false;
		echo "
		<script type=\"text/javascript\">
			window.location.href = \"principal.php?action=graphics\";
		</script>
		";
    }else {
        $showForm=true; 
        if($_POST){

            if(
                isset($_POST["pgenero"]) &&
                isset($_POST["grado"]) &&
                isset($_POST["edad"]) &&
                (isset($_POST["Facebook"]) ||
                isset($_POST["Instagram"]) ||
                isset($_POST["TikTok"]) ||
                isset($_POST["Pinterest"]) ||
                isset($_POST["correo"]) ||
                isset($_POST["Genius"]) ||
                isset($_POST["LinkedIn"]) ||
                isset($_POST["WhatsApp"]) ||
                isset($_POST["Telegram"]) ||
                isset($_POST["Canva"]) ||
                isset($_POST["Twitter"]) ||
                isset($_POST["Twitch"]) ||
                isset($_POST["YouTube"])
                ))
            {
                   $sql_geneal = 
                    "INSERT INTO quiz_general VALUES("
                    .$_SESSION["id"].","
                    ."'".$_POST["pgenero"]."'".","
                    ."'".$_POST["grado"]."'".","
                    ."'".$_POST["edad"]."'".");";

                    if($mysqli->query($sql_geneal)){
                        // direcition init
                        if(isset($_POST["Facebook"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'Facebook');"
                                );
                        }

                        if(isset($_POST["Instagram"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'Instagram');"
                                );
                        }
                        if(isset($_POST["TikTok"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'TikTok');"
                                );
                        }
                        if(isset($_POST["Pinterest"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'Pinterest');"
                                );
                        }
                        if(isset($_POST["correo"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'correo');"
                                );
                        }
                        if(isset($_POST["Genius"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'Genius');"
                                );
                        }
                        if(isset($_POST["LinkedIn"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'LinkedIn');"
                                );
                        }
                        if(isset($_POST["WhatsApp"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'WhatsApp');"
                                );
                        }
                        
                        if(isset($_POST["Telegram"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'Telegram');"
                                );
                        }
                        if(isset($_POST["Canva"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'Canva');"
                                );
                        }
                        if(isset($_POST["Twitter"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'Twitter');"
                                );
                        }
                        if(isset($_POST["Twitch"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'Twitch');"
                                );
                        }
                        if(isset($_POST["YouTube"])){
                            $mysqli->query("INSERT INTO plataform_rate VALUES ("
                                    .$_SESSION["id"].",'YouTube');"
                                );
                        }

                        //redirecionar pagina
                        echo "
                        <script type=\"text/javascript\">
                            window.location.href = \"principal.php?action=inicio\";
                        </script>
                        ";
                        

                    }else {
                        echo '<div class="alertB">',
						"<span class=\"closebtnB\" onclick=\"this.parentElement.style.display='none';\">&times;</span> ",
						'<strong>¡Cuidado!</strong> error con el server<br>',$mysqli->error,
						'</div>'; 
                    }

                
                
                   

            }else {
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
        <h1 class="page-header-title" >Encuesta de información general  </h1>
    </div>

    <form name="F1" action="<?php echo "?action=gen"?>"  method="POST" >
        <div class="col-lg-auto  mb-2">
            
            <!-- pregunta  de genero-->
            <div class="card mb-2">

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
            </div>    

            <!-- GRADO -->
            <div class="card mb-2">
                <div class="card-header">
                    <h5 class="card-title">Grado cursado actualmente</h5>
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
            </div>

            <!-- EDAD -->
            <div class="card mb-2">
                <div class="card-header">
                    <h5 class="card-title">Rango de edad</h5>
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
            </div>

            <!-- PLATAFORMAS -->
            
            <div class="card mb-2">
                <div class="card-header">
                    <h5 class="card-title">
                    Con que redes sociales y/o herramientas se asocia más frecuentemente
                    </h5>
                    <h6><i>Seleccione varias opciones con las cuales se identifique de manera más fuerte</i></h6>
                    
                </div>
                <div class="card-body" >
                    
                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["Facebook"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Facebook\" value=\"Facebook\" name=\"Facebook\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Facebook\" value=\"Facebook\" name=\"Facebook\">";
                            }
                        ?>
                        <label for="Facebook" class="custom-control-label">Facebook</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["Instagram"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Instagram\" value=\"Instagram\" name=\"Instagram\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Instagram\" value=\"Instagram\" name=\"Instagram\">";
                            }
                        ?>
                        <label for="Instagram" class="custom-control-label">Instagram</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["TikTok"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"TikTok\" value=\"TikTok\" name=\"TikTok\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"TikTok\" value=\"TikTok\" name=\"TikTok\">";
                            }
                        ?>
                        <label for="TikTok" class="custom-control-label">Tik Tok</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["Pinterest"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Pinterest\" value=\"Pinterest\" name=\"Pinterest\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Pinterest\" value=\"Pinterest\" name=\"Pinterest\">";
                            }
                        ?>
                        <label for="Pinterest" class="custom-control-label">Pinterest</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["correo"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"correo\" value=\"correo\" name=\"correo\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"correo\" value=\"correo\" name=\"correo\">";
                            }
                        ?>
                        <label for="correo" class="custom-control-label"> Correo Electrónico</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["Genius"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Genius\" value=\"Genius\" name=\"Genius\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Genius\" value=\"Genius\" name=\"Genius\">";
                            }
                        ?>
                        <label for="Genius" class="custom-control-label">Genius</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["LinkedIn"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"LinkedIn\" value=\"LinkedIn\" name=\"LinkedIn\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"LinkedIn\" value=\"LinkedIn\" name=\"LinkedIn\">";
                            }
                        ?>
                        <label for="LinkedIn" class="custom-control-label">LinkedIn</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                       <?php
                            if (isset($_POST["WhatsApp"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"WhatsApp\" value=\"WhatsApp\" name=\"WhatsApp\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"WhatsApp\" value=\"WhatsApp\" name=\"WhatsApp\">";
                            }
                        ?>
                        <label for="WhatsApp" class="custom-control-label">WhatsApp</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                       <?php
                            if (isset($_POST["Telegram"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Telegram\" value=\"Telegram\" name=\"Telegram\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Telegram\" value=\"Telegram\" name=\"Telegram\">";
                            }
                        ?>
                        <label for="Telegram" class="custom-control-label">Telegram</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                       <?php
                            if (isset($_POST["Canva"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Canva\" value=\"Canva\" name=\"Canva\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Canva\" value=\"Canva\" name=\"Canva\">";
                            }
                        ?>
                        <label for="Canva" class="custom-control-label">Canva</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["Twitter"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Twitter\" value=\"Twitter\" name=\"Twitter\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Twitter\" value=\"Twitter\" name=\"Twitter\">";
                            }
                        ?>
                        <label for="Twitter" class="custom-control-label">Twitter</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["Twitch"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Twitch\" value=\"Twitch\" name=\"Twitch\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"Twitch\" value=\"Twitch\" name=\"Twitch\">";
                            }
                        ?>
                        <label for="Twitch" class="custom-control-label">Twitch</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <?php
                            if (isset($_POST["YouTube"])){
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"YouTube\" value=\"YouTube\" name=\"YouTube\" checked>";
                            }else {
                                echo "<input class=\"custom-control-input\" type=\"checkbox\" id=\"YouTube\" value=\"YouTube\" name=\"YouTube\">";
                            }
                        ?>
                        <label for="YouTube" class="custom-control-label">YouTube</label>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" >ENVIAR</a>
        </div>
    </form>
</div>
<?php }?>