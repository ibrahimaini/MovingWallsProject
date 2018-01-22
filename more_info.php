<?php
session_start();
if(!isset($_SESSION["email"]) || $_SESSION["loggedin"] != 1){
            header("Location: scripts/logout.php");
            }
include ("scripts/functions.inc");

if(!isset($_GET["tid"])){
    redirect("?em=Forbidden!!!","");
}

$me = $_SESSION["email"];
$id = $_GET["tid"];

if(!is_numeric($id)){
    redirect("?em=Forbidden!!!","");
}

$res = check_info($id,$me);
if(empty($res)){
    redirect("?em=Forbidden!!!","");
}

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
         <img alt="Brand" src="img/travel_portal.png" class="d-inline-block align-top" alt="">

        <a href="scripts/logout.php"> <span class="glyphicon glyphicon-log-out" aria-hidden logout="true" style="font-size: 40px;  color: white;" id="logo"> </span></a>
        </div>
         <div class="container">
      
            <div class="parent taller_medium">
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
                    <h4 class="newapp">Upload</h4>
                
                    <div class="upload">
                        <table>
            <tr>
                <td>
                    Application ID : 
                </td>
                
                <td class="right">
                    <?= $res[0]["t_id"] ?>
                </td>
            </tr>
            
             <tr>
                <td>
                    By : 
                </td>
                
                <td class="right">
                    <?= get_name($res[0]["who"]).' ('.$res[0]["who"].')' ?>
                </td>
            </tr>
            
            
              <tr>
                <td>
                    Purpose : 
                </td>
                
                <td class="right">
                    <?= $res[0]["purpose"] ?>
                </td>
            </tr>
            
                <tr>
                <td>
                    Start Date : 
                </td>
                
                <td class="right">
                    <?= $res[0]["s_date"] ?>
                </td>
            </tr>
            
                <tr>
                <td>
                    End Date : 
                </td>
                
                <td class="right">
                    <?= $res[0]["e_date"] ?>
                </td>
            </tr>
            
                <tr>
                <td>
                    Mode : 
                </td>
                
                <td class="right">
                    <?= $res[0]["mode_name"] ?>
                </td>
            </tr>
            
            
                <tr>
                <td>
                    Ticket Cost : 
                </td>
                
                <td class="right">
                    RM  <?= $res[0]["ticket_cost"] ?>
                </td>
            </tr>
            
                <tr>
                <td>
                    Cost of Airport Cab at home city : 
                </td>
                
                <td class="right">
                    RM  <?= $res[0]["here_cab"] ?>
                </td>
            </tr>
            
            
               <tr>
                <td>
                    Cost of Airport Cab at destination city : 
                </td>
                
                <td class="right">
                    RM  <?= $res[0]["there_cab"] ?>
                </td>
            </tr>
            
            
            
               <tr>
                <td>
                    Hotel Cost : 
                </td>
                
                <td class="right">
                    RM <?= $res[0]["hotel_cost"] ?>
                </td>
            </tr>
            
            
               <tr>
                <td>
                    Local Conveyance at tour location : 
                </td>
                
                <td class="right">
                    <?= $res[0]["local_conveyance"] ?>
                </td>
            </tr>
            
            
               <tr>
                <td>
                    Application Status : 
                </td>
                
                <td class="right">
                    <?= $res[0]["status_name"] ?>
                </td>
            </tr>
            
                <tr>
                <td>
                    More Info : 
                </td>
                
                <td>
                    <form name="mi" action="scripts/save.php" method="post" >
                        <input type="hidden" value="<?= $res[0]["t_id"] ?>" name="tid" />
                        </br>
                        <textarea name="info" class="form-control" rows="3" maxlength="1000" required="required"></textarea>
                        </br>
                        <input type="submit"  class="btn btn-warning btn-block active" name="mi" value="Submit" /></br>
                    </form>
                   
                </td>
            </tr>
          
               <tr>
                <td>
                    Upload Receipts/Bills : 
                </td>
                
                <td class="right">
                    </br>
                    <form name="upload" action="scripts/save.php" method="post" enctype="multipart/form-data" >
                        <input type="hidden" value="<?= $res[0]["t_id"] ?>" name="tid" />
                        
                          
              <div class="form-group"> 
            <input type="text" class="form-control" maxlength="60" name="brief_desc" placeholder="Brief description" required="required"/>
              </div>
                       
                        <input type="file"  class="form-control" name="thumb" required="required"/> </br>
                        <input type="submit" class="btn btn-warning btn-block active" name="upload" value="Upload" />
                         </br>
                    </form>
                   
                </td>
            </tr>
                
        </table>
                    </div>
                    
                </div>
                
                
                <div>
                    </br>
                    <div class="dropdown" id="opt">
                        <button class="make-link dropdown-toggle" id="opt"  onmouseout="deunderline(this)" onmouseover="underline(this)" type="button" id="menu1" data-toggle="dropdown">my drafts
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
                        <button class="make-link dropdown-toggle" id="opt"  onmouseout="deunderline(this)" onmouseover="underline(this)" type="button" id="menu1" data-toggle="dropdown">upload receipts
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
