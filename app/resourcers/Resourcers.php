<?php
class Resourcers {
    private $columns = [];

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function get() 
    {
        $exit = [];
        foreach(Response::$data as $da) {
            $row = [];
            foreach($this->columns as $column) {
                $row[$column] = $da[$column];
            }
            array_push($exit, $row);
        }
        return $exit;
    }
}