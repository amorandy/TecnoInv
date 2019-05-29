<?php if(isset($_POST['id']) AND $_POST['id'] != NULL){ ?>
<select class="form-control form-control-line" name="banco">
<?php
include "config/config.php";

$tabla23 = ("SELECT * FROM banco WHERE country_id = ".$_POST['id'].""); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {	
?>	
<option value="<?php echo $registro['id']; ?>"><?php echo $registro['nombre']; ?></option>
<?php } ?>
</select>
<?php } ?>