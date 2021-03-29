<?php

class Client
{
    private $_soapClient = null;
 
    public function __construct()
    {
        
        $partes = explode("/","http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        $url = $partes[0]."/".$partes[1]."/".$partes[2]."/".$partes[3]."/".$partes[4]."/".$partes[5]."/"."Server.php?wsdl";

        require_once(getcwd() . '/lib/nusoap.php');
        $this->_soapClient= new nusoap_client($url);
        
        $this->_soapClient->soap_defencoding = 'UTF-8';
    }
    
    
    public function consultar($metodo,$array)
    {
      try
      {
        $result = $this->_soapClient->call($metodo, $array);
        $this->_soapResponse($result);
       }
      catch (SoapFault $fault)
       {
        trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
        }
     }
     
   
    /**
 * @param $result
 */
   private function _soapResponse($result)
   {
    echo '<h2>Request</h2>' . print_r($result);
    echo '<h2>XML Response</h2>';
   
    echo '<h2>Request</h2>' . htmlspecialchars($this->_soapClient->request, ENT_QUOTES);
    echo '<h2>Response</h2>' . htmlspecialchars($this->_soapClient->response, ENT_QUOTES);
   }    
        
}


// Ejemplo de uso
//$client = new Client();
//$client->consultar("addUser",array("bbbbb","ccccc","dddddd@aaa"));
//$client->consultar("getUser",array("Cristian"));


?>