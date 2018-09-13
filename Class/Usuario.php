<?php

    class Usuario {
        private $idusuario;
        private $deslogin;
        private $dessenha;
        private $dtcadastro;

        public function getIdusuario() {
            return $this->idusuario;
        }

        public function setIdusuario($value) {
            $this->idsuario = $value;
        }

        public function getDeslogin() {
            return $this->deslogin;
        }

        public function setDeslogin($value) {
            $this->deslogin = $value;
        }

        public function getDessenha() {
            return $this->dessenha;
        }

        public function setDessenha($value) {
            $this->dessenha = $value;
        }

        public function getDtcadastro() {
            return $this->dtcadastro;
        }

        public function setDtcadastro($value) {
            $this->dtcadastro = $value;
        }


        // MÉTODO DE CARREGAR PELO ID
        public function loadById($id) {

            $sql =  new Sql();
            $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            // CHAVE e VALOR
                ":ID"=>$id
            ));

            //  SE EXISTIR a variavel
            if (isset($results) > 0) {

                $row = $results[0];

    //Fizemos o SELECT e com isso, já estamos SETando os dados retornado do BANCO e jogando nos ATRIBUTOS
    // Estamos CARREGANDO os DADOS do banco para o OBJETO
                $this->setIdusuario($row['idusuario']);
                $this->setDeslogin($row['deslogin']);
                $this->setDessenha($row['dessenha']);
                $this->setDtcadastro(new DateTime($row ['dtcadastro']));
            }
        } // Fim Método LoadbyId

        // Aqui estamos tratando os dados para JSON que o banco mandou para os ATRIBUTOS e vamos ter uma melhor visualização.
        public function __toString(){

             return json_encode(array(
                "idusuario" => $this->getIdusuario(),
                "deslogin" => $this->getDeslogin(),
                "dessenha" => $this->getDessenha(),
                "dtcadastro" => $this->getDtcadastro()->format("d/m/y :Hi:s")
             ));
            
        }

    }

?>