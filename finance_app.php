<?php
session_start();
if(!isset($_SESSION["email"]) || $_SESSION["loggedin"] != 3){
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

$res = check_finance($id);
if(empty($res)){
    redirect("?em=Forbidden!!!","");
}
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
        <title>Finance Manager dashboad</title>
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
                    <h3 class="newapp"><?= $res[0]["purpose"].' from '.get_name($res[0]["who"]) ?></h3>
                    <div class="app">
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
                
                <td class="right">RM 
                    <?= $res[0]["ticket_cost"] ?>
                </td>
            </tr>
            
                <tr>
                <td>
                    Cost of Airport Cab at home city : 
                </td>
                
                <td class="right">RM 
                    <?= $res[0]["here_cab"] ?>
                </td>
            </tr>
            
            
               <tr>
                <td>
                    Cost of Airport Cab at destination city : 
                </td>
                
                <td class="right">RM 
                    <?= $res[0]["there_cab"] ?>
                </td>
            </tr>
            
            
            
               <tr>
                <td>
                    Hotel Cost : 
                </td>
                
                <td class="right">RM 
                    <?= $res[0]["hotel_cost"] ?>
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
            
            <?php $info = get_info($id); if(!empty($info)): ?>
                 <tr>
                <td>
                    More Info : 
                </td>
                
                <td class="right">
                    <?= $info[0]["info"] ?>
                </td>
            </tr>
            <?php endif; ?>

            <?php $receipts = get_rec($id); if(!empty($receipts)): ?>
                 <tr>
                <td>
                    Receipts : 
                </td>
                
                <td class="right">
                    <ul>
                          <?php foreach ($receipts as $r){
                                echo '<li><a href="'.$r["path"].'" target="_blank">'.$r["desc_"].'</a></li>';
                            } ?>                       
                    </ul>
                </td>
            </tr>
            <?php endif; ?>
            
            <?php if(check_response($id)): ?>
                <tr>
                <td>
                    Finance Response : 
                </td>
                
                <td class="right red">
                    <?= get_response($id) ?>
                </td>
            </tr>
            <?php endif; ?>
                <tr>
                <td>
                    Respond : 
                </td>
                
                <td>
                    <form name="fchange" action="scripts/save.php" method="post" onsubmit="return confirm('Are you sure?')">
                        <input type="hidden" value="<?= $res[0]["t_id"] ?>" name="for" />
                        </br>
                         <div class="form-group"> 
                        <select class="form-control" name="status">
                        <?php
                            $sql = "SELECT * from status where status_id > 2 and status_id != 6;";
                            $status = fetch($sql);
                            foreach($status as $st){
                                echo '<option value="'.$st["status_id"].'">'.$st["status_name"].'</option>';
                            }
                        ?>
                        </select>
                         </div>
                        </br>
                        <input type="submit" class="btn btn-warning btn-block active" value="Update Status" name="fchange" />
                        </br>
                     </form>
                </td>
            </tr>
        </table></div>
                </div>
         
                </div>
            </div>
             </div>
       
    </body>
</html>
