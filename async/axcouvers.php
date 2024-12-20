<?php
require('../maint/allact.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['image'])) {
    $myUploaddDir = "../media/ds_couvers/";
    if (isset($_POST['mycavsContent']) && !empty($_POST['mycavsContent'])) {
        
        if (!is_dir($myUploaddDir)) {
            mkdir($myUploaddDir, 0777, true);
        }
        $cavxName = $_POST['mycavsContent'];
        $cavxUrl = $myUploaddDir .$cavxName;
        if (file_exists($cavxUrl)) {
            unlink($cavxUrl);
        }
    }
    $fileName = $_FILES['image']['name']; // Le nom original du fichier   
    $fileType = $_FILES['image']['type']; // Le type du fichier (ex: image/webp)
    $fileSizei = $_FILES['image']['size'];
    $fileTmpName = $_FILES['image']['tmp_name']; // Le nom temporaire du fichier
    $romdfilesi = "cavx_" . uniqid() . ".jpeg"; // Le nouveau nom du fichier
    $chenincouver = $myUploaddDir .$romdfilesi;
    $couverCanvas = move_uploaded_file($fileTmpName, $chenincouver);

    echo json_encode(['recu' => 1 , 'cavx' => $romdfilesi]);
}else{
    $errorcavx = "une error sais produit, veillez resillez";
    echo json_encode(['recu' => 0 , 'cavx' => $errorcavx]);
}



?>