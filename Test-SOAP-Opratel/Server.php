<?php
    ini_set('soap.wsdl_cache_enabled',0);
    ini_set('soap.wsdl_cache_ttl',0);
 
class Server 
{
    private $server = null;
   
    public function __construct()
    {
        require_once(getcwd() . '/lib/nusoap.php');
        require_once(getcwd() . '/Service.php');
        require('Modelo.php');
        
                
        $this->server = new soap_server();
        $this->server->configureWSDL('Servidor', 'urn:Servidor');
        
        $this->server->register("addUser",
        array("username" => "xsd:string","password" => "xsd:string","email" => "xsd:string"),
        array("return" => "xsd:status_code"),
        "urn:User",
        "urn:User#addUser",
        "rpc",
        "encoded",
        "Agrega un nuevo usuario");
        
        
        $this->server->register("activateUser",
        array("username" => "xsd:string"),
        array("return" => "xsd:status_code"),
        "urn:Activate",
        "urn:User#activateUser",
        "rpc",
        "encoded",
        "Activa usuario");  
    
   
        $this->server->register("deactivateUser",
        array("username" => "xsd:string"),
        array("return" => "xsd:status_code"),
        "urn:Desactivate",
        "urn:User#deactivateUser",
        "rpc",
        "encoded",
        "Desactiva usuario");
        
       
        $this->server->register("getUser",
        array("username" => "xsd:string"),
        array("username" => "xsd:username","email" => "xsd:email"," password" => "xsd:password"),
        "urn:Get",
        "urn:User#getUser",
        "rpc",
        "encoded",
        "Obtiene usuarios");
        
        
                    
        function getUser($username)
        {
            return  Service::getUser($username,new Modelo()) ;                         
        }  
        
        
        function addUser($username, $password, $email)
        {     
          return Service::addUser($username, $password, $email, new Modelo()) ;  
        }
        
        
        function  activateUser($username)
        {         
             return Service::activateUser($username,new Modelo()) ;            
        }
        
        function deactivateUser($username)
        {
             return Service::deactivateUser($username,new Modelo()) ;
            
        }
        
                  
       $this->server->service(file_get_contents("php://input"));
    }
} 

$server = new Server();


?>