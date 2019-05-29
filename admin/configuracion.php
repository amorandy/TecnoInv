<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


if(isset($_POST['maximo'])){

    if(!isset($_POST['status'])){

        $sql = "UPDATE configuracion SET status='2'";
        $csql = $db_connect -> query($sql);
    }

    if(isset($_POST['status'])){

        $sql = "UPDATE configuracion SET status='1'";
        $csql = $db_connect -> query($sql);
    }

    $sql = "UPDATE configuracion SET maximo='".$_POST['maximo']."',cantidad1='".$_POST['des1']."',cantidad2='".$_POST['des2']."',cantidad3='".$_POST['des3']."',taza='".$_POST['taza']."'";
    $csql = $db_connect -> query($sql);


$good = 'Se han actualizado los datos';

}

$sql = "SELECT * FROM configuracion";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);
$status = $arr['status'];
$maximo = $arr['maximo'];
$cantidad1 = $arr['cantidad1'];
$cantidad2 = $arr['cantidad2'];
$cantidad3 = $arr['cantidad3'];
$taza = $arr['taza'];

?>
<style>

.onoffswitch3
{
    position: relative; width: 200px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}

.onoffswitch3-checkbox {
    display: none;
}

.onoffswitch3-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 0px solid #999999; border-radius: 0px;
}

.onoffswitch3-inner {
    display: block; width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}

.onoffswitch3-inner > span {
    display: block; float: left; position: relative; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}

.onoffswitch3-inner .onoffswitch3-active {
    padding-left: 10px;
    background-color: #EEEEEE; color: #FFFFFF;
}

.onoffswitch3-inner .onoffswitch3-inactive {
    padding-right: 10px;
    background-color: #EEEEEE; color: #FFFFFF;
    text-align: right;
}

.onoffswitch3-switch {
    display: block; width: 50%; margin: 0px; text-align: center; 
    border: 0px solid #999999;border-radius: 0px; 
    position: absolute; top: 0; bottom: 0;
}
.onoffswitch3-active .onoffswitch3-switch {
    background: #27A1CA; left: 0;
}
.onoffswitch3-inactive .onoffswitch3-switch {
    background: #A1A1A1; right: 0;
}
.onoffswitch3-checkbox:checked + .onoffswitch3-label .onoffswitch3-inner {
    margin-left: 0;
}

</style>

        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard</h4> </div>
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
if ($error != '') {
?>
<div class="alert alert-danger alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $error; ?>
	                                        </div>
<?php } ?>

			<?php
if ($good != '') {
?>
<div class="alert alert-success alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $good; ?>
	                                        </div>
<?php } ?>


                <!-- Start Page Content -->
                <div class="row">
                                   
                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4></h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">

                                     <div class="form-group">
                                       <label>Estatus del sistema</label> 
                                         
                                      </div>

     <div class="onoffswitch3">
    <input type="checkbox" name="status" class="onoffswitch3-checkbox" id="myonoffswitch3" <?php if($status ==1){echo "checked";} ?>>
    <label class="onoffswitch3-label" for="myonoffswitch3">
        <span class="onoffswitch3-inner">
            <span class="onoffswitch3-active"><span class="onoffswitch3-switch">Activo</span></span>
            <span class="onoffswitch3-inactive"><span class="onoffswitch3-switch">Inactivo</span></span>
        </span>
    </label>
</div>                                <div class="form-group">
                                       <label>Tasa de Cambio</label> 
                                       <input type="text" name="taza" class="form-control input-default" rows="10" requiered value="<?php echo $taza; ?>">
                                         
                                      </div>

                                       <div class="form-group">
                                       <label>Cantidad Maxima sin Verificasion US$</label> 
                                       <input type="text" name="maximo" class="form-control input-default" rows="10" requiered value="<?php echo $maximo; ?>">
                                         
                                      </div>

                                       <div class="form-group">
                                       <label>% Descuento por cantidad 1</label> 
                                      
                                       <input type="text" name="des1" class="form-control input-default col-sm-4" rows="5" requiered value="<?php echo $cantidad1; ?>">
                                    
                                      </div>

                                       <div class="form-group">
                                       <label>% Descuento por cantidad 2</label> 
                                       <input type="text" name="des2" class="form-control input-default col-sm-4" rows="10" requiered value="<?php echo $cantidad2; ?>">
                                         
                                      </div>

                                         <div class="form-group">
                                       <label>% Descuento por cantidad 3</label> 
                                       <input type="text" name="des3" class="form-control input-default col-sm-4" rows="10" requiered value="<?php echo $cantidad3; ?>">
                                         
                                      </div>
                                  
                                       
                                       
                                        <button type="submit" class="btn btn-success m-b-10 m-l-5">Actualizar</button>
                                    </form>
                                </div>
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

    <script src="js/lib/morris-chart/raphael-min.js"></script>
    <script src="js/lib/morris-chart/morris.js"></script>
    <script src="js/lib/morris-chart/morris-init.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>



</body>

</html>