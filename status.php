<?php
session_start();
if(!isset($_SESSION["email"])){
            header("Location: scripts/logout.php");
            }
include ("scripts/functions.inc");
$me = $_SESSION["email"];
$sql = "SELECT * FROM travel_plans t, mode m, status s where t.status_id = s.status_id "
        . "and t.status_id != '1' and m.mode_id = t.mode_id and t.who = '$me'";
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
        <title></title>
          <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/custom.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    </head>
    <body> 

          
        <div class="table-display3">    
        <table>            
            <tr class="title">
                <td>Application ID </td>
                <td>Purpose </td>
                <td>Start Date </td>
                <td>End Date </td>
                <td>Mode </td>
                <td>Ticket Cost </td>
                <td>Cost of Airport Cab at home city</td>
                <td>Cost of Airport Cab at destination city</td>
                <td>Hotel Cost</td>
                <td>Local conveyance at tour Location</td>
                <td>Manager in charge</td>
                <td>Status</td>
            </tr>
            <?php foreach($res as $re){ ?>
            <tr>
                <td class="status"><?= $re["t_id"] ?>.</td>
                <td><?= $re["purpose"] ?></td>
                <td><?= $re["s_date"] ?></td>
                <td><?= $re["e_date"] ?></td>
                <td><?= $re["mode_name"] ?> </td>
                <td><?= $re["ticket_cost"] ?> </td>
                <td><?= $re["here_cab"] ?></td>
                <td><?= $re["there_cab"] ?></td>
                <td><?= $re["hotel_cost"] ?></td>
                <td><?= $re["local_conveyance"] ?></td>
                <td><?= get_name($re["manager"]).' ('.$re["manager"].')' ?></td>
                <?php if($re["status_id"] == 5): ?>
                <td class="underline"><a href="more_info.php?tid=<?= $re["t_id"] ?>"><?= $re["status_name"] ?></a></td>               
                <?php else: ?>
                <td class="status"><?php echo $re["status_id"]==6?'Submitted':$re["status_name"] ?></td>
                <?php endif; ?>
            </tr>
                
            <?php }   ?>
        </table>
               </div>
               
    </body>
</html>
