<?php
require_once('../../maint/allact.php');
$idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null; // Récupération de l'ID utilisateur de la session
$success = 0;
$echec = "abonnement à la chaine échoue veuillez resseyer";

if ($_SERVER["REQUEST_METHOD"] === "POST") {   
   
    // Récupération des paramètres offset et limit de la requête GET
    $idUsing = isset($_POST['idusing']) ? (int)$_POST['idusing'] : null;
    if ($idUser != null && $idUsing != null) {

        $sqsadd = "INSERT INTO ds_abonnements(id_user, id_visiteur) VALUES(?,?)";
        $this_addAbn = $bdd->prepare($sqsadd);
        $this_addAbn->execute([$idUser, $idUsing]);

        $success = 1;
        $echec = "abonnement avec success";
    }else{
    $echec = "echec parametre incomplet idusing ";
    }

    $respx = ["success" => $success, "echec" => $echec];
    echo json_encode($respx);
}


?>