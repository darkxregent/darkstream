<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="<?=$darkhost?>/asset/uploadstyles.css">
    <title>Téléversement</title>
</head>
<body>
<div class="up_allcomtent">
    <form action="" method="post" class="up_comtent" enctype="multipart/form-data">
        <button type="button" onclick="annullation()" class="up_remove">Annuler</button>
        <div class="up_secours">
            <span onclick="infoDefined()" class="herfed_">i</span>
            <a href="" class="herfed_">Aide</a>
        </div>
        <div class="up_etat">
            <span class="etats span1"></span>
            <span class="etats span2"></span>
            <span class="etats span3"></span>
            <span class="etats span4"></span>
            <span class="etats span5"></span>
        </div>
        <div class="up_change chargement">
            <span class="pourcentage">0%</span>
            <div class="progress_bar">
                <div class="progression"></div>
            </div>
        </div>
        <div class="up_change trInfo">
            <p>Collection et Traitement des données de la publication . . .</p>
        </div>

        <!-- 1er formulaire -->
        <div class="file_content form1">
            <label for="uploadfile">
                <svg xmlns="http://www.w3.org/2000/svg" height="120" viewBox="0 -960 960 960" width="120" fill="#ffffffc8">
                    <path d="M251.26-141.04q-94.56 0-161.98-66.63Q21.87-274.3 21.87-370q0-81.57 51-146.04
                     51-64.48 131.13-78.35 22.57-90 88.57-150.22t153.56-71.35v362l-78-79.13-50.3
                      50.31L481-318.04l163.61-164.74-49.74-50.31-78 79.13v-362Q619-802.52 689.35-724.52t75.91
                       186.56v24q74.57 5.83 123.72 57.68 49.15 51.85 49.15 128.85 0 77.26-54.56 131.82-54.57
                        54.57-131.83 54.57H251.26Z"/>
                </svg>       
            </label>
            <h3>Selectionner le fichier à téléverser</h3>
            <input type="file" name="uploadfile" class="ds_uploadfile" required id="uploadfile" accept="video/*">
            <div class="uppaging">
                <button type="button" onclick="next1()" class="page">Suivante</button>
            </div>
        </div>

        <!-- 2e formulaire -->
        <div class="upfile_verryed form2">
            <div class="mysending">
                <label for="mytitle" class="lb_mytitle">Modifier le titre de la vidéo : </label>
                <input type="text" name="mytitle" class="mytitle" id="mytitle">
                <video class="myfiles" controls></video>
            </div>
            <div class="uppaging">
                <button type="button" onclick="prew2()" class="page">Retourner</button>
                <button type="button" onclick="next2()" class="page">Suivante</button>
            </div>
        </div>

        <!-- 3e formulaire -->
        <div class="updetail form3">
            <div class="detailform">
                <h3 class="hd_title"></h3>
                <div class="description">
                    <label for="disc">Description</label>
                    <textarea name="disc" id="disc" required class="disc" placeholder="Description de la vidéo en cours de publication."></textarea>
                </div>
                <div class="description">
                    <label for="tag">Les tags</label>
                    <textarea name="tag" id="tag" required class="disc" placeholder="Tags pour augmenter la visibilité et faciliter les recherches."></textarea>
                </div>
            </div>
            <div class="uppaging">
                <button type="button" onclick="prew3()" class="page">Retourner</button>
                <button type="button" onclick="next3()" class="page">Suivante</button>
            </div>
        </div>

        <!-- 4e formulaire -->
        <div class="uptypes form4">
            <div class="playlistform">
                <!-- LES OPTIONS -->
                <div class="upotion">
                    <label for="option">Sélectionner l'Option concernée par la publication</label>
                    <select name="option" id="option">
                        <option value="">Sélectionner une option</option>
                        <?php 
                        for ($i=0; $i < count($alloption); $i++) { 
                        ?>
                            <form action="" method="post">
                                <option value="<?=$alloption[$i]['id_option']?>"><?=$alloption[$i]['option']?></option>
                            </form>
                        <?php 
                        }
                        ?>
                    </select>
                </div>
                <div class="cathegorry">
                    <label for="cath">Sélectionner une catégorie d'option</label>
                    <select name="cath" id="cath">
                        <option value="">Aucune catégorie sélectionnée</option>
                    </select>
                </div>
                <div class="isPlaylist">
                    <div class="listing">
                        <div class="dxplaylist">
                            <label for="issetPlaylist">Ajouter à une Playlist</label>
                            <select name="issetPlaylist" id="issetPlaylist" class="issetPlaylist">
                                <option value="">Aucune playlist sélectionnée</option>
                            </select>
                        </div>
                        <div class="creat">
                            <label for="addplx" class="pl_lbl">Créer une nouvelle playlist ici - </label>
                            <input type="button" class="pl_button" onclick="dPlaylist()" value="Créer">
                        </div>
                    </div>
                </div>
                <div class="noPlaylist">
                    <div>
                        <label for="addPlaylist">Créer une playlist</label>
                        <input type="text" name="addPlaylist" id="addPlaylist" placeholder="Le nom de la nouvelle playlist" maxlength="70" class="addPlaylist">
                    </div>
                    <div class="creat">
                        <label for="addplx" class="pl_lbl">Sélectionner une playlist (existante) - </label>
                        <input type="button" class="pl_button" onclick="xPlaylist()" value="Sélectionner">
                    </div>
                </div>
            </div>
            <div class="uppaging">
                <button type="button" onclick="prew4()" class="page">Retourner</button>
                <button type="button" onclick="next4()" class="page">Suivante</button>
            </div>
        </div>

        <!-- 5e formulaire -->
        <div class="couverturs form5">
            <div class="mycouvers">
                <div class="vid_couvers">
                    <svg height="300" class="couvers_svg" viewBox="0 0 530 530" fill="currentColor">
                        <path d="M0,457.468h530.399V72.931H0V457.468z
                        M44.627,412.333l105.824-147.133l65.334,90.838l40.49,56.295h-80.977H44.627
                        L44.627,412.333z M328.442,199.41l153.144,212.923H275.125l-6.426-8.932l-43.486-60.463L328.442,199.41z M117.81,122.91
                        c23.097,0,41.821,18.724,41.821,41.821c0,23.097-18.724,41.821-41.821,41.821c-23.097,0-41.821-18.724-41.821-41.821
                        C75.992,141.634,94.713,122.91,117.81,122.91z"></path>
                    </svg>
                    <img src="" alt="la couverture de la publication" class="canvas_couvers">
                    <input type="text" name="mycanvas" id="mycanvas">
                </div>
                <div class="btn_couvers">
                    <button type="button" class="btn_genere">
                        <svg height="16" viewBox="0 -960 960 960" width="16" fill="#00f">
                            <path d="M380-300v-360l280 180-280 180ZM480-40q-108 0-202.5-49.5T120-228v108H40v-240h240v80h-98q51
                            75 129.5 117.5T480-120q115 0 208.5-66T820-361l78 18q-45 136-160 219.5T480-40ZM42-520q7-67
                            32-128.5T143-762l57 57q-32 41-52 87.5T123-520H42Zm214-241-57-57q53-44 114-69.5T440-918v80q-51 5-97
                            25t-87 52Zm449 0q-41-32-87.5-52T520-838v-80q67 6 128.5 31T762-818l-57 57Zm133 241q-5-51-25-97.5T761-705l57-57q44
                            52 69 113.5T918-520h-80Z"></path>
                        </svg>Générer
                    </button>
                    <label for="couvers" class="btn_pracourir">
                        <svg height="18" viewBox="0 -960 960 960" width="18" fill="#ffc400">
                            <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h240l80 80h320q33
                            0 56.5 23.5T880-640H160v400l96-320h684L837-217q-8 26-29.5 41.5T760-160H160Z"></path>
                        </svg>Parcourir
                    </label>
                    <input type="file" class="couvers" name="couvers" id="couvers" accept="image/*">
                </div>
            </div>
            <div class="uppaging">
                <button type="button" onclick="prew5()" class="page">Retourner</button>
                <button type="button" onclick="next5()" class="page">Suivante</button>
            </div>
        </div>

        <!-- 6e formulaire -->
        <div class="charging form6">
            <div class="finPub">
                <input type="submit" value="Publier" class="pub_submit">
                <div class="charging_svg">
                  <svg width="165" height="165" class="ratatElement"viewBox="0 0 150 150" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                      <style>
                        .dashed {
                          stroke: white;
                          fill: none;
                          stroke-width: 6;
                          stroke-dasharray: 10, 10;
                          stroke-linecap: round;
                          animation: dash 2s linear infinite;
                        }
                  
                        @keyframes dash {
                          to {
                            stroke-dashoffset: 1000;
                          }
                        }
                      </style>
                    </defs>
                    <path class="dashed" d="M 10 75 a 65 65 0 0 1 130 0" />
                  </svg>
                  
                  
                    <!-- <img src=""  alt=""> -->
                </div>
            </div>
            <div class="uppaging">
                <button type="button" onclick="prew6()" class="page">Retourner</button>
            </div>
        </div>

        <div class="form7">
            <input type="hidden" id="times" class="times" name="times">
        </div>
    </form>

    <div class="alert_content">
        <h6 class="alerthd">darkstream Indique :</h6>
        <p class="ds_alert"></p>
        <button type="button" class="btn_alert">OK</button>
    </div>
</div>
</body>
</html>
