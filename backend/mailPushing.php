<?php

    class DataBase{
        private $db;
        private $config = [
            'dsn' => 'mysql:host=localhost;dbname=codeacademy;charset=utf8',
            'user' => 'root',
            'pass' => "",
        ];

        function __construct(){
            try{
                $this->db = new PDO($this->config['dsn'], $this->config['user'], $this->config['pass']);
            }
            catch(PDOException $err) {
                exit('Blad polaczenia z baza danych: '.$err->getMessage());
            }
        }

        public function pushEmail($mail){
            // przygotowanie zapytania
            $insert = $this->db->prepare("INSERT INTO `mails`(`email`) VALUES (:mail)");
            // filtracja wskazanych danych
            $insert->bindValue(':mail', $mail, PDO::PARAM_STR);
            // właściwe wykonanie
            $insert->execute();
        }
    }

    $mailPush = new DataBase();
    $mailPush->pushEmail($_POST['mail']);