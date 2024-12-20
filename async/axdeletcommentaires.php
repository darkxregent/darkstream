<?php
require_once('../maint/allact.php');

$idVisiteur = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null; // Récupération de l'ID utilisateur de la session
$success = 0;
$message = "Échec de la supretion du commentaire !";

if ($_SERVER["REQUEST_METHOD"] === "POST") {   
    $idCommt = $_POST['id_delet'] ?? null;
    $commType = $_POST['commtType'] ?? null;

    if ($idCommt != null && $commType != null) {
        if ($commType == "M1") {

            $sqlcommtrx = "SELECT * FROM ds_resp_cmmt WHERE id_commentaire = ? AND id_visiteur = ?";
            $this_allcommtx = $bdd->prepare($sqlcommtrx);
            $this_allcommtx->execute([$idCommt, $idVisiteur]);
            $delet_all_repx = $this_allcommtx->fetchall();
            if (count($delet_all_repx) != 0) {
                $sqlrepx = "DELETE FROM ds_resp_cmmt WHERE id_commentaire = ? AND id_visiteur = ?";
                $this_repx = $bdd->prepare($sqlrepx);
                $this_repx->execute([$idCommt, $idVisiteur]);
            }
            // Code pour suprime un commentaire
            $sqlcommtx = "DELETE FROM ds_commentaires WHERE id_commentaire = ? AND id_visiteur = ?";
            $this_commtx = $bdd->prepare($sqlcommtx);
            if ($this_commtx->execute([$idCommt, $idVisiteur])) {

                $success = 1;
                $message = "Commentaire suprimer avec succes.";
            } else {
                $message = "Erreur lors de la supretion du commentaire.";
            }
        } else {
            // Code pour envoyer une réponse au commentaire
            $sqlrepcom = "DELETE FROM ds_resp_cmmt WHERE No = ? AND id_visiteur = ?";
            $this_repcom = $bdd->prepare($sqlrepcom);
            
            if ($this_repcom->execute([$idCommt, $idVisiteur])) {
                $success = 1;
                $message = "Reponse suprimer avec succes.";
            } else {
                $message = "Erreur lors la supretion de la réponse.";
            }
        }
    }else {
        $message = "Une erreur c'est produite veuille raffrechire la page!";
    }

    $respx = ["success" => $success, "message" => $message];
    echo json_encode($respx);
}
?>
