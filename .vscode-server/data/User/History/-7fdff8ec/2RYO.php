<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $msg = false ;

    if ($_POST['send']) {
        var_dump($_POST);

       $user = $page->getUserByEmail([
            'email'=>$_POST['email']
        ]);
        var_dump($user);
        if (!$user){
            $msg = "Email ou mot de passe incorrect !";
        } else {
            if(password_verify($_POST['password'],$user['password'])){
                $msg = "Email ou mot de passe incorrect !";
            } else {
                // On va vers la page profile et on affiche l'adresse mail
            }
        }
    }

    echo $twig->render('index.html.twig', [
        'msg' => $msg
    ]);