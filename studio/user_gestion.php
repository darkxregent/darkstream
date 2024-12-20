<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <title>darkStudios</title>
        
    </head>
    <?php
        require('../includes/headStudio.php');
    ?>



    
<body>
    <div class="studuo_all_content">
    <?php
        if (isset($_GET["upload"])) {
            require_once('user_uploads.php');
        }
        elseif (isset($_GET["pubx"])) {
            require_once('user_publications.php');
        }
        elseif (isset($_GET["statqx"])) {
            require_once('user_statistiques.php');
        }
        elseif (isset($_GET["tablx"])) {
            require_once('user_tableaux.php');
        }elseif (isset($_GET["averx"])) {
            require_once('user_avertissement.php');
        }elseif (isset($_GET["statx"])) {
            require_once('user_statuts.php');
        }
        else {
            require_once('user_tableaux.php');
        }
    ?>
    </div>
</body>



<script src="../script/sendscrIpt.js"></script>
</html>