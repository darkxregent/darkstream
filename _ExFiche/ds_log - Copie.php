<?php
    require('../maint/logact.php');
    if (isset($_SESSION['auth'])) {
        header('location: '.$darkhost.'/index');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/Allstyles.css">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/logstyleS.css">
    <title></title>  
</head>
<body class="log_content">

    <?php
    if (isset($_GET['login']) ) {
    ?>
    <form method="post" class="ds_log in">
        <div class="log_head">
            <img src="<?=$darkhost?>/img/ds_logo.png" class="logo" alt="logo du site">
            <p>Bon retour sur <span>DarkStream</span></p>
        </div>
        <div class="ds_in x">
            <label for="mymail">Votres Email</label>
            <input type="email" name="mymail" id="mymail" class="my mail" required placeholder="Ex: @gmail.com" maxlength="50">
        </div>
        <div class="ds_in pass x">
            <label for="mypass">Votres motes de passe</label>
            <input type="password" name="mypass" id="mypass" class="my pass" required minlength="8" maxlength="20" placeholder="Ex: @gmail.com" >
        </div>
        <div class="ds_in pass_remove">
            <a href="">mots de passe oublier</a>
        </div>
        <div class="ds_in avis">
            <input type="checkbox" name="check" id="check">
            <label for="check">Conserver mes cordonner</label>
        </div>
        <input type="submit" value="logIn" name="login" class="subin">
        
    </form>
    <?php
    }elseif (isset($_GET['logup'])) {
        if (!isset($_COOKIE['ageUser'])) {
    ?>
    <form method="post" class="ds_log up" enctype="multipart/form-data">
        <div class="log_head">
            <img src="<?=$darkhost?>/img/ds_logo.png" class="logo" alt="logo du site">
            <p>Bienvenu sur <span>DarkStream</span></p>
        </div>
        <p><?php
        if(isset($echec)){
            echo($echec);
            }?></p>
        <div class="ds_up">
            <label for="psx">Votres Pseudo</label>
            <input type="text" class="data psx" name="psx" id="psx" required placeholder="Pseudo"  minlength="4" maxlength="25" >
        </div>
        <div class="ds_up">
            <label for="mail">Votres mail</label>
            <input type="email" class="data mail" name="mail" id="mail"  required placeholder="Ex: @email.com" maxlength="50" >
        </div>
        <div class="ds_up">
            <label for="pass">Votres password</label>
            <input type="password" class="data pass" name="pass" id="pass" required placeholder="************" minlength="8" maxlength="20" >
        </div>
        <div class="ds_up">
            <label for="pass2">Confirmer password</label>
            <input type="password" class="data pass2" name="pass2" id="pass2" required placeholder="************" minlength="8" maxlength="20" >
        </div>
        <div class="ds_up">
            <label for="avatars">Veuillez AJouter une images</label>
            <input type="file" class="data_avatars" name="avatar" id="avatar" accept="image/*" required>
        </div>
        <div class="ds_up">
            <label for="ages">Veuillez isserer votre date de maissance</label>
            <input type="number" class="data age" name="age" id="age" maxlength="2" required placeholder="18">
        </div>
        <div class="ds_up avis">
            <input type="checkbox" name="check" id="check">
            <label for="check">J'ai lut et j'accept les <a href="">condition dutilisation</a> et les</label>
        </div>
        <input type="submit" value="LogUp" name="logup" class="subup">
    </form>
    <?php
        }else {
            header('location: '.$darkhost.'/log?login');
        }
    }elseif (isset($_GET['logrex'])) {
    ?>
        <div class="ds_log ">
        <div class="log_head">
            <img src="<?=$darkhost?>/img/ds_logo.png" class="logo" alt="logo du site">
            <p>Bienvenu sur <span>DarkStream</span></p>
        </div>
        <h3 class='log_remove'>Desolé vous été encore mineures veuiller revenire dans <?=18 - isset($_COOKIE['ageUser'])?>ans !!!</h3>
        <h4 type="button" class="log_close"> Quiter</h4>
        </div>
    <?php
    }elseif (!isset($_GET['login']) && !isset($_GET['logup']) && !isset($_GET['logrex'])) {
        if (!isset($_COOKIE['ageUser'])) {
            
    ?>
        <div class="ds_log ">
        <div class="log_head">
            <img src="<?=$darkhost?>/img/ds_logo.png" class="logo" alt="logo du site">
            <p>Bienvenu sur <span>DarkStream</span></p>
        </div>
        <h3 class='log_query'>Aviez vous deja un compte ?</h3>
        <div class="hearf_content " >
            <a class="first shild" href="<?=$darkhost?>/log?login">Oui</a>
            <a class="last shild" href="<?=$darkhost?>/log?logup">Non</a>
        </div>
        </div>
    <?php
        }else {
            if ($_COOKIE['ageUser'] >= 18) {
                header('location: '.$darkhost.'/log?login');
            }else {
                header('location: '.$darkhost.'/log?logrex');
            }
        }
    }
    ?>

</body>
</html>