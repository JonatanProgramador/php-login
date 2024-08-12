<?php
class StatusCode {
    const DB_ERROR_CONECT = "Error al conectar a la base de datos.";

    const DB_SUCCESS_CREATE_TABLE = "Creado la tabla ";
    const DB_ERROR_CREATE_TABLE = "Error al crear la tabla ";

    const DB_SUCCESS_DELETE_TABLE = "Eliminado la tabla ";
    const DB_ERROR_DELETE_TABLE = "Error al eliminar la tabla ";

    const DB_SUCCESS_INSERT_ROW = "Fila insertada.";
    const DB_ERROR_INSERT_ROW = "Error al insertar una fila.";

    const DB_ERROR_GET_ROWS = "Error al recuperar los datos de la fila.";

    const DB_SUCCESS_UPDATE_ROW = "Fila actualizada.";
    const DB_ERROR_UPDATE_ROW = "Error al actualizar la fila.";

    const DB_SUCCESS_DELETE_ROW = "Fila eliminada.";
    const DB_ERROR_DELETE_ROW = "Error al eliminar la fila.";
}