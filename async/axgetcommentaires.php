<?php
require_once('../maint/allact.php');

$idVisiteur = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null; // Récupération de l'ID utilisateur de la session
$success = 0;
$message = "Échec de l'envoi du commentaire !";

if ($_SERVER["REQUEST_METHOD"] === "POST") {   
    $idStream = $_POST['id_stream'] ?? null;
    $textMessageCommt = $_POST['comm_message'] ?? null;
    $idcommtofRepx = isset($_POST['id_comm']) ? (int)$_POST['id_comm'] : null;
    $dateTime = time();

    if ($idVisiteur != null && $idStream != null && $textMessageCommt != null) {
        if ($idcommtofRepx == null) {
            // Code pour envoyer un commentaire
            $sqlcommtx = "INSERT INTO ds_commentaires (id_stream, id_visiteur, commentaire, date) VALUES (?,?,?,?)";
            $this_commtx = $bdd->prepare($sqlcommtx);
            
            if ($this_commtx->execute([$idStream, $idVisiteur, $textMessageCommt, $dateTime])) {
                $success = 1;
                $message = "Commentaire ajouté avec succès.";
            } else {
                $message = "Erreur lors de l'ajout du commentaire.";
            }
        } else {
            // Code pour envoyer une réponse au commentaire
            $sqlrepcom = "INSERT INTO ds_resp_cmmt (id_commentaire, id_visiteur, commentaire, date) VALUES (?,?,?,?)";
            $this_repcom = $bdd->prepare($sqlrepcom);
            
            if ($this_repcom->execute([$idcommtofRepx, $idVisiteur, $textMessageCommt, $dateTime])) {
                $success = 1;
                $message = "Réponse ajoutée avec succès.";
            } else {
                $message = "Erreur lors de l'ajout de la réponse.";
            }
        }
    }

    $respx = ["success" => $success, "message" => $message];
    echo json_encode($respx);
}
?>
