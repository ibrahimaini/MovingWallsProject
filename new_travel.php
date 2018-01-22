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
    </head>
    <body>
    
        <p class="newapp"><h4>New Application</h4></p>
          <form name="go" method="post" action="scripts/save.php">
              <div class="form-group">
                    <input type="text" class="form-control" name="purpose" maxlength="255" placeholder="Purpose" required="required" />     
                  </div>
              <div class="labels"><p><div class="left new_trip">Start date</div><div class="right">End date</div></p></div>
          <div class="form-group">
               <input type="date" class="form-control in_line" name="sd" required="required" />     
            <input type="date" class="form-control in_line right" name="ed" required="required" />
          </div>
              
              
             <div class="form-group">
             <select class="form-control" name="mode">
                  <?php
                    include 'scripts/functions.inc';
                  $sql = "SELECT * from mode;";
                  $res = fetch($sql);
                  foreach ($res as $r){
                      echo '<option value="'.$r["mode_id"].'">'.$r["mode_name"].'</option>';
                  }
                    ?>                
            </select>           
          </div>
              
              
          <div class="form-group">
                 <input type="number" name="tc" class="form-control in_line" maxlength="10" placeholder="Ticket Cost (RM)" required="required" />
            <input type="number" name="hc" class="form-control in_line right" maxlength="10" placeholder="Home Cab Cost (RM)" required="required" />  
          </div>
             
           <div class="form-group">
            <input type="number" name="dc" class="form-control in_line" maxlength="10" placeholder="Destination Cab Cost (RM)" required="required" />           
            <input type="number" name="hoc" class="form-control in_line right" maxlength="10" placeholder="Hotel Cost (RM)" required="required" />
            </div>
              
              <div class="form-group"> 
            <input type="text" name="convey" class="form-control" maxlength="255" placeholder="Destination Local Conveyance" required="required" />
              </div>
              
             <input type="submit" class="btn btn-warning btn-block active" name="go" value="Next" />
        </form>
        
    </body>
</html>
