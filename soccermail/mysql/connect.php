<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of connect
 *
 * @author Family
 */
class Connect {
    
   function conn($name){
       /*
  $host = "localhost";
  $port = "3306";
  $user = "root";
  $pass = "";
        
        */
  $host = $_SERVER["SERVER_ADDR"];
  $port = "3306";
  $user = "staff";
  $pass = "Hardware0";
  $conn = new mysqli($host,$user,$pass,$name,$port);
 if($conn->connect_error){
  return false;
 }else{
    return $conn;
 }
 }
 
 function close($conn){
     if($conn->close()){
         return true;
         
     }else{
         return false;
     }
     
 }
     
 
}
