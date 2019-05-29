<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


$sql = "SELECT SUM(total) AS total FROM clientes";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);

$total = $arr['total'];

?>
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
				
				<!-- column -->

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
$tabla2 = ("SELECT * FROM transfers"); 
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
					
					
					
                </div>



               


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
         <!-- footer -->
         <footer class="footer"> © <?php echo date("Y"); ?> All rights reserved.</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>

    <script src="js/lib/jquery/jquery.min.js"></script>
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