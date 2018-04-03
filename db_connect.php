<?php

    class DB_CONNEXT {

        function _construct() {

            $this->connect();
        }

        function _destruct() {

            $this->close();
        }

        function connect() {

            require_once("db.inc");

            $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error());

            $db = mysqli_select_db(DB_DATABASE) or die(mysqli_error()) or die(mysqli_error());

            return $con;
        }

        function close() {

            mysqli_close();
        }

        
    }
?>