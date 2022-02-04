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

            echo "<p class='alert alert-danger'>Passwords do not match</p>";

        }

        elseif(strlen($password)<8){
            echo "<p class='alert alert-danger'>Password must not be less than 8 characters long</p>";
        }
        elseif(preg_match('/[^a-zA-Z\d]/', $password)==0 || preg_match('/\d/', $password)==0 || preg_match('/[A-Z]/', $password)==0 || preg_match('/[a-z]/', $password)==0){
            echo "<p class='alert alert-danger'>"."Password must contain at least 1 special character, 1 upper case letter, 1 lower case letter and 1 special character"."</p>";
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
            echo "<p class='alert alert-success'>The password was successfully changed</p>";
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
            echo "<p class='alert alert-danger'>The password you entered is not correct</p>";
        }
     
        }

        
    }else{
        echo "<p class='alert alert-danger'>Missing fields to fill in</p>";
    }

        



    }


//aqui se valida el new mobile ingresado y luego se le indica al servidor que envie un sms para validarlo con un codigo
// si todo bien del lado del servidor el codigo que devuelve el servidor lo guarda en un session para despues validarlo con el que ingrese el usuario 
    
if(isset($_POST['mobileenv'])){

    if($_POST["mobile"] != null ){

        $mobile =  htmlspecialchars($_POST['mobile']);
    
        if(strlen($mobile)<8){
            echo "<p class='alert alert-danger'>The mobile number must not have less than 8 digits</p>";
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
                echo "<p class='alert alert-success'>A code has been sent to your cell phone</p>";
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
            echo "<p class='alert alert-danger'>Invalid number error</p>";
            unset($_SESSION['codigo']);
            unset($_SESSION['newmobile']);
            unset($_SESSION['cont']);
        }
    }
}
    else{
        echo "<p class='alert alert-danger'>No number entered</p>";
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
<input type="text" name="codigomob" id="codigomob" placeholder="Enter your code ">
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
            echo  "<p class='alert alert-success'>Number changed successfully</p>";
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
            echo "<p class='alert alert-danger'>Wrong code, you have ".$_SESSION['cont']." attempts left</p>";
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
        echo "<p class='alert alert-danger'>Wrong code, you have ".$_SESSION['cont']." attempts left</p>";
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
                echo "<p class='alert alert-success'>Changed location</p>";

            }
            else{
                echo "<p class='alert alert-danger'>Unknown error</p>";
       
            }
        }else{
            echo "<p class='alert alert-danger'>Error: Invalid location</p>";
  
        }



    }else{
        echo "<p class='alert alert-danger'>Missing fields to fill in</p>"; 
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
                echo "<p class='alert alert-success'>Your public key has been successfully changed</p>";
                $_SESSION['billetera'] = $publickey;
            }
            else{
                echo "<p class='alert alert-danger'>Unknown error</p>";
       
            }
        }else{
            echo "<p class='alert alert-danger'>Invalid public key error</p>";
  
        }

        




    }else{
        echo "<p class='alert alert-danger'>Missing fields to complete</p>";
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
             echo "<p class='alert alert-success'>Avatar successfully updated</p>";

             $_SESSION['avatar'] = $avatar;
            
             ?>
             <script>$('#close').on('click', function() {
    $('#content').load('./configuraciones/team.php');

})</script>
             
             <?php
             
            
         }
         elseif($result == false){
             echo "<p class='alert alert-danger'>Unknown error</p>";
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
            echo "<p class='alert alert-success'>Team name successfully updated</p>";

            $_SESSION['teamname'] = $teamname;
           
        }
        elseif($result == false){
            echo "<p class='alert alert-danger'>Unknown error</p>";
        }



    }
    else{
        echo "<p class='alert alert-danger'>Missing fields to fill</p>";
    }
}












?>
<script src="configuraciones/funciones/enviarcodigomob.js"></script>