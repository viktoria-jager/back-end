<pre>
<?php




/*



/*
1: GIF
2: JPEG
3: PNG
4: SWF
5: PSD
6: BMP
7: TIFF (verzió 1)
8: TIFF (verzió 2)
9: JPC
10: JP2
11: JPX
12: JB2
13: SWC
14: IFF
15: WBMP
*/







require_once("FelhasznaloModel.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['delete_user_id'])) {
        $felhasznalo = new FelhasznaloModel();
        $felhasznalo->delete($_GET['delete_user_id']);
        header("location: index.php");
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nev =  $_POST['nev'];
    $email =  $_POST['email'];

    $password_hash =  password_hash($_POST['password'], PASSWORD_DEFAULT);
    $szuletesi_datum =  $_POST['szuletesi_datum'];
    $nem =  $_POST['nem'];
    $keresett_nem =  $_POST['keresett_nem'];
    $kapcsolat_jellege =  $_POST['kapcsolat_jellege'];
    $bemutatkozas =  $_POST['bemutatkozas'];
    $letrehozas_datuma = date("Y-m-d");
    $modositas_datuma = date("Y-m-d");




    $kep = $_FILES["profilkep"];
    //var_dump($kep['name']);

    for ($i = 0; $i < count($kep['name']); $i++) {

        
        $profilkep = json_encode($kep['name']);
        $imageSize = getimagesize($kep['tmp_name'][$i]);

        //var_dump($imageSize);

        if ($imageSize) {

            move_uploaded_file($kep['tmp_name'][$i], "mappa/" . $kep['name'][$i]);
           

        }
    }



    $felhasznalo = new FelhasznaloModel();

    $user_id = $_POST['user_id'];

    if ($user_id == "")
        $felhasznalo->create([$nev, $email, $password_hash, $szuletesi_datum, $nem, $keresett_nem, $kapcsolat_jellege,  $bemutatkozas, $profilkep, $letrehozas_datuma, $modositas_datuma]);
    else
        $felhasznalo->update([$nev, $email, $szuletesi_datum, $nem, $keresett_nem, $kapcsolat_jellege,  $bemutatkozas, $profilkep, $modositas_datuma, $user_id]);

//    header("location: index.php");
}
