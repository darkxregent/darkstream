
<?php
require('../maint/allact.php');

$id_user = $_SESSION['id_user'];
$success = 0;
$up_echec = "";


function setRandomStringId($length = 18) {
    // Define the characters to be used in the random string
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = 'src_';

    // Generate the remaining characters
    for ($i = 0; $i < $length - strlen($randomString); $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_ds_stream = setRandomStringId();
    if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] == UPLOAD_ERR_OK) {
        $up_files = $_FILES['uploadfile'];
        $allFileTypes = ['video/mp4'];
        if (in_array($up_files['type'], $allFileTypes)) {
            $uploadFileDir = '../media/ds_videos/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            $my_titre = !empty($_POST['mytitle']) ? analyse($_POST['mytitle']) : null;
            $my_disc = !empty($_POST['disc']) ? analyse($_POST['disc']) : null;
            $my_tags = !empty($_POST['tag']) ? analyse($_POST['tag']) : null;
            $my_option = !empty($_POST['option']) ? analyse($_POST['option']) : null;
            $my_cath = !empty($_POST['cath']) ? analyse($_POST['cath']) : null;
            $issetPlaylist = !empty($_POST['issetPlaylist']) ? analyse($_POST['issetPlaylist']) : null;
            $addPlaylist = !empty($_POST['addPlaylist']) ? analyse($_POST['addPlaylist']) : null;
            $mycanvas_name = !empty($_POST['mycanvas']) ? analyse($_POST['mycanvas']) : null;
            $fileduration = !empty($_POST['times']) ? analyse($_POST['times']) : null;

            if ($my_titre && $my_disc && $my_tags && $my_option && $my_cath !== null) {
                $id_playlist = 0;
                if ($issetPlaylist !== null ) {
                    $id_playlist = $issetPlaylist;
                }

                if ($addPlaylist !== null ) {
                    $reqplx = "SELECT * FROM ds_playlists WHERE id_user = ? AND id_option = ? AND playlist = ?";
                    $selpl = $bdd->prepare($reqplx);
                    $selpl->execute(array($id_user, $my_option, $addPlaylist));
                    $setplx = $selpl->fetchAll();

                    if (count($setplx) == 0) {
                        $reqpl = "INSERT INTO ds_playlists(id_user, id_option, playlist) VALUES(?, ?, ?)";
                        $setpl = $bdd->prepare($reqpl);
                        $setpl->execute(array($id_user, $my_option, $addPlaylist));
                        $id_playlist = $bdd->lastInsertId("id_playlist");
                    } else {
                        $id_playlist = $setplx[0]['id_playlist'];
                    }
                }
                if ($mycanvas_name !== null) {
                    $up_couver_name = $mycanvas_name;
                } else {
                    if (isset($_FILES['couvers']) && $_FILES['couvers']['error'] == UPLOAD_ERR_OK) {
                        $my_couvers = $_FILES['couvers'];
                        $allCouverTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                        $maxSize = 12 * 1024 * 1024; // 12MB en octets
                        if (in_array($my_couvers['type'], $allCouverTypes) && $my_couvers['size'] <= $maxSize) {
                            $uploadCouverDir = '../media/ds_couvers/';
                            if (!is_dir($uploadCouverDir)) {
                                mkdir($uploadCouverDir, 0777, true);
                            }
                            $extension = pathinfo($my_couvers['name'], PATHINFO_EXTENSION);
                            $couverName = 'cavx_' . uniqid() . '.' . $extension;
                            $url_couver = $uploadCouverDir . $couverName;

                            if (move_uploaded_file($my_couvers['tmp_name'], $url_couver)) {
                                $up_couver_name = $couverName;

                            } else {
                                $up_echec = "Erreur lors du téléchargement de l'image.";
                            }
                        } else {
                            $up_echec = "L'image sélectionnée n'est pas prise en charge ou dépasse 12 Mo.";
                        }
                    } else {
                        $up_echec = "La couverture a été mal sélectionnée.";
                    }
                }
                
                $filExtension = pathinfo($up_files['name'], PATHINFO_EXTENSION);
                $fileName = 'src_' . uniqid() . '.' . $filExtension;
                $url_file = $uploadFileDir . $fileName;

                if (move_uploaded_file($up_files['tmp_name'], $url_file)) {
                    $up_file_name = $fileName;
                    $fileSize = $up_files['size'];
                    $my_date = time();

                    // Insérer les données dans la base de données
                    $req = "INSERT INTO ds_stream (id_stream, id_user, id_option, id_categorie, id_playlist, titre, description, tag, stream, couver, size, durre, date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $bdd->prepare($req);
                    $stmt->execute([
                        $id_ds_stream, $id_user, $my_option, $my_cath, $id_playlist, $my_titre,
                        $my_disc, $my_tags, $up_file_name, $up_couver_name, $fileSize, $fileduration, $my_date
                    ]);

                    $success = 1;
                    $up_echec = "Votre vidéo a été publiée. Veuillez attendre la vérification des informations.";
                } else {
                    $up_echec = "Erreur lors du téléchargement de la vidéo.";
                }

            } else {
                $up_echec = "Veuillez remplir tous les champs.";
            }
        } else {
            $up_echec = "La vidéo sélectionnée n'est pas prise en charge.";
        }
    } else {
        $up_echec = "La vidéo a été mal sélectionnée.";
    }

    $respx = ["success" => $success, "up_echec" => $up_echec];
    echo json_encode($respx);
}
?>
