<?php
require_once('../maint/allact.php');

$success = 0;
$error = "Abonnement à la chaîne échoué, veuillez réessayer.";
$change = "000000";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $idUsing = isset($_GET['idusing']) ? (int)$_GET['idusing'] : null;

    if ($idUsing !== null) {
        try {
            $sqsesh = "SELECT * FROM ds_abonnements WHERE id_visiteur = ?";
            $this_selAbn = $bdd->prepare($sqsesh);
            $this_selAbn->execute([$idUsing]);
            $all_selAbon = $this_selAbn->fetchAll();
            $countallabn = count($all_selAbon);

            
            $success = 1;
            $error = "Traitement terminé avec succès.";
             // Formater le nombre d'abonnés
             $change = formaterAbonnes($countallabn);
        } catch (Exception $e) {
            $error = "Erreur de traitement : " . $e->getMessage();
        }
    } else {
        $error = "ID de l'utilisateur manquant ou invalide.";
    }

    // Réponse JSON
    $respx = ["success" => $success, "error" => $error, "change" => $change];
    echo json_encode($respx);
}
?>

