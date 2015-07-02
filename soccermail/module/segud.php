<?php

class Segud {
    
 function set($data,$table,$conn){
  $name = array("applicant","user","profile","account","signup","login","logout","follow","followID","guardianID");
  $length = array(6,12,4,7,7,11,7,3,2,2);
  $i = 0;
  $z = 0;
  $control = false;
  while($control==false){
   if($name[$i]==$table){
    $z = $length[$i];
    $control = true;
   }else{
    $i++;
    $control = false;
   }
  }
  $val = "";
  for($i=0;$i<$z;$i++){
   if($i!=0){
    $val = $val.","."'$data[$i]'";  
   }else{
    $val = "'$data[$i]'";   
   }
  }
  $mysqli = $conn->query("insert into $table values($val)");
  if($mysqli){
   return true;  
  }else{
   return false;   
  } 
 }
 
 function exists($col1,$data1,$table,$conn){
  $mysqli = $conn->query("select $col1 from $table where $col1 ='$data1'");
  if($mysqli){
   if(($mysqli->num_rows)>0){
    return true; 
   }else{
    return false;   
   }   
  }  
 }
 
 function existsv2($col1,$data1,$col2,$data2,$table,$conn){
  $mysqli = $conn->query("select $col1 from $table where $col1 ='$data1' and $col2 = '$data2'");
  if($mysqli){
   if(($mysqli->num_rows)>0){
    return true; 
   }else{
    return false;   
   }   
  }  
 }
    
 function get($col1,$col2,$data2,$table,$conn){
  $mysqli = $conn->query("select $col1 from $table where $col2 = '$data2'");
  if($mysqli){
   $row = $mysqli->fetch_array(MYSQLI_ASSOC);
   return trim($row[$col1]);
  }else{
   return false;
  }   
 }
 
 function getv2($col1,$data1,$col2,$data2,$table,$conn){
  $mysqli = $conn->query("select $col1 from $table where $col1 = '$data1' and $col2 = '$data2'");
  if($mysqli){
   $row = $mysqli->fetch_array(MYSQLI_ASSOC);
   return trim($row[$col1]);
  }else{
   return false;
  }   
 }    
    
 function update($col1,$data1,$col2,$data2,$table,$conn){
  $mysqli = $conn->query("update $table set $col1 = '$data1' where $col2 = '$data2'");
  if($mysqli){
   return true;   
  }else{
   return false;   
  }
 }
 
 function delete($col1,$data1,$table,$conn){
  $mysqli = $conn->query("delete from $table where $col1 = '$data1'");
  if($mysqli){
   return true;
  }else{
   return false;   
  }
 }
 
 function deletev2($col1,$data1,$col2,$data2,$table,$conn){
  $mysqli = $conn->query("delete from $table where $col1 = '$data1' and $col2 = '$data2'");
  if($mysqli){
   return true;
  }else{
   return false;   
  }
 }
 
}
