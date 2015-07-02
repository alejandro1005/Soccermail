<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author FAMILIA_2
 */
class User {
    
  function vdate($us_da,$us_mo,$us_ye,$y,$m,$d){
  if(($us_ye>1930)&&($us_ye<($y+1))){
   $ly = $us_ye % 4;
   if(($ly==0)&&($us_mo==2)&&($us_da>29)){
    echo "La feha que ingresaste no corresponde a una real."; 
    return false;
   }
   if(($ly!=0)&&($us_mo==2)&&($us_da>28)){
    echo "La feha que ingresaste no corresponde a una real."; 
    return false;
   }
   if((($us_mo==4)||($us_mo==6)||($us_mo==9)||($us_mo==11))&&($us_da==31)){
    echo "La fecha que ingresaste no corresponde a una real."; 
    return false;
   }
   if($us_ye==$y){
    if(($us_mo==$m)&&($us_da>$d)){
     echo "Por favor verifica los datos de tu fecha de nacimiento."
     ." Posiblemente la información que has ingresado no corresponde a una fecha válida aún.";
     return false;
    }
    if($us_mo>$m){
     echo "Por favor verifica los datos de tu fecha de nacimiento."
     ." Posiblemente la información que has ingresado no corresponde a una fecha válida aún.";
     return false;
    }
   }
   return true;
  }else{
   if($us_ye>$y){
    echo "$us_ye"." no es un año permitido. Por favor verifica tu fecha de nacimiento.";
    return false;
   }else{
    echo "$us_ye"." no es un año permitido. Por favor verifica tu fecha de nacimiento.";
    return false;
   }
  }
 }
 
 
  function vemail($us_em){
  if(filter_var($us_em, FILTER_VALIDATE_EMAIL)){
   return true;
  }else{
   return false;
  }
 }
 
 function vpassword($us_pa) {
  $length = strlen($us_pa); 
  $number = false;
  $letter = false;
  $cant = false;
  $n = array("0","1","2","3","4","5","6","7","8","9");
  $l = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","Ñ","O","P","Q","R","S","T","U","V","W","X","Y","Z");
  for($i=0;$i<$length;$i++){
   $char = $us_pa[$i];
   $z = 0;
   while(($z<10)&&($number==false)){
    if($char==$n[$z]){
     $number = true;  
    }else{
     $z++;   
    }
   }
   $z = 0;
   while(($z<27)&&($letter==false)){
    if($char==$l[$z]){
     $letter = true;  
    }else{
     $z++;   
    }
   }
  }
  if($length>8){
   $cant = true; 
  }else{
   $cant = false;   
  }
  if(($number==1)&&($letter==1)&&($cant==1)){
   return true;   
  }else{
   return false;
  }
 }
 
 
 
    
 function browser($us_ag){
  if(strpos($us_ag,"MSIE") != false){
   return "Explorer";
  }else{
   if(strpos($us_ag,"Firefox") != false){
    return "Firefox";   
   }else{
    if(strpos($us_ag,"Chrome") != false){
     return "Chrome"; 
    }else{
     if(strpos($us_ag,"Opera Mini") != false){
      return "Opera Mini";
     }else{
      if(strpos($us_ag,"Opera") != false){
       return "Opera";   
      }else{
       if(strpos($us_ag,"Safari") != false){
        return "Safari";   
       }else{
        return false;
       }  
      }  
     }   
    }  
   }  
  }
 }

 function ip(){
  $ip = filter_input(INPUT_SERVER,"REMOTE_ADDR");
  return $ip;
 }

 function os($us_ag){
  $systems = array(
             "Windows" => "Windows",
             "Mac OS X" => "Mac OS X",
             "Android" => "Android");
  foreach($systems as $os=>$pattern){
   if(eregi($pattern,$us_ag)){
    return $os;
   }
  }
  return "Unknow OS";   
 }
    
 function mac($us_ag,$os){
  $mac = array(
         "10.10" => $os." 10.10",
         "10.9" => $os." 10.9",
         "10.8" => $os." 10.8",
         "10.7" => $os." 10.7",
         "10.6" => $os." 10.6",
         "10.5" => $os." 10.5",
         "10.4" => $os." 10.4",
         "10.3" => $os." 10.3",
         "10.2" => $os." 10.2",
         "10.1" => $os." 10.1",
         "10.0" => $os." 10.0");
  foreach($mac as $version=>$pattern){
   if(eregi($pattern,$us_ag)){
    return $version;
   }
  }  
 }
    
 function android($us_ag,$os){
  $android = array(
             "5" => $os." 5",
             "4" => $os." 4",
             "3" => $os." 3",
             "2" => $os." 2",
             "1" => $os." 1");
  foreach($android as $version=>$pattern){
   if(eregi($pattern,$us_ag)){
    return $version;
   }
  }
 }
    
 function windows($us_ag,$os){
  $windows = array(
             "8.1" => $os." NT 6.3",
              "8" => $os." NT 6.2",
              "7" => $os." NT 6.1",
              "Vista" => $os." NT 6.0",
              "2003" => $os." NT 5.2",
              "XP" => $os." NT 5.1",
              "2000" => $os." NT 5.0");
  foreach($windows as $version=>$pattern){
   if(eregi($pattern,$us_ag)){
    return $version;
   }
  }
 }
 
 function version($us_ag,$os){
  $user = new User();
  if($os == "Mac OS X"){
   return $user->mac($us_ag,$os); 
  }
  if($os == "Windows"){
   return $user->windows($us_ag,$os); 
  }
  if($os == "Android"){
   return $user->android($us_ag,$os); 
  }
  if($os == "Unknow OS"){
   return "V0"; 
  }  
 }
 
        function iget($val){
  $data = filter_input(INPUT_GET,$val);
  return $data;
 } 
 
 
 
}
