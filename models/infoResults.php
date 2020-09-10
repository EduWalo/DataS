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
    
    //  generate the result about the code max result in 
    $arrayVals = $rowsTp;
    $maxVal1 = max( $arrayVals);
    $max1 = array_search( $maxVal1, $arrayVals);
    unset($arrayVals[$max1]);
    $maxVal2 = max( $arrayVals);
    $max2 = array_search( $maxVal2, $arrayVals);
    
    // 5% of tolerance
    if( abs( $maxVal1  - $maxVal2) < 5){
      $conteo = 2;
    }else{
      $conteo = 1;
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
      


      <div class="card shadow ">
        
        <div class="card-header "></div>
        <div class="card-body">
          


        </div>
        

        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <h5 class="card-title"></h5>
          </li>
          
        </ul>
        <div class="card-body">

          <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <div class="card-text">
            <?php
              echo "<h6>Percepción: </h6> <p style='padding-left:2em'>".getKnow($rowsLs["perception_val"]," Sensorial e Intuitiva ",$labelsLs["perception"]  )."</p>";
              echo "<h6>Canal de entrada: </h6> <p style='padding-left:2em'>".getKnow($rowsLs["input_val"]," Visual y Verbal ",$labelsLs["input"]  )."</p>";
              echo "<h6>Proceso: </h6> <p style='padding-left:2em'>".getKnow($rowsLs["processes_val"]," Activo y Reflectivo ",$labelsLs["processes"]  )."</p>";
              echo "<h6>Entendimiento: </h6> <p style='padding-left:2em'>".getKnow($rowsLs["understand_val"]," Global y Secuencial ",$labelsLs["understand"]  )."</p>";
            ?>  
          </div>
        </div>    
      </div>
    </div>

    <!-- Graficas de tipos de jugador -->
    <div class="tab-pane fade" id="pills-tp" role="tabpanel" aria-labelledby="pills-tp-tab">

    </div>
    
  </div>


<div class="row">
  <div class="col-xl-7 col-lg-2">
    <div class="card shadow mb-2 mt-2">
        <div class="card-header py-2">
            <h6 class="m-1 font-weight-bold text-primary">Estilos de aprendizaje  </h6>    
        </div>
        
        <div class="card-body">
            <div class="chart-area">
              <canvas id="bar-chart"  class="chartjs-render-monitor" style="display: block; width: 442px; height: 320px;">
              </canvas>
            </div>
            <div id="accordion">
              
                <div class="card-header" id="headingTwo">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Evaluación
                    </button>
                  </h5>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                
                  <div class="card-text">
                    <?php
                        echo "<h6>Percepción: </h6> <p style='padding-left:2em'>".getKnow($rowsLs["perception_val"]," Sensorial e Intuitiva ",$labelsLs["perception"]  )."</p>";
                        echo "<h6>Canal de entrada: </h6> <p style='padding-left:2em'>".getKnow($rowsLs["input_val"]," Visual y Verbal ",$labelsLs["input"]  )."</p>";
                        echo "<h6>Proceso: </h6> <p style='padding-left:2em'>".getKnow($rowsLs["processes_val"]," Activo y Reflectivo ",$labelsLs["processes"]  )."</p>";
                        echo "<h6>Entendimiento: </h6> <p style='padding-left:2em'>".getKnow($rowsLs["understand_val"]," Global y Secuencial ",$labelsLs["understand"]  )."</p>";
                    ?>
                  </div>
                </div>
              
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

  <!-- radial barchart -->
  <div class="col-xl-5">
    <div  class="card shadow  mb-2 mt-2">
      <div class="card-header py-2">
          <h6 class="m-1 font-weight-bold text-primary">Type of Players</h6>
      </div>
      
      <div class="card-body">
        <div class="chart-area">
          <canvas id="chartjs-3"  class="chartjs-render-monitor" style="display: block; width: 442px; height: 320px;">
          </canvas>
        </div>
      </div>

      <ul class="list-group list-group-flush">
        <!-- filantropo -->
        <?php if (($max1 == "philanthrop" && $conteo > 0) || 
                    ($max2 == "philanthrop" && $conteo > 0)
                  ){ $conteo--;?>
          <li class="list-group list-group-flush">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  Philanthrop:  <?php echo $rowsTp["philanthrop"] ?> % 
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-angle-down"></i>
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  La motivación para este tipo en particular, pues se interesa por el bien común, por ejercer un beneficio al entorno, generando acciones por una causa, un bienestar.
                  Suele ser muy agradable y se ve constantemente involucrado en acciones de ayuda y bienestar social, generando un agregado positivo, suele ayudar a los integrantes a generar resultados y avanzar en el proceso aparte de ser excelente guía sobre lo que conoce.
                </div>
              </div>
            </div>
          </li>
        <?php }else {  ?>
          <li class="list-group-item">Philanthrop:  <?php echo $rowsTp["philanthrop"] ?> % </li>
        <?php }?>

        <!-- socialicer -->
        <?php if (($max1 == "socialiser" && $conteo > 0) ||
                  ($max2 == "socialiser" && $conteo > 0)
                  ){ $conteo--;?>
          <li class="list-group list-group-flush">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  Socialiser:   <?php echo $rowsTp["socialiser"] ?> %  
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-angle-down"></i>
                  </button>
                </h5>
              </div>

              <div id="collapseOne2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  La motivación reside de manera fuerte en cualquiera de los tipos de interacción con los otros participantes, logrando compartir y socializar tanto progresos, temática, información o preferencias con respecto a su entorno.
                  Se incluye en grupos de manera particular y le agrada participar de manera proactiva en actividades conformadas por equipos de trabajo.
                </div>
              </div>
            </div>
          </li>
        <?php }else {  ?>
          <li class="list-group-item">Socialiser:   <?php echo $rowsTp["socialiser"] ?> %  </li>
        <?php }?>

        <!-- Free spirit -->
        <?php if (($max1 == "free_spirit" && $conteo > 0) ||
                  ($max2 == "free_spirit" && $conteo > 0)
                ){ $conteo--; ?>
          <li class="list-group list-group-flush">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  Free Spirit:  <?php echo $rowsTp["free_spirit"] ?> %
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-angle-down"></i>
                  </button>
                </h5>
              </div>

              <div id="collapseOne3" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  Una gran motivación es agregada a las actividades que permitan desarrollar de manera creativa distintas habilidades y le permita ser autónomo, de tal forma, logra explorar de distintas maneras para moverse dentro de su entorno y llegar a su objetivo de forma innovadora.
                  Podría verse involucrado en temáticas de desarrollo creativo con facilidad, demostrando un impulso a explorar nuevos caminos dentro de la dinámica.
                </div>
              </div>
            </div>
          </li>
        <?php }else {  ?>
          <li class="list-group-item">Free Spirit:  <?php echo $rowsTp["free_spirit"] ?> % </li>
        <?php }?>

         <!-- Achiever -->
         <?php if (($max1 == "achiever" && $conteo > 0) ||
                    ($max2 == "achiever" && $conteo > 0)
                  ){ $conteo--; ?>
          <li class="list-group list-group-flush">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  Achiever:     <?php echo $rowsTp["achiever"] ?> %   
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-angle-down"></i>
                  </button>
                </h5>
              </div>

              <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  Sus intenciones y motivación se despiertan al intentar dominar distintas actividades u objetivos, constantemente se ve involucrado en acciones respectivas a el desarrollo de habilidades específicas, las cuales, con constancia se podrían masterizar, logrando niveles de eficacia y gran afinidad.
                  Necesitan respectivamente, encontrar un reto constante, pues se ven poco involucrados en actividades que generen un desafío para su capacidad actual.	
                </div>
              </div>
            </div>
          </li>
        <?php }else {  ?>
          <li class="list-group-item">Achiever:     <?php echo $rowsTp["achiever"] ?> %    </li>
        <?php }?>

         <!-- Player -->
         <?php if (($max1 == "player" && $conteo > 0) ||
                    ($max2 == "player" && $conteo > 0)
                    ){ $conteo--; ?>
          <li class="list-group list-group-flush">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  Playe:        <?php echo $rowsTp["player"] ?> %  
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne5" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-angle-down"></i>
                  </button>
                </h5>
              </div>

              <div id="collapseOne5" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  La motivación está focalizada dentro de la especificación de recibir recompensas y reconocimientos de cualquier tipo, sobretodo, aquellas recompensas que son mucho más visibles y evidentes.
                  Su motivación, es inicialmente fuerte y perdura con respecto a la calidad de su recompensa dentro de sus gustos y valor perteneciente a su entorno.
                </div>
              </div>
            </div>
          </li>
        <?php }else {  ?>
          <li class="list-group-item">Playe:  <?php echo $rowsTp["player"] ?> %   </li>
        <?php }?>

         <!-- Disruptor -->
         <?php if (($max1 == "disruptor" && $conteo > 0)||
                    ($max2 == "disruptor" && $conteo > 0)
                  ){ $conteo--; ?>
          <li class="list-group list-group-flush">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  Disruptor:    <?php echo $rowsTp["disruptor"] ?> %    
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-angle-down"></i>
                  </button>
                </h5>
              </div>

              <div id="collapseOne6" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  La motivación especial de este tipo de jugador, es generar un cambio dentro del sistema, una disrupción, generar un nuevo punto, sus motivaciones no van exactamente con participar con el sistema, por el contrario quieren generar nuevas maneras de realizar determinados objetivos sin pasar por el procedimiento generado por definición.
                  En muchas ocasiones, son la mejor ayuda para encontrar nuevas puertas traseras y mejorar la implementación del sistema.
                </div>
              </div>
            </div>
          </li>
        <?php }else {  ?>
          <li class="list-group-item">Disruptor:    <?php echo $rowsTp["disruptor"] ?> %   </li>
        <?php }?>
        
      </ul>

    </div>
  </div>
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
          backgroundColor:"rgba(72, 123, 170, 0.5 )",
          borderColor:"#6369D1",
          pointBackgroundColor:"#2D8C83",
          pointBorderColor:"#fff",
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

</div>
