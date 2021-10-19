<?php

class Database
{

    //for singleton purposes

    private $databaseName = "farm_assist";
    private $username = "root";
    private $password = "";
    private $server = '127.0.0.1';

    private $conn;
    private $query;
    private static $instance = null;
    private $q = [];
    private $table = "";


    function __construct()
    {
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->databaseName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    public static function connect()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function table($table)
    {
       // $this->query = $table;
        $this->table = $table;

        return $this;
    }

    public function where($field, $operator, $value)
    {
        array_push($this->q, ['where'=>$field.$operator.$value]);

        if (strpos($this->query, 'WHERE') !== false) {
            $this->query = "{$this->query} AND {$field} {$operator} '{$value}'";
        } else {
            $this->query = "{$this->query} WHERE {$field} {$operator} '{$value}'";
        }


        return $this;

    }

    public function select($attr = null)
    {
        array_push($this->q, ['select' => $attr]);
        if (!$attr) {
            $this->query = "SELECT * FROM {$this->table} {$this->query}";
        } else {
            $this->query = "SELECT {$attr}  FROM {$this->table} {$this->query}";
        }
        return $this;
    }

    private function prepareData($values){

        $columns = [];
        $vals = [];

        foreach ($values as $col => $val) {
            array_push($columns, $col);
            $v = gettype($val) == 'string' ? "'" . $val . "'" : $val;
            array_push($vals, $v);
        }
        $columns = implode(',', $columns);
        $vals = implode(',', $vals);

        $this->query = "{$this->query} ({$columns}) VALUES ({$vals})";

    }

    public function insert($values)
    {
        $this->prepareData($values);
        $this->query = "INSERT INTO ".$this->table. ' '. $this->query;
        $this->conn->query($this->query);

        if ($this->conn->error) {
            die($this->conn->error);
        }

        $this->query = "";

    }

    public function delete(){
        $this->query = 'DELETE FROM '. $this->table. ' '. $this->query;
        $this->conn->query($this->query);
        echo $this->query;
        if($this->conn->error){
            die($this->conn->error);
        }
    }

    public function update($values){

        $data = [];

        foreach ($values as $col => $val) {
            $v = gettype($val) == 'string' ? "'" . $val . "'" : $val;
            array_push($data, $col.'='. $v);
        }

        $q = implode(',', $data);

        $this->query = "UPDATE ". $this->table. ' SET '. $q .$this->query;
       // array_push('update')

        $this->conn->query($this->query);
        if ($this->conn->error) {
            die($this->conn->error);
        }
        $this->query = "";

    }

    public function exec(){
        $this->conn->query($this->query);
        if ($this->conn->error) {
            die($this->conn->error);
        }
        $this->query = "";
    }

    function join($tableName, $first, $second)
    {   array_push($this->q, $tableName.$first.'='.$second);
        $this->query = "{$this->query} inner join $tableName ON {$first} = {$second}";
        return $this;
    }

    function get()
    {
        $data = [];

      //  return $this->query;

        $results = $this->conn->query($this->query);

        //  var_dump($results);

        if ($results) {

            if ($results->num_rows > 0) {
                // output data of each row
                while ($row =  $results->fetch_object()) {
                    array_push($data, $row);
                }
            }

        }

        if ($this->conn->error)
            die($this->conn->error);

      //  $this->conn->close();
        $this->query = "";

        return $data;
    }

    public function limit($amount){

        $this->query = $this->query. ' LIMIT '. $amount;

        $data = [];

      //  return $this->query;

        $results = $this->conn->query($this->query);

        //  var_dump($results);

        if ($results) {

            if ($results->num_rows > 0) {
                // output data of each row
                while ($row =  $results->fetch_object()) {
                    array_push($data, $row);
                }
            }

        }

        if ($this->conn->error)
            die($this->conn->error);

      //  $this->conn->close();
        $this->query = "";

        return $data;
    }

    public function orderByDesc($col){
        $this->query = $this->query. 'ORDER BY '.$col. ' DESC';
        return $this;
    }

    public function execRawSql($sql){
       $q = $this->conn->query($sql);
       if($this->conn->error){
           die($this->conn->error);
       }
    }


}