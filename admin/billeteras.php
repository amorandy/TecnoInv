<?php include "header.php"; 

if(isset($_POST['name'])){

    if($_POST['name']==NULL|$_POST['operador_id']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 

            require "config/config.php";

            $name = $_POST['name'];
            $operador_id = $_POST['operador_id'];

            $moneda_id = $_POST['moneda_id'];
            $monto = $_POST['monto'];

             $sql = ("INSERT INTO billetera (name,operador_id) VALUES ('$name','$operador_id')");
             $csql = $db_connect -> query($sql);
             

             $sql = "SELECT id FROM billetera ORDER by id DESC LIMIT 1";
             $rs = $db_connect -> query($sql);
             $arr=mysqli_fetch_array($rs);
             $o_id = $arr['id']; 

        foreach($moneda_id as $index => $value){

           $sql12 = ("INSERT INTO wallet (billetera_id,divisa_id,monto) VALUES ('$o_id','".$moneda_id[$index]."','".$monto[$index]."')");
           $csql = $db_connect -> query($sql12);
 

            }

            $good = "Se creo una nueva billetera con exito!";


}
}
get_billetera_data();
?>
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard <small style="color: #a6b7bf;">Billeteras</small></h4> </div>
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
                                    <h2>$<?php echo number_format(total, 2); ?></h2>
                                    <p class="m-b-0">Movimientos en <small>USD</small> HOY</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-20">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2>$<?php echo number_format(totalb, 2); ?></h2>
                                    <p class="m-b-0">Movimientos en <small>BsF</small> HOY</p>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                
         
                </div>

                <div class="row">
				
				<!-- column -->
                <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Agregar Billetera</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control input-default " placeholder="Nombre">
                                        </div>
                                       <div class="form-group">
                                 
                                       <select name="operador_id" class="form-control input-default">
                                       <option value="">Asignar operador</option>
                                       <?php  
include "config/config.php";                                      
$tabla2 = ("SELECT id,name FROM operadores ORDER BY id DESC"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) {  
?>

<option value="<?php echo $registro['id']; ?>"><?php echo $registro['name']; ?></option>

<?php } ?>
  </select>

  </div>                                     
                                        <?php  
include "config/config.php";                                      
$tabla23 = ("SELECT * FROM monedas"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {  
?>
                                        <input name="moneda_id[]" type="hidden" value="<?php echo $registro['id']; ?>">

                                        <div class="form-group">
                                            <input name="monto[]" type="text" class="form-control input-default " placeholder="Balance en <?php echo $registro['code']; ?>" value="">
                                        </div>



<?php } ?>
<input  type="submit" class="btn btn-info m-b-10 m-l-5" value="Crear">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h4>Billeteras </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php  
include "config/config.php";                                      
$tabla23 = ("SELECT * FROM billetera ORDER BY id DESC"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {  
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>  
                                                </td>
                                                <td><?php echo $registro['name']; ?></td>
                                                <td><a href="ver_billetera?id=<?php echo $registro['id']; ?>">Ver</a></td>
                                                
                                            
                                            
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
                                                <th>Billetera</th>
                                                <th>Tipo</th>
                                                <th>Monto en BsF</th>
                                                <th>Fecha</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>

<?php  
include "config/config.php";                                      
$tabla2 = ("SELECT * FROM billeteras_trans ORDER BY id DESC"); 
$rs2 = $db_connect -> query($tabla2);

while ($registro = mysqli_fetch_array($rs2)) {  

    $sql11 = "SELECT name FROM billetera WHERE id='".$registro['billetera_id']."'";
    $rs11 = $db_connect -> query($sql11);
    $arr11=mysqli_fetch_array($rs11);
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>
                                                </td>
                                                <td><?php echo $arr11['name']; ?></td>
                                                <td><span class="badge badge-success"><?php echo $registro['tipo']; ?></span></td>
                                                <td><?php echo number_format($registro['monto_local'], 2); ?></td>
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