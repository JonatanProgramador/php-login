<?php



class DataBase
{

  public static function createTable($table, $columns)
  {

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "CREATE TABLE " . $table . " (";
      foreach ($columns as $column) {
        $querry = $querry . $column->get() . ", ";
      }
      $querry = substr($querry, 0, -2);
      $querry = $querry . ");";
      $result = $link->query($querry);
      if ($result) {
        mysqli_close($link);
        Response::$message = StatusCode::DB_SUCCESS_CREATE_TABLE;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message = StatusCode::DB_ERROR_CREATE_TABLE;
        Response::$code  = 500;
      }
    } else {
      Response::$message = StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
    
  }

  public static function deleteTable($table)
  {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "DROP TABLE " . $table . ";";
      $result = $link->query($querry);
      if ($result) {
        mysqli_close($link);
        Response::$message = StatusCode::DB_SUCCESS_DELETE_TABLE;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message = StatusCode::DB_ERROR_DELETE_TABLE;
        Response::$code = 500;
      }
    } else {
      Response::$message = StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
  }


  public static function insertRow($table, $data)
  {

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "INSERT INTO " . $table;
      $columns = " (";
      $values = " VALUES (";
      foreach ($data as $key => $value) {
        $columns = $columns . $key . ", ";
        $values = $values . "'" . $value . "', ";
      }
      $columns = substr($columns, 0, -2);
      $columns = $columns . " ) ";
      $values = substr($values, 0, -2);
      $values = $values . " );";
      $querry = $querry . $columns . $values;
      $result = $link->query($querry);
      if ($result) {
        mysqli_close($link);
        Response::$message = StatusCode::DB_SUCCESS_INSERT_ROW;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message = StatusCode::DB_ERROR_INSERT_ROW;
        Response::$code = 500;
      }
    } else {
      Response::$message = StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
  }

  public static function getRows($table)
  {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "SELECT * FROM " . $table;
      $consult = $link->query($querry);
      if ($consult) {
        $result = [];
        while ($row = $consult->fetch_assoc()) {
          array_push($result, $row);
        }
        $consult->free();
        mysqli_close($link);
        Response::$data = $result;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message = StatusCode::DB_ERROR_GET_ROWS;
        Response::$code = 500;
      }
    } else {
      Response::$message =  StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
  }

  public static function findRowsById($table, $id)
  {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "SELECT * FROM " . $table . " WHERE id  = " . $id . ";";
      $consult = $link->query($querry);
      if ($consult) {
        $result = [];
        while ($row = $consult->fetch_assoc()) {
          array_push($result, $row);
        }
        $consult->free();
        mysqli_close($link);
        Response::$data = $result;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message = StatusCode::DB_ERROR_GET_ROWS;
        Response::$code = 500;
      }
    } else {
      Response::$message =  StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
  }

  public static function findRows($table, $where)
  {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "SELECT * FROM " . $table . " WHERE " . array_keys($where)[0] . " = '" . $where[array_keys($where)[0]] . "';";
      $consult = $link->query($querry);
      if ($consult) {
        $result = [];
        while ($row = $consult->fetch_assoc()) {
          array_push($result, $row);
        }
        $consult->free();
        mysqli_close($link);
        Response::$data = $result;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message =  StatusCode::DB_ERROR_GET_ROWS;
        Response::$code = 500;
      }
    } else {
      Response::$message =  StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
  }

  public static function updateRow($table, $data, $where)
  {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "UPDATE " . $table . " SET ";
      foreach ($data as $key => $value) {
        $querry = $querry . $key . " = '" . $value . "', ";
      }
      $querry = substr($querry, 0, -2);
      $querry = $querry . " WHERE " . array_keys($where)[0] . " = '" . $where[array_keys($where)[0]] . "';";
      $result = $link->query($querry);
      if ($result) {
        mysqli_close($link);
        Response::$message =  StatusCode::DB_SUCCESS_UPDATE_ROW;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message =  StatusCode::DB_ERROR_UPDATE_ROW;
        Response::$code = 500;
      }
    } else {
      Response::$message = StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
  }

  public static function updateRowById($table, $data, $id)
  {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "UPDATE " . $table . " SET ";
      foreach ($data as $key => $value) {
        $querry = $querry . $key . " = '" . $value . "', ";
      }
      $querry = substr($querry, 0, -2);
      $querry = $querry . " WHERE id = " . $id . ";";
      $result = $link->query($querry);
      if ($result) {
        mysqli_close($link);
        Response::$message =  StatusCode::DB_SUCCESS_UPDATE_ROW;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message =  StatusCode::DB_ERROR_UPDATE_ROW;
        Response::$code = 500;
      }
    } else {
      Response::$message = StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
  }

  public static function deleteRow($table, $where)
  {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "DELETE FROM " . $table . " WHERE " . array_keys($where)[0] . " = '" . $where[array_keys($where)[0]] . "';";
      $result = $link->query($querry);
      if ($result) {
        mysqli_close($link);
        Response::$message = StatusCode::DB_SUCCESS_DELETE_ROW;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message =  StatusCode::DB_ERROR_DELETE_ROW;
        Response::$code = 500;
      }
    } else {
      Response::$message =  StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
  }

  public static function deleteRowById($table, $id)
  {
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link) {
      $querry = "DELETE FROM " . $table . " WHERE id = " . $id . ";";
      $result = $link->query($querry);
      if ($result) {
        mysqli_close($link);
        Response::$message = StatusCode::DB_SUCCESS_DELETE_ROW;
        Response::$code = 200;
      } else {
        Response::$error = mysqli_error($link);
        mysqli_close($link);
        Response::$message =  StatusCode::DB_ERROR_DELETE_ROW;
        Response::$code = 500;
      }
    } else {
      Response::$message =  StatusCode::DB_ERROR_CONECT;
      Response::$code = 500;
    }
  }
}
