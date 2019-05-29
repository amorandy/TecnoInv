<?php
if(isset($_POST['check_card']))
{
	
include "config/config.php";

echo number_format($_POST['check_card'], 2);

}
?>