<?php
    require_once('maint/allact.php');
    require('maint/playerstream.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$darkhost?>/asset/dsplayerstyleS.css">
    <title>player</title>
</head>
    <?php
        require('includes/allhead.php');
    ?>
<body>
<!-- all content for the player -->
<div class="ds_content_player">
    <!-- heading conteurs -->
    <div class="stream_conteurs">
        <!-- voir la video -->
        <div class="stream_content">

            <select name="selplayer" class="selectyourplayer" id="selplayer">
                <option value="">darkPlayer</option>
                <option value="">OchoKom</option>
                <option value="">lecteurHtml</option>
            </select>

            <div class="players_container">
                <video src="<?=$listPlayer['stream']?>" controls="" poster="<?=$listPlayer['couver']?>"></video>
            </div>
            <div class="ds_player_detail_container">
                
                <h3 class="player_name"><?=$listPlayer['titre']?></h3>

                <div class="stream_user_detail">
                    <!-- PROFILE -->
                    <div class="st_profiles">
                        <a href="<?=$darkhost?>/users?id_using=<?=$listPlayer['id_st_user']?>&videos"><img src="<?=$listPlayer['avatar']?>" alt=""></a>
                        <div class="profiles_detail">
                            <a href="<?=$darkhost?>/users?id_using=<?=$listPlayer['id_st_user']?>&videos">
                                <h4 class="st_prof_name"><?=$listPlayer['pseudo']?></h4></a>
                            <h4 class="st_prof_abn"><?=$contUserAbn?></h4>
                        </div>
                    </div>

                    <!-- ITING -->
                  
                    <form method="post" class="st_cliking_content">
                        <input type="hidden" name="id_vid_play" value="<?=$listPlayer['id_stream']?>">
                        <input type="hidden" name="id_playeur" value="<?=$listPlayer['id_st_user']?>">
                        <span class="svg_liking" onclick="asyncAllLiking('true')"><svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20">
                        <path d="M700-83H234v-533l264-274 50 36q11.875 11.129 18.438 23.565Q573-818 573-799.68v-.32l-43
                         184h313q36.2 0 64.1 28.4Q935-559.2 935-525v37.33q0 12.291-3.5 29.024T924-432L804.33-153.255q-11.675
                          29.273-41.21 49.764Q733.586-83 700-83ZM174-616v533H50v-533h124Z"/></svg></span>
                        <span class="st_nbr_good"><?=$contTrueLikes?></span>

                        <hr class="like_barre">

                        <span class="st_nbr_bad"><?=$contFalseLikes?></span>
                        <span class="svg_liking" onclick="asyncAllLiking(false)"><svg height="20" viewBox="0 -960 960 960" fill="rgba(142, 0, 0, 0.785)">
                            <path d="M240-840h400v520L360-40l-50-50q-7-7-11.5-19t-4.5-23v-14l44-174H120q-32 0-56-24t-24-56v-80q0-7
                             1.5-15t4.5-15l120-282q9-20 30-34t44-14Zm480 520v-520h160v520H720Z"></path></svg></span>
                    </form>

                    <a href="<?php $listPlayer['stream']?>" download="[<?=$alloption[$id_rec_option - 1]['option']?>] <?=$listPlayer['titre']?>">
                        <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 -960 960 960" fill="#fff" width="28">
                        <path d="M153.304-73.304v-75.754h653.551v75.754H153.304Zm326.029-169.087L184.666-618.812h165.58v-268.043H608.58v268.043h166.246L479.333-242.391Z"/></svg>
                        <span class="dawnx">Telechager</span>
                    </a>

                    <div class="st_porf_view">555M vues</div>

                    <form method="post" class="forom_abn">
                        <input type="hidden" name="idusing" class="idusing" value="<?=$listPlayer['id_st_user']?>">
                        <?php 
                        if ($listPlayer['abn_auth'] == 0) {
                        ?>
                        <button type="button" class="abn_btn" onclick="axAbnSysteme()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15" fill="#fff">
                            <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220 322v-120q0-36-16-68.5T662-406q51
                            18 94.5 46.5T800-280v120h-80Zm80-280v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Zm-480-40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113
                            47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33
                            0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 0-111
                                13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/></svg>
                            <span> S'abonner </span></button>
                        <?php
                        }else {
                        ?>
                        <button type="button" class="abn_btn" onclick="axAbnSysteme()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15" fill="#fff">
                            <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220
                            322v-120q0-36-16-68.5T662-406q51 18 94.5 46.5T800-280v120h-80Zm240-360H720v-80h240v80Zm-640 40q-66 
                            0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 
                            17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33 
                            0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 
                            23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 
                            0-111 13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/></svg>
                            <span>se desabonner</span></button>
                        <?php
                        }
                        ?>
                    </form>
                </div>
                

                <div class="disc_content">
                    <h4 class="head_disc">
                        <span>xxxvue - il y à <?=$listPlayer['dating']?></span>
                        <span>descriptions 
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" class="svg_open" fill="#fff" width="24">
                            <path d="M480-345 240-585l56-56 184 184 184-184 56 56-240 240Z"></path></svg></span>
                    </h4>
                    <p class="containt_disc"><?=$listPlayer['description']?></p>
                </div>
            </div>
        </div>
            <!-- conteneures des autres videos sanpas  -->
        <div class="other_stream_content">
            my sujections videos aders
        </div>
    </div>



    <!-- playlist and commentaires -->
    <div class="sections_visiteurs">
            <!-- la playlists de la videos -->
            <?php 
            if (!isset($listPlayer['id_playlist']) != 0) {
                    
            ?>
            <div class="playlists_conteneurs">
                <h3 class="ply_hd">Non du plays liste</h3>
                <div class="pl_body">
                    

                    <div class="pl_card_systeme">
                        <div class="svg_text_player">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" class="in_play" id="in_Played" viewBox="0 -960 960 960" width="24" fill="#fff" style="display: block;">
                                <path d="M340.001-236.156v-487.688L723.074-480 340.001-236.156Z"></path></svg>
                        </div>
                        <img src="<?=$darkhost?>/media/ds_avatars/<?=$_SESSION['avatar']?>" class="vidx_player_img" alt="">
                        <div class="pl_vidx_info">
                            <h4 class="titre_pl_vidx">Titre videos playslistVTUSTRNUZR5U YSBRYSNEBT BERYDSTBSRYHTJXSTD EYS DHDR SYRBYS YBRTNYY TJSTUSRTKTJDRTFJDX </h4>
                            <p class="pl_info">il y as 4ans 10M vue</p>
                        </div>
                    </div>



                </div>
            </div>
            <?php
            }
            ?>





            <!-- les commentaires de l videos -->
            <div class="commentaires_conteneurs">
                <h3 class="cmm_hd">Commentaires 
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 -960 960 960" width="16">
                    <path d="M280-240q-17 0-28.5-11.5T240-280v-80h520v-360h80q17 0 28.5 11.5T880-680v600L720-240H280ZM80-280v-560q0-17 11.5-28.5T120-880h520q17
                     0 28.5 11.5T680-840v360q0 17-11.5 28.5T640-440H240L80-280Zm520-240v-280H160v280h440Zm-440 0v-280 280Z"></path></svg>
                </h3>
                <form action="" class="comm_form" method="post">
                    <img src="<?=$darkhost?>/media/ds_avatars/<?=$_SESSION['avatar']?>" class="prof_comm" alt="images de profille personnelle">
                    <input type="text" name="comm_message" id="comm_message" placeholder="Saisire Un Commentaires" required>
                    <button type="button" class="sub_comm_btn">
                        <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 -960 960 960" fill="#fff" width="22">
                        <path d="M142.463-193.271v-224.884L402.691-480.5l-260.228-63.268v-223.961L823.535-480.5 142.463-193.271Z"></path></svg>
                     </button>
                </form>

                <div class="comm_body">
                    <!-- comment card -->
                    <div class="cards_comm">
                        <a href=""><img src="<?=$darkhost?>/media/ds_avatars/<?=$_SESSION['avatar']?>" class="prof_comm_ext"></a>
                        <div class="info_comm_messages">
                            <a href="" class="comm_Pseudo">PSeudo</a>
                            <p class="messages_comm">massaging</p>
                            <div class="repx_comm">
                                <div class="edit_messages">
                                    <a href="" class="supr_comm">Suprimer</a>
                                    <a href="" class="Repond_comm">Repondre</a>
                                </div>
                                <p class="comm_durre">il y as 1min</p>
                            </div>


                            <div class="reponx_reponx">
                                <div class="cards_comm">
                                    <a href=""><img src="<?=$darkhost?>/media/ds_avatars/<?=$_SESSION['avatar']?>" class="prof_comm_ext"></a>
                                    <div class="info_comm_messages">
                                        <a href="" class="comm_Pseudo">PSeudo</a>
                                        <p class="messages_comm">massaging</p>
                                        <div class="repx_comm">
                                            <div class="edit_messages">
                                                <a href="" class="supr_comm">Suprimer</a>
                                                <a href="" class="Repond_comm">Repondre</a>
                                            </div>
                                            <p class="comm_durre">il y as 1min</p>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>


                <div class="comm_body">
                    <!-- comment card -->
                    <div class="cards_comm">
                        <a href=""><img src="<?=$darkhost?>/media/ds_avatars/<?=$_SESSION['avatar']?>" class="prof_comm_ext"></a>
                        <div class="info_comm_messages">
                            <a href="" class="comm_Pseudo">PSeudo</a>
                            <p class="messages_comm">massaging dsgkwshv wbvbhwsduvjbwn bwbdwdxbvukwibvw wbvjhwsdbvndbvhwx
                                dbbnjkwx xdfbxdfkjbxkjx x jbkvbxd xbvxkv vjwhbvw vdj,vwwvjhcv vjkdvw vwjkbvwnxbv,,,whvw j v</p>
                            <div class="repx_comm">
                                <div class="edit_messages">
                                    <a href="" class="supr_comm">Suprimer</a>
                                    <a href="" class="Repond_comm">Repondre</a>
                                </div>
                                <p class="comm_durre">il y as 1min</p>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
    </div>
</div>






</body>
   
<script src="script/Playerscript.js"></script>
</html>