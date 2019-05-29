<?php include "header.php"; 
get_index_week_data();
?>
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard <small style="color: #a6b7bf;">Estadisticas Hoy</small></h4> </div>
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
                <!-- Start Page Content -->
                <div class="row">
                     <div class="col-md-3">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>$<?php echo number_format(totalsum, 2); ?></h2>
                                    <p class="m-b-0">Total Procesado <small>USD</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>RD$ <?php echo number_format(totalsumdop, 2); ?></h2>
                                    <p class="m-b-0">Total Procesado <small>DOP</small></p>
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
                                    <h2><?php echo total; ?></h2>
                                    <p class="m-b-0">Trans. en espera</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-exchange f-s-40 color-danger"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo total_validando; ?></h2>
                                    <p class="m-b-0">Trans. validando</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-exchange f-s-40 color-info"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo total_completa; ?></h2>
                                    <p class="m-b-0">Trans. Completa</p>
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
                                    <h2><?php echo total_operando; ?></h2>
                                    <p class="m-b-0">Trans. Operando</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-money f-s-40 color-warning"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h3><?php echo number_format(taza, 0);?> Bs</h3>
                                    <p class="m-b-0">Tasa del Dia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-user f-s-40 color-danger"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo total_client; ?></h2>
                                    <p class="m-b-0">Nuevos Clientes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
				
				<!-- column -->
                                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Movimientos - Esta semana</h4>
                                <div id="morris-bar-chart"></div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Transferencias Recientes </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tipo</th>
                                                <th>Valor</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php  
include "config/config.php";                                      
$tabla23 = ("SELECT * FROM transfers ORDER BY id DESC LIMIT 5"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {  
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>  
                                                </td>
                                                <td><?php echo $registro['send_from']; ?> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $registro['send_to']; ?></td>
                                                <td><span>$<?php echo number_format($registro['monto_usd'], 2); ?></span></td>
                                                <td><span>Shamuel Perez</span></td>
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
                                  <?php if($registro['status'] == 6){ ?>
			                        <span class="label label label-warning">Esperando</span>
								  <?php } ?>
								   </td>
                                            
                                            
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
					
					
					
					  <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Registros </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Tipo</th>
                                                <th>Fecha</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

<?php  
include "config/config.php";                                      
$tabla2 = ("SELECT * FROM registros ORDER BY id DESC LIMIT 5"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) {  
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>
                                                </td>
                                                <td><?php echo $registro['user']; ?></td>
                                                <td><span class="badge badge-success"><?php echo $registro['tipo']; ?></span></td>
                                                <td><span><?php echo $registro['date']; ?></span></td>
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
            <?php include "config/total.php"; ?>
          <?php include "footer.php"; ?>