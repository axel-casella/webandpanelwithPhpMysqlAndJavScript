<?php


class DBConnection
{
    /** @var PDO|null*/
    private static $db;

    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASS = "";
    const DB_BASE = "essen";


    private function __construct()
    {}

    protected static function openConnection()
    {
        /*echo "DBConnection: creando la conexión con la base de datos PDO...<br>";*/
        $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_BASE . ";charset=utf8mb4";

        try {
            self::$db = new PDO($dsn, self::DB_USER, self::DB_PASS);
        } catch(Exception $e) {
            echo "Error al conectar con la base de datos :(";
        }
    }

    /**
     * @return PDO
     */
    public static function getConnection()
    {
        if(self::$db === null) {
            self::openConnection();
        }

        /*echo "DBConnection: retornando la instancia PDO con sus respectivas tablas...<br>";*/
        return self::$db;
    }
}