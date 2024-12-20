<?php
    // Include necessary files for player functionality and actions
    require_once('maint/allact.php'); // All actions related to the player
    require('maint/playerstream.php'); // Stream details for the player
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsplaystyles.css"> <!-- Link to CSS stylesheet -->
    <link rel="stylesheet" href="<?=$darkhost?>/includes/ochoVideoPlayer/Player.css"> <!-- Link to CSS stylesheet -->
    <link rel="stylesheet" href="<?=$darkhost?>/asset/herfcardstyles.css"> <!-- Link to CSS stylesheet -->
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dscoNtrols.css"> <!-- Link to CSS stylesheet -->

    <title>player</title> <!-- Page title -->
</head>
    <?php
        // Include the common header for the site
        require('includes/allhead.php');
    ?>
<body>



<!-- Main content for the video player -->
<div class="ds_content_player">
    <!-- Counter for stream views -->
    <div class="stream_conteurs">
        <!-- Video player section -->
        <div class="stream_content">

            
            <!-- Dropdown to select different players -->
            <select name="selplayer" onchange="changePlayerAll()" class="selectyourplayer" id="selplayer">
                <?php 
                if ($_COOKIE['playCookie'] == 'darkPlayer') {
                    ?>
                    <option value="darkPlayer" selected>darkPlayer</option>
                    <?php 
                }else{
                    ?>
                    <option value="darkPlayer" >darkPlayer</option>
                    <?php 
                }
                if ($_COOKIE['playCookie'] == 'OchoKom') {
                    ?>
                    <!-- <option value="OchoKom" selected>OchoKom</option> -->
                    <?php 
                }else{
                    ?>
                    <!-- <option value="OchoKom" >OchoKom</option> -->
                    <?php 
                }
                if ($_COOKIE['playCookie'] == 'lecteurHtml') {
                    ?>
                    <option value="lecteurHtml" selected>lecteurHtml</option>
                    <?php 
                }else{
                    ?>
                    <option value="lecteurHtml" >lecteurHtml</option>
                    <?php 
                }
                ?>
            </select>


            <!-- Container for the video player -->
            <div class="players-container">

                <div id="player-video-darkstream">
                    <video class="darkPlayer" id="darkLecteurs" src="<?=$listPlayer['stream']?>" poster="<?=$listPlayer['couver']?>"></video> 
                    <div id="darkstream_controls" class="dark_controls displayed">
                        <div id="ds-play-progress">
                            <div class="online-times">00:00</div>
                            <progress class="progress-bar" value="0" max="100"></progress>
                            <div class="fend-times"><?=$listPlayer['durre']?></div>
                        </div>
                        <div id="ds-play-contols">
                            <div id="ds-volume">
                                <div class="icone-volume">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF">
                                        <path d="M560-131v-68.67q94.67-27.33 154-105 59.33-77.66 59.33-176.33 0-98.67-59-176.67-59-78-154.33-104.66V-831q124
                                         28 202 125.5T840-481q0 127-78 224.5T560-131ZM120-360v-240h160l200-200v640L280-360H120Zm426.67 45.33v-332Q599-628
                                          629.5-582T660-480q0 55-30.83 100.83-30.84 45.84-82.5 64.5Z"/></svg>
                                </div>
                                <input type="range" name="volume-scroll" class="volume-scroll" min="0" value="1" max="1" step="0.1">
                            </div>
                            <div id="ds-playing">
                                <!-- <div class="video-prev">
                                    <svg class="ds-svg-icone" id="prews" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF">
                                        <path d="M220-240v-480h66.67v480H220Zm520 0L389.33-480 740-720v480Z"/></svg>
                                </div> -->
                                <div class="defil-prev">
                                    <svg class="ds-svg-icone" id="rewind" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF">
                                        <path d="M856-240 505.33-480 856-720v480Zm-401.33 0L104-480l350.67-240v480Z"/></svg>
                                </div>
                                <div class="play-pause">
                                    <svg class="ds-svg-icone" id="pause" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF">
                                        <path d="M320-202v-560l440 280-440 280Z"/></svg>
                                </div>
                                <div class="defil-next">
                                    <svg class="ds-svg-icone" id="forward" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF">
                                        <path d="M102.67-240v-480l350.66 240-350.66 240Zm404.66 0v-480L858-480 507.33-240Z"/></svg>
                                </div>
                                <!-- <div class="video-next">
                                    <svg class="ds-svg-icone" id="next" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF">
                                        <path d="M673.33-240v-480H740v480h-66.67ZM220-240v-480l350.67 240L220-240Z"/></svg>
                                </div> -->
                            </div>
                            <div id="ds-parametre">
                                <!-- <div class="quality"><svg class="ds-svg-icone" id="quality" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF">
                                    <path d="M800-80H560q-17 0-28.5-11.5T520-120v-240q0-17 11.5-28.5T560-400h240q17 0 28.5 11.5T840-360v80l80-80v240l-80-80v80q0
                                    17-11.5 28.5T800-80ZM480-480Zm2-140q-58 0-99 41t-41 99q0 48 27 84t71 50v-90q-8-8-13-20.5t-5-23.5q0-25 17.5-42.5T482-540q25
                                    0 42 17.5t17 42.5h81q0-58-41-99t-99-41ZM370-80l-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5
                                    1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7
                                        1 13.5v13.5h-80q-1-19-3-33.5t-6-27.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5
                                        23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q24 25 54 42t65 22v184h-70Z"/></svg></div> -->
                                <div class="vitess"><svg class="ds-svg-icone" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF">
                                    <path d="M418-340q24 24 62 23.5t56-27.5l224-336-336 224q-27 18-28.5 55t22.5 61Zm62-460q59 0 113.5 16.5T696-734l-76 48q-33-17-68.5-25.5T480-720q-133
                                     0-226.5 93.5T160-400q0 42 11.5 83t32.5 77h552q23-38 33.5-79t10.5-85q0-36-8.5-70T766-540l48-76q30 47 47.5 100T880-406q1 57-13 109t-41 99q-11 18-30
                                      28t-40 10H204q-21 0-40-10t-30-28q-26-45-40-95.5T80-400q0-83 31.5-155.5t86-127Q252-737 325-768.5T480-800Zm7 313Z"/></svg></div>
                                <div class="cadrage"><svg class="ds-svg-icone" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#FFFFFF">
                                    <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0
                                     33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm80-80h480v-320H240v320Zm-80 80v-480 480Z"/></svg></div>
                            </div>
                        </div>
                    </div>

                    <!-- <div id="parametre-quamity"></div> -->
                    <div id="parametre-vitess">
                        <span class="vitss vitss1x" onclick="setVitssX(0.50,'vitss1x')">0.5x</span>
                        <span class="vitss vitss2x" onclick="setVitssX(0.75,'vitss2x')">0.75x</span>
                        <span class="vitss vitss3x" onclick="setVitssX(1.00,'vitss3x')">1x</span>
                        <span class="vitss vitss4x" onclick="setVitssX(1.25,'vitss4x')">1.25x</span>
                        <span class="vitss vitss5x" onclick="setVitssX(1.50,'vitss5x')">1.5x</span>
                        <span class="vitss vitss6x" onclick="setVitssX(2.00,'vitss6x')">2x</span>
                    </div>
                </div>
            
                <ocho class="OchoKom" id="darkLecteurs" src="<?=$listPlayer['stream']?>" poster="<?=$listPlayer['couver']?>" size="720"></ocho>            

                <video class="lecteurHtml" id="darkLecteurs" src="<?=$listPlayer['stream']?>" controls="" poster="<?=$listPlayer['couver']?>"></video>

            </div>


            <div class="ds_player_detail_container">
                <h3 class="player_name"><?=$listPlayer['titre']?></h3> <!-- Video title -->

                <div class="stream_user_detail">
                    <div class="firstdatail">
                    <!-- User profile section -->
                        <div class="st_profiles">
                            <a href="<?=$darkhost?>/users?id_using=<?=$listPlayer['id_st_user']?>&videos">
                                <img src="<?=$listPlayer['avatar']?>" alt=""> <!-- User avatar -->
                            </a>
                            <div class="profiles_detail">
                                <a href="<?=$darkhost?>/users?id_using=<?=$listPlayer['id_st_user']?>&videos">
                                    <h4 class="st_prof_name"><?=$listPlayer['pseudo']?></h4> <!-- User pseudonym -->
                                </a>
                                <h4 class="st_prof_abn"><?=$contUserAbn?></h4> <!-- User subscription status -->
                            </div>
                        </div>

                        <!-- Likes and dislikes section -->
                        <form method="post" class="st_cliking_content">
                            <input type="hidden" name="id_vid_play" value="<?=$listPlayer['id_stream']?>"> <!-- Hidden input for video ID -->
                            <input type="hidden" name="id_playeur" value="<?=$listPlayer['id_st_user']?>"> <!-- Hidden input for user ID -->
                            <span class="svg_liking" onclick="asyncAllLiking(1)">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                                    <path d="M700-83H234v-533l264-274 50 36q11.875 11.129 18.438 23.565Q573-818 573-799.68v-.32l-43 184h313q36.2 0 64.1 28.4Q935-559.2 935-525v37.33q0 12.291-3.5 29.024T924-432L804.33-153.255q-11.675 29.273-41.21 49.764Q733.586-83 700-83ZM174-616v533H50v-533h124Z"/>
                                </svg>
                            </span>
                            <span class="st_nbr_good"><?=$contTrueLikes?></span> <!-- Number of likes -->

                            <hr class="like_barre"> <!-- Divider for likes and dislikes -->

                            <span class="st_nbr_bad"><?=$contFalseLikes?></span> <!-- Number of dislikes -->
                            <span class="svg_liking" onclick="asyncAllLiking(0)">
                                <svg height="20" viewBox="0 -960 960 960" fill="rgba(142, 0, 0, 0.785)">
                                    <path d="M240-840h400v520L360-40l-50-50q-7-7-11.5-19t-4.5-23v-14l44-174H120q-32 0-56-24t-24-56v-80q0-7 1.5-15t4.5-15l120-282q9-20 30-34t44-14Zm480 520v-520h160v520H720Z"></path>
                                </svg>
                            </span>
                        </form>

                        <!-- Download button for the video -->
                        <a href="<?php $listPlayer['stream']?>" class="ds_dawn" download="[<?=$alloption[$id_rec_option - 1]['option']?>] <?=$listPlayer['titre']?>">
                            <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 -960 960 960" fill="#fff" width="28">
                                <path d="M153.304-73.304v-75.754h653.551v75.754H153.304Zm326.029-169.087L184.666-618.812h165.58v-268.043H608.58v268.043h166.246L479.333-242.391Z"/>
                            </svg>
                            <span class="dawnx">Telechager</span> <!-- Download text -->
                        </a>
                    </div>
                    <div class="lastdetail">
                        <div class="st_porf_view"><?=$listPlayer['vue']?></div> <!-- Number of views -->

                        <!-- Subscription form -->
                        <form method="post" class="forom_abn">
                            <input type="hidden" name="idusing" class="idusing" value="<?=$listPlayer['id_st_user']?>"> <!-- User ID -->
                            <?php 
                            // Check if user is subscribed or not
                            if ($listPlayer['abn_auth'] == 0) {
                            ?>
                            <button type="button" class="abn_btn" onclick="axAbnSysteme()">
                                <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15" fill="#fff">
                                    <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220 322v-120q0-36-16-68.5T662-406q51 18 94.5 46.5T800-280v120h-80Zm80-280v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Zm-480-40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33 0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 0-111 13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/>
                                </svg>
                                <span> S'abonner </span></button>
                            <?php
                            } else {
                            ?>
                            <button type="button" class="abn_btn" onclick="axAbnSysteme()">
                                <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15" fill="#fff">
                                    <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220 322v-120q0-36-16-68.5T662-406q51 18 94.5 46.5T800-280v120h-80Zm240-360H720v-80h240v80Zm-640 40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33 0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 0-111 13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/>
                                </svg>
                                <span>se desabonner</span></button>
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>

                <div class="disc_content">
                    <h4 class="head_disc">
                        <span><?=$listPlayer['vue']?> - il y à <?=$listPlayer['dating']?></span> <!-- Date of the video -->
                        <span>descriptions 
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" class="svg_open" fill="#fff" width="24">
                            <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"></path></svg></span>
                    </h4>
                    <p class="containt_disc"><?=$listPlayer['description']?></p> <!-- Video description -->
                </div>
            </div>
        </div>



        <!-- Suggestions for other videos -->
        <div class="other_stream_content">
        <?php 
        if ($allSubPlayer) {
            foreach ($allSubPlayer as $subvaluex) {
                $ds_id_stream = $subvaluex["id_stream"];
                $ds_id_user = $subvaluex["id_user"];
                $ds_desx = $subvaluex["description"];
                $ds_durre = $subvaluex["durre"];

                $ds_stream = $subvaluex["stream"];
                $ds_couver = $subvaluex["couver"];

                $ds_times = calculerTempsEcoule($subvaluex["date"]);

                $d_user = $bdd->prepare("SELECT * FROM ds_user WHERE id_user = :query");
                $d_user->execute(['query' => $ds_id_user ]);
                $d_user_results = $d_user->fetchAll(PDO::FETCH_ASSOC);

                if ($ds_id_stream != $listPlayer['id_stream']) {
                    
                    ?>
                    <div class="other_card_content">
                        <a href="<?=$darkhost?>/stream?dsplayer=<?=$ds_id_stream?>" class="herf_for_video"> 
                            <video src="<?=$darkhost?>/media/ds_videos/<?=$ds_stream?>" id="videoExtra"  poster="<?=$darkhost?>/media/ds_couvers/<?=$ds_couver?>" class="" ></video>
                        </a>
                        <div class="herf_info_video">
                            <a href="<?=$darkhost?>/stream?dsplayer=<?=$ds_id_stream?>" class="herf_video_titre">
                            SUIVONT : <?=$subvaluex["titre"]?>
                            </a>
                            <div class="herf_profil">
                                <a href="<?=$darkhost?>/users?id_using=<?=$ds_id_user?>&videos"><img  class="herf_avatar" src="<?=$darkhost?>/media/ds_avatars/<?=$d_user_results[0]['avatar']?>" alt=""></a>
                                <a href="<?=$darkhost?>/users?id_using=<?=$ds_id_user?>&videos"><h5 class="herf_pseudo"><?=$d_user_results[0]["pseudo"]?> </h5></a>
                            </div>
                            <div class="herf_other_info">
                                <span class="herf_durre">Durrée : <?=$ds_durre?></span>
                                <div>
                                    <span class="herf_vues"> Vues  </span>
                                    <span class="herf_update">il y a : <?=$ds_times?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                
            }
        }
        ?>

        </div>


    </div>

    <!-- Visitor sections for playlists and comments -->
    <div class="sections_visiteurs">
            <!-- Video playlists -->
            <?php 
            if ($listPlayer['id_playlist'] != 0) {
            ?>
            <div class="playlists_conteneurs">
                <h3 class="ply_hd">[<?=$alloption[$all_sellist["id_option"]-1]['option']?>] <?=$all_sellist["playlist"]?></h3> <!-- Playlist title -->
                <div class="pl_body">
                    <?php 
                    for ($i=0; $i < count($all_this_sellist); $i++) { 
                    if ($stream_id == $all_this_sellist[$i]["id_stream"]) {
                    ?>
                    <div class="pl_card_systeme">
                        <div class="svg_text_player">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" class="in_play" id="in_Played" viewBox="0 -960 960 960" width="24" fill="#fff" style="display: block;">
                                <path d="M340.001-236.156v-487.688L723.074-480 340.001-236.156Z"></path>
                            </svg>
                        </div>
                        <img src="<?=$darkhost?>/media/ds_couvers/<?=$all_this_sellist[$i]["couver"]?>" class="vidx_player_img" alt=""> <!-- User avatar in playlist -->
                        <div class="pl_vidx_info">
                            <h4 class="titre_pl_vidx"><?=$all_this_sellist[$i]["titre"]?></h4> <!-- Video title in playlist -->
                            <p class="pl_info">Il y a <?=calculerTempsEcoule($all_this_sellist[$i]["date"])?> -- Durrée : <?=$all_this_sellist[$i]["durre"]?></p> <!-- Playlist view information -->
                        </div>
                    </div>
                    
                    <?php
                    }else {
                    ?>
                    <a href="?dsplayer=<?=$all_this_sellist[$i]["id_stream"]?>" class="pl_card_systeme avxxx">
                        <div class="svg_text_player"><span><?=$i+1?></span></div>
                        <img src="<?=$darkhost?>/media/ds_couvers/<?=$all_this_sellist[$i]["couver"]?>" class="vidx_player_img" alt=""> <!-- User avatar in playlist -->
                        <div class="pl_vidx_info">
                            <h4 class="titre_pl_vidx"><?=$all_this_sellist[$i]["titre"]?></h4> <!-- Video title in playlist -->
                            <p class="pl_info">Il y a <?=calculerTempsEcoule($all_this_sellist[$i]["date"])?> -- Durrée : <?=$all_this_sellist[$i]["durre"]?></p> <!-- Playlist view information -->
                        </div>
                    </a>
                    <?php
                    
                    
                    }
                    }
                    ?>
                    
                </div>
            </div>
            <?php
            }
            ?>

            <!-- Comments section -->
            <div class="commentaires_conteneurs">

                <form method="POST" class="forom_info">
                    <input type="hidden" class="dsidstream"  name="id_stream" value="<?=$listPlayer['id_stream']?>">
                    <input type="hidden" class="id_stream" data-id_stream="<?=$listPlayer['id_stream'] ?>">
                    <input type="hidden" class="id_stream_user" data-id_stream_user="<?=$listPlayer['id_st_user']?>">
                </form>



                <h3 class="cmm_hd">Commentaires 
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 -960 960 960" width="16">
                    <path d="M280-240q-17 0-28.5-11.5T240-280v-80h520v-360h80q17 0 28.5 11.5T880-680v600L720-240H280ZM80-280v-560q0-17 11.5-28.5T120-880h520q17 0 28.5 11.5T680-840v360q0 17-11.5 28.5T640-440H240L80-280Zm520-240v-280H160v280h440Zm-440 0v-280 280Z"></path></svg>
                </h3>
                <form class="comm_form" >
                    <img src="<?=$darkhost?>/media/ds_avatars/<?=$_SESSION['avatar']?>" class="prof_comm" alt="images de profille personnelle"> <!-- User avatar for comment -->
                    <input type="text" name="comm_message" class="comm_message" id="comm_message" placeholder="Saisire Un Commentaires" required> <!-- Input for comment -->
                    <button type="button" class="sub_comm_btn" onclick="getComm()">
                        <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 -960 960 960" fill="#fff" width="22">
                        <path d="M142.463-193.271v-224.884L402.691-480.5l-260.228-63.268v-223.961L823.535-480.5 142.463-193.271Z"></path></svg>
                     </button>
                </form>

                <div class="comm_body">
                    <!-- Example comment card -->
                    
                </div>

               
                

            </div>
    </div>
</div>

<!-- racourccie Visitor sections for playlists and comments -->
<div class="section_play_rax" onclick="conteneurSectionRax()">
List
</div>

<!-- Link to JavaScript file -->
<script src="script/Playerscript.js"></script> 
<script src="script/dscontrolS.js"></script> 
<!-- Link to JavaScript lecteur OCHO -->
<!-- <script type="module" src="includes/ochoVideoPlayer/Video-player.js"></script> -->
</body>

</html>
