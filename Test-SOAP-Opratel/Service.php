<?php

class Service
{
    
 
   public static function addUser($username, $password, $email, $modelo)
    {
      
        if($username != "" && $password != "" &&  $email!= "")
        {
            
            if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
               {
                  $message = "ERROR - Hubo un error al intentar procesar request addUser Error campo Email | username: {$username} | password: {$password} | email: {$email} ";
                  writeLog($message);
                 return "Error campo Email";
               }
            if(strlen($username) < 3 OR  strlen($username) > 32 )
               {
                  $message = "ERROR - Hubo un error al intentar procesar request addUser Error campo Usuario | username: {$username} | password: {$password} | email: {$email} ";
                  writeLog($message);
                 return "Error campo Usuario";
               }
             if(strlen($password ) < 3 OR  strlen($password ) > 32 )
               {
                  $message = "ERROR - Hubo un error al intentar procesar request addUser Error campo Password | username: {$username} | password: {$password} | email: {$email} ";
                  writeLog($message);
                 return "Error campo Password";
               }  
            
            $password = md5($password);
            
          $query = "insert into usuario values('$username','$password','$email',0)";
          
          $resultado = $modelo->consultar($query);

          
          
        if($resultado != 1){

            $message = "ERROR - Hubo un error al intentar procesar request addUser Error $resultado";
            
            return $resultado;
            }
            $message = "INFO - Procesamos request addUser | username: {$username} | password: {$password} | email: {$email}";
            writeLog($message);
            
            return 0;
        }

          $message = "ERROR - Hubo un error al intentar procesar request addUser Faltan campos | username: {$username} | password: {$password} | email: {$email} ";
          writeLog($message);
        
         return "Faltan campos";
        
    }
    
  
 public static function  activateUser($username,$modelo)
    {
        
        $query = "UPDATE usuario SET activo = 1 where username = '$username' " ;
        $resultado = $modelo->consultar($query);
          
        if($resultado != 1){
            $message = "ERROR - Hubo un error al intentar procesar request activateUser $resultado | username: {$username}";
            return $resultado;
            }

        $message = "INFO - Procesamos request activateUser | username: {$username} ";
        writeLog($message);            
        return 0;
        
    }
    
    
 public static function deactivateUser($username,$modelo)
    {
        
        $query = "UPDATE usuario SET activo = 0 where username = '$username' " ;
        $resultado = $modelo->consultar($query);
          
        if($resultado != 1){
            $message = "ERROR - Hubo un error al intentar procesar request deactivateUser $resultado | username: {$username}";
            return $resultado;
            }

        $message = "INFO - Procesamos request deactivateUser | username: {$username} ";
        writeLog($message);            
        return 0; 
        
    }  
    
    
 public static function getUser($username,$modelo)
   {
    
    $query = "SELECT * FROM usuario WHERE username = '$username'";
    
    $resultado = $modelo->consultar($query);
    $array = mysqli_fetch_assoc($resultado);
         
        if($resultado != 1){
            $message = "ERROR - Hubo un error al intentar procesar request getUser $resultado | username: {$username}";
            return $resultado;
            }   
        $message = "INFO - Procesamos request getUser | username: {$username} ";
        writeLog($message);    
        return $array;
   }

    
    
    
    
}

