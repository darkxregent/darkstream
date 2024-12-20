<?php
require_once('../maint/allact.php');
$idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null; // Récupération de l'ID utilisateur de la session
$success = 0;
$echec = "abonnement à la chaine échoue veuillez resseyer";

if ($_SERVER["REQUEST_METHOD"] === "POST") {   
    $idUsing = isset($_POST['idusing']) ? (int)$_POST['idusing'] : null;
    if ($idUser != null && $idUsing != null) {

        $sqsesh = "SELECT * FROM ds_abonnements WHERE id_user=? AND id_visiteur=?";
        $this_selAbn = $bdd->prepare($sqsesh);
        $this_selAbn->execute([$idUser, $idUsing]);
        $all_selAbon = $this_selAbn -> fetchall();


        if (count($all_selAbon) == 0) {

            $sqsadd = "INSERT INTO ds_abonnements(id_user, id_visiteur) VALUES(?,?)";
            $this_addAbn = $bdd->prepare($sqsadd);
            $this_addAbn->execute([$idUser, $idUsing]);
    
            $success = 1;
            $echec = "tretement terminer ab";
            $change = "Se desabonner";


        }else {

            $sqsrev = "DELETE FROM ds_abonnements WHERE id_user=? AND id_visiteur=?";
            $this_videos = $bdd->prepare($sqsrev);
            $this_videos->execute([$idUser, $idUsing]);

            $success = 1;
            $echec = "tretement terminer dex";
            $change = "S'abonner";

        }
    }else {

        $echec = "echec parametre incomplet";

    }



    $respx = ["success" => $success, "echec" => $echec, "change" => $change];
    echo json_encode($respx);
}

?>