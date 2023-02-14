<?php

include_once 'db.php';

class User extends DB{

    private $nombre;
    private $username;
    private $pass;
    private $passs;

    public function userExists($user, $pass){
       
        //echo $md5pass,$user,$pass;
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $pass]);
        //echo ($query->rowCount());
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            //$this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];
            $this->pass = $currentUser['password'];
        }
        
        
    }

    function sendData($user, $passs, $signature){
       // echo $user, $pass, $signature;
        $data = [
            'user' => $user,
            'pass' => $passs,
            'firma' => $signature,
        ];
        $sql = "INSERT INTO informacion (username, password, signature) VALUES (:user, :pass, :firma)";
        $query = $this->connect()->prepare($sql);
        $query -> execute($data);
        
        //echo ($query->rowCount());
       
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }
   
    public function isDataSend($user){
        $query = $this->connect()->prepare('SELECT * FROM informacion WHERE username = :user');
        $query->execute(['user' => $user]);
        //echo ($query->rowCount());
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }


    public function getNombre(){
        return $this->nombre;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPass(){
        return $this->pass;
    }
    
}

?>
