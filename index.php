<?php
        session_start();
        if(isset($_SESSION["email"])){
            header("Location: scripts/logout.php");
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
        <meta charset="UTF-8">
        <title></title>
          <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script language="javascript" type="text/javascript">
setTimeout(function(){
    fade(document.getElementById('alert'));
}, 5000);

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
            
        <div class="container loginForm">
            <div class="loginheader">
              <img alt="Brand" src="img/tp.png" class="d-inline-block align-top">
            </div>
      
            <div class="loginparent">
                <div class="bg-image"></div>
                <div class="login">
                     <form name="login" action="scripts/confirm_login.php" method="post">
                   <div class="form-group">
                       <label for="usr"> <h4><span class="glyphicon glyphicon-user" aria-hidden="true"> </span> Email :</h4></label>
                        <input type="email" class="form-control" id="usr" placeholder="Email" name="email" required="required"/>
                  </div>
                  <div class="form-group">
                        <label for="pwd"><h4><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span> Password :</h4></label>
                        <input type="password" class="form-control" class="form-control" id="pwd" placeholder="Password" name="password" required="required"/>
                  </div>   <br>  
                         <input type="submit" value="Login" class="btn btn-warning btn-block active" name="login" /></br></br>
            
            <?php if(isset($_GET["em"])): ?>
                         <div id="alert" class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?= $_GET["em"] ?>
            </div>
            <?php endif; ?>
                </div>
            </div>
        </form>
        </div>
    </body>
</html>
