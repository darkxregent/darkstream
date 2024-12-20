<?php
    require_once('../maint/allact.php');
    $idUser = $_SESSION['id_user'];
    $idUsing = isset($_GET["id_using"]) ? $_GET["id_using"] : null;
    require('../maint/alluseract.php');


    function addclasse($varx){
        if (isset($_GET[$varx])) {
            $text = "class=typeActif";
            echo $text;
        }
    }

    if (isset($_GET['params'])) {
        $encodedParams = $_GET['params'];
        $decodedParams = base64_decode($encodedParams);
        parse_str($decodedParams, $params);
    
        // Reconstruire l'URL avec les paramètres décodés
        $baseUrl = strtok($_SERVER["REQUEST_URI"], '?');
        $newQuery = http_build_query($params);
        $newUrl = $baseUrl . '?' . $newQuery;
    
        // Rediriger vers la nouvelle URL
        header("Location: $newUrl");
        exit;

    }

    $sqrab = "SELECT * FROM ds_abonnements WHERE id_user = ? AND id_visiteur = ?";
    $set_ab = $bdd -> prepare($sqrab);
    $set_ab -> execute([$idUser, $idUsing]);
    $setabList = $set_ab -> fetchall();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/Userstyles.css">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/Cardstyles.css">
</head>
    <?php
        require('../includes/allhead.php');
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


<div class="ds_conteneurs">
    <div class="my_head">
        <img src="<?=$darkhost?>/media/ds_avatars/<?=$setuserList[0]['avatar']?>" class="user_avx" alt="proafile utilisateurs">
        <div class="my_profile">
            <div class="ifo_profile">
                <h3 class="mycompte">@_<?=$setuserList[0]['pseudo']?></h3>
                <div class="myLink">
                    <span class="link">#My_Link</span>
                    <ddiv class="abonx">
                        <span class="coneteursabn"></span>
                        <?php 
                        if ($idUser != $idUsing) {
                        ?>
                        <form method="post" id="Abn">
                            <input type="hidden" name="idusing" class="idusing" value="<?=$idUsing?>">
                            <?php 
                                if (count($setabList) == 0) {
                            ?>
                            <input type="button"  class="syblx_abnx" onclick="axAbnSysteme()"  value="S'abonner">
                            <?php
                                }else{
                            ?>
                            <input type="button"  class="syblx_abnx" onclick="axAbnSysteme()" value="Se desabonner">
                            <?php }?>
                        </form>
                        <?php 
                        }
                        ?>
                    </ddiv>
                </div>
                <div class="myBio">
                    mybio .703Q101-472 268-66 66ZM371.441-406q75.985 0 127.272-51.542Q550-509.083
                            550-584.588q0-75.505-51.346-127.459Q447 && xxxVue-il y as xxxTimes
                </div>
            </div>
            <div class="prf_menu">
                <a href="<?=$darkhost?>/users?id_using=<?=$idUsing?>&videos" <?=addclasse("videos")?>>Videos</a>
                <a href="<?=$darkhost?>/users?id_using=<?=$idUsing?>&playlists" <?=addclasse("playlists")?>>Playlists</a>
                <form action="<?=$darkhost?>/users?id_using=<?=$idUsing?>&min_search" class="user_search" method="post">
                    <input type="search" name="min_search" id="min_searchin" placeholder="Courts recherche" required>
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="22" height="22" fill="#FFF">
                            <path d="M794-96 525.787-364Q496-341.077 457.541-328.038 419.082-315 373.438-315q-115.311
                            0-193.875-78.703Q101-472.406 101-585.203T179.703-776.5q78.703-78.5 191.5-78.5T562.5-776.356Q641-697.712
                            641-584.85q0 45.85-13 83.35-13 37.5-38 71.5l270 268-66 66ZM371.441-406q75.985 0 127.272-51.542Q550-509.083
                            550-584.588q0-75.505-51.346-127.459Q447.309-764 371.529-764q-76.612 0-128.071
                                51.953Q192-660.093 192-584.588t51.311 127.046Q294.623-406 371.441-406Z"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        <button class="copieLink" onclick="copyLink()" type="button">copier
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
            <path d="M362.31-260Q332-260 311-281q-21-21-21-51.31v-455.38Q290-818 311-839q21-21 51.31-21h335.38Q728-860
             749-839q21 21 21 51.31v455.38Q770-302 749-281q-21 21-51.31 21H362.31Zm0-60h335.38q4.62 0 8.46-3.85
              3.85-3.84 3.85-8.46v-455.38q0-4.62-3.85-8.46-3.84-3.85-8.46-3.85H362.31q-4.62 0-8.46 3.85-3.85
               3.84-3.85 8.46v455.38q0 4.62 3.85 8.46 3.84 3.85 8.46 3.85Zm-140 200Q192-120
                171-141q-21-21-21-51.31v-515.38h60v515.38q0 4.62 3.85 8.46 3.84 3.85 8.46
                 3.85h395.38v60H222.31ZM350-320v-480 480Z"/></svg>
        </button>
    </div>
    <?php
        if (isset($_GET["videos"])) {
            require_once('st_videos.php');
        }
        elseif (isset($_GET["playlists"])) {
            require_once('st_playlists.php');
        }
        elseif (isset($_GET["abonnements"])) {
            require_once('st_abonnements.php');
        }
        elseif (isset($_GET["min_search"])) {
            require_once('st_min_search.php');
        }
        else {
            require_once('st_videos.php');
        }
    ?>


</div>


</body>
<script src="../script/userscript.js"></script>
</html>