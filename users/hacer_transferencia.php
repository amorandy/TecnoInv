<?php session_start ();

 if(empty($_SESSION['user'])){ 
    header('Location: login');
}else{

$email=$_SESSION['user'];

date_default_timezone_set('America/Santo_Domingo'); 
include "config/int.php"; 
include "config/config.php";

$error = '';

get_user_info($email);
get_country_user_data(country_id);
get_currency_user_data(moneda_id_user);
get_config_data();

$limit = valor * maximo;
$multiple = 0;
$id_c =  id;


$taza_boliares = taza / valor;

if (isset( $_POST['bene'] ) )
{
    if($_POST['bene']==NULL|$_POST['monto']==NULL|$_POST['banco']==NULL|$_POST['pais']==NULL|$_POST['recibo_date']==NULL|$_FILES["fileimagen"]["name"]==NULL) { 
        
       
       $error = "Parece que te ha faltado una informacion. Revisa y completa todos los campos requeridos.";
        
        }else{ 

            if(count($_POST['bene']) > 1){

                $multiple = 1;
            }


            $total = array_sum($_POST['monto']);



            if(total >= maximo AND status != 3){

                
            $error = "Parece que has llegado al limite de envio. Verifica tu cuenta para eliminar los limites.";


            }else{

            
            if (!($_FILES['fileimagen']['type'] == "image/jpeg" OR $_FILES['fileimagen']['type'] =="image/gif" OR $_FILES['fileimagen']['type'] =="image/jpg" OR $_FILES['fileimagen']['type'] =="image/png")){

               
             $error = "La imagen que intentas subir tiene un formato invalido";

            }else{

            $bene = $_POST['bene'];
            $monto = $_POST['monto'];
            $recibo_date = $_POST['recibo_date'];
            $note = "No hay notas";
            $recibo = $_POST['recibo'];
            $pais_dep = $_POST['pais'];
            $banco_dep = $_POST['banco'];

            if(isset($_POST['note'])){
                
                $note = $_POST['note'];

            }

            $taza_moneda_local_a = taza / valor;

            $i = 0;
            $arr_c = count($bene);

            foreach($bene as $index => $value ){


                $taza_moneda_local_a_enviar = taza / valor;
                $taza_frente_al_dolar = 1 / valor;
                $total = $monto[$index];
    
                $monto_des = $taza_moneda_local_a_enviar * $total;
        
                $total_a = $total * $taza_frente_al_dolar;
                $preferen = 0;
                $por = preferencial($total_a);


                $tracker = rand(1000000000,9999999999);
                $country_env = $code_co;

                get_destinatario_info($bene[$index]);

                $banco = $banco_des;

                $country_de = $country_de;

                select_validador();

                $validador = $validador;

                $code_c = $code;

                $currency_des =  $moneda_des;

                $taza = taza;

                if($por != false){

                    $preferen = 1;
                    $porciento = $monto_des * $por / 100;
                    $suma = $porciento + $monto_des;
                    $monto_des = $suma;
                }

                $temp = explode(".", $_FILES["fileimagen"]["name"]);
                $newfilename = rand(1,100000000000000) . '.' . end($temp);
                move_uploaded_file($_FILES["fileimagen"]["tmp_name"], "../trans_img_client/" . $newfilename);

                $sql = ("INSERT INTO transfers (tracker,send_to,send_from,date_recibo,validador_id,monto_usd,monto_local,monto_des,currency,currency_des,status,imagen,note,banco_id,recibo,cliente_id,des_id,taza,multiple,pais_dep,banco_dep,preferencial) VALUES ('$tracker','$country_de','$country_env','$recibo_date','$validador','$total_a','$total','$monto_des','$code_c','$currency_des','6','https://www.tecnoinversionesrb.com/trans_img_client/$newfilename','$note','$banco','$recibo','$id_c','".$bene[$index]."','$taza','$multiple','$pais_dep','$banco_dep','$preferen')");
                $csql = $db_connect -> query($sql);


            }



            $sum_total = total + $total_a;

            $sql12 = ("UPDATE clientes SET total='$sum_total' WHERE id='$id_c'");
            $csql = $db_connect -> query($sql12);
            header("Location: confirm");
       

}
}
}
}
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="../admin/images/logo.png">
    <title>Tecno Inversiones RB</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="css/float.css" id="theme" rel="stylesheet">

<style>
     .sinborde {
    border: 0;
  
  }
  </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            
                            <!-- Light Logo icon -->
                            <img src="assets/images/icon.png" alt="homepage" class="light-logo" width="50"/>
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         
                         <!-- Light Logo text -->    
                         <img src="assets/images/Logo_Tecnoinversiones_Logo_Blanco.png" class="light-logo" alt="homepage" width="150"/></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="profile-pic m-r-10" /><?php $name = explode(" ",name); echo $name['0']; ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="index" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="perfil" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Perfil</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="transferencias" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Transferencias</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="beneficiarios" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Beneficiarios</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="logout" aria-expanded="false"><i class="mdi mdi-earth"></i><span class="hide-menu">Salir</span></a>
                        </li>
    
                    </ul>
                    
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>

                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
          
                <?php
if ($error != '') {
?>
<div class="alert alert-danger alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $error; ?>
	                                        </div>
<?php } ?>


                
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    
                        <!-- Column -->
                        <form method="post" name="form" action="" enctype="multipart/form-data" role="form" data-toggle="validator" novalidate="true">
      
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" href="#home">Beneficarios →</a> </li>
                               
                               
                           
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">




                                    <div class="card-block">
                                    <div class="col-md-12 column">

                                        <div class="alert alert-success alert-dismissable">
	                                           
                                               <h4> <i class="mdi mdi-currency-usd-off"></i> Tasa del dia <?php echo number_format(taza, 2);?></h4>
                               
                                               </div>

                                    <div class="alert alert-info alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="mdi mdi-information-outline"></i> Seleccione un beneficiario y establezca el monto que desea <b>enviar en <?php echo $code; ?></b>. Ingrese la cantidad sin comas o puntos como aparece en su recibo de deposito. Verifique que todo este bien antes de ir al siguiente paso
                                            </div>
                                            <div class="col-md-12" style="font-size: 20px;">
                                            Cantidad Total a Recibir en BSF: <input type="text" id="total_dos" class="sinborde" value="Calculando total..."> 
</div>
<br>
        
			<table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					<tr>
						<th class="text-center">
							#
						</th>
						<th class="text-center">
							Beneficiario
						</th>
						<th class="text-center">
							Monto <?php echo $code; ?>
						</th>

                 
						
					</tr>
                </thead>
            
				<tbody>
               
					<tr id='addr0'>
						<td>1</td>
						<td>
						<select name="bene[]" class="form-control" id="full_name" required>
    <option value="">Beneficiario...</option>
<?php  
$id = id;
$tabla23 = ("SELECT id,name FROM beneficiario WHERE cliente_id = '$id'"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {
    ?>  
    <option value="<?php echo $registro['id']; ?>"><?php echo $registro['name']; ?></option>
<?php } ?>
</select>
						</td>
						<td>
                        <!--checkDec(this); -->
						<input type="text" onkeyup="checkDec(this); checkcard(); findTotal_dos();" onblur="findTotal()" id="cardCheck" name='monto[]'   data-validation="number"  placeholder='Ingrese el monto' class="form-control" required/>
						</td>
					
                        
					</tr>
                    
                    <tr id='addr1'></tr>
                    
				</tbody>
            </table>
<span id="taza_cal"></span>

<!-- TOTAL
            <div class="form-group">
                                       
                                        <div class="col-md-12" style="font-size: 20px;">
                                        Total a Enviar: DOP <input type="text" id="total" class="sinborde" value="Calculando total...">
                                        </div>
                                    </div>
-->
           

  <span id="add_row" ata-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="mdi mdi-account-multiple-plus" style="font-size: 22px;"></i> Agregar</span>
    <span id='delete_row' style="padding-left: 15px;"><i class="mdi mdi-account-remove" style="font-size: 23px;"></i> Eliminar</span>
        <br><br>
    

<button class="btn btn-success" data-toggle="tab" role="tab" href="#profile">Continuar</button>

</div>
                                   
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                <div class="card-block col-md-12">
                                <div class="alert alert-info alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="mdi mdi-information-outline"></i> Revise la cantidad a enviar, suba los datos del banco donde realizo el deposito y una imagen <b>clara</b> del recibo de deposito bancario por el valor exacto que se muestra abajo.
                                            </div>

                                 
                                            <div class="form-group">
                                       
                                       <div class="col-md-12" style="font-size: 20px;">
                                       Total a Enviar: <?php echo $code; ?> <input type="text" id="total" class="sinborde" value="Calculando total...">
                                       </div>
                                   </div>

                                     <div class="form-group">
                                       
                                       <div class="col-md-12" style="font-size: 20px;">

                                   
                                       </div>
                                   </div>

                                           <div class="form-group">
                                      <label for="example-email" class="col-md-12">Pais de Deposito <small><i class="mdi mdi-information-outline"></i> Ingrese el Pais desde donde esta realizando este deposito para el envio</small></label>

                                      
                                      <div class="col-md-12">
                                      <select name="pais" id="val" onchange="select()" class="form-control form-control-line">
                                      <option value="">Seleccione Pais..</option>
<?php  
$tabla23 = ("SELECT id,pais FROM paises"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {
?> 
                                          <option value="<?php echo $registro['id']; ?>"><?php echo $registro['pais']; ?></option>

<?php } ?>
</select>                                    
                                      </div>
                                  </div>

                                   <div class="form-group">
                                      <label class="col-md-12">Banco de Deposito <small><i class="mdi mdi-information-outline"></i> Ingrese el Banco donde realizo este deposito para el envio</small></label>
                                      <div class="col-md-12">
                                      <div id="div1"></div> 
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <label class="col-md-12">No. Recibo <small><i class="mdi mdi-information-outline"></i> OPCIONAL: Ingrese el numero del recibo bancario o numero de transacion</small></label>
                                      <div class="col-md-12">
                                          <input type="text" name="recibo" value="" class="form-control form-control-line">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-12">Fecha del Deposito <small><i class="mdi mdi-information-outline"></i> Puede encontrar esta fecha en su recibo o en los detalles de la transaccion</small></label>
                                      <div class="col-md-12">
                                          <input type="text" name="recibo_date" placeholder="" class="form-control form-control-line">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-md-12">Imagen del Recibo <small><i class="mdi mdi-information-outline"></i> Cargue una imagen <b>clara</b> del recibo o una captura de pantalla de la transferncia</small></label>
                                      <div class="col-md-12">
                                          <input type="file" name="fileimagen" placeholder="" class="form-control form-control-line">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-12">Nota <small><i class="mdi mdi-information-outline"></i> Opcional: Agregue una nota sobre esta transferencia</small></label>
                                      <div class="col-md-12">
                                          <textarea name="note" rows="5" class="form-control form-control-line"></textarea>
                                      </div>
                                  </div>
                                  <div class="alert alert-warning alert-dismissable">
                                  <i class="mdi mdi-information-outline"></i> Revise todos los detalles de la transaccion antes de presionar el boton "Enviar Transferencia". Puede volver atras para ver sus beneficiarios y el monto que enviara a cada uno. <a data-toggle="tab" href="#home">Volver Atras</a>
                                </div>
                                  <div class="form-group">
                                      <div class="col-sm-12">
                                          <button class="btn btn-success">Enviar transferencia</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                                </div>
                               
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

              </div>


            <footer class="footer"> © <?php echo date("Y"); ?> Tecno Inversiones RB </footer>


        </div>

    </div>

    
              
            
    
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
<!--
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
-->

<script>
  $.validate({
    lang: 'es'
  });
</script>

<script>

function select(){
    
    var name = document.getElementById('val').value;
    $.ajax({
        url: "ACE.php",
        type: "POST",
        data: {
        id:name,
        }, 
        success: function(result){
        $("#div1").html(result);
    }});
}


</script>

<script>

function checkcard()
{
 var i = 1;
 var name=document.getElementById("cardCheck").value;
	
 if(name)
 {
  $.ajax({
  type: 'post',
  url: 'checkdata.php',
  data: {
   check_card:name*<?php echo $taza_boliares; ?>,
   costumer:2,
  },
  success: function (response) {
      
   $('#taza_cal_addr').html(response);
   if(response=="OK")	
   {
    return true;	
   }
   else
   {
    return false;	
   }
  }
  });
  i++;
 }
 else
 {
  $('#taza_cal').html("");
  return false;
 }
}
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
    $('input[name="recibo_date"]').daterangepicker({
                autoclose: true,
                singleDatePicker: true,
                toggleActive: true,
                locale: {
      format: 'YYYY-M-DD'
    }
                });
    </script>


<script>
function checkDec(el){
 var ex = /^[0-9]+\.?[0-9]*$/;
 if(ex.test(el.value)==false){
   el.value = el.value.substring(0,el.value.length - 1);
  }
}
    
</script> 

 <script>

function findTotal(){
    var arr = document.getElementsByName('monto[]');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total').value = tot;
}

</script>

<script>
function findTotal_dos(){

    var arr_dos = document.getElementsByName('monto[]');
    var tot_dos=0;
    for(var i=0;i<arr_dos.length;i++){
        if(parseInt(arr_dos[i].value))
            tot_dos += parseInt(arr_dos[i].value)*'<?php echo $taza_boliares; ?>';
    }
    document.getElementById('total_dos').value = tot_dos;

}

    </script>


    <script>
	$(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){b=i-1;
      $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      if(i != 4){
      i++; 
      }
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

});
	</script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="assets/plugins/d3/d3.min.js"></script>
    <script src="assets/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="js/dashboard1.js"></script>
</body>

</html>
