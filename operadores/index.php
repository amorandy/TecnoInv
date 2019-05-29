<?php include "header.php"; 
get_index_week_data(idv);
?>
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard <small style="color: #a6b7bf;">Estadisticas ultima semana</small></h4> </div>
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
                                    <span><i class="fa fa-exchange f-s-40 color-success"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo total; ?></h2>
                                    <p class="m-b-0">Trans. Nuevas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-money f-s-40 color-warning"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo number_format(taza, 0);?> Bs</h2>
                                    <p class="m-b-0">Tasa del Dia</p>
                                </div>
                            </div>
                        </div>
                    </div>


      
				
				<!-- column -->
                                   
                    <div class="col-lg-12">
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
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php  
include "config/config.php";   
$vid =  idv;                                   
$tabla23 = ("SELECT * FROM transfers WHERE operador_id = $vid ORDER BY id DESC LIMIT 10"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {  
    
        $idc =  $registro['cliente_id'];
    
$sql = "SELECT name FROM clientes WHERE id = '$idc'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);

$namec = $arr["name"];
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>  
                                                </td>
                                                <td><?php echo $registro['send_from']; ?> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $registro['send_to']; ?></td>
                                                <td><span>$<?php echo number_format($registro['monto_usd'], 2); ?></span></td>
                                                <td><span><?php echo $namec; ?>  </span></td>
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
			                        <span class="label label label-danger">Cancelado</span>
								  <?php } ?>
                                  <?php if($registro['status'] == 5){ ?>
			                        <span class="label label label-danger">Error</span>
								  <?php } ?>
                                  <?php if($registro['status'] == 6){ ?>
			                        <span class="label label label-warning">Esperando</span>
								  <?php } ?>
								   </td>

                                   
                                       <td><a href="ver_transaccion?id=<?php echo $registro['id']; ?>&at=1">Procesar</a></td>     
                                            
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
					
					
					
  

    </script>

               


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <?php include "config/total.php"; ?>
          <?php include "footer.php"; ?>

