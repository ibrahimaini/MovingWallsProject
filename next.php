<?php
session_start();
        // put your code here
if(!isset($_SESSION["email"]) || $_SESSION["loggedin"] != 1){
            header("Location: scripts/logout.php");
            }
            
include ("scripts/functions.inc");
$me = $_SESSION["email"];
$sql = "SELECT * FROM `travel_plans` where status_id = '1' and who = '$me' order by t_id desc;";
$drafts = fetch($sql);

$sql = "SELECT * FROM `travel_plans` where status_id != '1' and who = '$me';";
$uploads = fetch($sql);
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
        <title></title>
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

function underline(element){
    element.className = 'make-link dropdown-toggle underline';
}

function deunderline(element){
    element.className = 'make-link dropdown-toggle deunderline';
}

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
                <div id="content" class="content">
                    
                    
                    
                    
                    
                    <div class="next">
                        <h4>Select Manager : </h4>
                       <form onsubmit="return confirm('Are you sure you want to Submit?')" name="save" action="scripts/save.php" method="post"> 
       
                        <div class="form-group">  
                           <select class="form-control" name="managers">
                  <?php              
                  $sql = "SELECT email, name from staffs where role_id = '2';";
                  $res = fetch($sql);
                  foreach ($res as $r){
                      echo '<option value="'.$r["email"].'">'.$r["name"].'</option>';
                  }
                    ?>                
                         </select>
                        </div>
            <input type="submit" class="btn btn-warning btn-block active" name="save" value="Done" />
         </form> 
                    </div>
                            
                    
                    
                    
                    
                    
                    
                </div>
                
                
                <div>
                    </br>
                    <div class="dropdown" id="opt">
                        <button class="make-link dropdown-toggle" onmouseout="deunderline(this)" onmouseover="underline(this)" id="opt" type="button" id="menu1" data-toggle="dropdown">my drafts
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                             <?php if(empty($drafts)){echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='#'>empty</a></li>";} else {
                                    foreach($drafts as $r){
                                        echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="draft.php?tid='.$r["t_id"].'">'.$r["purpose"].'</a></li>';
                                }
                            } ?>
                    </ul>
                  </div>
                    
                    <div class="dropdown" id="opt">
                        <button class="make-link dropdown-toggle" onmouseout="deunderline(this)" onmouseover="underline(this)" id="opt" type="button" id="menu1" data-toggle="dropdown">upload receipts
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                             <?php if(empty($uploads)){echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='#'>empty</a></li>";} else {
                                    foreach($uploads as $r){
                                        echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="upload.php?tid='.$r["t_id"].'">'.$r["purpose"].'</a></li>';
                                    }
                                } ?>
                        </ul>
                      </div>

                    <ul id="options">
                        <li><a href="#new_travel">new application</a></li>              
                        <li><a href="#status">application status</a></li>
                    </ul>
              
                </div>
                </div>
             </div>
       
    </body>
</html>
