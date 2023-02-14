<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
</head>
<body>   
            
    <div class="general">  
        <form class="login" action="" method="POST">             
            <div class="border_bottom" > 
                <div id="cliente">
                    <h2 class="login">Acceso clientes</h2>
                </div>                
                <img src="includes/img/icono.jpg" width="20%" height="20%" alt="">
                <p>Particulares</p> 
            </div>                      
            <p><input type="text" name="username" placeholder="Usuario"></p>
            <p><input type="password" name="password" placeholder="Clave de acceso"></p>
            <p><input type="submit" value="Entrar" ></p>
            <div id="errorid">
                <?php

                    if(isset($errorLogin)){
                        echo  "<p class='error'> $errorLogin </p>";
                        
                    }

                    if(isset($_SESSION["login"] )){
                        echo  "<p class='error'>"  .$_SESSION['login']. "</p>";
                        $_SESSION["login"] = null;
                    }

                ?> 
            </div>                    
        </form>
    </div>  
</body>
</html>
