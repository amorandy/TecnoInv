<?php
include "header.php";
$error = '';
$good = '';
?>



        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard > Registros</b></h4> </div>
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
                        <div class="card">
                          
                            <div class="card-body">
                            <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered">
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
$tabla2 = ("SELECT * FROM registros ORDER BY id DESC"); 
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




					  


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
         <!-- footer -->
         <footer class="footer"> © <?php echo date("Y"); ?> All rights reserved.</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
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