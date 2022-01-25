<?php

include '../../funcionesg/db_conn.php';
include '../../funcionesg/sesion.php';


if(isset($_POST['ingresar'])){
    if($_POST['monto'] != null){
        
if($_POST['montowallet'] > 0){
    if($_POST['monto'] > 0){
        $monto = $_POST['monto'];
       $montobilletera = $_POST['montowallet'];
        
        
       if(preg_match('/[a-z]/', $monto)==0 ||  preg_match('/[A-Z]/', $monto==0)){
            if($montobilletera >= $monto){

                $data = array(
                    'accion' => 'ingresartokens',
                    'data' => 
                    array('user' => $_SESSION['user_email'],
                    )
                );
                $result = conectarserver($data);

                if($result != false){
                    if($result != null){
                        echo "<p class='alert alert-success'>Se a enviado un codigo a su Email</p>";
                        $_SESSION['codigomon2'] = $result;
                        $_SESSION['monto2'] = $monto;
                        $_SESSION['cont2']=3;
                    }else{
                        echo "<p class='alert alert-danger'>Error</p>";
                        unset($_SESSION['codigomon2']);
                        unset($_SESSION['monto2']);
                        unset($_SESSION['cont2']);
                    }
                }else{
                    echo "<p class='alert alert-danger'>Error monto no valido</p>";
                    unset($_SESSION['codigomon2']);
                    unset($_SESSION['monto2']);
                    unset($_SESSION['cont2']);
                }
            }else{
                echo "<p class='alert alert-danger'>El monto de tokens ingresado no puede ser mayor a la cantidad de tokens en tu billetera</p>";
                unset($_SESSION['codigomon2']);
                unset($_SESSION['monto2']);
                unset($_SESSION['cont2']);
            }
    }else{
        echo "<p class='alert alert-danger'>No valido</p>";
        unset($_SESSION['codigomon2']);
        unset($_SESSION['monto2']);
        unset($_SESSION['cont2']);
    }
}else{
    echo "<p class='alert alert-danger'>Valor ingresado no valido</p>";
    unset($_SESSION['codigomon2']);
    unset($_SESSION['monto2']);
    unset($_SESSION['cont2']);
}
}else{
    echo "<p class='alert alert-danger'>No tiene fondos suficientes</p>";
    unset($_SESSION['codigomon2']);
    unset($_SESSION['monto2']);
    unset($_SESSION['cont2']);
}
        

    }else{
        echo "<p class='alert alert-danger'>Faltan campos a completar</p>";
    }
}



    
?>

<?php 
//aqui se recibe el codigo ingresado por el usuario
if (isset($_SESSION['codigomon2'])) { 

?>
<input type="text" name="codigomonto2" id="codigomonto2" placeholder="Ingrese su codigo ">
    <input type="submit" name="codenvmonto2" class="btn btn-primary" id="codenvmonto2" value="Enviar">

<?php 
}?>

<?php 
if(isset($_POST['codenvmonto2'])){
    if($_SESSION['codigomon2'] != null && $_POST['codigomonto2'] != null){

        if($_SESSION['codigomon2'] == $_POST['codigomonto2']){
            

?>

<script>
async function asyncCall(){

  const cantidad = <?php echo $_SESSION['monto2']; ?>;
  const wallet = await window.solana.connect()
  const connection = new solanaWeb3.Connection("https://api.devnet.solana.com") //Esta podria ser una variable global
  const programToken=new solanaWeb3.PublicKey("TokenkegQfeZyiNwAJbNbGKPFXCWuBvf9Ss623VQ5DA")
  const tokenid = new solanaWeb3.PublicKey("J3cNN8LqrgXwti2MEgm2jwiY1NFBvsdsSGiFyVUB6gi7")
  const acc=await connection.getParsedProgramAccounts(programToken,{
    filters: [{dataSize: 165,},{memcmp:{offset:32,bytes: wallet.publicKey.toString(),},},],});
  var Orig = 0
  for(var i=0;i<acc.length;i++){
      if(acc[i].account.data.parsed.info.mint  === tokenid.toString()){
        Orig = acc[i].pubkey
      }
  }
  if(typeof Orig === 'object'){
    const transaction = new solanaWeb3.Transaction()
    const Dest = new solanaWeb3.PublicKey("2BN4GxbBGcNiPWvSDtvWw7jFk4XV7LVFHY4PETUyWrGg") //Esta es la direccion de la cuenta de token del destino, no el token ni la direccion principal
    const instruction = new solanaWeb3.TransactionInstruction(
    splToken.Token.createTransferInstruction(programToken,Orig,Dest,wallet.publicKey,[],cantidad*1e9))
    transaction.add(instruction)
    transaction.recentBlockhash= (await connection.getRecentBlockhash()).blockhash
    transaction.feePayer = wallet.publicKey
    const signedTransaction = await window.solana.signTransaction(transaction)
    const signature = await connection.sendRawTransaction(signedTransaction.serialize())
    console.log(signature);
    alert("Trasaccion enviada satisfactoriamente");
    
    $(document).ready(function(){
    //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
    setTimeout(refrescar, 4000);
  });
       function refrescar(){
    //Actualiza la página
    location.reload();
  }

  }
  else{
    console.log("No se encontro cuenta de token")
    alert("Error desconocido");
  }
}

asyncCall()

            


  
  
</script>

<?php


unset($_SESSION['codigomon2']);
unset($_SESSION['monto2']);
unset($_SESSION['cont2']);

?>

<?php
        
        }else{
            $_SESSION['cont2'] = $_SESSION['cont2'] - 1;
            echo "<p class='alert alert-danger'>Codigo erroneo, quedan ".$_SESSION['cont2']." intentos</p>";
            if($_SESSION['cont2'] <= 0){
                unset($_SESSION['codigomon2']);
                unset($_SESSION['monto2']);
                unset($_SESSION['cont2']); 
                ?>
                 <script>
                     location.reload();
                </script>
           <?php
            }

        }


    }else{
        $_SESSION['cont2'] = $_SESSION['cont2'] - 1;
        echo "<p class='alert alert-danger'>Codigo erroneo, quedan ".$_SESSION['cont2']." intentos</p>";
        if($_SESSION['cont2'] <= 0){
            unset($_SESSION['codigomon2']);
            unset($_SESSION['monto2']);
            unset($_SESSION['cont2']); 
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