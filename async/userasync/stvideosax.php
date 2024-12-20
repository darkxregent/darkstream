<?php
require_once('../../maint/allact.php');


$idUser = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null; // Récupération de l'ID utilisateur de la session
$id_rec_option = isset($_COOKIE['myoption']) ? $_COOKIE['myoption'] : null; // Récupération de l'option depuis le cookie


// Récupération des paramètres offset et limit de la requête GET
$idUsing = isset($_GET['idusing']) ? (int)$_GET['idusing'] : $idUser;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;

$sqrvideos = "SELECT * FROM ds_stream WHERE id_user = ? AND id_option = ? LIMIT ?, ?";
$this_videos = $bdd->prepare($sqrvideos);
$this_videos->bindParam(1, $idUsing, PDO::PARAM_INT);
$this_videos->bindParam(2, $id_rec_option, PDO::PARAM_INT);
$this_videos->bindParam(3, $offset, PDO::PARAM_INT);
$this_videos->bindParam(4, $limit, PDO::PARAM_INT);
$this_videos->execute();
$myAllVideos = $this_videos->fetchAll(PDO::FETCH_ASSOC);

$videos = array(); // Tableau pour stocker les vidéos
foreach ($myAllVideos as $video) {
    $videos[] = [
        'idStream' => $darkhost . "/stream?dsplayer=" . $video['id_stream'],
        'stream' => $darkhost . "/media/ds_videos/" . $video['stream'],
        'couver' => $darkhost . "/media/ds_couvers/" . $video['couver'],
        'titre' => $video['titre']
    ];
}

echo json_encode($videos); // Envoyer les vidéos en format JSON






    // session_start();
    // $darkhost = 'http://'.$_SERVER['HTTP_HOST'];
    // $ismobiles = strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"mobile");
    // $serveur = 'localhost';
    // $nom = 'root';
    // $pass = '';
    // try {
    //     $bdd = new PDO("mysql:host=$serveur;dbname=streaming", $nom, $pass);
    //     $bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // }catch (PDOException $e) {
    //     echo('Connexion a la bdd  refuse type : ' .$e -> getmessage());
    // }
    
    // $id_rec_option = $_COOKIE['myoption'];
    // $idUsing = 15;


    // $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
    // $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20;

    // $sqrvideos = "SELECT * FROM ds_stream WHERE id_user = ? AND id_option = ? LIMIT ?, ?";
    // $this_videos = $bdd->prepare($sqrvideos);
    // $this_videos->execute([$idUsing, $id_rec_option, $offset, $limit]);
    // $myAllVideos = $this_videos->fetchAll(PDO::FETCH_ASSOC);

    // $videos = array();
    // foreach ($myAllVideos as $video) {
    //     $videos[] = [
    //         'stream' => $darkhost."/media/ds_videos/".$video['stream'],
    //         'couver' => $darkhost."/media/ds_couvers/".$video['couver'],
    //         'titre' => $video['titre']
    //     ];
    // }

    // echo json_encode($videos);
?>
