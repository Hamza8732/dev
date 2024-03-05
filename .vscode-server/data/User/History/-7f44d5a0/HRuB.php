<?php

namespace App;

class Page
{
    private \Twig\Environment $twig;
    private $link;
    private string $session;

    function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '../var/cache/compilation_cache',
            'debug' => true
        ]);


    try{
        $this->link= new \PDO('mysql:host=mysql;dbname=b2-paris',"root","");
    } catch (\PDOException $e){
        var_dump($e->getMessage());
        die();
    }
    }

    public function insert(string $table_name, array $data)
    {
        $sql = 'INSERT INTO ' . $table_name . '(email, password) VALUES (:email, :password)' ;
        $sth = $this->link->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
        $sth->execute($data);
    }
    public function getUSERByEmail (array $data)
    {
        $sql="SELECT * FROM users Where email = :email" ;
        $sth=£this->link->prepare($sql);
        $sth->execute($data);

        return $sth->fetch(\PDD::FETCH_ASSOC);
    }
    public function render(string $name, array $data) :string
    {
        return $this->twig->render($name, $data);
    }
}