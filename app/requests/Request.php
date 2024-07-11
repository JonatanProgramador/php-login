<?php
class Request {
    private $columns = [];

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function isValid() 
    {  
        $valid = true;
        $index = 0;
        $data = json_decode(file_get_contents('php://input'));
        while($valid && $index < count($this->columns)) {
            $valid = array_key_exists($this->columns[$index], $data);
            $index++;
        }
        return $valid;
    }
}