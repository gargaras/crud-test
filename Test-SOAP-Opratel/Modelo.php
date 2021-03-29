<?php

class Modelo{
    
    private   $servername = "localhost";
    private   $database = "usuarios";
    private   $username = "root";
    private   $password = "";
    private   $conn;
    
    
   function __construct()
   {
    
      $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database); 
      
      
            if (!$this->conn) { 
               die("Fallo conexion: " . mysqli_connect_error()); 
               } 
  
    
   }     
    
   public function consultar($query)
    {
      
       
        $result = mysqli_query($this->conn,$query);  
        
        if (!$result) 
             {
                
              return mysqli_error($this->conn);  
              
             }
             
        return $result;
    }

    
}


?>