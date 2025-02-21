<?php 

$status = session_status();
if($status == PHP_SESSION_NONE){
    //There is no active session
    //              servidor , usuario, senha, nome do banco de dado
    session_start();
    $con=  mysqli_connect("127.0.0.1:3306","u729741782_siscramAdmin","SiscramSistem2@23","u729741782_siscram");
   
}
else if($status == PHP_SESSION_ACTIVE){
    //Destroy current and start new one
   
    $con=  mysqli_connect("127.0.0.1:3306","u729741782_siscramAdmin","SiscramSistem2@23","u729741782_siscram");
}

?>