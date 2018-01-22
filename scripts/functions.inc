<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function redirect($msg,$dir){
   // $msg = urlencode($ms);
 
     if ($_SESSION["loggedin"] == 1) {
            header("Location: ".$dir."staffs.php".$msg);
        } else if ($_SESSION["loggedin"] == 2) {
            header("Location: ".$dir."managers.php".$msg);
        } else if ($_SESSION["loggedin"] == 3) {
            header("Location: ".$dir."financial_managers.php".$msg);
        } else {
            header("Location: logout.php");
        }
    
}

function check($id,$who){
    
    $sql = "SELECT * FROM `travel_plans` where status_id = '1' and who = '$who' and manager = '' and t_id = '$id'";
    return fetch($sql);
}

function check_upload($id,$who){    
    $sql = "SELECT * FROM travel_plans t, mode m, status s where m.mode_id = t.mode_id and s.status_id = t.status_id and t.status_id != '1' and t.who = '$who' and t.t_id = '$id'";
    return fetch($sql);
}

function get_info($id){
    $sql = "SELECT * FROM `more_info` where t_id = '$id' order by t_id desc limit 1;";
    return fetch($sql);
}

function get_rec($id){
    $sql = "SELECT * FROM `uploads` where t_id = '$id' order by t_id desc;";
    return fetch($sql);
}


function check_info($id,$who){    
    $sql = "SELECT * FROM travel_plans t, mode m, status s where m.mode_id = t.mode_id and t.status_id = '5' and s.status_id = t.status_id and t.status_id != '1' and t.who = '$who' and t.t_id = '$id'";
    return fetch($sql);
}

function check_finance($id){
        $sql = "SELECT * from travel_plans t, status s, mode m,f_managers f where t.mode_id = m.mode_id and t.status_id = s.status_id and f.t_id = t.t_id and t.t_id = '$id'";
        $res = fetch($sql);
        if(empty($res)){
            return $res;
        }
        
        $sql = "SELECT * from f_managers where t_id = '$id';";
        if(empty(fetch($sql))){
            return array();
        }
        else {
            return $res;
        }
}

function get_response($id){
    $sql = "SELECT * FROM f_responses f, status s where f.status_id = s.status_id  and f.t_id = '$id';";
    $temp = fetch($sql);
    if(empty($temp)){
        return '';
    }
    return $temp[0]["status_id"]==6?'Submitted to finance':$temp[0]["status_name"];
}

function get_mresponse($id){
    $sql = "SELECT * FROM f_managers f, status s where f.status_id = s.status_id  and f.t_id = '$id';";
    //die($sql);
    $temp = fetch($sql);
    if(empty($temp)){
        return '';
    }
    return $temp[0]["status_id"]==3?'Submitted to finance':$temp[0]["status_name"];
}


function check_response($id){
    $sql = "SELECT * FROM f_managers where t_id = '$id';";
    if(empty(fetch($sql))){
        return false;
    }
    
    $sql = "SELECT * FROM f_responses where t_id = '$id';";
    if(empty(fetch($sql))){
        return false;
    }
    return true;
}

function check_mstatus($id){
    $sql = "SELECT * FROM f_managers where t_id = '$id';";
    if(empty(fetch($sql))){
        return false;
    }
    
    $sql = "SELECT * FROM f_responses where t_id = '$id';";
    if(empty(fetch($sql))){
        return true;
    }
    return false;
}

function check_fresponse($id){
    $sql = "SELECT * FROM `f_responses` where t_id = '$id';";
   // die($sql);
    return empty(fetch($sql));
}

function check_manager($id,$man){

    $sql = "SELECT * FROM travel_plans t, mode m, status s"
            . " where t_id = '$id' and manager = '$man' and s.status_id = t.status_id and m.mode_id = t.mode_id";
    return fetch($sql);
}
function fetch($sql){
	include ("connect.php");	
	$new_ress = array();			
	$ress =  $con->query($sql);
					
							$in = 0;
					while($row = $ress->fetch_assoc())
												{
													 $new_ress[$in] = $row;
													  $in++;
												}	
		
	return $new_ress;
					}
function insert($sql){
	include ("connect.php");		
	if ($con->query($sql) === TRUE) {
        global $last_id;
        mysqli_close($con);
        return true;
    } else {
        mysqli_close($con);
        return false;
    }
}

function get_name($em){
    $sql = "SELECT name from staffs where email = '$em';";
    $res = fetch($sql);
    if (!empty($res)) {
        return $res[0]["name"];
    } else {
        return 'Unknown user';
    }
}
function insert_n_return($sql){
	include ("connect.php");
        $last_id = 0;
	if ($con->query($sql) === TRUE) {
        $last_id = $con->insert_id;
    }
        mysqli_close($con);
        
        return $last_id;
}

function checkIfImage($imaName){
$ext=strtolower(substr(strrchr($imaName,"."),1));
if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
        return true;
    } else {
        return false;
    }
}

function checkIfImageExist($target_file){
    if (file_exists('../' . $target_file)) {
        return false;
    } else {
        return true;
    }
}
