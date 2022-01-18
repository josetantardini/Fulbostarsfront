<?php
    include '../../../funcionesg/db_conn.php';
    include '../../../funcionesg/sesion.php';
    if(isset($_POST['passwordenv'])){
        //config password
    if($_POST["password"] != null && $_POST["passwordant"] != null && $_POST["rpassword"] != null){


        $password = $_POST['password'];
        $passwordant = $_POST['passwordant'];
        $rpassword = $_POST['rpassword'];
      
        if($password != $rpassword){

            echo "<p class='alert alert-danger'>Contraseñas distintas</p>";

        }

        elseif(strlen($password)<8){
            echo "<p class='alert alert-danger'>La contraseña no puede tener menos de 8 caracteres</p>";
        }
        elseif(preg_match('/[^a-zA-Z\d]/', $password)==0 || preg_match('/\d/', $password)==0 || preg_match('/[A-Z]/', $password)==0 || preg_match('/[a-z]/', $password)==0){
            echo "<p class='alert alert-danger'>"."La contraseña debe de tener al menos 1 caracter especial, 1 mayuscula, 1 minuscula y 1 caracter especial"."</p>";
        }else{
            
		$data = array(
			'accion' => 'updatepassword',
			'data' => 
			array('user' => $_SESSION['user_email'],
			'password' => $password,
            'passwordant' => $passwordant
			)
		);
	//	echo var_dump($data);			
		$result = conectarserver($data);

        if($result == true){
            echo "<p class='alert alert-success'>La contraseña fue cambiada correctamente</p>";
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
        elseif($result == false){
            echo "<p class='alert alert-danger'>La contraseña actual ingresada no es correcta</p>";
        }
     
        }

        
    }else{
        echo "<p class='alert alert-danger'>Faltan campos a completar</p>";
    }

        



    }


//aqui se valida el new mobile ingresado y luego se le indica al servidor que envie un sms para validarlo con un codigo
// si todo bien del lado del servidor el codigo que devuelve el servidor lo guarda en un session para despues validarlo con el que ingrese el usuario 
    
if(isset($_POST['mobileenv'])){

    if($_POST["mobile"] != null ){

        $mobile =  htmlspecialchars($_POST['mobile']);
    
        if(strlen($mobile)<8){
            echo "<p class='alert alert-danger'>El numero de celular no puede tener menos de 8 digitos</p>";
            unset($_SESSION['codigo']);
            unset($_SESSION['newmobile']);
            unset($_SESSION['cont']);
        }else{

        $data = array(
			'accion' => 'updatemobile',
			'data' => 
			array('user' => $_SESSION['user_email'],
			'mobile' => htmlspecialchars($mobile),
			)
		);
	//	echo var_dump($data);			
		$result = conectarserver($data);
        if($result != false){
            if($result != null){
                echo "<p class='alert alert-success'>Se a enviado un codigo a su mobile</p>";
                $_SESSION['codigo'] = $result;
                $_SESSION['newmobile'] = $mobile;
                $_SESSION['cont']=3;
            }
            else{
                echo "<p class='alert alert-danger'>Error</p>";
                unset($_SESSION['codigo']);
                unset($_SESSION['newmobile']);
                unset($_SESSION['cont']);
            }
        }else{
            echo "<p class='alert alert-danger'>Error numero no valido</p>";
            unset($_SESSION['codigo']);
            unset($_SESSION['newmobile']);
            unset($_SESSION['cont']);
        }
    }
}
    else{
        echo "<p class='alert alert-danger'>No se ingreso ningun numero</p>";
        unset($_SESSION['codigo']);
        unset($_SESSION['newmobile']);
        unset($_SESSION['cont']);
    }


}






    
    ?>

<?php 
//aqui se recibe el codigo ingresado por el usuario
if (isset($_SESSION['codigo'])) { 

?>
<input type="text" name="codigomob" id="codigomob" placeholder="Ingrese su codigo ">
    <input type="submit" name="codenv" id="codenv" value="Enviar">

<?php 
}?>

<?php 
if(isset($_POST['codenv'])){
    if($_SESSION['codigo'] != null && $_POST['codigomob'] != null){

        if($_SESSION['codigo'] == $_POST['codigomob']){
            
        $data = array(
			'accion' => 'codigoconfirmadomobile',
			'data' => 
			array('user' => $_SESSION['user_email'],
			'mobile' => htmlspecialchars($_SESSION['newmobile']),
			)
		);
	//	echo var_dump($data);			
		$result = conectarserver($data);

        if($result == true){
            echo  "<p class='alert alert-success'>Numero cambiado satisfactoriamente</p>";
           unset($_SESSION['codigo']);
           unset($_SESSION['newmobile']);
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
                unset($_SESSION['codigo']);
                unset($_SESSION['newmobile']);
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
            unset($_SESSION['codigo']);
            unset($_SESSION['newmobile']);
            unset($_SESSION['cont']); 
            ?>
       <script>
           location.reload();
       </script>
       <?php
        }
    }
}


//update ubicacion

if(isset($_POST['ubienv'])){

    if($_POST["city"] != null && $_POST["country"] != null ){

        $city =  htmlspecialchars($_POST['city']);
        $country =  htmlspecialchars($_POST['country']);

        $data = array(
			'accion' => 'updateubicacion',
			'data' => 
			array('user' => $_SESSION['user_email'],
			'city' => htmlspecialchars($city),
            'country' => htmlspecialchars($country)
			)
		);


	//	echo var_dump($data);			
		$result = conectarserver($data);



        
        if($result != false){
            if($result == true){
                echo "<p class='alert alert-success'>Ubicacion modificada</p>";

            }
            else{
                echo "<p class='alert alert-danger'>Error desconocido</p>";
       
            }
        }else{
            echo "<p class='alert alert-danger'>Error ubicacion no valida</p>";
  
        }



    }else{
        echo "<p class='alert alert-danger'>Faltan campos a completar</p>"; 
    }


}


if(isset($_POST['keyenv'])){

    if($_POST['publickey'] != null){

        $publickey =  htmlspecialchars($_POST['publickey']);

        $data = array(
			'accion' => 'updatepublickey',
			'data' => 
			array('user' => $_SESSION['user_email'],
			'publickey' => htmlspecialchars($publickey),
           
			)
		);
	//	echo var_dump($data);			
		$result = conectarserver($data);


        if($result != false){
            if($result == true){
                echo "<p class='alert alert-success'>se a cambiado su public key satisfactoriamente</p>";

            }
            else{
                echo "<p class='alert alert-danger'>Error desconocido</p>";
       
            }
        }else{
            echo "<p class='alert alert-danger'>Error public key no valido</p>";
  
        }

        




    }else{
        echo "<p class='alert alert-danger'>Faltan campos a completar</p>";
    }


}










//avatar
if(isset($_POST['avatar'])){
   

    $avatar= htmlspecialchars($_POST['avatar']);


    $data = array(
             'accion' => 'updateavatar',
             'data' => 
             array('user' => $_SESSION['user_email'],
             'avatar' => htmlspecialchars($avatar)           
             )
         );
     //	echo var_dump($data);			
         $result = conectarserver($data);
 
 
         if($result == true){
             echo "<p class='alert alert-success'>Avatar actualizado con exito</p>";

             $_SESSION['avatar'] = $avatar;
            
             ?>
             <script>$('#close').on('click', function() {
    $('#content').load('./configuraciones/team.php');

})</script>
             
             <?php
             
            
         }
         elseif($result == false){
             echo "<p class='alert alert-danger'>Error desconocido</p>";
         }
    
}
       

//teamname

if(isset($_POST['teamenv'])){

    if($_POST['teamname'] != null){

      $teamname1 = $_POST['teamname'];

      $teamname = htmlspecialchars($teamname1);
      

        $data = array(
            'accion' => 'updateteamname',
            'data' => 
            array('user' => $_SESSION['user_email'],
            'teamname' => htmlspecialchars($teamname)           
            )
        );
    //	echo var_dump($data);			
        $result = conectarserver($data);


        if($result == true){
            echo "<p class='alert alert-success'>Team name actualizado con exito</p>";

            $_SESSION['teamname'] = $teamname;
           
        }
        elseif($result == false){
            echo "<p class='alert alert-danger'>Error desconocido</p>";
        }



    }
    else{
        echo "<p class='alert alert-danger'>Faltan campos a completar</p>";
    }
}












?>
<script src="configuraciones/funciones/enviarcodigomob.js"></script>