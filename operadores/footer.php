<footer class="footer"> © 2018 All rights reserved.</footer>
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

    <script>

    Morris.Bar( {
		element: 'morris-bar-chart',
		data: [ {
			y: '<?php echo date("Y-m-d", strtotime ("-6days")); ?>',
			a: <?php echo $total7; ?>
        }, {
			y: '<?php echo date("Y-m-d", strtotime ("-5days")); ?>',
			a: <?php echo $total6; ?>
        }, {
			y: '<?php echo date("Y-m-d", strtotime ("-4days")); ?>',
			a: <?php echo $total5; ?>
        }, {
			y: '<?php echo date("Y-m-d", strtotime ("-3days")); ?>',
			a: <?php echo $total4; ?>
        }, {
			y: '<?php echo date("Y-m-d", strtotime ("-2days")); ?>',
			a: <?php echo $total3; ?>
        }, {
			y: '<?php echo date("Y-m-d", strtotime ("-1days")); ?>',
			a: <?php echo $total2; ?>
        }, {
			y: '<?php echo date("Y-m-d", strtotime ("-0days")); ?>',
			a: <?php echo $total1; ?>
        } ],
		xkey: 'y',
		ykeys: [ 'a'],
		labels: ['Transferencias US$'],
		barColors: [ '#26DAD2'],
		hideHover: 'auto',
		gridLineColor: '#eef0f2',
		resize: true
    } );

    </script>

</body>

</html>