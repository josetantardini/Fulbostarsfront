<?php

include '../../funcionesg/db_conn.php';
include '../../funcionesg/sesion.php';

if(isset($_POST['retirar'])){
    if($_POST['monto'] != null){
        
        $monto = $_POST['monto'];
       $montoactual = $_SESSION['tokens'];
        
        
       if(preg_match('/[a-z]/', $monto)==0 ||  preg_match('/[A-Z]/', $monto==0)){
            if($monto < $montoactual){

                $data = array(
                    'accion' => 'retirarfulbo',
                    'data' => 
                    array('user' => $_SESSION['user_email'],
                    'monto' => $monto
                    )
                );
                $result = conectarserver($data);

                if($result != false){
                    if($result != null){
                        echo "<p class='alert alert-success'>Se a enviado un codigo a su Email</p>";
                        $_SESSION['codigomon'] = $result;
                        $_SESSION['monto'] = $monto;
                        $_SESSION['cont']=3;
                    }else{
                        echo "<p class='alert alert-danger'>Error</p>";
                        unset($_SESSION['codigomon']);
                        unset($_SESSION['monto']);
                        unset($_SESSION['cont']);
                    }
                }else{
                    echo "<p class='alert alert-danger'>Error monto no valido</p>";
                    unset($_SESSION['codigomon']);
                    unset($_SESSION['monto']);
                    unset($_SESSION['cont']);
                }
            }else{
                echo "<p class='alert alert-danger'>El monto de tokens ingresado no puede ser mayor a tu monto actual de tokens</p>";
                unset($_SESSION['codigomon']);
                unset($_SESSION['monto']);
                unset($_SESSION['cont']);
            }
    }else{
        echo "<p class='alert alert-danger'>No valido</p>";
        unset($_SESSION['codigomon']);
        unset($_SESSION['monto']);
        unset($_SESSION['cont']);
    }
     
        

    }else{
        echo "<p class='alert alert-danger'>Faltan campos a completar</p>";
    }
}



    
?>

<?php 
//aqui se recibe el codigo ingresado por el usuario
if (isset($_SESSION['codigomon'])) { 

?>
<input type="text" name="codigomonto" id="codigomonto" placeholder="Ingrese su codigo ">
    <input type="submit" name="codenvmonto" class="btn btn-primary" id="codenvmonto" value="Enviar">

<?php 
}?>

<?php 
if(isset($_POST['codenvmonto'])){
    if($_SESSION['codigomon'] != null && $_POST['codigomonto'] != null){

        if($_SESSION['codigomon'] == $_POST['codigomonto']){
            
        $data = array(
			'accion' => 'codigoconfirmadomonto',
			'data' => 
			array('user' => $_SESSION['user_email'],
			'monto' => htmlspecialchars($_SESSION['monto']),
			)
		);
	//	echo var_dump($data);			
		$result = conectarserver($data);

        if($result == true){
            echo  "<p class='alert alert-success'>Monto retirado a su billetera satisfactoriamente</p>";
           unset($_SESSION['codigomon']);
           unset($_SESSION['monto']);
           unset($_SESSION['cont']);
            
  ?>
   <script>
   $(document).ready(function(){
    //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
    setTimeout(refrescar, 3000);
  });
       function refrescar(){
    //Actualiza la página
    location.reload();
  }
           </script>
  <?php
        }
            

        }else{
            $_SESSION['cont'] = $_SESSION['cont'] - 1;
            echo "<p class='alert alert-danger'>Codigo erroneo, quedan ".$_SESSION['cont']." intentos</p>";
            if($_SESSION['cont'] <= 0){
                unset($_SESSION['codigomon']);
                unset($_SESSION['monto']);
                unset($_SESSION['cont']); 
                ?>
           <script>
               location.reload();
           </script>
           <?php
            }

        }


    }else{
        $_SESSION['cont'] = $_SESSION['cont'] - 1;
        echo "<p class='alert alert-danger'>Codigo erroneo, quedan ".$_SESSION['cont']." intentos</p>";
        if($_SESSION['cont'] <= 0){
            unset($_SESSION['codigomon']);
            unset($_SESSION['monto']);
            unset($_SESSION['cont']); 
            ?>
       <script>
           location.reload();
       </script>
       <?php
        }
    }
}






?>

<script src="./js/codigoenv.js"></script>