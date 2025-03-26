<?php
/*
    Controller za novice. Vključuje naslednje standardne akcije:
        index: izpiše vse novice
        show: izpiše posamezno novico
        
    TODO:
        delete: izbriše novico iz baze
*/

class articles_controller
{
    public function index()
    {
        //s pomočjo statične metode modela, dobimo seznam vseh novic
        //$ads bo na voljo v pogledu za vse oglase index.php
        $articles = Article::all();

        //pogled bo oblikoval seznam vseh oglasov v html kodo
        require_once('views/articles/index.php');
    }

    public function show()
    {
        //preverimo, če je uporabnik podal informacijo, o oglasu, ki ga želi pogledati
        if (!isset($_GET['id'])) {
            return call('pages', 'error'); //če ne, kličemo akcijo napaka na kontrolerju stran
            //retun smo nastavil za to, da se izvajanje kode v tej akciji ne nadaljuje
        }
        //drugače najdemo oglas in ga prikažemo
        $article = Article::find($_GET['id']);
        require_once('views/articles/show.php');
    }

    public function create()
    {
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: /auth/login");
            exit();
        }
        require_once('views/articles/create.php');
    }

    public function store()
    {
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: /auth/login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $abstract = $_POST['abstract'];
            $text = $_POST['text'];
            $user_id = $_SESSION['USER_ID'];
            Article::insert($title, $abstract, $text, $user_id);
            header("Location: /");
            exit();
        }
    }

    // Akcija za "Moje novice"
    public function list()
    {
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: /auth/login");
            exit();
        }
        $articles = Article::findByUserId($_SESSION['USER_ID']);
        require_once('views/articles/list.php');
    }

    // Akcija za prikaz obrazca za urejanje
    public function edit()
    {
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: /auth/login");
            exit();
        }
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        $article = Article::find($_GET['id']);
        if (!$article || $article->user->id != $_SESSION['USER_ID']) {
            return call('pages', 'error'); // Prepreči urejanje tujih novic
        }
        require_once('views/articles/edit.php');
    }

    // Akcija za shranjevanje sprememb
    public function update()
    {
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: /auth/login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $article = Article::find($_POST['id']);
            if (!$article || $article->user->id != $_SESSION['USER_ID']) {
                return call('pages', 'error');
            }
            $title = $_POST['title'];
            $abstract = $_POST['abstract'];
            $text = $_POST['text'];
            Article::update($_POST['id'], $title, $abstract, $text);
            header("Location: /articles/list");
            exit();
        }
    }

    public function delete()
    {
        if (!isset($_SESSION['USER_ID'])) {
            header("Location: /auth/login");
            exit();
        }
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        $article = Article::find($_GET['id']);
        if (!$article || $article->user->id != $_SESSION['USER_ID']) {
            return call('pages', 'error'); // Prepreči brisanje tujih novic
        }
        Article::delete($_GET['id']);
        header("Location: /articles/list");
        exit();
    }
}