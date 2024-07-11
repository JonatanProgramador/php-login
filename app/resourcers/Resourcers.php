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
        foreach($this->columns as $column) {
            $exit[$column] = Response::$data[0][$column];
        }

        return $exit;
    }
}