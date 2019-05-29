<?php include "header.php"; ?>
<?php
$error = '';
$good = '';

if(isset($_GET['edit'])){
    include "config/config.php";
    $sql = "SELECT * FROM admins WHERE id = '".$_GET['id']."'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs); 

    $name = $arr['name'];
    $email = $arr['email'];

    if(isset($_POST['upname'])){

    if($_POST['upname']==NULL|$_POST['upemail']==NULL|$_POST['uppassword']==NULL|$_POST['upstatus']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 

    $cl = update_admins($_POST['upname'],$_POST['upemail'],$_POST['uppassword'],$_POST['upstatus'],$_GET['edit']);

    if($cl){
        $good = "Se han actualizado los datos";
    }

        }
    }
}

if(isset($_POST['name'])){

    if($_POST['name']==NULL|$_POST['email']==NULL|$_POST['password']==NULL|$_POST['status']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 

    $cl = register_admins($_POST['name'],$_POST['email'],$_POST['password'],$_POST['status']);
    if($cl){
        $good = "Nuevo Validador agregado";
    }
}
}
?>
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard</h4> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home.</a></li>
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
                                <h4>Agregar Administrador</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control input-default " placeholder="Nombre">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="text" class="form-control input-default " placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <input name="email" type="text" class="form-control input-default " placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                                  
                                                    <select name="status" class="form-control input-default">
															<option value="">Estatus...</option>
															<option value="1">Activo</option>
															<option value="2">Inactivo</option>
														</select>
                                                </div>
                                       
                                        <input type="submit" class="btn btn-success m-b-10 m-l-5" value="Agregar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

<?php if(isset($_GET['edit'])){ ?>
                     <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Actualizar Administrador</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                        <div class="form-group">
                                            <input name="upname" type="text" class="form-control input-default " placeholder="Nombre" value="<?php echo $name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input name="uppassword" type="text" class="form-control input-default " placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <input name="upemail" type="text" class="form-control input-default " placeholder="Email" value="<?php echo $email; ?>">
                                        </div>
                                        <div class="form-group">
                                                  
                                                    <select name="upstatus" class="form-control input-default">
														
															<option value="1">Activo</option>
															<option value="2">Inactivo</option>
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
                                <h4>Validadores </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Estatus</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php  
include "config/config.php";                                      
$tabla2 = ("SELECT id,name,email,status FROM admins ORDER BY id DESC"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) {  
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>
                                                </td>
                                                <td><?php echo $registro['name']; ?></td>
                                                <td><?php if($registro['status'] == 1){echo "<span class='badge badge-success'>Activo";}else{echo "<span class='badge badge-danger'>Inactivo";} ?></span></td>
                                                <td><a href="admin?id=<?php echo $registro['id']; ?>&edit=1"><i class="fa fa-pencil" aria-hidden="true"></i>
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