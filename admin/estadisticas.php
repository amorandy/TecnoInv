<?php
$error = '';
$good = '';
//$email=$_SESSION['username'];


$email = "solucioneswebfp@gmail.com";
require_once "config/int.php";
get_admin_info($email); 

require "config/config.php";


$total = 0;
$totalC = 0;
$totalT = 0;

if(isset($_POST['dates'])){
    $dates = explode("- ", $_POST['dates']);
    $start = $dates[0];
    $end =  $dates[1];

    $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date) >= '$start' AND DATE(date) <= '$end'";
	$rs = $db_connect -> query($sql);
	$arr=mysqli_fetch_array($rs);
	
    $total = $arr["total"];
    
    $rsa = ("SELECT id FROM clientes WHERE DATE(date) >= '$start' AND DATE(date) <= '$end'");
    $conection = $db_connect -> query($rsa);
    $totalC = mysqli_num_rows($conection);

    $rsa1 = ("SELECT id FROM transfers WHERE DATE(date) >= '$start' AND DATE(date) <= '$end'");
    $conection1 = $db_connect -> query($rsa1);
    $totalT = mysqli_num_rows($conection1);
}

//Cerrar conexion
mysqli_close($db_connect);
?>
<?php include "header.php"; ?>


        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard > Transferencias</b></h4> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">




            <div class="col-lg-12" align="center">
                     <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 align="center" class="panel-title"><span>Seleccione un rango de fecha</span></h3>
                                 
                                    </div>
                                    <div class="panel-body">
                                        <div class="top10-box-child-top">
					
					<div class="form-group">
			                                			<form method="post">
			                                			<div class="col-sm-6">
			                                				<div class="input-daterange input-group" id="date-range">
																<input type="text" class="form-control" placeholder="yyyy-mm-dd" name="dates">
                                                                <button type="submit" class="btn btn-space btn-primary">Filtrar</button>
															</div>
												
															
			                                			</div>
							
														
			                                		</div>
													
													
					
													
													
</div>





</div>
</form>
</div>

</div>



                <div class="row">

                <div class="col-md-3">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>$<?php echo number_format($total, 2); ?></h2>
                                    <p class="m-b-0">Total Procesado</p>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-3">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-users f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $totalC; ?></h2>
                                    <p class="m-b-0">Clientes</p>
                                </div>
                            </div>
                        </div>
                    </div>

                      <div class="col-md-3">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                <span><i class="fa fa-exchange f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $totalT; ?></h2>
                                    <p class="m-b-0">Transacciones</p>
                                </div>
                            </div>
                        </div>
                    </div>
			


				<!-- column -->



										
<?php if(isset($_POST['dates'])){ ?>
                

					  <div class="col-lg-12">
                        <div class="card">
                          
                            <div class="card-body">
                            <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tipo</th>
                                                <th>No. Transaccion</th>
                                                <th>Monto USD</th>
                                                <th>Remitente</th>
                                                <th>Beneficiario</th>
                                                <th>Fecha</th>
                                                <th>Estatus</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php  
include "config/config.php";                                      
$tabla2 = ("SELECT * FROM transfers WHERE DATE(date) >= '$start' AND DATE(date) <= '$end'"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) {  

    $sql = "SELECT name FROM beneficiario WHERE id = '".$registro['des_id']."'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs); 

    $beneficiario = $arr['name'];

    $sql1 = "SELECT name FROM clientes WHERE id = '".$registro['cliente_id']."'";
    $rs1 = $db_connect -> query($sql1);
    $arr1=mysqli_fetch_array($rs1); 

    $remitente = $arr1['name'];
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>
                                                </td>
                                                <td><?php echo $registro['send_from']; ?> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $registro['send_to']; ?></td>
                                                <td><?php echo $registro['tracker']; ?>
                                                <td>$<?php echo number_format ($registro['monto_usd'], 2); ?></td>
                                                <td><?php echo $remitente; ?></td>
                                                <td><?php echo $beneficiario; ?></td>
                                                <td><?php echo $registro['date']; ?></td>
                                                <td> <?php if($registro['status'] == 1){ ?>
			                        <span class="label label label-success">Validando</span>
								  <?php } ?>
								  <?php if($registro['status'] == 2){ ?>
			                        <span class="label label label-info">Transfiriendo</span>
								  <?php } ?>
								  <?php if($registro['status'] == 3){ ?>
			                        <span class="label label label-success">Completado</span>
								  <?php } ?>
								   <?php if($registro['status'] == 4){ ?>
			                        <span class="label label label-success">Cancelado</span>
								  <?php } ?>
                                  <?php if($registro['status'] == 5){ ?>
			                        <span class="label label label-success">Error</span>
								  <?php } ?>
								   </td>
                                                <td><a href="ver_transaccion?id=<?php echo $registro['id']; ?>"><div style="font-size: 24px; line-height: 1.5em;"><i class="fa fa-eye" aria-hidden="true"></i></div></a> </td>
                                            </tr>
<?php 
} 
//Cerrar conexion
mysqli_close($db_connect); 
?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php }else{ ?>	



					  <div class="col-lg-12">
                        <div class="card">
                          
                            <div class="card-body">
                            <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tipo</th>
                                                <th>No. Transaccion</th>
                                                <th>Monto USD</th>
                                                <th>Remitente</th>
                                                <th>Beneficiario</th>
                                                <th>Fecha</th>
                                                <th>Estatus</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                N/A
                                                </td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td> N/A </td>
						
                                                <td>N/A </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>				
					
                </div>


<?php } ?>
               


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
         <!-- footer -->
         <footer class="footer"> © <?php echo date("Y"); ?> All rights reserved.</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



    <script>
    $('input[name="dates"]').daterangepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
                toggleActive: true,
                locale: {
      format: 'YYYY-M-DD'
    }
                });
    </script>


    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>



</body>

</html>