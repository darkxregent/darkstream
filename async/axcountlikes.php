<?php
require_once('../maint/allact.php');

$idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null; // Récupération de l'ID utilisateur de la session
$success = 0;
$error = "ERREUR, veuillez réessayer.";
$NbnLike = "0";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idVidPlay = isset($_POST['id_vid_play']) ? $_POST['id_vid_play'] : null;
    $idPlayeur = isset($_POST['id_playeur']) ? (int)$_POST['id_playeur'] : null;
    $likType = isset($_POST['likType']) ? $_POST['likType'] : null;
    if ($idUser != null && $idVidPlay != null && $idPlayeur != null ) {
        try {
            $sqslike = "SELECT * FROM ds_likes WHERE id_stream=? AND id_user_stream=? AND id_user =? AND liked =?";
            $this_sellike = $bdd->prepare($sqslike);
            $this_sellike->execute([$idVidPlay, $idPlayeur, $idUser, $likType]);
            $all_selLike = $this_sellike->fetchAll();
            $countallLike = count($all_selLike); 
                   
            $NbnLike = formatLikes($countallLike);
            $success = 1;
            $error = "Traitement terminé avec succès.";


        } catch (Exception $e) {
            $error = "Erreur de traitement : " . $e->getMessage();
        }
    } else {
        $error = "Information insuvissente !";
    }

    // Réponse JSON
    $respx = ["success" => $success, "error" => $error, "NbnLike" => $NbnLike];
    echo json_encode($respx);
}
?>

