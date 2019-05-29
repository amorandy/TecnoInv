<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


$id = idv;

$sql = "SELECT id,name FROM billetera WHERE operador_id = '$id'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);


?>

        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard <small style="color: #a6b7bf;">Balances</small></h4> </div>
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
                                <h4>Balances de la Billetera: <b><?php echo $arr['name']; ?></b></h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">

<?php  
include "config/config.php";                                      
$tabla23 = ("SELECT id,monto,divisa_id FROM wallet WHERE billetera_id = '".$arr['id']."' AND monto != '".NULL."'"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {
    
    $sql = "SELECT code FROM monedas WHERE id = '".$registro['divisa_id']."'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);
    $code = $arr['code'];   

?>
                                        <input name="moneda_id[]" type="hidden" value="<?php echo $registro['divisa_id']; ?>">

                                        <div class="form-group">

                                        <?php echo $code; ?> 
                                 
                                        <input name="monto[]" type="text" class="form-control input-default " placeholder="" value="<?php echo number_format($registro['monto'], 2); ?>" disabled>
                                        </div>



<?php } ?>


                                       
                                        <input  type="submit" class="btn btn-info m-b-10 m-l-5" value="Actualizar">
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