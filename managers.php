<?php
session_start();
        // put your code here
if(!isset($_SESSION["email"])  || $_SESSION["loggedin"] != 2){
            header("Location: scripts/logout.php");
            }
            
include ("scripts/functions.inc");
$me = $_SESSION["email"];
$sql = "SELECT * FROM `travel_plans` where status_id != '1' and manager = '$me';";
$res = fetch($sql);
        ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="windows-1252">
        <title>Manager dashboad</title>
          <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript">
       
setTimeout(function(){
    fade(document.getElementById('message'));
}, 2000);


  $(function(){
        $("#options a").click(function(){
            var page = this.hash.substr(1);
            $.get(page+".php",function(html_){
                $("#content").html(html_);
            });return false;
            
        });
    });


function fade(element) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            element.style.display = 'none';
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 50);
}
</script>
    </head>
    <body>
        <div class="header">
         <img alt="Brand" src="img/tp.png" class="d-inline-block align-top" alt="">

        <a href="scripts/logout.php"> <span class="glyphicon glyphicon-log-out" aria-hidden logout="true" style="font-size: 40px;  color: white;" id="logo"> </span></a>
        </div>
         <div class="container">
      
           <div class="col-lg-12">
           <div class="parent">
                <div class="bg-image"></div>
                <?php if(isset($_GET["em"])): ?>
                <div class="message" id="message">
                    <div class="alert alert-danger" id="alert" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <?= $_GET["em"] ?>
                    </div>
                </div>
                <?php elseif(isset($_GET["sm"])): ?>
                 <div class="message" id="message">
                    <div class="alert alert-success" id="alert" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <?= $_GET["sm"] ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <div id="content" class="content man">
                    </br></br>
                    <h3>Applications</h3>
                    <ul>
            <?php if(empty($res)){echo "Folder is empty!!!";} else {
                foreach($res as $r){
                    echo '<li><a href="application.php?tid='.$r["t_id"].'">'.$r["purpose"].' from '.get_name($r["who"]).'</a></li>';
                }
            } ?>
        </ul>
                </div>
         
                </div>
           </div>
             </div>
       
    </body>
</html>
