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
    </head>
    <body>
        <?php
         $root = realpath(filter_input(INPUT_SERVER,"DOCUMENT_ROOT"));
         include $root."/soccermail/mysql/connect.php";
         include $root."/soccermail/module/segud.php";
         $connect = new Connect();
         $conn = $connect->conn("soccermail");
         $segud = new Segud();
         if($conn!=false){
         if($segud->exists("user_id","97112514426","profile",$conn)){
             echo "el usuario existe";
         }else{
            echo "el usuario no existe"; 
         }
         }
         
        ?>
    </body>
</html>
