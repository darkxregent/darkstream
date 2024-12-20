<?php
require_once('../maint/allact.php');

    header("Content-Type: text/xml");

    echo('<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>');
    
    echo('<response 
    style="
    display: flex;
    flex-direction: column;
    ">');

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_stream = $_POST['id_stream'] ?? null;
        $offset = (int)$_POST['offset'] ?? 0;
        $limit = (int)$_POST['limit'] ?? 15;

        // recuperation des commentaires
        if ($id_stream != null) {
            $reqsetcmmt = "SELECT * FROM ds_commentaires WHERE id_stream = ? ORDER BY id_commentaire DESC LIMIT $offset,$limit";
            $set_cmmt = $bdd -> prepare($reqsetcmmt);
            $set_cmmt -> execute([$id_stream]);
            $set_all_cmmt = $set_cmmt -> fetchall();

            if (count($set_all_cmmt) != 0) {

                for ($i=0; $i < count($set_all_cmmt); $i++) { 
                    $Temps_cmmt = calculerTempsEcoule($set_all_cmmt[$i]['date']);
                    // information du visiteur (cmmt)
                    $requser = "SELECT * FROM ds_user WHERE id_user = ?";
                    $set_cmmt_user = $bdd -> prepare($requser);
                    $set_cmmt_user -> execute([$set_all_cmmt[$i]['id_visiteur']]);
                    $set_all_cmmt_user = $set_cmmt_user -> fetchall();  
                    ?>

                        <!-- Example comment card -->
                        <div class="cards_comm">
                            <a href=""><img src="<?=$darkhost?>/media/ds_avatars/<?=$set_all_cmmt_user[0]['avatar']?>" class="prof_comm_ext"></a>
                            <div class="info_comm_messages">
                                <a href="" class="comm_Pseudo"><?=$set_all_cmmt_user[0]['pseudo']?></a>
                                <p class="messages_comm"><?=$set_all_cmmt[$i]['commentaire']?></p>
                                <div class="repx_comm" data-comm="<?=$set_all_cmmt[$i]['id_commentaire']?>">
                                    <div class="edit_messages">
                                        <?php 
                                        if ($set_all_cmmt_user[0]['id_user'] == $_SESSION["id_user"]) {
                                        ?>
                                            <a class="supr_comm" onclick="suprCommt(<?=$set_all_cmmt[$i]['id_commentaire']?>,'M1')">Suprimer</a>
                                        <?php
                                        }
                                        ?>
                                        <a class="Repond_comm" onclick="changeRepForom(this)">Repondre</a>
                                    </div>
                                    <p class="comm_durre">il y as <?=$Temps_cmmt?></p> <!-- Comment timestamp -->
                                </div>
                                <div class="reponx_reponx">
                                        
                                    
                    
                    <?php 

                    // recuperation des reponse aux commentaires
                    $reqsetrep = "SELECT * FROM ds_resp_cmmt WHERE id_commentaire = ? ORDER BY No DESC";
                    $set_resp = $bdd -> prepare($reqsetrep);
                    $set_resp -> execute([$set_all_cmmt[$i]['id_commentaire']]);
                    $set_all_resp = $set_resp -> fetchall();
                    
                    if (count($set_all_resp) != 0) {
                        
                        for ($e=0; $e < count($set_all_resp); $e++) { 
                            $Temps_resp = calculerTempsEcoule($set_all_resp[$e]['date']);
                            // information du visiteur (resp)
                            $requser = "SELECT * FROM ds_user WHERE id_user = ?";
                            $set_resp_user = $bdd -> prepare($requser);
                            $set_resp_user -> execute([$set_all_resp[$e]['id_visiteur']]);
                            $set_all_resp_user = $set_resp_user -> fetchall();

                            ?>

                                        <!-- Reply to comment -->
                                        <div class="cards_comm">
                                            <a href=""><img src="<?=$darkhost?>/media/ds_avatars/<?=$set_all_resp_user[0]['avatar']?>" class="prof_comm_ext"></a>
                                            <div class="info_comm_messages">
                                                <a href="" class="comm_Pseudo"><?=$set_all_resp_user[0]['pseudo']?></a>
                                                <p class="messages_comm"><?=$set_all_resp[$e]['commentaire']?></p>
                                                <div class="repx_comm" data-comm="<?=$set_all_cmmt[$i]['id_commentaire']?>">
                                                    <div class="edit_messages">
                                                    <?php 
                                                    if ($set_all_resp_user[0]['id_user'] == $_SESSION["id_user"]) {
                                                    ?>
                                                        <a class="supr_comm" onclick="suprCommt(<?=$set_all_resp[$e]['No']?>,'R1')">Suprimer</a>
                                                    <?php
                                                    }
                                                    ?>
                                                        <a class="Repond_comm" onclick="changeRepForom(this)">Repondre</a>
                                                    </div>
                                                    <p class="comm_durre">il y as <?=$Temps_resp?></p> <!-- Reply timestamp -->
                                                </div>
                                            </div>
                                        </div>
                            <?php 

                        }
                    }
                ?>
                            </div>
                        </div>
                    </div>
                <?php 
                }
            }else {
                echo("<div class='commt_erreur'>aucun Commentaires pour le moment ; Soyer le premier à commenter</div>");
            }
        }else {
            echo("Une erreur c'est produite veuille raffrechire la page!");
        }
    }

    echo('</response>');

?>