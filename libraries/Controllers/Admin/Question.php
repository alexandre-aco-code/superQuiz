<?php

namespace Controllers\Admin;

class Question extends \Controllers\Admin
{
    protected $modelName = \Models\Question::class;

    protected $nameCrud = "Question";

    protected $pageTitle = "Gestion des Questions";

    public function index()
    {

        //titre de la page
        $this->tplVars = $this->tplVars + [
            'page_title' => $this->pageTitle
        ];

        //liste des données
        $this->tplVars = $this->tplVars + [
            'list' => $this->model->findAllQuestionsWithTopicName()
        ];

        //afficher la liste 
        \Renderer::showAdmin(strtolower($this->nameCrud) . "/list", $this->tplVars);
    }



    public function create(array $data = [])
    {

        //tester les champs
        if (
            empty($_POST['Topic_Id']) ||
            empty($_POST['IndexQuestion']) ||
            empty($_POST['Question']) ||
            empty($_POST['Answers']) ||
            empty($_POST['IndexGoodAnswer']) ||
            empty($_POST['Image']) 
            // empty($_POST['product_price_eco']) ||
            // empty($_POST['product_desc_0']) ||
            // empty($_FILES['product_visuel']['name'])
        ) {
            //au moins un des champs est vide
            \Session::addFlash('error', 'champ(s) obligatoire(s) non rempli(s) !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }

        //test particulier
        //IndexQuestion number
        if (!intval($_POST['IndexQuestion']) > 0) {
            \Session::addFlash('error', 'IndexQuestion doit etre un chiffre !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }


        //IndexQuestion on vérifie qu'il existe pas déjà dans le topic
        if ($this->model->findQuestionsWithTopicIdAndIndexQuestion($_POST['Topic_Id'], $_POST['IndexQuestion'])) {
            \Session::addFlash('error', 'la question avec le rang IndexQuestion existe déjà dans ce topic ! Changez le IndexQuestion');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }




        //IndexGoodAnswer number 
        if (!intval($_POST['IndexGoodAnswer']) > 0) {
            \Session::addFlash('error', 'IndexGoodAnswer doit etre un chiffre !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }


        //traiter le formulaire
        //preparation un tableau
        $data['Id'] = NULL;
        $data['IndexQuestion'] = $_POST['IndexQuestion'];
        $data['IndexGoodAnswer'] = $_POST['IndexGoodAnswer'];
        $data['Question'] = $_POST['Question'];
        $data['Answers'] = $_POST['Answers'];
        $data['Image'] = $_POST['Image'];
        $data['Topic_Id'] = $_POST['Topic_Id'];
        $data['ScoreValue'] = intval(1);

        //si on arrive ici on va pouvoir insérer la question
        $newQuestion = $this->model->insert($data);

        if (!$newQuestion > 0) {
            //l'insertion a échouée
            \Session::addFlash('error', 'l\'insertion a échouée !');
            //rediriger l'utilisateur vers le formulaire
            \Http::redirectBack();
        }


        parent::update($data);

    }

    //init list productline, tag, brand
    private function initSelectList()
    {
        //récupérer la liste des rayons (productlines)
        $questionModel = new \Models\Question();
        $this->tplVars = $this->tplVars + ['questions' => $questionModel->findAll()];

        //récupérer la liste des marques
        $topicModel = new \Models\Topic();
        $this->tplVars = $this->tplVars + ['topics' => $topicModel->findAll()];

    }

    public function newForm()
    {
        //titre de la page
        $this->pageTitle = "Création d'une question";

        //initialisation des selects list
        $this->initSelectList();

        parent::newForm();
    }

    public function editForm()
    {
        //titre de la page
        $this->pageTitle = "Edition d'une question";

        //initialisation des selects list
        $this->initSelectList();

        //recupération de la liste des diapos
        // $DiapModel = new \Models\Diap();
        $this->tplVars = $this->tplVars + [
            'list' => $this->model->findQuestionById(intval($_GET['id']))
        ];

        parent::editForm();
    }

    public function update(array $data = [])
    {
        //tester les champs
        if
        (
            empty($_POST['Topic_Id']) ||
            empty($_POST['IndexQuestion']) ||
            empty($_POST['Question']) ||
            empty($_POST['Answers']) ||
            empty($_POST['IndexGoodAnswer']) ||
            empty($_POST['Image']) 
        ) {
            //au moins un des champs est vide
            \Session::addFlash('error', 'champ(s) obligatoire(s) non rempli(s) !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }


        //traiter le formulaire
        //preparation un tableau
        $data['Id'] = intval($_POST['id']);
        $data['IndexQuestion'] = $_POST['IndexQuestion'];
        $data['IndexGoodAnswer'] = $_POST['IndexGoodAnswer'];
        $data['Question'] = $_POST['Question'];
        $data['Answers'] = $_POST['Answers'];
        $data['Image'] = $_POST['Image'];
        $data['Topic_Id'] = $_POST['Topic_Id'];
        $data['ScoreValue'] = intval(1);


        //test particulier
        //IndexQuestion number
        if (!intval($_POST['IndexQuestion']) > 0) {
            \Session::addFlash('error', 'IndexQuestion doit etre un chiffre !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }

        //IndexGoodAnswer number 
        if (!intval($_POST['IndexGoodAnswer']) > 0) {
            \Session::addFlash('error', 'IndexGoodAnswer doit etre un chiffre !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }


        parent::update($data);
    }

    private function supDiapo(array $list)
    {
        $DiapoModel = new \Models\Diap();

        foreach ($list as $value) {
            $DiapoModel->delete(intval($value));

            //détuire le fichier dans uploads
            unlink('uploads/diaporamas/' . $value . '_min.png');
            unlink('uploads/diaporamas/' . $value . '_max.png');
        }
    }

    private function uploadFile(string $name_input, string $name_file)
    {
        //test sur le format du fichier
        $allowed_file_types = ['image/png'];

        //dossier d'upload
        $uploaddir = 'uploads/' . strtolower($this->nameCrud) . '/';

        if (!in_array($_FILES[$name_input]['type'], $allowed_file_types)) {
            \Session::addFlash('error', 'mauvais format de fichier !');
            \Http::redirectBack();
        }

        //finalisation de l'upload
        $uploadfile = $uploaddir . $name_file;



        if (!move_uploaded_file($_FILES[$name_input]['tmp_name'], $uploadfile)) {
            \Session::addFlash('error', 'upload non valide !');
            \Http::redirectBack();
        }

        return true;
    }
}
