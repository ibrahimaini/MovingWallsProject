<?php
session_start();
include 'functions.inc';
include 'connect.php';

if(isset($_SESSION["email"])){
    header("Location: logout.php");
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



if(isset($_POST["login"])){
    $email = mysqli_real_escape_string($con,$_POST["email"]);
    $password = hash('sha256',$_POST["password"]);
    $sql = "SELECT email, name, role_id from staffs where email = '$email' and password = '$password';";
    $res = fetch($sql);
    if(empty($res)){
        $msg = '?em='.urlencode("Invalid login credentials!!!...");
        header("Location: ../index.php".$msg);
    }
    else {
        $_SESSION["email"] = $res[0]["email"];
         $_SESSION["name"] = $res[0]["name"];
        $_SESSION["loggedin"] = $res[0]["role_id"];
        redirect("","../");
    }
}else {
    header("Location: logout.php");
}