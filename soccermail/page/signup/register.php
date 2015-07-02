<?php
 
 $root = realpath(filter_input(INPUT_SERVER,"DOCUMENT_ROOT"));
 include $root."/soccermail/mysql/connect.php";
 include $root."/soccermail/module/segud.php";
 include $root."/soccermail/module/user.php";
 
class Register {
    
 function construct(){
  $field = array("us_ide","us_id","us_nam","us_su","us_da","us_mo","us_ye",
                 "us_ge","us_re","us_pho","us_mob","us_na","us_em","us_pa");
  $register = new Register();
  $vfields = $register->vfields($field);
  if($vfields!=false){
   $year = date("Y");
   $month = date("m");
   $day = date("d");
   $hours = date("H");
   $minutes = date("i");
   $seconds = date("s");
   $user = new User();
   $us_id = $user->iget("us_id");
   $us_su = $user->iget("us_su");
   $us_da = $user->iget("us_da");
   $us_mo = $user->iget("us_mo");
   $us_ye = $user->iget("us_ye");
   $us_ge = $user->iget("us_ge");
   $us_re = $user->iget("us_re");
   $us_ide = $user->iget("us_ide");
   $us_nam = $user->iget("us_nam");
   $us_pho = $user->iget("us_pho");
   $us_mob = $user->iget("us_mob");
   if($user->vdate($us_da,$us_mo,$us_ye,$year,$month,$day)){
    if($vfields=="account"){
     $us_na = $user->iget("us_na");
     $us_em = $user->iget("us_em");
     $us_pa = $user->iget("us_pa");
     if($user->vemail($us_em)){
      if($user->vpassword($us_pa)){
       $connect = new Connect();
       $conn = $connect->conn("soccermail");
       if($conn!=false){
        $segud = new Segud();
        if($segud->existsv2("id",$us_id,"identity",$us_ide,"applicant",$conn)){
         if(!$segud->exists("name",$us_na,"account",$conn)){
          if(!$segud->exists("email",$us_em,"account",$conn)){
           $us_sc = $segud->get("school","id",$us_id,"applicant",$conn);
           $data = array($us_id,$us_nam,$us_su,$us_da,$us_mo,$us_ye,$us_ge,$us_re,$us_pho,$us_mob,$us_ide,$us_sc);
           if($segud->set($data,"user",$conn)){
            if($segud->delete("id",$us_id,"applicant",$conn)){
             $data = array($us_id,$day,$month,$year,$seconds,$minutes,$hours);
             if($segud->set($data,"signup",$conn)){
              $us_bi = "La biografía de ".$us_nam;
              $us_ph = "La foto de ".$us_nam;
              $us_he = "El encabezado de ".$us_nam;
              $data = array($us_id,$us_bi,$us_ph,$us_he);
              if($segud->set($data,"profile",$conn)){
               $mysqli = $conn->query("select max(id) from account");
               $row = $mysqli->fetch_array(MYSQLI_NUM);
               $ac_id = (trim($row[0]))+1;
               $data = array($ac_id,"true","true",$us_id,$us_na,$us_em,$us_pa);
               if($segud->set($data,"account",$conn)){
                $data = array($us_id,0,0);
                if($segud->set($data,"follow",$conn)){
                 $us_ag = filter_input(INPUT_SERVER,"HTTP_USER_AGENT");
                 $ip = $user->ip();
                 $os = $user->os($us_ag);
                 $browser = $user->browser($us_ag);
                 $version = $user->version($us_ag,$os);
                 $data = array($ac_id,$day,$month,$year,$seconds,$minutes,$hours,$os,$version,$browser,$ip);
                 if($segud->set($data,"login",$conn)){
                  if($segud->update("session","true","id",$ac_id,"account",$conn)){
                   session_start();
                   $_SESSION["logac_id"] = $ac_id;
                   $_SESSION["logus_em"] = $us_em;
                   $_SESSION["logus_id"] = $us_id;
                   $_SESSION["logus_na"] = $us_na;
                   $_SESSION["logus_sc"] = $us_sc;
                   $_SESSION["session"]=true;
                   if($connect->close($conn)){
                    echo "true";
                   }/*close conn*/ 
                  }
                 }
                }
               }
              }
             }
            }
           }
          }else{
           echo "La dirección de correo electrónico ya ha sido registrada.";
          }
         }else{
          echo "El nombre de usuario ya existe, intenta nuevamente con uno distinto.";   
         }
        }else{
         echo "El documento de identidad no ha sido registrado o no corresponde al tipo de usuario "
         ."del mismo. Obtén más información con un entrenador de la escuela.";   
        }
       }
      }else{
       echo "La contraseña no es segura. Por favor verifica que tenga mayúsculas, números y que sea" 
       ."almenos de 9 caracteres, e inténtalo nuevamente.";   
      }
     }else{
      echo "La dirección de correo electrónico es incorrecta. Si presentas algún inconveniente "
      ."con el símbolo del arroba puedes copiarlo: "."<b>"."@"."</b>"." y pegarlo.";   
     }
    }
   }
  }
 }
    
    
 function vfields($field){
  $return = 0;
  for($i=0;$i<14;$i++){
   $get = filter_input(INPUT_GET,$field[$i]);
   if(!empty($get)){
    $return = $return + 1;    
   } 
  }
  $mess = "Para completar tu registro, es necesario que ingreses toda la información que te solicitamos. "
          ."Por favor, verifica que todos los campos estén llenos.";
  if($return==14){
   $us_id = filter_input(INPUT_GET,'us_id');
    if($us_id[0]!="#"){
     return "account";
    }
  }else{
   if(($return==11)&&(empty(filter_input(INPUT_GET,'us_na')))&&(empty(filter_input(INPUT_GET,'us_em')))
    &&(empty(filter_input(INPUT_GET,'us_pa')))){
    $us_id = filter_input(INPUT_GET,'us_id');
     if($us_id[0]=="#"){
      return "profile";
     }else{
      echo $mess;
      return false;
     }
   }else{
    echo $mess;
    return false;
   }    
  }
 }
   
}

$register = new Register();
$register->construct();