<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_POST['send'])){
        $page->insert('users',[
            'email'     => $_POST['email'],
            'password'  =>password_hash( $_POST['password'],PASSWORD_DEFAULT)
        ]);

        header('location: index.php');

    }

    echo $page->render('register.html.twig', []);