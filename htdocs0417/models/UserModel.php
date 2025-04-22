<?php



class UserModel {


    public static function getOneByEmail ($email){

        $conn = Database::getConnection();

        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("s", $email); 

        $stmt->execute();

        $result = $stmt->get_result();

        $data = $result->fetch_array(); 

        return $data;

        
    }

}