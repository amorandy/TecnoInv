<?php include "header.php"; ?>
<?php
$error = '';
$good = ''; 

if(isset($_GET['ve'])){

    if($_GET['ve'] == 1) { 
        
        $id = $_GET['id'];

        $sql = "UPDATE clientes SET status='3' WHERE id='".$_GET['id']."'";
        $csql = $db_connect -> query($sql);

        $sql = "UPDATE verificasiones SET status='1' WHERE user_id='".$_GET['id']."'";
        $csql = $db_connect -> query($sql);
        

        sendMessage($id,1);


            $good = 'El usuario se ha verificado';


        
        }else{ 

            $sql = "UPDATE clientes SET status='1' WHERE id = '".$_GET['id']."'";
            $csql = $db_connect -> query($sql);

           sendMessage($id,2);

            

            $good = 'Se rechazo la verificacion del usuario';

           

}
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

                <div class="row">
				
				<!-- column -->

					  <div class="col-lg-12">



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



                        <div class="card">
                            <div class="card-title">
                                <h4>Solicitudes de Verificacion </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Estatus</th>
                                                <th>Tipo de Doc</th>
                                                <th>No. Documento</th>
                                                <th>Imagen Doc.</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

<?php                                       
$tabla2 = ("SELECT * FROM verificasiones WHERE status = 2"); 
$rs2 = $db_connect -> query($tabla2);
while ($registro = mysqli_fetch_array($rs2)) {  
    
$tabla = ("SELECT name,doc_type,doc_no FROM clientes WHERE id = '".$registro['user_id']."'"); 
$rs = $db_connect -> query($tabla);
$arr = mysqli_fetch_array($rs);
?>

                                            <tr>
                                                <td>
                                                <?php echo $registro['id']; ?>
                                                </td>
                                                <td><?php echo $arr['name']; ?></td>
                                                <td><?php if($registro['status'] == 1){echo "<span class='badge badge-success'>Verificado";}else{echo "<span class='badge badge-danger'>Pendiente";} ?></span></td>
                                                <td><?php echo $arr['doc_type']; ?></td>
                                                <td><?php echo $arr['doc_no']; ?></td>
                                                <td><span class="label label label-success sweet-html">Ver Documento</span></td>
                                                <td><a href="verificasiones?id=<?php echo $registro['user_id']; ?>&ve=1">Aprobar/<a href="verificasiones?id=<?php echo $registro['user_id']; ?>&ve=2">Rechazar</a></i>
</a></td>
                                            </tr>

    <script>
    document.querySelector('.sweet-html').onclick = function(){
    swal({
        title: "Documento",
        text: "<img width='450' src='<?php echo $registro['imagen']; ?>'>",
        html: true
    });
};
    </script>

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


        <script src="js/lib/sweetalert/sweetalert.min.js"></script>
    <!-- scripit init-->


    <script src="js/lib/morris-chart/raphael-min.js"></script>
    <script src="js/lib/morris-chart/morris.js"></script>
    <script src="js/lib/morris-chart/morris-init.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>



</body>

</html>