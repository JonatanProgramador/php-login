<?php
class Model
{
  private $table;

  public function __construct($table)
  {
    $this->table = $table;
  }

  public function create($columns)
  {
    DataBase::createTable($this->table, $columns) . $this->table;
  }

  public function drop()
  {
    DataBase::deleteTable($this->table) . $this->table;
  }

  /**
   * @param array $data array asociativo donde la clave es la columna.
   */
  public function insert($data)
  {
    DataBase::insertRow($this->table, $data);
  }

  public function get()
  {
    DataBase::getRows($this->table);
  }

  public function find($where)
  {
    DataBase::findRows($this->table, $where);
  }

  public function findById($id)
  {
    DataBase::findRowsById($this->table, $id);
  }

  public function update($where, $data)
  {
    DataBase::updateRow($this->table, $data, $where);
  }

  public function updateById($id, $data)
  {
    DataBase::updateRowById($this->table, $data, $id);
  }

  public function delete($where)
  {
    DataBase::deleteRow($this->table, $where);
  }

  public function deleteById($id)
  {
    DataBase::deleteRowById($this->table, $id);
  }
}
