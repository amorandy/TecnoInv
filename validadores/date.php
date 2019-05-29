<?php 
if(isset($_POST['date'])){

if($_POST['date']==NULL|$_POST['monto']==NULL|$_POST['digitos']==NULL) { 

    echo 'Todos los campos son requeridos';
    
    }else{ 

        $arr_s = explode(':',$_POST['date']);
        list($year, $mes, $day) = explode('-', $_POST['date']);;



        

        $signature = $year.$mes.substr($day, 0, 2).$arr_s[1].$arr_s[2].$_POST['monto'].$_POST['digitos'];


    }
}
      


?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
        </head>
        <body>
        <form method="POST">
        <div class="form-group">
                                <label>Fecha</label>
<input type="text" name="date" class="form-control input-default" value="">
                                </div>

                                <div class="form-group">
                                <label>Monto <small style="color: #fd5411;">No incluir puntos y/o comas</small></label>
<input type="number" name="monto" class="form-control input-default" value="">
                                </div>

<div class="form-group">
                                <label>5 Digitos <small style="color: #fd5411;">No incluir puntos y/o comas</small></label>
<input type="number" name="digitos" class="form-control input-default" value="">
                                </div>
<input  type="submit" class="btn btn-info m-b-10 m-l-5" value="Enviar transaccion">
                                </form>
        </body>
        <script src="js/lib/jquery/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
    $('input[name="date"]').daterangepicker({
		        timePicker: true,
                timePickerSeconds: true,
                autoclose: true,
                singleDatePicker: true,
                toggleActive: true,
                locale: {
      format: 'YYYY-M-DD HH:mm:ss'
    }
                });
    </script>
        </html>