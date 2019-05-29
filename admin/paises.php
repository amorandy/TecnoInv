<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


if(isset($_POST['code'])){

    if($_POST['code']==NULL|$_POST['pais']==NULL|$_POST['moneda_id']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 



            $code = $_POST['code'];
            $pais = $_POST['pais'];
            $moneda = $_POST['moneda_id'];

             $sql = ("INSERT INTO paises (pais,code,moneda_id) VALUES ('$pais','$code','$moneda')");
             $csql = $db_connect -> query($sql);


            $good = "Moneda agregada con exito";


}
}
if(isset($_POST['upcode'])){

    if($_POST['upcode']==NULL|$_POST['uppais']==NULL|$_POST['upmoneda_id']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 

$sql = ("UPDATE paises SET code='".$_POST['upcode']."',pais='".$_POST['uppais']."',moneda_id='".$_POST['upmoneda_id']."' WHERE id= '".$_GET['id']."'");
$csql = $db_connect -> query($sql);

$good = "Pais actualizo con exito";

        }

    }


    if(isset($_GET['edit'])){

        $sql22 = "SELECT * FROM paises WHERE id = '".$_GET['id']."'";
        $rs22 = $db_connect -> query($sql22);
        $arr22=mysqli_fetch_array($rs22); 


    }
?>
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
                                   
                <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Agregar Pais</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                    <div class="form-group">
                                            <input name="pais" type="text" class="form-control input-default " placeholder="Nombre del Pais">
                                        </div>
                                        <div class="form-group">
                                            <input name="code" type="text" class="form-control input-default " placeholder="Codigo del Pais">
                                        </div>

                                         <div class="form-group">
                                         <select name="moneda_id" class="form-control input-default ">
                                         <?php  
include "config/config.php";                                      
$tabla2 = ("SELECT * FROM monedas"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) { 


?>
                                         <option value="<?php echo $registro['id']; ?>"><?php echo $registro['code']; ?></option>

<?php } ?>
                                         </select>
                                           
                                        </div>
                                       
                                        <input type="submit" class="btn btn-info m-b-10 m-l-5" value="Agregar">
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>

                  
                   
<?php if(isset($_GET['edit'])){ ?>
                     <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Actualizar Pais</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                    <div class="form-group">
                                            <input name="uppais" type="text" class="form-control input-default " placeholder="Nombre del Pais" value="<?php echo $arr22['pais']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input name="upcode" type="text" class="form-control input-default " placeholder="Codigo del Pais" value="<?php echo $arr22['code']; ?>">
                                        </div>

                                         <div class="form-group">
                                         <select name="upmoneda_id" class="form-control input-default ">
                                         <?php  
include "config/config.php";                                      
$tabla2 = ("SELECT * FROM monedas"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) { 


?>
                                         <option value="<?php echo $registro['id']; ?>" <?php if($arr22['moneda_id'] == $registro['id']){ ?>selected<?php } ?>><?php echo $registro['code']; ?></option>

<?php } ?>
                                         </select>
                                           
                                        </div>
                                       
                                        <input type="submit" class="btn btn-info m-b-10 m-l-5" value="Actualizar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?> 
</div>
                <div class="row">
				
				<!-- column -->

					  <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Operadores </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Codigo del Pais</th>
                                                <th>Moneda</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php  
include "config/config.php";                                      
$tabla2 = ("SELECT * FROM paises"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) { 
    
    $sql = "SELECT code FROM monedas WHERE id = '".$registro['moneda_id']."'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs); 
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>
                                                </td>
                                                <td><?php echo $registro['pais']; ?></td>
                                                <td><?php echo $registro['code']; ?> </td>
                                                <td><?php echo $arr['code']; ?> </td>
                                                <td><a href="paises?id=<?php echo $registro['id']; ?>&edit=1"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a></td>
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

    <script src="js/lib/morris-chart/raphael-min.js"></script>
    <script src="js/lib/morris-chart/morris.js"></script>
    <script src="js/lib/morris-chart/morris-init.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>



</body>

</html>