<?php

class Sql extends PDO {

    // Atributo
    private $conexao;

    //  Vai nascer já com está função
    public function __construct() {
        $this->conexao = new PDO("mysql:dbname=dbphp7;host=localhost", "root","");
    }

    // Método para receber varios parametros/resultado
    private function setParams($statment, $parameters = array()) {

        foreach ($parameters as $key => $value ) {
            $this->setParam($statment, $key, $value);
        }
    }


    private function setParam($statment, $key, $value) {
        $statment->bindParam($key, $value);
    }


    public function query($rawQuery, $params = array()) {

        $stmt = $this->conexao->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();  

        return $stmt;
    }


    public function select($rawQuery, $params = array()):array {

        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        
    }


}

?>