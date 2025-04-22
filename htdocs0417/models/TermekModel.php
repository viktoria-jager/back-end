<?php


class TermekModel {

    

    public static function list (){
        $conn = Database::getConnection();


        $sql = "SELECT * FROM termekek";
        $query = mysqli_query($conn, $sql);

        $data = $query->fetch_all(MYSQLI_ASSOC);

        return $data;        
    }

    
    public static function create ( $nev, $ar, $kep, $raktaron ){
        $conn = Database::getConnection();

        $sql = "INSERT INTO termekek (nev, ar, kep, raktaron ) VALUES ( ?, ?, ?, ? ) ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $nev, $ar, $kep, $raktaron );
        $stmt->execute();
        
    }


    public static function getOneById ($id){
        $conn = Database::getConnection();
        
        $sql = "SELECT * FROM termekek WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id );
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data;
    }

    public static function update ($nev, $ar, $imagepath, $raktaron, $id){
        
        $conn = Database::getConnection();

        $sql = "UPDATE termekek SET
            nev = ?,
            ar = ?,
            kep = ?,
            raktaron = ? 
            WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisii", $nev, $ar, $imagepath, $raktaron, $id);
        $stmt->execute();
      

    }

    public static function delete ($id){
        $conn = Database::getConnection();

        $sql = "DELETE FROM termekek WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id );
        $stmt->execute();

    }





    








}
