<?php


    class userManager
    {
        private $table;

        public function __construct($table)
        {
            $this->table = $table;
        }

        public function ggjkhkjhjh()
        {
            
        }


    }



    function createUser()
    {
        require DB;
        $table = "user";

        $req = $db->prepare();
        $req->bindValue();
        $req->execute();
        $req->closeCursor();
    }

    function findAllUsers()
    {
        require DB;
        $table = "user";

        $req = $db->prepare();
        $req->execute();
        $users = $req->fetchAll();
        $req->closeCursor();
        return $users;
    }