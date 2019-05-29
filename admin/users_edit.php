<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


if(isset($_POST['name'])){

    if($_POST['name']==NULL|$_POST['email']==NULL|$_POST['tel']==NULL|$_POST['doc_type']==NULL|$_POST['doc_no']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 

         $status = "";   

        if($_POST['status'] != NULL){

            $status = ",status='".$_POST['status']."'";
        }    


            $name = $_POST['name'];
            $email = $_POST['email'];
            $doc_type = $_POST['doc_type'];
            $doc_no = $_POST['doc_no'];
            $tel = $_POST['tel'];

            $sql = ("UPDATE clientes SET name='$name',email='$email'$status,tel='$tel',doc_type='$doc_type',doc_no='$doc_no' WHERE id = '$id'");
            $csql = $db_connect -> query($sql);


            $good = "Actualizado correctamente";


}
}
get_users_data($id);
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
                                   
                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Editar Usuario</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                        <div class="form-group">
                                        Nombre Completo
                                            <input name="name" type="text" class="form-control input-default " placeholder="Nombre" value="<?php echo name; ?>">
                                        </div>
                              
                                        <div class="form-group">
                                        Correo Electronico
                                            <input name="email" type="text" class="form-control input-default " placeholder="Email" value="<?php echo email; ?>">
                                        </div>

                                        <div class="form-group">
                                        Celular
                                            <input name="tel" type="text" class="form-control input-default " placeholder="Email" value="<?php echo tel; ?>">
                                        </div>

                                        <div class="form-group">
                                        Tipo de Documento
                                            <input name="doc_type" type="text" class="form-control input-default " placeholder="Email" value="<?php echo doc_type; ?>">
                                        </div>

                                        <div class="form-group">
                                        No. De Documento
                                            <input name="doc_no" type="text" class="form-control input-default " placeholder="Email" value="<?php echo doc_no; ?>">
                                        </div>
                                        <div class="form-group">

                                                        Estatus Actual: <?php if(status == 1){?><span class="label label label-info">Activo/No verificado</span><?php } ?>
                                                        <?php if(status == 2){?><span class="label label label-danger">Inactivo</span><?php } ?>
                                                        <?php if(status == 3){?><span class="label label label-success sweet-html">Verificado (Ver Documento)</span><?php } ?>
                                                        <br> <br>
                                                    <select name="status" class="form-control input-default">
															<option value="">Estatus...</option>
															<option value="1">Activo</option>
															<option value="2">Inactivo</option>
                                                            <option value="3">Verificado</option>
														</select>
                                                </div>
                                       
                                      
                                                <input type="submit" class="btn btn-success m-b-10 m-l-5" value="Actualizar">
                                </div>
                            </div>
                        </div>


                        
                    </div>

                 
					
					
                </div>

</form>


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

<?php if(status == 3){ ?>

    <script src="js/lib/sweetalert/sweetalert.min.js"></script>
    <!-- scripit init-->
    <script>
    document.querySelector('.sweet-html').onclick = function(){
    swal({
        title: "Documento",
        text: "<img width='450' src='<?php echo imagen_doc; ?>'>",
        html: true
    });
};
    </script>

<?php } ?>

    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>



</body>

</html>