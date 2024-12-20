<?php
    // Include necessary files for player functionality and actions
    require_once('maint/allact.php'); // All actions related to the player
    require_once('maint/searchact.php'); // All search resultat 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/herfcardstyles.css">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/sEarchstyles.css">
    <title>Document</title>
</head>
    <?php
        // Include the common header for the site
        require('includes/allhead.php');
        if (!$ismobiles) {
    ?>
    <style>
        .content_cath{
            display: none;
        }
        .content_nav{
            top:50px;
        }
        </style>
        <?php
            }
        ?>
        <style>
        .content_cath{
            display: none;
        }
    </style>
<body>
    <div class="ds_content_search">
        <!-- Result Of Search -->
        <div class="ds_watch_search">
            <span>Result Of Search : </span>
            <span> <?=$_GET["search_q"]?></span>
        </div>

        <!-- Suggestions videos on the search -->
        <?php if ($user_results) {?>
        <div class="search_user_content">
            <?php 
            foreach ($user_results as  $userelements) {
                ?>
                <div class="search_user">
                    <a href="<?=$darkhost?>/users?id_using=<?=$userelements["id_user"]?>&videos">
                        <img src="<?=$darkhost?>/media/ds_avatars/<?=$userelements["avatar"]?>" class="search_user_prof" alt=""></a>
                    <a href="<?=$darkhost?>/users?id_using=<?=$userelements["id_user"]?>&videos"><h4><?=$userelements["pseudo"]?></h4></a>
                </div>
                <?php
            }
            ?>
        </div>
        <?php  
        }?>

        <div class="other_stream_content">

            <?php 
            // Génération de l'affichage des résultats
            if ($cachedResults) {
                echo $cachedResults;
            }elseif ($results) {
                foreach ($results as $queryelements) {
                    $ds_id_stream = $queryelements["id_stream"];
                    $ds_id_user = $queryelements["id_user"];
                    $ds_desx = $queryelements["description"];
                    $ds_durre = $queryelements["durre"];

                    $ds_stream = $queryelements["stream"];
                    $ds_couver = $queryelements["couver"];

                    $ds_times = calculerTempsEcoule($queryelements["date"]);

                        $d_user = $bdd->prepare("SELECT * FROM ds_user 
                        WHERE id_user = :query");
                        $d_user->execute(['query' => $ds_id_user ]);
                    
                        // Récupération des résultats
                        $d_user_results = $d_user->fetchAll(PDO::FETCH_ASSOC);
                ?> 
                       
                    <div class="other_card_content">
                        <a href="<?=$darkhost?>/stream?dsplayer=<?=$ds_id_stream?>" class="herf_for_video"> 
                            <video src="<?=$darkhost?>/media/ds_videos/<?=$ds_stream?>"  id="videoExtra" poster="<?=$darkhost?>/media/ds_couvers/<?=$ds_couver?>" class="" ></video>
                        </a>
                        <div class="herf_info_video">
                            <a href="<?=$darkhost?>/stream?dsplayer=<?=$ds_id_stream?>" class="herf_video_titre">
                            SUIVONT : <?=$queryelements["titre"]?>
                            </a>
                            <div class="herf_profil">
                                <a href="<?=$darkhost?>/users?id_using=<?=$ds_id_user?>&videos"><img  class="herf_avatar" src="<?=$darkhost?>/media/ds_avatars/<?=$d_user_results[0]['avatar']?>" alt=""></a>
                                <a href="<?=$darkhost?>/users?id_using=<?=$ds_id_user?>&videos"><h5 class="herf_pseudo"><?=$d_user_results[0]['pseudo']?> </h5></a>
                            </div>
                            <div class="herf_other_info">
                                <span class="herf_durre">Durrée : <?=$ds_durre?></span>
                                <div>
                                    <span class="herf_vues"> Vues  </span>
                                    <span class="herf_update">il y à <?=$ds_times?> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php

                }
            }
             else {
                $output = "<div class='or_no_query'>Aucun résultat trouvé pour : << ".$_GET['search_q']." >></div>";
                echo $output;
            }

            ?>

            
        </div>




        <!-- Autres Subjection de contenu similaire -->
        <div class="ds_watch_search other">
            Autres Subjection de contenu
        </div>

        <!-- Suggestions for other videos on the search -->

        <?php 
            if ($resultatsRecherche) {
            foreach ($resultatsRecherche as $queryelementsother) {
                        $ds_id_stream = $queryelementsother["id_stream"];
                        $ds_id_user = $queryelementsother["id_user"];
                        $ds_desx = $queryelementsother["description"];
                        $ds_durre = $queryelementsother["durre"];

                        $ds_stream = $queryelementsother["stream"];
                        $ds_couver = $queryelementsother["couver"];

                        $ds_times = calculerTempsEcoule($queryelementsother["date"]);
                            
                                $d_user = $bdd->prepare("SELECT * FROM ds_user 
                                WHERE id_user = :query");
                                $d_user->execute(['query' => $ds_id_user ]);
                            
                                // Récupération des résultats
                                $d_user_results = $d_user->fetchAll(PDO::FETCH_ASSOC);
                    ?> 
                           
                        <div class="other_card_content">
                            <a href="<?=$darkhost?>/stream?dsplayer=<?=$ds_id_stream?>" class="herf_for_video"> 
                                <video src="<?=$darkhost?>/media/ds_videos/<?=$ds_stream?>" id="videoExtra" poster="<?=$darkhost?>/media/ds_couvers/<?=$ds_couver?>" class="" ></video>
                            </a>
                            <div class="herf_info_video">
                                <a href="<?=$darkhost?>/stream?dsplayer=<?=$ds_id_stream?>" class="herf_video_titre">
                                SUIVONT : <?=$queryelementsother["titre"]?>
                                </a>
                                <div class="herf_profil">
                                    <a href="<?=$darkhost?>/users?id_using=<?=$ds_id_user?>&videos"><img  class="herf_avatar" src="<?=$darkhost?>/media/ds_avatars/<?=$d_user_results[0]['avatar']?>" alt=""></a>
                                    <a href="<?=$darkhost?>/users?id_using=<?=$ds_id_user?>&videos"><h5 class="herf_pseudo"><?=$d_user_results[0]['pseudo']?> </h5></a>
                                </div>
                                <div class="herf_other_info">
                                    <span class="herf_durre">Durrée : <?=$ds_durre?></span>
                                    <div>
                                        <span class="herf_vues"> Vues  </span>
                                        <span class="herf_update">il y à <?=$ds_times?> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                }
            }else {
                $output = "<div class='or_no_query'>Aucun résultat trouvé.</div>";
            }

            ?>
 
        </div>





    </div>
</body>
<script src="script/searchscript.js"></script>
</html>



