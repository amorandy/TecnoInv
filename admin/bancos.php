<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


if(isset($_POST['banco'])){

    if($_POST['banco']==NULL|$_POST['caracteres']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 



            $banco = $_POST['banco'];
            $caracteres = $_POST['caracteres'];

             $sql = ("INSERT INTO banco (nombre,caracteres) VALUES ('$banco','$caracteres')");
             $csql = $db_connect -> query($sql);


            $good = "Banco agregado con exito";


}
}
if(isset($_POST['upbanco'])){

    if($_POST['upbanco']==NULL|$_POST['upcaracteres']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 

$sql = ("UPDATE banco SET nombre='".$_POST['upbanco']."',caracteres='".$_POST['upcaracteres']."' WHERE id= '".$_GET['id']."'");
$csql = $db_connect -> query($sql);

$good = "Banco actualizado con exito";

        }

    }


    if(isset($_GET['edit'])){

        $sql22 = "SELECT * FROM banco WHERE id = '".$_GET['id']."'";
        $rs22 = $db_connect -> query($sql22);
        $arr22=mysqli_fetch_array($rs22); 


    }

    get_banco_data();
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


                 <div class="row">
                
                <div class="col-md-4">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>$<?php echo number_format(total, 2); ?></h2>
                                    <p class="m-b-0">Movimientos Depositos en <small>USD</small> HOY</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-usd f-s-40 color-info"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>RD$<?php echo number_format(totaldop, 2); ?></h2>
                                    <p class="m-b-0">Movimientos Depositos en <small>DOP</small> HOY</p>
                                </div>
                            </div>
                        </div>
                    </div>  
                
                </div>
                
                <!-- Start Page Content -->
                <div class="row">
                                   
                <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Agregar Banco</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                    <div class="form-group">
                                            <input name="banco" type="text" class="form-control input-default " placeholder="Nombre del Banco">
                                        </div>
                                        <div class="form-group">
                                            <input name="caracteres" type="text" class="form-control input-default " placeholder="Numero de caracteres">
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
                                <h4>Actualizar Banco</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                    <div class="form-group">
                                            <input name="upbanco" type="text" class="form-control input-default " placeholder="Nombre del Pais" value="<?php echo $arr22['nombre']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input name="upcaracteres" type="text" class="form-control input-default " placeholder="Codigo del Pais" value="<?php echo $arr22['caracteres']; ?>">
                                        </div>

                                        
                                       
                                        <input type="submit" class="btn btn-info m-b-10 m-l-5" value="Actualizar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?> 

          
				
				<!-- column -->

					  <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Bancos </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Caracteres</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php  
include "config/config.php";                                      
$tabla2 = ("SELECT * FROM banco"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) { 
    
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>
                                                </td>
                                                <td><?php echo $registro['nombre']; ?></td>
                                                <td><?php echo $registro['caracteres']; ?> </td>
                                                <td><a href="bancos?id=<?php echo $registro['id']; ?>&edit=1"><i class="fa fa-pencil" aria-hidden="true"></i>
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
					
					
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Todos los Movimientos </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Banco</th>
                                                <th>Tipo</th>
                                                <th>Monto USD</th>
                                                <th>Fecha</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

<?php  
include "config/config.php";                                      
$tabla2 = ("SELECT * FROM transfers WHERE status='2' OR status = '3' ORDER BY id DESC"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) {  

    $sql11 = "SELECT nombre FROM banco WHERE id='".$registro['banco_dep']."'";
    $rs11 = $db_connect -> query($sql11);
    $arr11=mysqli_fetch_array($rs11);
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>
                                                </td>
                                                <td><?php echo $arr11['nombre']; ?></td>
                                                <td><span class="badge badge-success">DEPOSITO</span></td>
                                                <td>$<?php echo number_format($registro['monto_usd'], 2); ?></td>
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