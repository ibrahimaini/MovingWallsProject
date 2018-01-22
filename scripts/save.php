<?php
session_start();
include 'functions.inc';
include 'connect.php';


if(!isset($_SESSION["email"])){
    header("Location: logout.php");
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


	$imagetmp="";
	$imagetype="";
	$imagecon="";
	$imagety="";
        

if(isset($_POST["go"])){
    $email = $_SESSION["email"];
    $purpose = mysqli_real_escape_string($con,$_POST["purpose"]);
    $sd = mysqli_real_escape_string($con,$_POST["sd"]);
    $ed = mysqli_real_escape_string($con,$_POST["ed"]);
    $mod_id = mysqli_real_escape_string($con,$_POST["mode"]);    
    $tc = mysqli_real_escape_string($con,$_POST["tc"]);
    $hc = mysqli_real_escape_string($con,$_POST["hc"]);    
    $dc = mysqli_real_escape_string($con,$_POST["dc"]);
    $hoc = mysqli_real_escape_string($con,$_POST["hoc"]);
    $convey = mysqli_real_escape_string($con,$_POST["convey"]);
    
    
    $sql = "INSERT INTO `travel_plans` (`t_id`, `who`, `purpose`, `s_date`, `e_date`, `mode_id`, `ticket_cost`, `here_cab`, `there_cab`, `hotel_cost`, `local_conveyance`, `status_id`, `manager`) "
            . "VALUES (NULL, '$email', '$purpose', '$sd', '$ed', '$mod_id', '$tc', '$hc', '$dc', '$hoc', '$convey', '1', '');";
    //die($sql);
    $last = insert_n_return($sql);
    if($last>0){
        $_SESSION["last"] = $last;
        header("Location: ../next.php");
    }else {
        redirect("?em=".urldecode("Something went wrong!!!"), "../");
    }
    
    
    
    
}elseif(isset($_POST["save"])){
    $manager = $_POST["managers"];
    if(!isset($_SESSION["last"])){
       redirect("?em=".urlencode("Something went wrong!!!"), "../");  
    }
    
    $id = $_SESSION["last"];     
    $sql = "UPDATE `travel_plans` SET `status_id` = '2', `manager` = '$manager' WHERE `travel_plans`.`t_id` = '$id';";
    if(insert($sql)){
        unset($_SESSION["last"]);
        redirect("?sm=".urlencode("Submission Successful!!!"), "../");
    }else {
        redirect("?em=".urlencode("Something went wrong!!!"), "../");
    }
    
    
    
    
    
    
}else if(isset($_POST["go_draft"])){
    $email = $_SESSION["email"];
    $purpose = mysqli_real_escape_string($con,$_POST["purpose"]);
    $sd = mysqli_real_escape_string($con,$_POST["sd"]);
    $ed = mysqli_real_escape_string($con,$_POST["ed"]);
    $mod_id = mysqli_real_escape_string($con,$_POST["mode"]);    
    $tc = mysqli_real_escape_string($con,$_POST["tc"]);
    $hc = mysqli_real_escape_string($con,$_POST["hc"]);    
    $dc = mysqli_real_escape_string($con,$_POST["dc"]);
    $hoc = mysqli_real_escape_string($con,$_POST["hoc"]);
    $convey = mysqli_real_escape_string($con,$_POST["convey"]);
    $tid = mysqli_real_escape_string($con,$_POST["tid"]);
    
    
    $sql = "UPDATE `travel_plans` SET "
            . "`purpose` = '$purpose', `s_date` = '$sd', `e_date` = '$ed', `mode_id` = '$mod_id',"
            . " `ticket_cost` = '$tc', `here_cab` = '$hc', `there_cab` = '$dc', `hotel_cost` = '$hoc',"
            . " `local_conveyance` = '$convey' WHERE `travel_plans`.`t_id` = '$tid';";
    
    if(insert($sql)){
        $_SESSION["last"] = $tid;
        header("Location: ../next.php");
    }else {
        redirect("?em=".urldecode("Something went wrong!!!"), "../");
    }
}





else if(isset($_POST["change"])){
    $status = mysqli_real_escape_string($con,$_POST["status"]);
    $tid = mysqli_real_escape_string($con,$_POST["for"]);
    
    
    $sql1 = "UPDATE `travel_plans` SET `status_id` = '$status' WHERE `travel_plans`.`t_id` = '$tid';";
    insert($sql);
    $checker = false;
    if ($status == 3) {
        $sql_ = "INSERT INTO `f_managers` (`t_id`, `status_id`) VALUES ('$tid', '3');";
       $checker = insert($sql_);
       if(!$checker){
        $sql = "UPDATE `f_managers` SET `status_id` = '$status' WHERE `t_id` = '$tid';";
        $checker = insert($sql);
       }
    }

    if(insert($sql1)){
        redirect("?sm=".urldecode("Status Changed!!!"), "../");
    }else {
        redirect("?em=".urldecode("Something went wrong!!!"), "../");
    }
}


else if(isset($_POST["fchange"])){
    $status = mysqli_real_escape_string($con,$_POST["status"]);
    $tid = mysqli_real_escape_string($con,$_POST["for"]);
    
    
   $sql = "INSERT INTO `f_responses` (`t_id`, `status_id`) VALUES ('$tid', '$status');";
   if(!insert($sql)){
       $sql = "UPDATE f_responses SET `status_id` = '$status' WHERE `t_id` = '$tid';";
       insert($sql);
   }
    $sql_ = "UPDATE f_managers SET `status_id` = '$status' WHERE `t_id` = '$tid';";
    
    if(insert($sql_)){
        redirect("?sm=".urldecode("Status Changed!!!"), "../");
    }else {
        redirect("?em=".urldecode("Something went wrong!!!"), "../");
    }
}
else if(isset($_POST["mi"])){
    $tid = mysqli_real_escape_string($con,$_POST["tid"]);
    $info = mysqli_real_escape_string($con,$_POST["info"]);
    
    
    $sql = "INSERT INTO `more_info` (`t_id`, `info`) VALUES ('$tid', '$info');";
    
    if(insert($sql)){
        redirect("?sm=".urldecode("More Info submitted!!!"), "../");
    }else {
        redirect("?em=".urldecode("Something went wrong!!!"), "../");
    }
} 



elseif(isset($_POST["upload"])){
     if(isset($_FILES['thumb']) && checkIfImage($_FILES["thumb"]["name"])) {	
       
          if($_FILES["thumb"]["size"] > 3000000 ) { //3 MB
        // File too big
	redirect("?em=".urldecode("Image file selected too large!!!"), "../");				
			} 
           else {   
                                $imagename=$_FILES["thumb"]["name"];
				$target_dir='receipts/';
				$imagepath = $target_dir.basename($imagename);
				$imagety=$_FILES["thumb"]["type"];
				
		if(checkIfImageExist($imagepath)){
					//continue
                if (!move_uploaded_file($_FILES["thumb"]["tmp_name"], '../' . $imagepath)) {
                  redirect("?em=".urldecode("Error Uploading Image file..."), "../");
                }
                //already uploaded
                     $tid = mysqli_real_escape_string($con, $_POST["tid"]);  
                      $desc = mysqli_real_escape_string($con, $_POST["brief_desc"]);  
                     $sql = "INSERT INTO `uploads` (`t_id`, `path`, `desc_`) VALUES ('$tid', '$imagepath', '$desc');";                     
                     if (insert($sql)) {
                    redirect("?sm=".urldecode("Uploaded..."), "../");
                } else {
                    redirect("?em=".urldecode("Error Uploading Image file, please try again..."), "../");
                }
            }	else {
                     redirect("?em=".urldecode("Image file already exist, please rename image and try again..."), "../");
			}
           }
    
   }else {redirect("?em=".urldecode("Invalid image file!!!"), "../");}
}
else {
    header("Location: logout.php");
}