<?php
require "controller/connection.php";
//consult results
$sql = "SELECT * FROM student_result WHERE id_student=".$_SESSION["id"];
$resultado = $mysqli->query($sql);
//copy the result
$row = $resultado->fetch_assoc();
echo $row["process"];
?>

<div class="ml-1 mt-4">
    <p class="text-center">
        <h3><strong>Resultados en estilos de aprendizaje</strong></h3>
    </p>
    <br>
    <br>
    <div class="progress5-group" >
        Percepción : <?php if($row["process"] == 'ACT'){}else {}?>
        <span class="float-right"> <b>160</b>/200</span>
        <div class="progress " style="height:30px">
        <div class="progress-bar bg-primary" style="width: 80%"></div>
        </div>
    </div>
    <!-- /.progress-group -->

    <div class="progress-group">
        Complete Purchase
        <span class="float-right"><b>310</b>/400</span>
        <div class="progress progress-sm">
        <div class="progress-bar bg-danger" style="width: 75%"></div>
        </div>
    </div>

    <!-- /.progress-group -->
    <div class="progress-group">
        <span class="progress-text">Visit Premium Page</span>
        <span class="float-right"><b>480</b>/800</span>
        <div class="progress progress-sm">
        <div class="progress-bar bg-success" style="width: 60%"></div>
        </div>
    </div>

    <!-- /.progress-group -->
    <div class="progress-group">
        Send Inquiries
        <span class="float-right"><b>250</b>/500</span>
        <div class="progress progress-sm">
        <div class="progress-bar bg-warning" style="width: 50%"></div>
        </div>
    </div>
    <!-- /.progress-group -->
    </div>

    <div class="card bg-gradient-info" style="position: relative; left: 0px; top: 0px;">
              <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Sales Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas class="chart chartjs-render-monitor" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 685px;" width="685" height="250"></canvas>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;"></div>

                    <div class="text-white">Mail-Orders</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;"></div>

                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div style="display:inline;width:60px;height:60px;"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;"></div>

                    <div class="text-white">In-Store</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>