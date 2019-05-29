<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


$id = $_GET['id'];

get_transaction_info($id);

if(isset($_POST['operador']) AND status != 3){
    
    if($_FILES["imagen"]["name"]==NULL) { 
      
       $error = 'Seleccione una imagen';  
        
    }else{

       $monto_bf =  number_format(taza * monto_usd, 2, '.', '');
       $curr_des = currency_des;

       $idO = operador_id;
     

       
       
      $sql = "SELECT id FROM billetera WHERE operador_id = '$idO'";
      $rs = $db_connect -> query($sql);
      $arr222=mysqli_fetch_array($rs);
      $bill_id = $arr222['id'];

      $sql = "SELECT id FROM monedas WHERE code = '$curr_des'";
      $rs = $db_connect -> query($sql);
      $arr223=mysqli_fetch_array($rs);
      $c_id = $arr223['id'];

      $sql = "SELECT monto FROM wallet WHERE divisa_id = '$c_id' AND billetera_id = '$bill_id'";
      $rs = $db_connect -> query($sql);
      $arr=mysqli_fetch_array($rs);

      if($monto_bf > $arr['monto']){

        $error="$monto_dii No tienes balance suficiente en tu billetera para completar esta transaccion. Contacta la administracion.";
      
    }else{



    if($_POST['operador']==NULL) { 

        $error = 'Seleccione un Estatus';
        
        }else{ 
    
    //Genero un registro
    generar_registro($id,"Completo una orden",name);

    $temp = explode(".", $_FILES["imagen"]["name"]);
    $newfilename = rand(1,100000000000000) . '.' . end($temp);
    move_uploaded_file($_FILES["imagen"]["tmp_name"], "../trans_img/" . $newfilename);

    sendMessageAtt(cliente_id,5,"/home/fidonoxt/public_html/trans_img/$newfilename");
 
    $monto_dii = $arr['monto'] - $monto_bf;
    $montoUSD = monto_usd;
    
    $sql = ("UPDATE wallet SET monto='$monto_dii'  WHERE divisa_id = '$c_id' AND billetera_id = '$bill_id'");
    $csql = $db_connect -> query($sql);

    $sql = ("INSERT INTO billeteras_trans (currency,billetera_id,tipo,monto_local,monto_usd) VALUES ('$curr_des','$bill_id','ENVIO','$monto_bf','$montoUSD')");
    $csql = $db_connect -> query($sql);


    $sql = ("UPDATE transfers SET status='3',operador_imagen='https://www.tecnoinversionesrb.com/trans_img/$newfilename' WHERE id = '$id'");
    $csql = $db_connect -> query($sql);


    $good = "La transaccion se completo exitosamente";

}
}
}
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

.tooltippp {
    position: relative;
    display: inline-block;
}

.tooltippp .tooltippptext {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 150%;
    left: 50%;
    margin-left: -75px;
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltippp .tooltippptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltippp:hover .tooltippptext {
    visibility: visible;
    opacity: 1;
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
                      <td>Cliente:</td>
                      <td><?php echo $nameC; ?></td>
                    </tr>
					
					 <tr>
                      <td>No. Telefono:</td>
                      <td><?php echo $tel; ?></td>
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


<?php 
$idD = des_id;
$sql = "SELECT banco,no_cuenta,name,doc_type,doc_no FROM beneficiario WHERE id = '$idD'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs); 
$banco = $arr['banco'];
$no_cuenta = $arr['no_cuenta'];
$name = $arr['name'];
$doc_type = $arr['doc_type'];
$doc_no = $arr['doc_no'];

$sql1 = "SELECT nombre FROM banco WHERE id = '$banco'";
$rs1 = $db_connect -> query($sql1);
$arr1=mysqli_fetch_array($rs1); 

$nameb = $arr1['nombre'];

?>  

                     <tr>
                     <td>Banco de Destino:</td>
                

                 <td><?php echo $nameb; ?></td>

                   <tr>
                     <td>Cuenta de Destino:</td>
                

                 <td><span id="to-copy"><?php echo $no_cuenta; ?></span> <div class="tooltippp"><div onclick="CopyToClipboard('to-copy')" onmouseout="outFunc()"><span class="tooltippptext" id="mytooltippp">Copiar al Clipboard</span><i class="fa fa-clipboard" aria-hidden="true"></i></div></div></td>
             
                         
                    </tr>

                    <tr>
                     <td>Beneficiario:</td>
                

                 <td><span id="to-copy1"><?php echo $name; ?></span> <div class="tooltippp"><div onclick="CopyToClipboard1('to-copy1')" onmouseout="outFunc1()"><span class="tooltippptext" id="mytooltippp1">Copiar al Clipboard</span><i class="fa fa-clipboard" aria-hidden="true"></i></div></div></td>
             
                         
                    </tr>
                    
                     <tr>
                     <td>Tipo de documento:</td>
                

                 <td><?php echo $doc_type; ?></td>
             
                         
                    </tr>
                    
                     <tr>
                     <td>No. Documento:</td>
                

                 <td><span id="to-copy2"><?php echo $doc_no; ?></span> <div class="tooltippp"><div onclick="CopyToClipboard2('to-copy2')" onmouseout="outFunc2()"><span class="tooltippptext" id="mytooltippp2">Copiar al Clipboard</span><i class="fa fa-clipboard" aria-hidden="true"></i></div></div></td>
             
                         
                    </tr>
                    
                    <tr>
                    <td><b>Monto A enviar en <?php echo currency_des; ?></b>:</td>
                      <td><span id="to-copy3"><?php echo number_format(monto_des, 2); ?></span> <div class="tooltippp"><div onclick="CopyToClipboard3('to-copy3')" onmouseout="outFunc3()"><span class="tooltippptext" id="mytooltippp3">Copiar al Clipboard</span><i class="fa fa-clipboard" aria-hidden="true"></i></div></div></td>
                         
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


                      <tr>
                      <td>Monto en USD:</td>
                      <td><?php echo number_format(monto_usd, 2); ?></td>
                    </tr>
                    <tr>
                    <td>Monto en <?php echo currency; ?>:</td>
                      <td><?php echo number_format(monto_local, 2); ?></td>
                    </tr>
                    
                    
                     </tr>
                      <td>Nota:</td>
                      <td><?php echo note; ?></td>
                         
                    </tr>
                    <tr>
                    <td>Ver Recibo</td>
                    <td><?php if(operador_imagen != null){ ?> <span class="label label label-success sweet-html">Ver imagen</span> <?php }else{ ?> No disponible <?php } ?></td>
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
                                <h4>Cambiar Estatus </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <form action="" method="post" enctype="multipart/form-data">


<div class="form-group">
                                          
                                                 <input type="file" name="imagen" <?php if(status == '3'){ ?>disabled<?php } ?>>
                                                                            </div>


                                <div class="form-group">
                                                  
                    <select name="operador" class="form-control input-default" <?php if(status == '3'){ ?>disabled<?php } ?>>
                                                          <option value="">Seleccione...</option>

                                                          <option value="3">Completado</option>

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


<style>
.swal-wide{
    width:660px !important;
    height: 660px !important;

}
</style>

<script>
function CopyToClipboard (containerid) {

  var textarea = document.createElement('textarea')
  textarea.id = 'temp_element'

  textarea.style.height = 0

  document.body.appendChild(textarea)

  textarea.value = document.getElementById(containerid).innerText

  var selector = document.querySelector('#temp_element')

  selector.select()

  document.execCommand('copy')

  var tooltippp = document.getElementById("mytooltippp");

  tooltippp.innerHTML = "Copiado!";

  document.body.removeChild(textarea)
}

function CopyToClipboard1 (containerid) {

  var textarea = document.createElement('textarea')
  textarea.id = 'temp_element'

  textarea.style.height = 0

  document.body.appendChild(textarea)

  textarea.value = document.getElementById(containerid).innerText

  var selector = document.querySelector('#temp_element')

  selector.select()

  document.execCommand('copy')

  var tooltippp = document.getElementById("mytooltippp1");

  tooltippp.innerHTML = "Copiado!";

  document.body.removeChild(textarea)
}

function CopyToClipboard2 (containerid) {

  var textarea = document.createElement('textarea')
  textarea.id = 'temp_element'

  textarea.style.height = 0

  document.body.appendChild(textarea)

  textarea.value = document.getElementById(containerid).innerText

  var selector = document.querySelector('#temp_element')

  selector.select()

  document.execCommand('copy')

  var tooltippp = document.getElementById("mytooltippp2");

  tooltippp.innerHTML = "Copiado!";

  document.body.removeChild(textarea)
}

function CopyToClipboard3 (containerid) {

  var textarea = document.createElement('textarea')
  textarea.id = 'temp_element'

  textarea.style.height = 0

  document.body.appendChild(textarea)

  textarea.value = document.getElementById(containerid).innerText

  var selector = document.querySelector('#temp_element')

  selector.select()

  document.execCommand('copy')

  var tooltippp = document.getElementById("mytooltippp3");

  tooltippp.innerHTML = "Copiado!";

  document.body.removeChild(textarea)
}

function outFunc1() {
  var tooltippp = document.getElementById("mytooltippp1");
  tooltippp.innerHTML = "Copiar al clipboard";
}

function outFunc2() {
  var tooltippp = document.getElementById("mytooltippp2");
  tooltippp.innerHTML = "Copiar al clipboard";
}

function outFunc3() {
  var tooltippp = document.getElementById("mytooltippp3");
  tooltippp.innerHTML = "Copiar al clipboard";
}

function outFunc() {
  var tooltippp = document.getElementById("mytooltippp");
  tooltippp.innerHTML = "Copiar al clipboard";
}
</script>

    <script>
    document.querySelector('.sweet-html').onclick = function(){
    swal({
        title: "Recibo",
        customClass: 'swal-wide',
        text: "<img width='580' height='550' src='<?php echo operador_imagen; ?>'>",
        html: true
    });
};
    </script>



    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>



</body>

</html>