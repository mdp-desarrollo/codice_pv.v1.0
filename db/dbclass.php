<?php
class db extends PDO {
   
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
   
    public function __construct(){
        $this->engine = 'mysql';
<<<<<<< HEAD
        $this->host = 'localhost';
=======
        $this->host = '192.168.131.241';
>>>>>>> 2745cee20a8f8f19ddc69bb7efe1859f1df26301
        $this->database = 'correspondencia_pv';
        $this->user = 'correspondencia';
        $this->pass = 'c0rr3sp0nd3nc14';
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass );
    }
}
?>
