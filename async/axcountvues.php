<?php
require_once('../maint/allact.php');
$success = 0;
$echec = "erreur tragiques est survenue";

if ($_SERVER["REQUEST_METHOD"] === "POST") {   
    $idStream = $_POST['id_stream'] ?? null;
    if ($idStream != null ) {

        
        $this_selx = $bdd->prepare("SELECT * FROM ds_vues WHERE id_stream=?");
        $this_selx->execute([$idStream]);
        $all_selvuex = $this_selx -> fetchall();

        $countAll_selvuex = count($all_selvuex);

        
        if ($countAll_selvuex == 0)  {
            $nbrVuex = 1; 
            $this_selvux = $bdd->prepare( "INSERT INTO ds_vues (id_stream, vue) VALUES (?,?)");
            $this_selvux->execute([$idStream, $nbrVuex]);

            $success = 1;
        }else {
            $nbrVuex = $all_selvuex[0]["vue"];
            $nbrVuex ++; 
            $sqseshvx = "UPDATE ds_vues SET vue = $nbrVuex WHERE id_stream=?";
            $this_selvux = $bdd->prepare($sqseshvx);
            $this_selvux->execute([$idStream]);

            $success = 1;
        }
        if ($success == 1) {
            $echec = "bon visionnage et abonner vous sur cette chaime !";
        }
        

    }

    $respx = ["success" => $success, "echec" => $echec];
    echo json_encode($respx);
}

?>