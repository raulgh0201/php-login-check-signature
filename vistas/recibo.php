<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anular Recibo</title>
    <link rel="stylesheet" href="main-recibo.css">
</head>
<body>

    <div class="general">
        <form class="login "action="./index.php" method="POST">  

            <?php  
                if(!isset($_SESSION['user'])){
                    session_start();
                    $_SESSION["login"] = "No estás logueado";
                    header('location: ../index.php');            
                }   
            ?>

            <?php       
                if (isset($checkSignature) && $checkSignature){
                    sleep(2);
            ?>      
                    <div class="border_bottom">
                        <h2 class="login">Recibo anulado correctamente</h2>                
                    </div>
                    <div id='signature'>
                        <img width=20%; height=20%; src="includes/img/tick.png">                 
                    </div>
                
                    
            <?php                
                header("refresh:5;url=includes/logout.php");
                }else{
            ?>
                    <div class="border_bottom">
                        <h2 class="login">Bienvenido <?php echo $user->getUsername(); ?> </h2> 
                    </div>
                    <div id="anularecibo">
                        <h3>Anula el recibo</h3>
                    </div>       
                    <p><input type="text" name="signature"  placeholder="Introduce tu firma digital"></p>
                    <p><input type="submit" value="Anular"></p>     
            

                    <div id="cs">

                        <a href="includes/logout.php">Cerrar sesión</a>
 
                    </div>
            <?php             
                    if(isset($errorFirma)){
                    echo   "<div id='errorid'>
                                <p class='error'> $errorFirma </p> 
                            </div>";
                       
                        $errorFirma = null;                      
                    }
    
                }            
            ?>       
        </form>
    </div>
</body>
</html>


