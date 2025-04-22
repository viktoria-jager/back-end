<?php


class FelhasznaloModel
{

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "tarskereso");

        if ($this->conn->connect_error) {
            die("Adatbázis kapcsolat sikertelen: " . $this->conn->connect_error);
        }
    }


    public function list()
    {
        $sql = 'SELECT * FROM felhasznalok';
        $stmt = $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function getOneById($id)
    {
        $sql = 'SELECT * FROM felhasznalok WHERE user_id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array();
        return $data;
    }

    public function create(array $args)
    {

        $sql = 'INSERT INTO felhasznalok (nev, email, password_hash, szuletesi_datum, nem, keresett_nem, kapcsolat_jellege, bemutatkozas, profilkep, letrehozas_datuma, modositas_datuma) VALUES (?,?,?,?,?,?,?,?,?,?,? )';
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssssss", ...$args);
        $stmt->execute();



        return true;
    }

    public function update(array $args)
    {

        $sql = 'UPDATE felhasznalok 
        SET 
            nev = ?, 
            email =  ?,
            szuletesi_datum = ?,
            nem = ?,
            keresett_nem = ?,
            kapcsolat_jellege = ?,
            bemutatkozas = ?,
            profilkep =  ?,
            modositas_datuma =  ?
            WHERE user_id = ? '; 

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssssi", ...$args);

        $stmt->execute();
        
    }

    public function delete ( $user_id ) {
        $sql = "DELETE FROM felhasznalok WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id );
        $stmt->execute();
    }
}
