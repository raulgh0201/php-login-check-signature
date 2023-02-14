<?php

include_once 'includes/user.php';
include_once 'includes/user_session.php';


$userSession = new UserSession();
$user = new User();


if(isset($_SESSION['user'])){
    //echo "Hay sesión";
    $user->setUser($userSession->getCurrentUser());
    if (isset($_POST["signature"])){
        $signature = $_POST["signature"];   
        if(comprobar_firma($signature)){   
            if (!$user->isDataSend($user->getUsername())){
                $user->sendData($user->getUsername(),$user->getPass(),$signature);    
                $checkSignature = true; 
            } else{
                $checkSignature = false;
                $errorFirma = "Ya has introducido la firma digital"; 
                echo $checkSignature;
            }      
        }else{
            $errorFirma = "Formato de firma no válido";
        }
    }       
      
    include_once 'vistas/recibo.php';
}else if(isset($_POST['username']) && isset($_POST['password'])){
    //echo "Validación de login";

    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    if($user->userExists($userForm, $passForm)){
        //echo "usuario validado";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);
        sleep(5);
        include_once 'vistas/recibo.php';
        
    }else{
        //echo "nombre de usuario y/o password incorrecto";
        //echo $userForm, $passForm;
        $errorLogin = "Nombre de usuario y/o password es incorrecto";
        include_once 'vistas/login.php';
    }

}else{
    //echo "Login";
    include_once 'vistas/login.php';
}

function comprobar_firma($firma){
    //compruebo que el tamaño del string sea válido.
    if (strlen($firma)<1 || strlen($firma)>8){
       return false;
    }
 
    //compruebo que los caracteres sean los permitidos
    $permitidos = "0123456789";
    for ($i=0; $i<strlen($firma); $i++){
       if (strpos($permitidos, substr($firma,$i,1))===false){
          return false;
       }
    }
    return true;
 }


?>