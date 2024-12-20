<?php
    require_once('maint/allact.php');
    require('maint/indexact.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/CarDstyles.css">
    <title>Bienvenue Sur darkStream</title>
</head>
    <?php
        require('includes/allhead.php');
    ?>
<body>
    <!-- conteneurs de tous les elements intergres au site -->
    <div class="ds_content_allcard">
        <!-- coteneurs des cadres du body (les styles videos) -->
        <div class="allcard_content">
            <!-- conteneurs des cadres -->
            <?php 
            for ($o=0; $o< count($allcardcontent) ; $o++) {
                $id_stream = $allcardcontent[$o]['id_stream'];
                $id_st_user = $allcardcontent[$o]['id_user'];
                $ds_titre = $allcardcontent[$o]['titre'];
                $ds_stream = $darkhost."/media/ds_videos/".$allcardcontent[$o]['stream'];
                $ds_couver = $darkhost."/media/ds_couvers/".$allcardcontent[$o]['couver'];
                $ds_times_pass = $allcardcontent[$o]['date'];
                $ds_times = calculerTempsEcoule($ds_times_pass);
                
                $sqlx = "SELECT * FROM ds_user WHERE id_user = ? ";
                $usered = $bdd->prepare($sqlx);
                $usered->execute([$id_st_user]);
                $usering = $usered->fetch();

                $user_pseudo = $usering['pseudo'];
                $user_avatar =  $darkhost."/media/ds_avatars/".$usering['avatar'];

                $countvue = $bdd -> prepare("SELECT * FROM ds_vues WHERE id_stream=?");
                $countvue -> execute([$id_stream]);
                $allcountvuex = $countvue -> fetchall();

                if (count($allcountvuex) != 0) {
                    $strean_vue['vue'] = formatVues($allcountvuex[0]['vue']);
                }else {
                    $strean_vue['vue'] = "Aucune vue";
                }
                
            ?>
            <div class="card_content">
                <a href="<?=$darkhost?>/stream?dsplayer=<?=$id_stream?>">
                    <video src="<?=$ds_stream?>" poster="<?=$ds_couver?>" class="vid_extrait" id="vid_plays"></video>
                </a>
                <div class="if_vid_card">
                    <a href="<?=$darkhost?>/users?id_using=<?=$id_st_user?>&videos"><img src="<?=$user_avatar?>" alt="" class="card_profile" width="45" height="45"></a>
                    <div class="if_card">
                        <p href="<?=$darkhost?>/stream?dsplayer=<?=$id_stream?>" class="card_tr">
                            <a href="<?=$darkhost?>/stream?dsplayer=<?=$id_stream?>"><?=$ds_titre?></a>
                        </p>
                        <div class="prod">
                            <a href="<?=$darkhost?>/users?id_using=<?=$id_st_user?>&videos" class="card_prod">
                            <?=$user_pseudo?>
                            </a>
                            <p class="card_card_times">
                            <?=$strean_vue['vue']?> - <?=$ds_times?>
                            </p>
                        </div>
                        
                    </div>
                </div>

            </div>
            <?php 
            }
            ?>



            
        </div>
        <div class="paginage">
            <a href="?idcath=<?=$idCath?>&pages=<?=$Npages-1?>" class="deplaseing">Retourne</a>
            <ul class="pagelist">
                <?php
                $rNPages = $Npages - 2;
                $sNPages = $Npages + 2;
                if ($Npages > 10) {
                    $sopages = $Npages-10;
                    echo("<li><a href='$darkhost/index?idcath=$idCath&pages=$sopages'>-10</a></li>");
                }
                if ($rNPages > 1) {
                    echo("<li>. . .</li>");
                }
                
                for ($i=0; $i <$nbrPages ; $i++) { 
                    $pading = $i + 1;
                    if ($Npages == $pading) {
                        echo("<li class='pageselect'>$pading</li>");
                    }elseif ($rNPages <= $pading AND $pading <= $sNPages) {
                        echo("<li><a href='$darkhost/index?idcath=$idCath&pages=$Npages'>$pading</a></li>");
                    }
                }

                if ($nbrPages > $sNPages) {
                    echo("<li>. . .</li>");
                }
                if (($nbrPages-$Npages) > 10) {
                    $sopages = $Npages+10;
                    echo("<li><a href='$darkhost/index?idcath=$idCath&pages=$sopages'>+10</a></li>");
                }
                ?>
            </ul>
            <a href="?idcath=<?=$idCath?>&pages=<?=$Npages+1?>" class="deplaseing">Suivente</a>
        </div>
        <?php
            require('includes/allfood.php');
        ?>
    </div>
</body>
   
<script src="script/indexscript.js"></script>
</html>