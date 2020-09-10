<?php
    require "controller/connection.php";

    $rowsLs = $resultadoLs->fetch_assoc();
    $rowsTp = $resultadoTp->fetch_assoc();
    
    // labest to graphics 
    $labelsLs= array();
    if ($rowsLs["perception"] == "INT"){
      $labelsLs["perception"] = "Intuitivo";
    }else {
      $labelsLs["perception"] = "Sensitivo";
    }

    if ($rowsLs["input"] == "VERB"){
      $labelsLs["input"] = "Verbal";
    }else {
      $labelsLs["input"] = "Visual";
    }

    if ($rowsLs["processes"] == "REF"){
      $labelsLs["processes"] = "Reflectivo";
    }else {
      $labelsLs["processes"] = "Activo";
    }

    if ($rowsLs["understand"] == "GLOB"){
      $labelsLs["understand"] = "Global";
    }else {
      $labelsLs["understand"] = "Secuencial";
    }

    // valores de la data
    $dataLs = array();
    $dataLs["perception"] = $rowsLs["perception_val"];
    $dataLs["input"] = $rowsLs["input_val"];
    $dataLs["processes"] = $rowsLs["processes_val"];
    $dataLs["understand"] = $rowsLs["understand_val"];

    // colores de la fuerza con la que se inclina 
    $backg = array();
    $backg_b = array();

    //funciton to generate the colors
    function getcolor($puntaje)
    {
      if($puntaje<=4){
        $color["rgba"] = "rgba(0, 146, 134, 0.4)";
        $color["rgb"] = "rgb(0, 146, 134)";
      }else if($puntaje<=8){
        $color["rgba"] = "rgba(0, 188, 170, 0.5)";
        $color["rgb"] = "rgb(0, 188, 170)";
      }else {
        $color["rgba"] = "rgba(44, 252, 189, 0.6)";
        $color["rgb"] = "rgb(44, 252, 189)";
      }
      return $color;
    }
    //this function allow know the value of points
    function getKnow($puntos, $equ, $modF){
      if($puntos <= 4){
        return "Presenta una <strong>preferencia equilibrada </strong> por las direccionamiento <i>".$equ."</i> aunque con una preferencia leve por un direccionamiento más ".$modF."<br>";
      }else if($puntos <= 8){
        return "Presenta una <strong>preferencia Moderada </strong>por un direccionamiento ".$modF.
        " así que puede que se le pueda facilitar el aprendizaje si se le brinda apoyo en esa dirección <br>";
      }else {
        return "Presenta una <strong>preferencia fuerte </strong>por un direccionamiento ".$modF.
        " así que puede que se puede que se dificulte para aprender en ambientes que no cuenten con apoyo en esa dirección <br>";
      }
      
    }
    
    //set 
    $backg_b["perception"] = getcolor($rowsLs["perception_val"])["rgb"];
    $backg["perception"] = getcolor($rowsLs["perception_val"])["rgba"];

    $backg_b["input"] = getcolor($rowsLs["input_val"])["rgb"];
    $backg["input"] = getcolor($rowsLs["input_val"])["rgba"];

    $backg_b["processes"] = getcolor($rowsLs["processes_val"])["rgb"];
    $backg["processes"] = getcolor($rowsLs["processes_val"])["rgba"];
    
    $backg_b["understand"] = getcolor($rowsLs["understand_val"])["rgb"];
    $backg["understand"] = getcolor($rowsLs["understand_val"])["rgba"];


    //tratamiento
    
    $motivacionesTP = array(
      "philanthrop" => '<h6 class=" card-subtitle">Componente Filántropo: <i> Propósito </i></h6>
        <p class="card-text p-2">
          Requiere un propósito como motivación principal, siendo capaz de trabajar por esta sin esperar algo a cambio. 
          <br>
          Puede ser de mucha ayuda para servir constructivamente y generar una experiencia positiva. 
          <br>
          Responde de manera motivada ante elementos de intercambio de conocimiento, tareas administrativas, roles de guía y actividades de comercio o colección. 
        </p>',

      "socialiser" =>
        '<h6 class=" card-subtitle">Componente Socializador:  <i>Relaciones Interpersonales </i></h6>
        <p class="card-text p-2">
          Requiere de un entorno que les permita gene   rar distintas conexiones interpersonales con los demás participantes. 
          <br>
          Es visto muy motivado dentro de los entornos en donde se pueda interactuar con otros y crear conexiones sociales, respondiendo a estímulos y actividades elaboradas para desarrollarse de manera grupal. 
          <br>
          Responde de manera positiva ante actividades que se definan en entornos de trabajo en equipo o agrupaciones, gremios, etc. 
        </p>',

      "free_spirit" => 
        '<h6 class=" card-subtitle">Componente Espíritu Libre: <i>Autonomía</i> </h6>
        <p class="card-text p-2">
          Requiere de un entorno que no limite las acciones de descubrimiento y exploración. 
          <br>
          Puede ser de ayuda en contextos de navegación, creatividad e innovación, siendo capaces de ejercer buenos resultados mientras no exista un control externo que les impida percibir una libertad. 
          <br>
          Responde continuamente a los estímulos de exploración, personalización, contenido desbloqueable y sorpresas. 
        </p>',

      "achiever" =>
        '<h6 class=" card-subtitle">Componentes Triunfador: <i>Competencia </i></h6>
        <p class="card-text p-2">
          Requiere un entorno competitivo, en donde se recompense sus logros con tareas que parezcan un reto, no solo con la complejidad de la tarea si no con la dificultad que presenta ante sus habilidades. 
          <br>
          Es capaz de completar tareas que requieran niveles de habilidades específicos para desarrollarlas. 
          <br>
          Responde de manera activa dentro de actividades que representen desafíos, donde sea capaz de medir su progreso, requieran del aprendizaje de nuevas habilidades. 
        </p>',
      
      "player" => 
        '<h6 class=" card-subtitle">Componente Jugador: <i>Recompensas</i> </h6>
        <p class="card-text p-2">
          Requiere de una recompensa a cambio de realizar las tareas propuestas. 
          <br>
          Se mantiene el interés siempre y cuando la recompensa sea de su agrado o despierte su curiosidad. 
          <br>
          Responde de manera comprometida con aquellas actividades, sin importar el tipo de la misma, que conlleve un premio, reconocimiento, puntuación o ganancia. 
        </p>',
      
      "disruptor" => 
        '<h6 class=" card-subtitle"> Componente Disruptor: <i>Cambio</i>  </h6>
        <p class="card-text p-2">
          No requieren un entorno específico para que entren a ejercer sus intereses, pues su motivación está en impulsar un cambio dentro del sistema planteado, colocando sus límites a prueba y forzando nuevas opciones. 
          <br>
          Presta una gran ayuda para determinar la consistencia en las actividades empleadas y muchas veces para generar cambios positivos o innovadores. 
        </p>'
    );

    function getScaleMotivations($resultadosTP,$motivacionesTPI){
      //$arrayVals = $rowsTp;
      $arrayVals = $resultadosTP;
      for ($i=0; $i < 6; $i++) { 
        //take MAx
        $maxVal = max( $arrayVals);
        //take indx
        $maxIndex = array_search( $maxVal, $arrayVals);
        //delete max val
        unset($arrayVals[$maxIndex]);

        //show options
        echo $motivacionesTPI[$maxIndex];
      }
    }

   

?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


  <!-- Pestañas de muestra -->
<div class="mt-3 ml-n2 ">
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-ls-tab" data-toggle="pill" href="#pills-ls" role="tab" aria-controls="pills-ls" aria-selected="true">Estilos de aprendizaje</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-tp-tab" data-toggle="pill" href="#pills-tp" role="tab" aria-controls="pills-tp" aria-selected="false">Perfiles de jugadors</a>
    </li>
  </ul>
</div>




<!-- contenido de las pestañas -->
<div class="tab-content col-auto id="pills-tabContent">

  <!-- Graficas estilos de aprendizaje  -->
  <div class="tab-pane fade show active" id="pills-ls" role="tabpanel" aria-labelledby="pills-ls-tab">
    <!-- graphic -->
    <canvas  id="bar-chart"  class="chartjs-render-monitor" style=" width: 1100rem; height: 420rem;" ></canvas>
    <!-- info -->

    <div class="">
      <h4 class="text-info"> Evaluación</h4>
      <p class="card-tex lead">
        Con respecto a las respuestas dadas para el test de <i> estilos de aprendizaje</i>, 
        se pueden observar distintos rasgos cognitivos, que pueden indicar como tu perfil de estudiante te permite percibir, 
        interactuar y responder a diferentes ambientes de aprendizaje; algunas de esas características que se pueden inferir para tu perfil como estudiante, por tus respuestas son: 
      </p>

      <dl class="blockquote">
        <dt class="mt-4">¿Qué tipo de información perciben preferentemente los estudiantes?</dt>
        <dd class="pl-4 ">
          <?php 
            echo getKnow($rowsLs["perception_val"]," Sensorial e Intuitiva ",$labelsLs["perception"]  );
          ?>
        </dd>

        <dt class="mt-4">¿A través de qué modalidad sensorial es más efectivamente percibida la información cognitiva?</dt>
        <dd class="pl-4">
          <?php 
            echo getKnow($rowsLs["input_val"]," Visual y Verbal ",$labelsLs["input"]  );
          ?>
        </dd>

        <dt class="mt-4">¿Con qué tipo de organización de la información está más cómodo el estudiante a la hora de trabajar?</dt>
        <dd class="pl-4">
          <?php 
            echo getKnow($rowsLs["processes_val"]," Activo y Reflectivo ",$labelsLs["processes"]  );
          ?>
        </dd>

        <dt class="mt-4">¿Cómo progresa el estudiante en su aprendizaje?</dt>
        <dd class="pl-4">
          <?php 
            echo getKnow($rowsLs["understand_val"]," Global y Secuencial ",$labelsLs["understand"]  );
          ?>
        </dd>
      </dl>
    </div>
  </div>

  <!-- Graficas de tipos de jugador -->
  <div class="tab-pane fade" id="pills-tp" role="tabpanel" aria-labelledby="pills-tp-tab">
    <div class="row align-items-center"">
      <div class="col-12 col-md-6" >
        <canvas id="chartjs-3"  class="chartjs-render-monitor b-2" ></canvas>
      </div>
      <div class="col-10 col-md-6" >
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            Componente Filántropo :  <?php echo $rowsTp["philanthrop"]; ?> %
          </li>

          <li class="list-group-item">
            Componente Socializador :   <?php echo $rowsTp["socialiser"]; ?> %
          </li>

          <li class="list-group-item">
            Componente Espíritu Libre :  <?php echo $rowsTp["free_spirit"]; ?> %
          </li>

          <li class="list-group-item">
            Componentes Triunfador :   <?php echo $rowsTp["achiever"]; ?> %
          </li>

          <li class="list-group-item">
            Componente Jugador :  <?php echo $rowsTp["player"]; ?> %
          </li>

          <li class="list-group-item">
            Componente Disruptor : <?php echo $rowsTp["disruptor"]; ?> %    
          </li>
        </ul>
      </div>
    </div>

    <div class="card mt-2 shadow">
      <div class="card-header">
        <h5>Escala de motivaciones </h5>
        <h6 class="card-subtitle mb-2 text-muted"> 
        Encontrar ordenadas de manera descendente aquellas descripciones de las motivaciones, desde la más importante a la que menos puede generar un impacto importante, partiendo desde el perfil de jugador inferido por las respuestas al test de Perfiles de Jugadores 
        </h6>
      </div>
      <div class="card-body">
        <?php
          getScaleMotivations($rowsTp,$motivacionesTP);
        ?>
      </div>

    </div>
  </div>
</div>




<!-- script barchart -->
<script>
    // Bar chart
    new Chart(document.getElementById("bar-chart"), {
        type: 'horizontalBar',
        data: {
          labels: [
            'Percepcion: ' +'<?php echo $labelsLs["perception"] ?>' ,
            'Canal: ' + '<?php echo $labelsLs["input"] ?>' ,
            'Proceso: ' + '<?php echo $labelsLs["processes"] ?>' ,
            'Entendimiento: ' + '<?php echo $labelsLs["understand"] ?>' 
            ],
          
          datasets: [
            {
              label: "Puntuación",
              borderWidth: 1,
              backgroundColor: [
                '<?php echo $backg["perception"] ?>' ,
                '<?php echo $backg["input"] ?>' ,
                '<?php echo $backg["processes"] ?>' ,
                '<?php echo $backg["understand"] ?>' 
              ],
              borderColor: [
                '<?php echo $backg_b["perception"] ?>' ,
                '<?php echo $backg_b["input"] ?>' ,
                '<?php echo $backg_b["processes"] ?>' ,
                '<?php echo $backg_b["understand"] ?>' 
              ],
              
              borderWidth:1,
              
              data: [
                '<?php echo $rowsLs["perception_val"] ?>' ,
                '<?php echo $rowsLs["input_val"] ?>' ,
                '<?php echo $rowsLs["processes_val"] ?>' ,
                '<?php echo $rowsLs["understand_val"] ?>' 
              ],
              
            }
          ]
        },
        options: {
          legend: { display: false },
          title: {
            display: false,
            text: 'Estilos de aprendizaje'
          },
          scales: {
            xAxes: [{
              display: true,
              ticks: {
                  min: 0,   // minimum value will be 0
                  max: 11,
                  stepSize:1,
                  
                  
              }
            }],
            yAxes: [{
              display: true,
              ticks: {
                
                  
              }
            }],

          }
          
        }
    });
</script>

<!-- script radial barchart -->
<script>
    new Chart(document.getElementById("chartjs-3"),{
      type:"radar",
      data:{
        labels:["Philanthrop","Socialiser","Free Spirit","Achiever","Player","Disruptor"],
        datasets:[{
          label:"Procentaje",
          data: [ 
                '<?php echo $rowsTp["philanthrop"] ?>' ,
                '<?php echo $rowsTp["socialiser"] ?>' ,
                '<?php echo $rowsTp["free_spirit"] ?>' ,
                '<?php echo $rowsTp["achiever"] ?>',
                '<?php echo $rowsTp["player"] ?>', 
                '<?php echo $rowsTp["disruptor"] ?>'  
              ],
          fill:true,
          backgroundColor:"rgba(72, 123, 170, 0.2 )",
          borderColor:"#6369D1",
          pointBackgroundColor:"#2D8C83",
          pointBorderColor:"#ffAABB",
          pointHoverBackgroundColor:"#7BEDBA",
          pointHoverBorderColor:"#1AB3A6"
        }
        
        ]
      },
      options:{
        legend: { display: false },
        elements:{
          line:{
            tension:0,
            borderWidth:1.5
          }
        },
        scale: {
          angleLines: {
            display: true
          },
          gridLines:{
            display: true
          },
          ticks: {
              suggestedMin: 0,
          }
          
          
        }
      }});
</script>