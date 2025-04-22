<?php

include "FelhasznaloModel.php";

$felhasznalok = new FelhasznaloModel();
$allRegs = $felhasznalok->list();

if (isset($_GET['user_id'])) {
    $modUser = $felhasznalok->getOneById($_GET['user_id']);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Nev</th>
                    <th>Email</th>
                    <th>Nem</th>
                    <th>Avatar</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allRegs as $sor) : ?>

                    <tr>
                        <td><?= $sor['user_id'] ?></td>
                        <td><?= $sor['nev'] ?></td>
                        <td><?= $sor['email'] ?></td>
                        <td><?= $sor['nem'] ?></td>
                        <td>
                            <?php
                            $keptomb = json_decode($sor['profilkep']);
                            foreach($keptomb as $kep ) :
                            ?>
                            <img src="mappa/<?=$kep?>" width="50">
                                
                            <?php endforeach; ?>
                        
                        </td>
                        <td>
                            <a href="index.php?user_id=<?= $sor['user_id'] ?>">szerkesztés</a>
                            <a href="FelhasznaloController.php?delete_user_id=<?= $sor['user_id'] ?>">törlés</a>
                            
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>


        <form id="registerForm" action="FelhasznaloController.php" method="POST" enctype="multipart/form-data">
            <label for="name">Név:</label>
            <input type="text" id="name" name="nev" value="<?= $modUser['nev'] ?? "" ?>">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?= $modUser['email'] ?? "" ?>">

            <label for="birthdate">Születési dátum:</label>
            <input type="date" id="birthdate" name="szuletesi_datum" value="<?= $modUser['szuletesi_datum'] ?? "" ?>">

            <label for="gender">Nem:</label>
            <select id="gender" name="nem">
                <option <?= (isset($modUser['nem']) && $modUser['nem'] == "male") ? "selected" : "" ?> value="male">Férfi</option>
                <option <?= (isset($modUser['nem']) && $modUser['nem'] == "female") ? "selected" : "" ?> value="female">Nő</option>
                <option <?= (isset($modUser['nem']) && $modUser['nem'] == "other") ? "selected" : "" ?> value="other">Egyéb</option>
            </select>

            <label for="interest">Kit keresel?</label>
            <select id="interest" name="keresett_nem">
                <option <?= ($modUser['keresett_nem'] ?? '') === "male" ? "selected" : "" ?> value="male">Férfiakat</option>
                <option <?= ($modUser['keresett_nem'] ?? '') === "female" ? "selected" : "" ?> value="female">Nőket</option>
                <option <?= ($modUser['keresett_nem'] ?? '') === "both" ? "selected" : "" ?> value="both">Mindkettőt</option>
            </select>

            <label for="relationship">Milyen kapcsolatot keresel?</label>
            <select id="relationship" name="kapcsolat_jellege">
                <option <?= (isset($modUser['kapcsolat_jellege']) && $modUser['kapcsolat_jellege'] == "serious") ? "selected" : "" ?> value="serious">Komoly kapcsolat</option>
                <option <?= (isset($modUser['kapcsolat_jellege']) && $modUser['kapcsolat_jellege'] == "casual") ? "selected" : "" ?> value="casual">Laza kapcsolat</option>
                <option <?= (isset($modUser['kapcsolat_jellege']) && $modUser['kapcsolat_jellege'] == "friendship") ? "selected" : "" ?> value="friendship">Barátság</option>
            </select>

            <label for="bio">Bemutatkozás:</label>
            <textarea id="bio" rows="4" placeholder="Mesélj magadról..." name="bemutatkozas"><?= $modUser['bemutatkozas'] ?? "" ?></textarea>

            <label for="profilePic">Profilkép feltöltése:</label>

            <input type="file" id="profilePic" accept="image/*" name="profilkep[]" multiple >

            <input id="user_id" type="hidden" name="user_id" value="<?= $modUser['user_id'] ?? "" ?>">

            <button type="submit">Regisztráció</button>
        </form>


    </div>




    <script>
        let user_elem = document.querySelector("#user_id");

        console.dir(user_elem);
        if (user_elem.value == "") {

            document.getElementById('registerForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                if (password !== confirmPassword) {
                    alert('A jelszavak nem egyeznek!');
                    return;
                }
                this.submit();
            });
        }
    </script>


</body>

</html>