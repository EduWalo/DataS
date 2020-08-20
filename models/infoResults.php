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
        return "Presenta una <strong>preferencia equilibro </strong> por las direccionamiento <i>".$equ."</i> aunque con una preferencia leve por un direccionamiento más ".$modF."<br>";
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

    // -----------------------------------------------------------------------------
    // var_dump($rowsTp);
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


<!-- barchar html -->


<div class="row">

  <div class="col-xl-7 col-lg-6">
    <div class="card shadow mb-2 mt-2">
        <div class="card-header py-2">
            <h6 class="m-1 font-weight-bold text-primary">Learn Styles</h6>
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
            display: true,
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
            }]
          }
          
        }
    });
  </script>

  <!-- radial barchart -->
  <div class="col-xl-5 col-lg-6">
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
        <li class="list-group-item">Philanthrop:  <?php echo $rowsTp["philanthrop"] ?> % </li>
        <li class="list-group-item">Socialiser:   <?php echo $rowsTp["socialiser"] ?> %  </li>
        <li class="list-group-item">Free Spirit:  <?php echo $rowsTp["free_spirit"] ?> % </li>
        <li class="list-group-item">Achiever:     <?php echo $rowsTp["achiever"] ?> %    </li>
        <li class="list-group-item">Disruptor:    <?php echo $rowsTp["disruptor"] ?> %   </li>
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
              //suggestedMax: 100,
              //sepSize: 25,
              

          }
      }
      }});
  </script>

</div>
