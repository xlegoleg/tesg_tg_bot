<?php
/**
 * @author Oleg Kurganov [xxxlegoleg@gmail.com]
 * @since PHP 7.4
 */

namespace core;

use mysqli;

class Database {
    private $host;

    private $user_name;

    private $user_pass;

    private $db_name;

    public function __construct($config) {
        $this->host = $config['host'];
        $this->user_name = $config['user_name'];
        $this->user_pass = $config['user_pass'];
        $this->db_name = $config['db_name'];
    }

    public function connect(): mysqli {
        $mysql = new mysqli($this->host,$this->user_name,$this->user_pass,$this->db_name);
        if ($mysql->connect_error) {
            echo "Error : ('. $mysql->connect_errno .') '. $mysql->connect_error)";
        }
        return $mysql;
    }
}