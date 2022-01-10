<?php
    include '../../../funcionesg/db_conn.php';
    include '../../../funcionesg/sesion.php';


    if(isset($_POST['resetpass'])){
        if($_POST['email'] != null){

            $email = $_POST['email'];
            if (strpos($email,"@")==0 || strpos($email,".")==0 ) {
                echo "<p class='alert alert-danger'>"."No coincide con un Email ejemplo: gergino@hotmail.com."."</p>";
            }else{
                $data = array(
                    'accion' => 'resetpassword',
                    'data' => 
                    array('user' => $email
                    )
                );
             
             
                $result = conectarserver($data);
                if($result != false){
                    if($result != null){
                        echo "<p class='alert alert-success'>Se a enviado un codigo a su email</p>";
                        $_SESSION['codigoservidor'] = $result;
                        $_SESSION['cont']=3;
                        $_SESSION['email']=$email;
                        unset($_SESSION['accessresetpassword']);
                    }
                    else{
                        echo "<p class='alert alert-danger'>Error</p>";
                        unset($_SESSION['codigoservidor']);
                        unset($_SESSION['cont']);
                        unset($_SESSION['accessresetpassword']);
                        unset($_SESSION['email']);
                    }
                }else{
                    echo "<p class='alert alert-danger'>Error email no valido</p>";
                    unset($_SESSION['codigoservidor']);
                    unset($_SESSION['cont']);
                    unset($_SESSION['accessresetpassword']);
                    unset($_SESSION['email']);
                }
            }

        }else{
            echo "<p class='alert alert-danger'> Faltan campos a completar </p>";
        }


    }




    if (isset($_SESSION['codigoservidor'])) { 

        ?>
        <input type="text" name="codigoemail" id="codigoemail" placeholder="Ingrese su codigo ">
            <input type="submit" name="codenv" id="codenv" value="Enviar">
        
        <?php 
        }?>


<?php 
if(isset($_POST['codenv'])){
    if($_SESSION['codigoservidor'] != null && $_POST['codigoemail'] != null){

        if($_SESSION['codigoservidor'] == $_POST['codigoemail']){

                $_SESSION['accessresetpassword'] = true;

        }else{
            $_SESSION['cont'] = $_SESSION['cont'] - 1;
            echo "<p class='alert alert-danger'>Codigo erroneo, quedan ".$_SESSION['cont']." intentos</p>";
            if($_SESSION['cont'] <= 0){
                unset($_SESSION['codigoservidor']);
                unset($_SESSION['cont']); 
                unset($_SESSION['email']);
                unset($_SESSION['accessresetpassword']);
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
            unset($_SESSION['codigoservidor']);
            unset($_SESSION['cont']); 
            unset($_SESSION['accessresetpassword']);
            unset($_SESSION['email']);
            ?>
       <script>
           location.reload();
       </script>
       <?php
        }
    }
}




if(isset($_SESSION['accessresetpassword'])){
    if($_SESSION['accessresetpassword'] == true){

        unset($_SESSION['codigoservidor']);
        unset($_SESSION['cont']); 

        ?>
        <script>
  $("#codigoemail").css("display", "none");
  $("#codenv").css("display", "none");
        </script>
        <?php

?>

<input type="text" name="newpassword" id="newpassword" placeholder="Ingrese su Nuevo password ">
    <input type="submit" name="newenv" id="newenv" value="Enviar">

<?php 
?>


<?php 
}else{
    unset($_SESSION['codigoservidor']);
    unset($_SESSION['cont']); 
    unset($_SESSION['accessresetpassword']);
    unset($_SESSION['email']);
}
}


if(isset($_POST['newenv']) && isset($_SESSION['accessresetpassword']) ){

    if($_POST['newpassword'] != null && $_SESSION['accessresetpassword'] == true ){

        $password = $_POST['newpassword'];

        if(strlen($password)<8){
            echo "<p class='alert alert-danger'>La contraseña no puede tener menos de 8 caracteres</p>";
        }
        elseif(preg_match('/[^a-zA-Z\d]/', $password)==0 || preg_match('/\d/', $password)==0 || preg_match('/[A-Z]/', $password)==0 || preg_match('/[a-z]/', $password)==0){
            echo "<p class='alert alert-danger'>"."La contraseña debe de tener al menos 1 caracter especial, 1 mayuscula, 1 minuscula y 1 caracter especial"."</p>";
        }else{
           
            $data = array(
                'accion' => 'resetpasswordfinal',
                'data' => 
                array('user' => $_SESSION['email'],
                'password' => $password
                )
            );
         
         
            $result = conectarserver($data);
            if($result != false){
                if($result != null){
                    echo "<p class='alert alert-success'>Se a cambiado su password</p>";
                    unset($_SESSION['codigoservidor']);
                    unset($_SESSION['cont']);
                    unset($_SESSION['email']);
                    unset($_SESSION['accessresetpassword']);
                }else{
                    echo "<p class='alert alert-danger'>Error desconocido</p>";
                }
           


        }else{
            echo "<p class='alert alert-danger'>Error desconocido</p>";
        }




        }
    } else{
        echo "<p class='alert alert-danger'> Faltan campos a completar </p>";
    }   

}








?>



<script src="funciones/postreset.js"></script>
