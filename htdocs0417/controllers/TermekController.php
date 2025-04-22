<?php

class TermekController
{




    public static function list()
    {

        $data = TermekModel::list();

        require (isset($_SESSION['adminLogin']) &&  $_SESSION['adminLogin'] == true) ? "views/admin-list.html" : "views/guest-list.html";
    }


    public static function create()
    {

        $nev = StringTools::sanitize($_POST['nev']);
        $ar = StringTools::sanitize($_POST['ar']);
        $raktaron = StringTools::sanitize($_POST['raktaron']);

        $kep = $_FILES['kep'];

        $imagepath = "content/" . $kep['name'];

        $imageSize = getimagesize($kep['tmp_name']);
        if (!empty($imageSize)) {
            move_uploaded_file($kep['tmp_name'], $imagepath);
        }

        TermekModel::create($nev, $ar, $imagepath, $raktaron);

        header("location: /");
    }




    public static function updatepage($id)
    {
        

        $updateData = TermekModel::getOneById($id);

        $data = TermekModel::list();

        require (isset($_SESSION['adminLogin']) &&  $_SESSION['adminLogin'] == true) ? "views/admin-list.html" : "views/guest-product.html";
    }


    public static function update($id)
    {
        $nev = $_POST['nev'];
        $ar = $_POST['ar'];
        $raktaron = $_POST['raktaron'];

        $kep = $_FILES['kep'];

        if (empty($kep))  $imagepath = $_POST['originalImage'];
        else {

            $imagepath = "content/" . $kep['name'];

            $imageSize = getimagesize($kep['tmp_name']);
            if (!empty($imageSize)) {
                move_uploaded_file($kep['tmp_name'], $imagepath);
            }
        }

        TermekModel::update($nev, $ar, $imagepath, $raktaron, $id);

        header("location: /");
    }

    public static function delete($id) {

        TermekModel::delete($id);
        header("location: /");
    }

}
