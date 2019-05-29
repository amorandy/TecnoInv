<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


$id = $_GET['id'];

get_transaction_info($id);

$sql = "SELECT id,pais FROM paises WHERE id = ".pais_dep."";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);
$pais_dep = $arr['pais'];

$sql2 = "SELECT id,nombre FROM banco WHERE id = ".banco_dep."";
$rs2 = $db_connect -> query($sql2);
$arr2=mysqli_fetch_array($rs2);
$banco_dep = $arr2['nombre'];


if(isset($_POST['operador']) AND status == 1){

    if($_POST['operador']==NULL|$_POST['date']==NULL|$_POST['monto']==NULL|$_POST['digitos']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 

            $arr_s = explode(':',$_POST['date']);
            list($year, $mes, $day) = explode('-', $_POST['date']);;
        
            $signature = $year.$mes.substr($day, 0, 2).$arr_s[1].$arr_s[2].$_POST['monto'].$_POST['digitos'];

            $sql = "SELECT id_trans,signature FROM firmas_trans WHERE signature = '$signature'"; 
            $rs = $db_connect -> query($sql);
            $arr = mysqli_fetch_array($rs);
            
            if (mysqli_num_rows($rs)>0){
                
                $error = 'ATENCION! Ya existe un recibo con esta firma ---> <a href="ver_transaccion?id='.$arr["id_trans"].'">VER ESA TRANSACCION</a>';
                
            }else{



        $sql = ("INSERT INTO firmas_trans (id_trans,signature) VALUES ('$id','$signature')");
        $csql = $db_connect -> query($sql);

    $sql = ("UPDATE  transfers SET status='2',operador_id='".$_POST['operador']."' WHERE id = '$id'");
    $csql = $db_connect -> query($sql);
   //Genero un registro
    generar_registro($id,"Asigno un operador",name);

    $good = "La transaccion se asigno a un operador exitosamente";

}
}
}
if(isset($_GET['at']) AND status == 6){

    $sql = ("UPDATE transfers SET status='1' WHERE id = '$id'");
    $csql = $db_connect -> query($sql);
   //Genero un registro
    generar_registro($id,"Esta validando una transaccion",name);

}

if(isset($_GET['can']) AND status != 4){

    if($_GET['note_acc']==NULL) { 

        $error = 'Ingrega una nota explicando el motivo de la cancelacion.';
        
        }else{ 

    $sql = ("UPDATE transfers SET status='4' WHERE id = '$id'");
    $csql = $db_connect -> query($sql);
   //Genero un registro
    generar_registro($id,"Cancelo una transferencia",name);

    //Enviamos una notificasion al usuario
    sendMessageCan(cliente_id,$_GET['note_acc']);

    $good = "Se cancelo la transaccion";

}
}


if(isset($_GET['err']) AND status != 5){

    if($_GET['note_acc']==NULL) { 

        $error = 'Ingrega una nota explicando el motivo del error.';
        
        }else{ 

    $sql = ("UPDATE  transfers SET status='5' WHERE id = '$id'");
    $csql = $db_connect -> query($sql);
   //Genero un registro
    generar_registro($id,"Marco como Erronea una transferencia",name);
    
    //Enviamos una notificasion al usuario
    sendMessageErr(cliente_id,$_GET['note_acc']);
    
    $good = "Se marco como erronea la transaccion";
}
}

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

<?php
if ($good != '') {
?>
<div class="alert alert-success alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $good; ?>
	                                        </div>
<?php } ?>


<?php
if ($error != '') {
?>
<div class="alert alert-danger alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $error; ?>
	                                        </div>
<?php } ?>

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
			                        <span class="label label label-danger">Cancelado</span>
								  <?php } ?>
                                  <?php if(status == 5){ ?>
			                        <span class="label label label-danger">Error</span>
								  <?php } ?>
                                  <?php if(status == 6){ ?>
			                        <span class="label label label-warning">Esperando</span>
								  <?php } ?>
                                  
                                  </h4>

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
              </tr>



<?php 
require "config/config.php";
$idC = cliente_id;
$sql = "SELECT tel,name FROM clientes WHERE id = '$idC'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs); 
$nameC = $arr['name'];
$tel = $arr['tel'];
?>

              <tr>
                      <td>Pais de Deposito:</td>
                      <td><?php echo $pais_dep; ?></td>
              </tr>


               <tr>
                      <td>Nombre Cliente:</td>
                      <td><?php echo $nameC; ?></td>
              </tr>

               <tr>
                      <td>Telefono:</td>
                      <td><?php echo $tel; ?></td>
              </tr>
              <tr>
                      <td>Banco de Deposito:</td>
                      <td><?php echo $banco_dep; ?></td>
              </tr>

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

<form action="" method="GET">

                    <tr>
                    
                    <td>Nota:</td>

                        <td> <input type="text" name="note_acc" class="form-control input-default"> <input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                         
                    </tr>

                    


                     <td>Accion:</td>
                    <?php if(status != '3'){ ?>
                        <td> <button name="can" type="submit" class="btn btn-danger btn-sm" value="1">Cancelar</button> <button name="err" type="submit" class="btn btn-danger btn-sm" value="1">Erronea</button></td>
                    <?php }else{ ?>
                 <td>...</td>
                 <?php } ?>
                         
                    </tr>

                    </form>
                    
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

                    <tr>
                      <td>Fecha:</td>
                      <td><?php echo date; ?></td>
                    </tr>

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
                      <td><?php echo number_format(taza * monto_usd, 2); ?></td>
                         
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
                                <h4>Asignar Operador/Crear Firma </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <form method="POST">

                                <div class="form-group">
                                <label>Fecha</label>
<input type="text" name="date" class="form-control input-default" value="">
                                </div>

                                <div class="form-group">
                                <label>Monto <small style="color: #fd5411;">No incluir puntos, espacios o comas</small></label>
<input type="number" name="monto" class="form-control input-default" value="">
                                </div>

<div class="form-group">
                                <label>5 Digitos <small style="color: #fd5411;">No incluir puntos, espacios o comas</small></label>
<input type="number" name="digitos" class="form-control input-default" value="">
                                </div>


                                <div class="form-group">
                                                  
                    <select name="operador" class="form-control input-default" <?php if(status == '3'){ ?>disabled<?php } ?>>
                                                          <option value="">Operador...</option>
<?php  
include "config/config.php";                                      
$tabla23 = ("SELECT id,name FROM operadores WHERE status = '1'"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {  
?>
                                                          <option value="<?php echo $registro['id']; ?>"><?php echo $registro['name']; ?></option>
<?php } ?>
                                                      </select>
                                              </div>


<input  type="submit" class="btn btn-info m-b-10 m-l-5" value="Enviar transaccion">


                                              </form>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
    $('input[name="date"]').daterangepicker({
		        timePicker: true,
                timePickerSeconds: true,
                autoclose: true,
                singleDatePicker: true,
                toggleActive: true,
                locale: {
      format: 'YYYY-M-DD HH:mm:ss'
    }
                });
    </script>

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