<?php
require_once('../maint/allact.php');
$idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null; // Récupération de l'ID utilisateur de la session
$success = 0;
$echec = "trop de clicks sur le bouton de like";

if ($_SERVER["REQUEST_METHOD"] === "POST") {   
    $idVidPlay = isset($_POST['id_vid_play']) ? $_POST['id_vid_play'] : null;
    $idPlayeur = isset($_POST['id_playeur']) ? (int)$_POST['id_playeur'] : null;
    $liked = $_POST['liked'];
    if ($idUser != null && $idVidPlay != null && $idPlayeur != null && $liked != null) {

        
        $sqsesh = "SELECT * FROM ds_likes WHERE id_stream=? AND id_user_stream=? AND id_user =?";
        $this_selx = $bdd->prepare($sqsesh);
        $this_selx->execute([$idVidPlay, $idPlayeur, $idUser]);
        $all_sellikx = $this_selx -> fetchall();

        $countAll_sellikx = count($all_sellikx);

        
        if ($countAll_sellikx == 0)  {

            $sqseshlk = "INSERT INTO ds_likes (id_stream, id_user_stream, id_user, liked) VALUES (?,?,?,?)";
            $this_sellkx = $bdd->prepare($sqseshlk);
            $this_sellkx->execute([$idVidPlay, $idPlayeur, $idUser, $liked]);

            $success = 1;
        }elseif ($countAll_sellikx == 1)  {

            $sqseshlk = "UPDATE ds_likes SET liked = $liked WHERE id_stream=? AND id_user_stream=? AND id_user =?";
            $this_sellkx = $bdd->prepare($sqseshlk);
            $this_sellkx->execute([$idVidPlay, $idPlayeur, $idUser]);

            $success = 1;
        }else{

            $sqseshlk = "DELETE FROM ds_likes WHERE id_stream=? AND id_user_stream=? AND id_user =?";
            $this_sellkx = $bdd->prepare($sqseshlk);
            $this_sellkx->execute([$idVidPlay, $idPlayeur, $idUser]);

            $success = 1;
        }
        if ($success == 1) {
            $echec = "mercie pour votres avies ";
        }
        

    }

    $respx = ["success" => $success, "echec" => $echec];
    echo json_encode($respx);
}

?>