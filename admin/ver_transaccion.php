<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


$id = $_GET['id'];

get_transaction_info($id);
?>
<style>

.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}


</style>

        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard </h4> </div>
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
				
				
				
				              <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title" style="text-align: center;">
                                <h4>Estatus: <?php if(status == 1){ ?>
			                        <span class="label label label-success">Validando</span>
								  <?php } ?>
								  <?php if(status == 2){ ?>
			                        <span class="label label label-info">Transfiriendo</span>
								  <?php } ?>
								  <?php if(status == 3){ ?>
			                        <span class="label label label-success">Completado</span>
								  <?php } ?>
								   <?php if(status == 4){ ?>
			                        <span class="label label label-success">Cancelado</span>
								  <?php } ?>
                                  <?php if(status == 5){ ?>
			                        <span class="label label label-success">Error</span>
								  <?php } ?></h4>

                            </div>
                            <div class="card-body">
                            <div class="panel panel-primary">
                          
                          <div class="panel-body">
                            <div class="col-md-12 col-lg-12 "> 
                <table class="table table-user-information">
                  <tbody>
           
                    <tr>
                      <td>No. Transferencia:</td>
                      <td><?php echo tracker; ?></td>
                    </tr>

                    <tr>
                      <td>No. Recibo:</td>
                      <td><?php echo recibo; ?></td>
              
                       <tr>
                      <td>Imagen del Recibo:</td>
                      <td><span class="label label label-success sweet-html">Ver imagen</span></td>
                    </tr>

                      <tr>
                      <td>Fecha del Recibo:</td>
                      <td><?php echo date_recibo; ?></td>
                    </tr>
    <?php
    include "config/config.php";
    $idV = validador_id;
    $sql = "SELECT name FROM validadores WHERE id = '$idV'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);
    ?>
                    <tr>
                    <td>Validador:</td>
                      <td><?php echo $arr['name']; ?></td>
                    </tr>
                    <?php mysqli_close($db_connect); ?>
                    <tr>
     <?php
    include "config/config.php";
    $idO = operador_id;
    $sql = "SELECT name FROM operadores WHERE id = '$idO'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);
    ?>
                    <td>Operador:</td>
                    <?php if(status == 1){ ?>
                        <td> <span class="label label label-info">No asignado aun</span></td>
                    <?php }else{ ?>
                 <td><?php echo $arr['name']; ?></td>
                 <?php } ?>
                         
                    </tr>
                    
                    <?php mysqli_close($db_connect); ?>
                   
                  </tbody>
                </table>
      
               

</div>
              </div>
            </div>
        

                            </div>
                        </div>


                        
                    </div>
				
				
                                   
                <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Detalles de la Transaccion</h4>

                            </div>
                            <div class="card-body">
                            <div class="panel panel-primary">
                          
                          <div class="panel-body">
                            <div class="col-md-12 col-lg-12 "> 
                <table class="table table-user-information">
                  <tbody>
           
                    <tr>
                      <td>Tipo:</td>
                      <td><?php echo send_from; ?> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo send_to; ?></td>
                    </tr>
<?php 
require "config/config.php";
$idC = cliente_id;
$sql = "SELECT name FROM clientes WHERE id = '$idC'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs); 
$nameC = $arr['name'];
?>
                    <tr>
                      <td>Fecha:</td>
                      <td><?php echo date; ?></td>
                    </tr>
<?php mysqli_close($db_connect); ?>  

<?php 
require "config/config.php";
$idD = des_id;
$sql = "SELECT name FROM beneficiario WHERE id = '$idD'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs); 
$nameD = $arr['name'];
?>               
                       <tr>
                      <td>Nombre del Beneficiario:</td>
                      <td><?php echo $nameD; ?></td>
                    </tr>
<?php mysqli_close($db_connect); ?> 
                      <tr>
                      <td>Monto en USD:</td>
                      <td><?php echo number_format(monto_usd, 2); ?></td>
                    </tr>
                    <tr>
                    <td>Monto en <?php echo currency; ?>:</td>
                      <td><?php echo number_format(monto_local, 2); ?></td>
                    </tr>
                    <tr>
                    <td>Monto Enviado en <?php echo currency_des; ?>:</td>
                      <td><?php echo number_format(monto_des, 2); ?></td>
                         
                    </tr>
                    
                     </tr>
                      <td>Nota:</td>
                      <td><?php echo note; ?></td>
                         
                    </tr>
                   
                  </tbody>
                </table>
      
               

</div>
              </div>
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
$tabla2 = ("SELECT * FROM registros WHERE transfer_id = '$id' ORDER BY id DESC LIMIT 5"); 
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



                    <!-- /# column -->



                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
           <!-- footer -->
           <footer class="footer"> © <?php echo date("Y"); ?> All rights reserved.</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>

    
<!-- All Jquery -->
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



    <script src="js/lib/sweetalert/sweetalert.min.js"></script>
    <!-- scripit init-->


<style>
.swal-wide{
    width:660px !important;
    height: 660px !important;

}
</style>

    <script>
    document.querySelector('.sweet-html').onclick = function(){
    swal({
        title: "Recibo",
        customClass: 'swal-wide',
        text: "<img width='580' height='550' src='<?php echo imagen; ?>'>",
        html: true
    });
};
    </script>



    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>



</body>

</html>