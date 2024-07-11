<?php
class Column
{
  private $column;
  public const STRING = "varchar(80)";
  public const INTEGER = "INT";
  public const TEXT = "LONGTEXT";

  public function __construct($name, $type)
  {
    $this->column = $name . " " . $type;
  }

  public function notNull()
  {
    $this->column = $this->column . " NOT NULL";
  }

  public function autoIncrement()
  {
    $this->column = $this->column . " AUTO_INCREMENT";
  }

  public function primaryKey()
  {
    $this->column = $this->column . " PRIMARY KEY";
  }

  public function unique() 
  {
    $this->column = $this->column . " UNIQUE";
  }

  public function get()
  {
    return $this->column;
  }
}