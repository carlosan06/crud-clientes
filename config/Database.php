<?php
// Clase encargada de la conexión a la base de datos
class Database
{
    private static $host = "localhost";
    private static $baseDatos = "crud_clientes";
    private static $usuario = "crud_user";
    private static $clave = "crud123";
    private static $conexion = null;

    public static function conectar()
    {
        // Se crea la conexión una sola vez y se reutiliza
        if (self::$conexion === null) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$baseDatos . ";charset=utf8mb4";
            self::$conexion = new PDO($dsn, self::$usuario, self::$clave);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return self::$conexion;
    }
}
