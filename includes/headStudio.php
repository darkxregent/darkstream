<?php
    @include('../maint/allact.php');
    // if (!isset($_SESSION['auth']))  {
    //     header('location: '.$darkhost.'/log');
    // }

    $sqloption = "SELECT * FROM ds_options";
    $seloption = $bdd -> prepare($sqloption);
    $seloption -> execute();
    $alloption = $seloption -> fetchall(); 

    if (isset($_POST['btn_option'])) {
        $id_option = $_POST['id_option'];

        $consoption = "SELECT * FROM ds_options WHERE id_option = ?";
        $constoption = $bdd -> prepare($consoption);
        $constoption -> execute([$id_option]);
        $constalloption = $constoption -> fetchall(); 

        setcookie("myoption",$id_option , time() + (365 * 24 * 60 * 60),'/');
        header('location: index');
    }
    if (isset($_COOKIE['myoption'])) {
        $id_rec_option = $_COOKIE['myoption'];
    }else {
        $id_rec_option = 1;
    }

    $conscath = "SELECT * FROM ds_categories WHERE id_option = ?";
    $constcath = $bdd -> prepare($conscath);
    $constcath -> execute([$id_rec_option]);
    $constallcath = $constcath -> fetchall(); 
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsststyles/st_allstyles.css">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsststyles/st_headstyles.css">  
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsststyles/st_pubx.css">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsststyles/st_statqx.css">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsststyles/st_tablx.css">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsststyles/st_averx.css">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsststyles/st_statx.css">
</head>
<body>
    <header class="header_content">
        <div class="allhead_content">
            <nav class="head_content">
                <a href="<?=$darkhost?>/studios" class="st_titre">
                    <img src="<?=$darkhost?>/img/logoStudio.png" alt="lien vert le le darkstudio">
                </a>
                <a href="<?=$darkhost?>/users?id_using=<?=$_SESSION['id_user']?>&videos" class="herf_stat">
                    <img src="<?=$darkhost?>/media/ds_avatars/<?=$_SESSION['avatar']?>" class="ds_avatars" alt="">
                    <span><?="@_".$_SESSION['pseudo']?></span>
                </a>
            </nav>
            <nav class="this_options">
                <?php 

                $_SESSION['get_options'] = isset($_SESSION['get_options']) != null ? $_SESSION['get_options'] : "1";

                if (isset($_GET['pubx'])) {
                    $selctx = 'pubx';
                }
                elseif (isset($_GET['statqx'])) {
                    $selctx = 'statqx';
                }
                elseif (isset($_GET['tablx'])) {
                    $selctx = 'tablx';
                }
                elseif (isset($_GET['averx'])) {
                    $selctx = 'averx';
                }elseif (isset($_GET['statx'])) {
                    $selctx = 'statx';
                }else {
                    $selctx = 'tablx';
                }
                $_SESSION['get_options'] = !empty($_GET[$selctx]) ? $_GET[$selctx] : $_SESSION['get_options'];


                for ($i=0; $i < count($alloption); $i++) {
                    if ($alloption[$i]['id_option'] != $_SESSION['get_options']) {
                    ?>
                    <a href="<?="?".$selctx."=".$alloption[$i]['id_option']?>"><?=$alloption[$i]['option']?></a>
                    <?php 
                    }else {
                    ?>
                    <a class="st_option" href="<?="?".$selctx."=".$alloption[$i]['id_option']?>"><?=$alloption[$i]['option']?></a>
                    <?php 
                    }
                }
                
                ?>
            </nav>
        </div>
        


        <div class="nav_content">
            <a href="?upload" class="uploading">Televerser</a>
            <div class="sous_nav">
                <a href="<?=$darkhost?>/index" class="link_content">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" focusable="false">
                        <path d="m12 4.44 7 6.09V20h-4v-6H9v6H5v-9.47l7-6.09m0-1.32-8 6.96V21h6v-6h4v6h6V10.08l-8-6.96z"></path></svg>
                    <span>Accueil</span>
                </a>
                <a href="?tablx" class="link_content">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" enable-background="new 0 0 24 24" height="24" width="24" focusable="false" viewBox="0 -960 960 960">
                        <path d="M400-492.309q-57.749 0-98.874-41.124-41.125-41.125-41.125-98.874 0-57.75
                         41.125-98.874 41.125-41.125 98.874-41.125 57.749 0 98.874 41.125 41.125 41.124
                          41.125 98.874 0 57.749-41.125 98.874-41.125 41.124-98.874 41.124ZM100.001-187.694v-88.922q0-30.307
                           15.462-54.884 15.461-24.576 43.153-38.038 49.847-24.846 107.692-41.5Q324.154-427.691
                            400-427.691h11.692q4.846 0 10.462 1.23-6.077 14.154-10.039 28.846-3.961 14.692-6.576
                             29.922H400q-69.077 0-122.307 15.885-53.231 15.884-91.539 35.807-13.615 7.308-19.885
                              17.077-6.269 9.77-6.269 22.308v28.923h252q4.461 15.23 11.577 30.922 7.115 15.692
                               15.653 29.077H100.001Zm544.23 29.614-8.923-53.076q-14.308-4.231-26.923-11.077-12.616-6.846-24-17.154l-50.692
                                17.615-28.461-48.383 41.384-33.846q-4.307-15.538-4.307-30.615 0-15.078
                                 4.307-30.616l-40.999-34.615 28.461-48.383 50.307 18q11-10.308 23.808-16.962
                                  12.807-6.654 27.115-10.885l8.923-53.076h56.921l8.539 53.076q14.308 4.231
                                   27.115 11.193 12.808 6.961 23.808 17.884l50.307-19.23 28.461 49.614-41
                                    34.615q4.308 14.429 4.308 30.061 0 15.631-4.308 29.939l41.385 33.846-28.461
                                     48.383-50.692-17.615q-11.384 10.308-24 17.154-12.615 6.846-26.923 11.077l-8.539
                                      53.076h-56.921Zm28.11-100.383q31.428 0 53.774-22.38t22.346-53.807q0-31.428-22.38-53.774t-53.808-22.346q-31.427
                                       0-53.773 22.38-22.346 22.38-22.346 53.808 0 31.427 22.38 53.773 22.38 22.346 53.807 22.346ZM400-552.307q33
                                        0 56.5-23.5t23.5-56.5q0-33-23.5-56.5t-56.5-23.5q-33 0-56.5 23.5t-23.5 56.5q0 33 23.5 56.5t56.5 23.5Zm0-80Zm12 384.614Z"></path></svg>
                    <span>Table de Bore</span>
                </a>
                <a href="?pubx" class="link_content">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" enable-background="new 0 0 24 24" height="24" width="24" focusable="false" viewBox="0 -960 960 960">
                        <path d="M40-80v-360h240v360H40Zm320 0v-360h240v360H360Zm320 0v-360h240v360H680Zm-240-80h80v-200h-80v200ZM40-520v-360h240v360H40Zm320
                        0v-360h240v360H360Zm320 0v-360h240v360H680Zm-560-80h80v-200h-80v200Zm640 0h80v-200h-80v200Z"></path></svg>
                    <span>Publications</span>
                </a>
                <a href="?statqx" class="link_content">
                    <svg xmlns="http://www.w3.org/2000/svg"  fill="#FFF" enable-background="new 0 0 24 24" height="24" width="24" focusable="false" viewBox="0 -960 960 960">
                        <path d="M180.001-180.001v-276.151H320v276.151H180.001Zm230 0v-599.998h139.998v599.998H410.001Zm229.999
                         0v-403.844h139.999v403.844H640Z"></path></svg>
                    <span>Statistique</span>
                </a>
                <a href="?averx" class="link_content">
                         <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff">
                            <path d="M120-156.92v-618.46q0-27.62 18.5-46.12Q157-840 184.62-840h590.76q27.62 0 46.12 18.5Q840-803
                             840-775.38v430.76q0 27.62-18.5 46.12Q803-280 775.38-280h-532.3L120-156.92Zm360-226.16q10.46 0
                              17.54-7.07 7.08-7.08 7.08-17.54 0-10.46-7.08-17.54-7.08-7.08-17.54-7.08-10.46 0-17.54 7.08-7.08
                               7.08-7.08 17.54 0 10.46 7.08 17.54 7.08 7.07 17.54 7.07Zm-20-118.46h40v-243.08h-40v243.08Z"/></svg>
                    <span>Avertissement</span>
                </a>
                <a href="?statx" class="link_content">
                         <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff">
                            <path d="M120-156.92v-618.46q0-27.62 18.5-46.12Q157-840 184.62-840h590.76q27.62 0 46.12 18.5Q840-803
                             840-775.38v430.76q0 27.62-18.5 46.12Q803-280 775.38-280h-532.3L120-156.92Zm360-226.16q10.46 0
                              17.54-7.07 7.08-7.08 7.08-17.54 0-10.46-7.08-17.54-7.08-7.08-17.54-7.08-10.46 0-17.54 7.08-7.08
                               7.08-7.08 17.54 0 10.46 7.08 17.54 7.08 7.07 17.54 7.07Zm-20-118.46h40v-243.08h-40v243.08Z"/></svg>
                    <span>Statuts</span>
                </a>
            
        </div>
    </header>
</body>
</html>