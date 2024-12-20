<?php
require_once('allact.php');

// nom du cookie
$name = "ageUser";

// Fonction pour assainir les entrées utilisateur
function analyse($data) {
    return htmlspecialchars(trim($data));
}

if (isset($_POST['logup'])) {
    $echec = '';

    $psx = !empty($_POST['psx']) ? analyse($_POST['psx']) : null;
    $mail = !empty($_POST['mail']) ? analyse($_POST['mail']) : null;
    $pass = !empty($_POST['pass']) ? analyse($_POST['pass']) : null;
    $pass2 = !empty($_POST['pass2']) ? analyse($_POST['pass2']) : null;
    $age = !empty($_POST['age']) ? (int)analyse($_POST['age']) : null;

    if ($psx && $mail && $pass && $pass2 && $age !== null) {
        if ($pass === $pass2) {
            if ($age >= 18) {
                if (!empty($_POST['check'])) {
                    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
                        $avatar = $_FILES['avatar'];
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                        $maxSize = 2 * 1024 * 1024; // 2MB en octets

                        if (in_array($avatar['type'], $allowedTypes) && $avatar['size'] <= $maxSize) {
                            $uploadDir = '../media/ds_avatars/';
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0777, true);
                            }

                            $extension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
                            $avatarName = 'avx_' . uniqid() . '.' . $extension;
                            $url_avatar = $uploadDir . $avatarName;
                            if (move_uploaded_file($avatar['tmp_name'], $url_avatar)) {
                                $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

                                $seting = $bdd->prepare("SELECT * FROM ds_user WHERE pseudo = ?");
                                $seting->execute([$psx]);
                                if ($seting->rowCount() == 0) {
                                    $sqrget = "INSERT INTO ds_user(pseudo, mail, password, avatar, age) VALUES(?, ?, ?, ?, ?)";
                                    $geting = $bdd->prepare($sqrget);
                                    $geting->execute([$psx, $mail, $hashedPass, $avatarName, $age]);

                                    $seted = $bdd->prepare("SELECT * FROM ds_user WHERE pseudo = ?");
                                    $seted->execute([$psx]);
                                    $setedpx = $seted->fetchAll();
                                    if (!empty($setedpx)) {
                                        $_SESSION['auth'] = true;
                                        $_SESSION['id_user'] = $setedpx[0]['id_user'];
                                        $_SESSION['pseudo'] = $setedpx[0]['pseudo'];
                                        $_SESSION['mail'] = $setedpx[0]['mail'];
                                        $_SESSION['avatar'] = $setedpx[0]['avatar'];
                                        $_SESSION['age'] = $setedpx[0]['age'];

                                        if (createCookie($name, $age)) {
                                            header('Location: ' . $darkhost . '/index');
                                            exit;
                                        }
                                    } else {
                                        $echec = "Une erreur est survenue, veuillez réessayer.";
                                    }
                                } else {
                                    $echec = "Il y a déjà un compte avec ce nom d'utilisateur.";
                                }
                            } else {
                                $echec = 'Erreur lors du téléchargement de l\'image.';
                            }
                        } else {
                            $echec = 'Type de fichier non autorisé ou fichier trop grand. Seuls les fichiers JPEG, PNG et GIF de taille maximale 2MB sont autorisés.';
                        }
                    } else {
                        $echec = "Veuillez insérer votre image.";
                    }
                } else {
                    $echec = "Veuillez lire et cocher la case.";
                }
            } else {
                createCookie($name, $age);
                $echec = "Vous devez être majeur pour vous inscrire.";
            }
        } else {
            $echec = "Les mots de passe doivent être identiques.";
        }
    } else {
        $echec = "Veuillez remplir tous les champs.";
    }
}

if (isset($_POST['login'])) {
    $echec = '';

    $mail = !empty($_POST['mail']) ? analyse($_POST['mail']) : null;
    $pass = !empty($_POST['pass']) ? analyse($_POST['pass']) : null;

    if ($mail && $pass) {
        $ssqrgetin = "SELECT * FROM ds_user WHERE mail = ?";
        $geting = $bdd->prepare($ssqrgetin);
        $geting->execute([$mail]);
        $geted = $geting->fetchAll();
        if (!empty($geted)) {
            $hackpass = $geted[0]['password'];
            if (password_verify($pass, $hackpass)) {
                $_SESSION['auth'] = true;
                $_SESSION['id_user'] = $geted[0]['id_user'];
                $_SESSION['pseudo'] = $geted[0]['pseudo'];
                $_SESSION['mail'] = $geted[0]['mail'];
                $_SESSION['avatar'] = $geted[0]['avatar'];
                $_SESSION['age'] = $geted[0]['age'];

                if (createCookie($name, $_SESSION['age'])) {
                    header('Location: ' . $darkhost . '/index');
                    exit;
                }
            } else {
                $echec = "Mot de passe incorrect.";
            }
        } else {
            $echec = "Email incorrect.";
        }
    } else {
        $echec = 'Veuillez remplir tous les champs.';
    }
}

if (!empty($echec)) {
    echo $echec;
}
?>



























<!-- 
require_once('allact.php');
// nom du cookie
$name = "ageUser";

if (isset($_POST['logup'])) {
    if (!empty($_POST['psx'])) {
        $psx = analyse($_POST['psx']);
        if (!empty($_POST['mail'])) {
            $mail = analyse($_POST['mail']);
            if (!empty($_POST['pass'])) {
                $pass = analyse($_POST['pass']);
                if (!empty($_POST['pass2'])) {
                    $pass2 = analyse($_POST['pass2']);
                    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
                        $avatar = $_FILES['avatar'];

                        // Vérifier le type de fichier
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                        if (in_array($avatar['type'], $allowedTypes)) {
                            // Vérifier la taille du fichier (max 2MB)
                            $maxSize = 2 * 1024 * 1024; // 2MB en octets
                            if ($avatar['size'] <= $maxSize) {
                                // Définir le répertoire de destination
                                $uploadDir = '../media/ds_avatars/';
                                if (!is_dir($uploadDir)) {
                                    mkdir($uploadDir, 0777, true);
                                }

                                // Déplacer le fichier uploadé vers le répertoire de destination
                                $avatarName = basename($avatar['name']);
                                $extension = pathinfo($avatarName, PATHINFO_EXTENSION);
                                $avatarName = 'avx_' . uniqid() . '.' . $extension;
                                $url_avatar = $uploadDir . $avatarName;
                                $dawnfiles = move_uploaded_file($_FILES['avatar']['tmp_name'], $url_avatar);
                                if ($dawnfiles) {
                                    if (!empty($_POST['age'])) {
                                        $age = analyse($_POST['age']);
                                        if ($age >= 18) {
                                            if (!empty($_POST['check'])) {
                                                if ($pass == $pass2) {
                                                    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

                                                    $seting = $bdd->prepare("SELECT * FROM ds_user WHERE pseudo = ?");
                                                    $seting->execute([$psx]);
                                                    $setingpx = $seting->fetchAll();
                                                    if (count($setingpx) == 0) {
                                                        $sqrget = "INSERT INTO ds_user(pseudo, mail, password, avatar, age) VALUES(?, ?, ?, ?, ?)";
                                                        $geting = $bdd->prepare($sqrget);
                                                        $geting->execute([$psx, $mail, $hashedPass, $avatarName, $age]);

                                                        $seted = $bdd->prepare("SELECT * FROM ds_user WHERE pseudo = ?");
                                                        $seted->execute([$psx]);
                                                        $setedpx = $seted->fetchAll();
                                                        if (count($setedpx) != 0) {
                                                            $_SESSION['auth'] = true;
                                                            $_SESSION['id_user'] = $setedpx[0]['id_user'];
                                                            $_SESSION['pseudo'] = $setedpx[0]['pseudo'];
                                                            $_SESSION['mail'] = $setedpx[0]['mail'];
                                                            $_SESSION['avatar'] = $setedpx[0]['avatar'];
                                                            $_SESSION['age'] = $setedpx[0]['age'];

                                                            if (createCookie($name, $age)) {
                                                                header('location: ' . $darkhost . '/index');
                                                            }
                                                        } else {
                                                            $echec = "Une erreur est survenue, veuillez réessayer !";
                                                        }
                                                    } else {
                                                        $echec = "Il y a déjà un compte avec ce nom d'utilisateur.";
                                                    }
                                                } else {
                                                    $echec = "Les mots de passe doivent être identiques.";
                                                }
                                            } else {
                                                $echec = "Veuillez lire et cocher la case.";
                                            }
                                        } else {
                                            createCookie($name, $age);
                                        }
                                    } else {
                                        $echec = "Veuillez remplir l'âge.";
                                    }
                                } else {
                                    $echec = 'Erreur lors du téléchargement de l\'image.';
                                }
                            } else {
                                $echec = 'Le fichier est trop grand. La taille maximale est de 2MB.';
                            }
                        } else {
                            $echec = 'Type de fichier non autorisé. Seuls les fichiers JPEG, PNG et GIF sont autorisés.';
                        }
                    } else {
                        $echec = "Veuillez insérer votre image.";
                    }
                } else {
                    $echec = "Veuillez confirmer votre mot de passe.";
                }
            } else {
                $echec = "Veuillez remplir votre mot de passe.";
            }
        } else {
            $echec = "Veuillez remplir votre email.";
        }
    } else {
        $echec = "Veuillez remplir votre pseudo.";
    }
}

if (isset($_POST['login'])) {
    if (!empty($_POST['mail']) && !empty($_POST['pass'])) {
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];

        $ssqrgetin = "SELECT * FROM ds_user WHERE mail = ?";
        $geting = $bdd->prepare($ssqrgetin);
        $geting->execute([$mail]);
        $geted = $geting->fetchAll();
        if (count($geted) != 0) {
            $hackpass = $geted[0]['password'];
            if (password_verify($pass, $hackpass)) {
                $_SESSION['auth'] = true;
                $_SESSION['id_user'] = $geted[0]['id_user'];
                $_SESSION['pseudo'] = $geted[0]['pseudo'];
                $_SESSION['mail'] = $geted[0]['mail'];
                $_SESSION['avatar'] = $geted[0]['avatar'];
                $_SESSION['age'] = $geted[0]['age'];

                if (createCookie($name, $_SESSION['age'])) {
                    header('location: ' . $darkhost . '/index');
                }
            } else {
                $echec = "Mot de passe incorrect.";
            }
        } else {
            $echec = "Email incorrect.";
        }
    } else {
        $echec = 'Veuillez remplir tous les champs.';
    }
}
?>
 -->

































//     require_once('allact.php');
// // nom du cookies 
// $name = "ageUser";


// if (isset($_POST['logup'])) {
//     if (!empty($_POST['psx'])) {
//         $psx = analyse($_POST['psx']);
//         if (!empty($_POST['mail'])) {
//             $mail = analyse($_POST['mail']);
//             if (!empty($_POST['pass'])) {
//                 $pass = analyse($_POST['pass']);
//                 if (!empty($_POST['pass2'])) {
//                     $pass2 = analyse($_POST['pass2']);
//                     if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
//                         $avatar = $_FILES['avatar'];
                        
//                         // Vérifier le type de fichier
//                         $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
//                         if (in_array($avatar['type'], $allowedTypes)) {
//                             // Vérifier la taille du fichier (par exemple, max 2MB)
//                             $maxSize = 12 * 1024 * 1024; // 2MB en octets
//                             if ($avatar['size'] <= $maxSize) {
//                                 // Définir le répertoire de destination
//                                 $uploadDir = '../media/ds_avatars/';
//                                 if (!is_dir($uploadDir)) {
//                                     mkdir($uploadDir, 0777, true);
//                                 }

//                                 // Déplacer le fichier uploadé vers le répertoire de destination
//                                 $avatar =  basename($avatar['name']);
//                                 $extension =  pathinfo($avatar, PATHINFO_EXTENSION);
//                                 $avatarname = 'avx_'.uniqid().'.'.$extension;
//                                 $url_avatar = $uploadDir .$avatarname;
//                                 $dawnfiles = move_uploaded_file($_FILES['avatar']['tmp_name'], $url_avatar);
//                                 if (isset($dawnfiles)) {
//                                     if (!empty($_POST['age'])) {
//                                         $age = analyse($_POST['age']);
//                                         if ($age >= 18) {
//                                             if (!empty($_POST['check'])) {
//                                                 if ($pass == $pass) {
//                                                     $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
                                                    
//                                                     $seting = $bdd -> prepare("SELECT * FROM ds_user WHERE pseudo = ?");
//                                                     $seting -> execute(array($psx));
//                                                     $setingpx = $seting -> fetchall();
//                                                     if (count($setingpx) == 0) {
//                                                         $sqrget= "INSERT INTO ds_user(pseudo,mail,password,avatar,age) VALUES(?,?,?,?,?)";
//                                                         $geting = $bdd -> prepare($sqrget);
//                                                         $geting -> execute([$psx,$mail,$hashedPass,$avatarname,$age]);

//                                                         $seted = $bdd -> prepare("SELECT * FROM ds_user WHERE pseudo = ?");
//                                                         $seted -> execute(array($psx));
//                                                         $setedpx = $seted -> fetchall();
//                                                         if (count($setedpx) != 0) {
//                                                             $_SESSION['auth'] = true;
//                                                             $_SESSION['id_user'] = $setedpx[0]['id_user'];
//                                                             $_SESSION['pseudo'] = $setedpx[0]['pseudo'];
//                                                             $_SESSION['mail'] = $setedpx[0]['mail'];
//                                                             $_SESSION['avatar'] = $setedpx[0]['avatar'];
//                                                             $_SESSION['age'] = $setedpx[0]['age'];

                                                            
//                                                             if (createCookie($name, $age)) {
//                                                                 header('location: '.$darkhost.'/index');
//                                                             }
//                                                         }else {
//                                                             $echec ="Une eurror est survenue veuillez resseyer !";
//                                                         }
//                                                     }else{
//                                                         $echec ="il y as deja un compte sur se mon d'utilisateur";
//                                                     }
//                                                 }else {
//                                                     $echec = "Vos password doives etre identiques";
//                                                 }
//                                             }else{
//                                                 $echec = "Veuillez lire et cocher le case";
//                                             }
//                                         }else {
//                                             createCookie($name, $age);
//                                         }
//                                     }else{
//                                         $echec = "Veuillez ramplire age";
//                                     }
//                                 } else {
//                                     $echec = 'Erreur lors du téléchargement de l\'image.';
//                                 }
//                             } else {
//                                 $echec = 'Le fichier est trop grand. La taille maximale est de 12MB.';
//                             }
//                         } else {
//                             $echec = 'Type de fichier non autorisé. Seuls les fichiers JPEG, PNG et GIF sont autorisés.';
//                         }   
//                     }else{
//                         $echec = "Veuillez isserer votres Images";
//                     }
//                 }else{
//                     $echec = "Veuillez comfirmer votre password";
//                 }
//             }else{
//                 $echec = "Veuillez ramplire votre password";
//             }
//         }else{
//             $echec = "Veuillez ramplire votre Email";
//         }
//     }else{
//         $echec = "Veuillez ramplire votre pseudo";
//     }
// }




// if (isset($_POST['login'])) {
//     if (!empty($_POST['mail']) && !empty($_POST['pass'])) {
//         if (!empty($_POST['mail'])) {
//             $mail = $_POST['mail'];
//              if (!empty($_POST['pass'])) {
//                 $pass = $_POST['pass'];

//                 $ssqrgetin = "SELECT * INTO ds_user WHERE mail=?"; 
//                 $geting = $bdd -> prepare($ssqrgetin);
//                 $geting -> execute([$mail]);
//                 $geted = $geting -> fetchall();
//                 if (count($geted) != 0) {
//                     $hackpass = $geted[0]['pass'];
//                     if (password_verify($pass,$hackpass)) {
//                         $_SESSION['auth'] = true;
//                         $_SESSION['id_user'] = $geted[0]['id_user'];
//                         $_SESSION['pseudo'] = $geted[0]['pseudo'];
//                         $_SESSION['mail'] = $geted[0]['mail'];
//                         $_SESSION['avatar'] = $geted[0]['avatar'];
//                         $_SESSION['age'] = $geted[0]['age'];

//                         if (createCookie($name, $age)) {
//                             header('location: '.$darkhost.'/index');
//                         }
//                     }else {
//                         $echec = "Password est inccorect". `$pass`;
//                     }
//                 }else {
//                     $echec = "Mail est inccorect". `$mail`;
//                 }       
//             }else {
//                 $echec = 'Viellez replires le champs password';
//             }
//         }else {
//             $echec = 'Viellez replires le champs mail';
//         }
//     }else {
//         $echec = 'Viellez replires tout les champs';
//     }
// }