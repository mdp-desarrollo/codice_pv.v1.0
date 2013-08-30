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
>>>>>>> c71ba4fd28f16967ee08c288ff31a8bd1663e0b3
        $this->database = 'correspondencia_pv';
        $this->user = 'correspondencia';
        $this->pass = 'c0rr3sp0nd3nc14';
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass );
    }
}
?>
