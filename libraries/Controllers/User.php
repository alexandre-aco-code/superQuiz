<?php

namespace Controllers;

class User extends Controller
{
    //contruction du nom du modele à utiliser
    protected $modelName = \Models\User::class;

    public function loginForm()
    {
        // affiche directement la modale login
        \Http::redirect($this->tplVars['WWW_URL'] . "index.php?controller=user&task=login&topic=1&indexQuestion=1#modalLogin");
    }

    public function out()
    {
        \Session::disconnect();

        \Http::redirect(WWW_URL);
    }

    public function login()
    {
        //vérifie que j'ai bien les champs email et password
        if (
            empty($_POST['emaillogin']) ||
            empty($_POST['passwordlogin'])
        ) {

            //au moins un des 2 champs est vide
            \Session::addFlash('error', 'champs obligatoires non remplis !');
            //rediriger l'utilisateur vers le formulaire de login
            \Http::redirectBack();
        }

        //tester si le couple email/password existe bien
        if (!$this
            ->model
            ->verifEmailPwd($_POST['emaillogin'], $_POST['passwordlogin'])) {
            //identification impossible
            \Session::addFlash('error', 'identification impossible !');
            //rediriger l'utilisateur vers le formulaire de login
            \Http::redirectBack();
        }

        //l'identification a réussi
        //si l'utilisateur est Admin on le redirige vers le dashboard
        //sinon vers l'accueil du site
        if (\Session::isAdmin()) {
            \Http::redirect(WWW_URL . "index.php?controller=Admin\Dashboard&task=index");
        }

        \Session::addFlash('success', 'identification réalisée ;) !');

        \Http::redirect(WWW_URL . "index.php?controller=main");
    }

    public function index()
    {
        //affichage
        \Renderer::show("newUser", $this->tplVars);
    }

    public function create()
    {

        //vérifier la présence des champs obligatoire
        if (empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['avatar'])) {
            //au moins un des champs obligatoires non rempli
            \Session::addFlash('error', 'au moins un des champs obligatoires non rempli !');
            //rediriger l'utilisateur vers le formulaire
            \Http::redirectBack();
        }

        //test pseudo non numérique
        if (ctype_digit($_POST['pseudo'])) {
            //au moins le nom ou le prénom est numérique
            \Session::addFlash('error', 'Le pseudo ne peut pas être que numérique !');
            //rediriger l'utilisateur vers le formulaire
            \Http::redirectBack();
        }

        //vérifier le format de l'email
        //on utilise filter_var('bob@example.com', FILTER_VALIDATE_EMAIL)
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            //l'email n'est pas au bon format
            \Session::addFlash('error', 'l\'email n\'est pas au bon format !');
            //rediriger l'utilisateur vers le formulaire
            \Http::redirectBack();
        }

        //besoin d'une requete SQL vérifier si l'email existe déjà dans la base de données
        if ($this
            ->model
            ->is_exist_user($_POST['email'])
        ) {
            //l'email est déjà présent
            \Session::addFlash('error', 'l\'email existe déjà !');
            //rediriger l'utilisateur vers le formulaire
            \Http::redirectBack();
        }

        //si on arrive ici on va pouvoir insérer notre nouvel utilisateur
        if ($this
            ->model
            ->create($_POST)
        ) {
            //le compte a bien été créé
            \Session::addFlash('success', 'Création du compte réussie !');
            //rediriger l'utilisateur vers la page d'accueil
            \Http::redirect(WWW_URL);
        } else {
            //l'insertion a échouée
            \Session::addFlash('error', 'la création du compte a échouée !');
            //rediriger l'utilisateur vers le formulaire
            \Http::redirectBack();
        }
    }

    /// LA PAGE RANKINGS BASEE SUR LES SCORES DES USERS
    public function rankings()
    {

        if ($_GET['task'] == 'rankings') {

            // On récupère la liste des users
            $userAndScoreList = $this
                ->model
                ->getGlobalRankings();

            $questionList = new \Models\Question();
            $numberOfQuestions = count($questionList->findAll());

            $this->tplVars = $this->tplVars + ['userAndScoreList' => $userAndScoreList, 'numberOfQuestions' => $numberOfQuestions];

            \Renderer::show("rankings", $this->tplVars);
        } else {
            throw new \Exception('Impossible d\'afficher la page Rankings !');
        }
    }

    public function infosUser()
    {

        if (null !== \Session::getId() && !empty(\Session::getId())) {

            $infosUser = $this
                ->model
                ->getAllInfoOfAnUser(\Session::getId());

            $this->tplVars = $this->tplVars + ['infosUser' => $infosUser];

            \Renderer::show("infoUser", $this->tplVars);
        } else {

            \Session::addFlash('error', 'Pas de compte connecté !');
            \Http::redirectBack();
        }
    }
}
