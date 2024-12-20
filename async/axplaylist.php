<?php
require('../maint/allact.php');
    header("Content-Type: text/xml");

    echo('<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>');

    echo('<response>');
    $id_user = $_SESSION['id_user'];
    $id_option = $_POST['options'];
        echo('<label for="issetPlaylist">Ajoute dans une Playlist</label>');
        echo('<select name="issetPlaylist" id="issetPlaylist" class="issetPlaylist">');
        if ($id_option != 0) {
        
            $reqpl = "SELECT * FROM ds_playlists WHERE id_user = ? AND id_option = ?";
            $selectplx = $bdd -> prepare($reqpl);
            $selectplx -> execute(array($id_user, $id_option));
            $set_plx = $selectplx -> fetchall();
            if(count($set_plx) > 0) {
                echo('<option value="">Aucune Playlists selectionner</option>');
                for ($a=0; $a < count($set_plx); $a++) {
                    $id_playlist = $set_plx[$a]['id_playlist'];
                    $my_playlist = $set_plx[$a]['playlist'];
                    
                    echo("<option value='$id_playlist'>$my_playlist</option>");
                }
            }else{
                echo('<option value="">cree une nouvelle playlist pour cette option</option>');
            }  
        } else {
            echo('<option value="">aucun playlist n\'a été selectionner</option>');
        }
        echo('</select>');
    echo('</response>');
?>
