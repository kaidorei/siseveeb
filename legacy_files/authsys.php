<?
	  function auth(){ 
//		echo "IN echo";
          global $PHP_SELF, $sent, $mysession, $login, $passwd, $bye;  
          if ($bye) {                                     // user requested logout 
            session_start(); 
            session_unregister("mysession"); 
            session_destroy(); 
            return 0; 
          } 

          if(isset($_POST['sent'])){                               // arrive from login form 

           $login_ok = 0;  

            if (isset($_POST['login']) && isset($_POST['passwd'])){

			$query="SELECT username FROM isik WHERE password='".MD5($_POST['passwd'])."' AND username='".$_POST['login']."'";

            $result = mysql_query($query);

//			echo mysql_num_rows($result);
               if (mysql_num_rows($result)>0){ 
                  session_start();  
//echo $query;
                // create the session array 
                  $mysession = array ("login" => $_POST['login'], "passwd" => $_POST['passwd'], "ID" => session_id(), "valid" => 1);  
                  session_register("mysession");  
                if($_SESSION['count']<1) $_SESSION['count']=0;
				  return 1;                               // authentication succeeded 
                  $login_ok = 1;  
                 // break;  
               } 
				 if(!$login_ok){  
				 echo("denied");
              return 0;  }                                 // access denied  

            }    
			}
           else {           

                                // arrive from session var 
//		  echo("arrive from login form ");
           $login_ok = 0;  
            session_start();  
            foreach($GLOBALS["mysession"] as $elem):      // retrieve session array 
              $ses_tmp[] = $elem;  
            endforeach;  
            $login = $ses_tmp[0];                         // added by jds 
          $passwd = $ses_tmp[1];                        // added by jds 
            $query = "SELECT username,password,id FROM isik WHERE password='".MD5($passwd)."' AND username='".$login."'";
//			echo $query;
            $result = mysql_query($query);


               if (mysql_num_rows($result)>0){ 
                  session_start();  
                // create the session array 
                 $mysession = array ("login" => $login, "passwd" => $passwd, "ID" => session_id(), "valid" => 1);  
                  session_register("mysession");  
                 return 1;                               // authentication succeeded 
                  $login_ok = 1;  
                  break;  
                } 

            if(!$login_ok):  
              return 0;                                   // access denied 
            endif;  
         }  
      }

	  $mysession = array ("login"=>FALSE, "passwd"=>FALSE, "ID"=>FALSE, "valid"=>FALSE, "logid" => 0);  
      $uri = basename($PHP_SELF);  
      $stamp = md5(srand(5));  
	   $loginform=1;	

      if(!auth()){                 // authentication failed 
        $loginform=1;               // display login form 
		}
     else { 
	  $loginform=0;                       // authentication was successful 
        }
	  ?>