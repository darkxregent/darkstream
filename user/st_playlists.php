<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les PLaylists de @_<?=$_SESSION['pseudo']?></title>
</head>
<body>
    <div class="allcard_content">
    <?php
    for ($i=0; $i < count($setingList); $i++) {
        $sqrvideos = "SELECT * FROM ds_stream WHERE id_playlist = ?";
        $this_videos = $bdd -> prepare($sqrvideos);
        $this_videos -> execute([$setingList[$i]["id_playlist"]]);
        $myAllVideos = $this_videos -> fetchall();

        $link = $darkhost."/stream?dsplayer=".$myAllVideos[0]['id_stream'];
        $ds_couver = $darkhost."/media/ds_couvers/".$myAllVideos[0]['couver'];
        $ds_titre = $setingList[0]['playlist'];
    ?>
                    <style>
                        .card_tr{
                            
                            height: 42px;
                            background: #957f7f;
                            border-radius: 5px;
                            
                        }
                        .card_tr a{
                            width: 100%;
                            height: 100%; 
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                        
                        
                    </style>
            <div class="card_content">
                <a href="<?=$link?>" class="">
                    <div class="herf_vid_extrait">
                        <img src="<?=$ds_couver?>" class="vid_extrait" alt="">
                    </div>
                   
                </a>
                
                <p href="" class="card_tr">
                    <a href=""><?=$ds_titre?></a>
                </p>

               

            </div>
    <?php
    }
    ?>
    </div>



</body>
