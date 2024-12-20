<?php
require('../maint/allact.php');
    header("Content-Type: text/xml");

    echo('<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>');

    echo('<response>');
    $id_option = $_POST['options'];
        echo('<label for="cath">Selectionner une cathegories d\'option</label>');
        echo('<select class="cath" name="cath" id="cath">');
            if ($id_option != 0) {
            
                $reqcath = "SELECT * FROM ds_categories WHERE id_option = ?";
                $selectcath = $bdd -> prepare($reqcath);
                $selectcath -> execute(array($id_option));
                $set_cath = $selectcath -> fetchall();
        
                if(count($set_cath) > 0) {
                    echo('<option value="">aucune cathegorie n\'a été selectionner</option>');
                    for ($a=0; $a < count($set_cath); $a++) {
                        $id_cath = $set_cath[$a]['id_categorie'];
                        $cath = $set_cath[$a]['categorie'];
                        
                        echo("<option value='$id_cath'>$cath</option>");
                    }
                }else{
                    echo('<option value="">aucune cathegorie n\'a été selectionner</option>');
                }  
            } else {
                echo('<option value="">aucune cathegorie n\'a été selectionner</option>');
            }

        echo('</select>');
    echo('</response>');
?>
