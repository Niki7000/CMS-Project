<?php

    namespace CMS\Models;

    class DB
    {

        public $connection;

        public function __construct()
        {
            $this->connection = new \PDO("mysql:host=localhost;dbname=CMS", "root", "");
        }
    }