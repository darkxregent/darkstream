<?php
    // @include('../maint/allact.php');
    if (!isset($_SESSION['auth']))  {
        header('location: '.$darkhost.'/log');
    }

   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsstyles.css">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/allstyleS.css">
    <?php
        if ($ismobiles) {
           ?>  
           <link rel="stylesheet" href="<?=$darkhost?>/asset/mobiLstyles.css">           
           <?php
        }
    ?>
</head>
<header class="ds_header">
<div class="content_head">
    <h1 class="ds_titre">
        <a href="<?=$darkhost?>" class="logo prv"><img src="<?=$darkhost?>/img/Ds_logo.png" class="logo" alt="logo du site"></a>
        <a href="<?=$darkhost?>" class="titre">
        <svg xmlns="http://www.w3.org/2000/svg" width="175" height="25" viewBox="0 0 700 100" class="ds_logo_svg">
            <defs>
                <style>
                .cls-1 {
                    fill: none;
                    stroke: #fff;
                    stroke-linejoin: round;
                    stroke-width: 7.8px;
                }

                .cls-2, .cls-3 {
                    fill: #fff;
                }

                .cls-2 {
                    fill-rule: evenodd;
                }

                .cls-3 {
                    font-size: 26.341px;
                    font-family: "Franklin Gothic Medium";
                }
                </style>
            </defs>
            <rect class="cls-1" x="5" y="4" width="191" height="93" rx="10" ry="10"/>
            <path class="cls-2" d="M15,14H184V86H15V14ZM59.531,50.415L130.8,28.806l-0.351,44.342Z"/>
            <text id="darkStream" class="cls-3" transform="matrix(3.55, -0.019, 0.047, 5.079, 211.767, 95.267)">darkStream</text>
            </svg>

        </a>
    </h1>
    <?php if (isset($_GET['search_q'])) {
        $countsearch = analyse($_GET['search_q']);
    }else {
        $countsearch = "";
    }?> 
    <form class="ds_search_content" action="<?=$darkhost?>/watch" method="GET">
        <input type="search" class="ds_search" name="search_q" id="search_q" value="<?=$countsearch?>">
        <button type="submit" class="btn_search">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="svg_search">
                <path d="M794-96 525.787-364Q496-341.077 457.541-328.038 419.082-315 373.438-315q-115.311
                0-193.875-78.703Q101-472.406 101-585.203T179.703-776.5q78.703-78.5 191.5-78.5T562.5-776.356Q641-697.712
                641-584.85q0 45.85-13 83.35-13 37.5-38 71.5l270 268-66 66ZM371.441-406q75.985 0 127.272-51.542Q550-509.083
                550-584.588q0-75.505-51.346-127.459Q447.309-764 371.529-764q-76.612 0-128.071
                    51.953Q192-660.093 192-584.588t51.311 127.046Q294.623-406 371.441-406Z"></path>
            </svg>
        </button>    
    </form>
    <div class="other_icon">
        <div href="" class="herf_notif">
        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="ds_svg notif" height="24" viewBox="0 0 24 24" width="24" focusable="false" fill="#FFFFFF">
            <path d="M10 20h4c0 1.1-.9 2-2 2s-2-.9-2-2zm10-2.65V19H4v-1.65l2-1.88v-5.15C6 7.4 7.56 5.1 10 4.34v-.38c0-1.42 1.49-2.5 2.99-1.76.65.32
             1.01 1.03 1.01 1.76v.39c2.44.75 4 3.06 4 5.98v5.15l2 1.87zm-1 .42-2-1.88v-5.47c0-2.47-1.19-4.36-3.13-5.1-1.26-.53-2.64-.5-3.84.03C8.15
              6.11 7 7.99 7 10.42v5.47l-2 1.88V18h14v-.23z"></path></svg>
            
        </div>
        <a href="<?=$darkhost?>/studios?upload" class="herf_send">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" class="ds_svg send" width="24" focusable="false" fill="#FFFFFF">
            <path d="M14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2zm3-7H3v12h14v-6.39l4 1.83V8.56l-4 1.83V6m1-1v3.83L22 7v8l-4-1.83V19H2V5h16z"></path></svg>
        
        </a>
        <?php
        if (!$ismobiles) {
        ?>
        <div class="herf_stat">
            <img src="<?=$darkhost?>/media/ds_avatars/<?=$_SESSION['avatar']?>" class="ds_avatars" alt="">
        </div>
        <?php
        }
        ?>

        
        <div class="options">
        <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" class="ds_svg options" width="30px" fill="#FFFFFF">
            <path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0
            33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0
            56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33
            23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
        </div>
    </div>
</div>
<div class="content_cath">
    <a href="<?=$darkhost?>/index?idcath=<?=$constallcath[0]['id_categorie']?>"><?=$alloption[$id_rec_option - 1]['option']?></a>
    <?php 
    if (isset($_GET['idcath'])) {
        $cathid = $_GET['idcath'];
    }else{
        $cathid = $constallcath[0]['id_categorie'];
    }
    
    for ($e=0; $e < count($constallcath) ; $e++) { 
        $namecath = $constallcath[$e]['categorie'];
        
        $cathed = $bdd->prepare( "SELECT * FROM ds_stream WHERE id_categorie = ? ");
        $cathed->execute([$constallcath[$e]['id_categorie']]);
        $cathing = $cathed->fetchAll();

        if (count($cathing) != 0) {
            if ($constallcath[$e]['id_categorie'] != $cathid) {
            ?>
            <a href="<?=$darkhost?>/index?idcath=<?=$constallcath[$e]['id_categorie']?>"><?=$namecath?></a>
            <?php
            }else {
            ?>
            <a href="<?=$darkhost?>/index?idcath=<?=$constallcath[$e]['id_categorie']?>" class="speccath"><?=$namecath?></a>
            <?php
            } 
        }
    }
    ?>


</div>
</header>
<?php
if (!$ismobiles) {
?>
    <!-- pour la partie du bureau -->
    <nav class="content_nav">
        <a href="<?=$darkhost?>/index" class="ds_nav">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" >
                <path d="m12 4.44 7 6.09V20h-4v-6H9v6H5v-9.47l7-6.09m0-1.32-8 6.96V21h6v-6h4v6h6V10.08l-8-6.96z"></path></svg>
            Acceuil
        </a>
        <a href="<?=$darkhost?>/users?id_using=<?=$_SESSION['id_user']?>&abonnements" class="ds_nav">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" enable-background="new 0 0 24 24" width="24" height="24">
                <path d="M10 18v-6l5 3-5 3zm7-15H7v1h10V3zm3 3H4v1h16V6zm2 3H2v12h20V9zM3 10h18v10H3V10z"></path></svg>
            Abonnement
        </a>
        <a href="<?=$darkhost?>/users?id_using=<?=$_SESSION['id_user']?>&videos" class="ds_nav">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" >
                <path d="m11 7 6 3.5-6 3.5V7zm7 13H4V6H3v15h15v-1zm3-2H6V3h15v15zM7 17h13V4H7v13z"></path></svg>
            Mes videos
        </a>
    </nav>
<?php
}else{
?>
   <!-- pour la partie du mobile  -->
    <nav class="content_nav">
        <a href="<?=$darkhost?>/index" class="ds_nav">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false" >
                <path d="m12 4.44 7 6.09V20h-4v-6H9v6H5v-9.47l7-6.09m0-1.32-8 6.96V21h6v-6h4v6h6V10.08l-8-6.96z"></path></svg>
            Acceuil
        </a>
        <div class="herf_stat mobile">
            <img src="<?=$darkhost?>/media/ds_avatars/<?=$_SESSION['avatar']?>" class="ds_avatars" alt="">
        </div>
        <a href="<?=$darkhost?>/users?id_using=<?=$_SESSION['id_user']?>&abonnements" class="ds_nav">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" enable-background="new 0 0 24 24" width="24" height="24">
                <path d="M10 18v-6l5 3-5 3zm7-15H7v1h10V3zm3 3H4v1h16V6zm2 3H2v12h20V9zM3 10h18v10H3V10z"></path></svg>
            Abonnement
        </a>
    </nav>
<?php
}
?>
<body class="ds_content">
    <div class="ds_content_options">
        <div class="option_head">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" class="ds_svg opferme">
                <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56
                 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83
                  0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134
                   0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"></path>
            </svg>
            <h3>Nos options</h3>
            <img src="<?=$darkhost?>/img/ds_logo.png" class="logo" alt="logo du site">
        </div>
        <div class="option_body">
            <?php 
            for ($i=0; $i < count($alloption); $i++) { 
            ?>
                <form action="" method="post">
                    <input type="hidden" name="id_option" value="<?=$alloption[$i]['id_option']?>">
                    <input type="submit" name="btn_option" value="<?=$alloption[$i]['option']?>" class="btn_options">
                </form>
            <?php 
            }
            ?>
        </div>
    </div>

    <div class="ds_content_notif">
        <div class="option_head">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" class="ds_svg ntferme">
                <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56
                 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83
                  0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134
                   0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"></path>
            </svg>
            <h3>Nos options</h3>
            <img src="<?=$darkhost?>/img/ds_logo.png" class="logo" alt="logo du site">
        </div>
        <div class="notif_body">
            <h3 class="singnal_notif">
                Aucun <br>
                notification as signler
            </h3>
        </div>
    </div>

    <div class="ds_conent_shot_parametre">
            <a href="<?=$darkhost?>/users?id_using=<?=$_SESSION['id_user']?>&videos" class="cp_herf mycp"><?=$_SESSION['pseudo']?></a>
            <a href="<?=$darkhost?>/studios" class="cp_herf mygp">darkStudios</a>
            <a href="<?=$darkhost?>/logout" class="cp_herf dex">Deconnexion</a>
    </div>
</body>
<script>
    var btnOp = document.querySelector(".options");
    var contOp = document.querySelector(".ds_content_options");
    var frxop = document.querySelector(".ds_svg.opferme");
    var hrNof = document.querySelector(".herf_notif");
    var contnt = document.querySelector(".ds_content_notif");
    var frxnt = document.querySelector(".ds_svg.ntferme");
    var param = document.querySelector(".herf_stat");
    var cp0pen = document.querySelector(".ds_conent_shot_parametre");

    btnOp.addEventListener('click', ()=>{
        contOp.classList.toggle('xop');
        contnt.classList.remove('ntx');
        cp0pen.classList.remove('actif');
    });
    frxop.addEventListener('click', ()=>{
        contOp.classList.remove('xop');
    });

    hrNof.addEventListener('click', ()=>{
        contnt.classList.toggle('ntx');
        contOp.classList.remove('xop');
        cp0pen.classList.remove('actif');
    });
    frxnt.addEventListener('click', ()=>{
        contnt.classList.remove('ntx');
        
    });


    param.addEventListener('click', ()=>{
        cp0pen.classList.toggle('actif');
        contOp.classList.remove('xop');
        contnt.classList.remove('ntx');
    });




</script>
</html>