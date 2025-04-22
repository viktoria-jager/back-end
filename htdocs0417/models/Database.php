<?php


class Database {


    private static ?mysqli $connection = null;

    public static function getConnection(): mysqli {
        if (self::$connection === null) {
            
            self::$connection = new mysqli(MYSQLI_HOST, MYSQLI_USER, MYSQLI_PASSWORD, MYSQLI_DB);

            if (self::$connection->connect_error) {
                die("Adatbázis kapcsolat hiba: " . self::$connection->connect_error);
            }

            self::$connection->set_charset("utf8mb4");
        }

        return self::$connection;
    }
}