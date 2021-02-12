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

        // var_dump($_POST);


        //tester les champs
        if (
            empty($_POST['Topic']) ||
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

        //IndexGoodAnswer number 
        if (!intval($_POST['IndexGoodAnswer']) > 0) {
            \Session::addFlash('error', 'IndexGoodAnswer doit etre un chiffre !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }


        // //test si la question existe déjà
        // if ($this->model->findByName($_POST['product_ref']) > 0) {
        //     //doublon  
        //     \Session::addFlash('error', 'ce produit existe déjà !');
        //     //rediriger l'utilisateur vers le formulaire 
        //     \Http::redirectBack();
        // }

        //traiter le formulaire
        //preparation un tableau
        $data['Id'] = NULL;
        $data['IndexQuestion'] = $_POST['IndexQuestion'];
        $data['IndexGoodAnswer'] = $_POST['IndexGoodAnswer'];
        $data['Question'] = $_POST['Question'];
        $data['Answers'] = $_POST['Answers'];
        $data['Image'] = $_POST['Image'];
        $data['Topic_Id'] = $_POST['Topic'];
        $data['ScoreValue'] = intval(1);

        // var_dump($data);
        // die();

        //si on arrive ici on va pouvoir insérer la question
        $newQuestion = $this->model->insert($data);

        if (!$newQuestion > 0) {
            //l'insertion a échouée
            \Session::addFlash('error', 'l\'insertion a échouée !');
            //rediriger l'utilisateur vers le formulaire
            \Http::redirectBack();
        }

        //gestion des tags
        // if (isset($_POST['product_tags'])) {
        //     foreach ($_POST['product_tags'] as $tag) {
        //         //lancer une insertion dans la table Tag_product
        //         $this->model->insertTagProduct(intval($tag), $newQuestion);
        //     }
        // }

        //mise à jour de la base de données
        // $data['Visuel'] = $newQuestion . ".png";
        // $data['Id'] = $newQuestion;



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
        // $this->tplVars = $this->tplVars + [
        //     'diaps' => $DiapModel->findAllByProduct(intval($_GET['id']))
        // ];

        parent::editForm();
    }

    public function update(array $data = [])
    {
        //tester les champs
        if (
            empty($_POST['product_status']) ||
            empty($_POST['shelf']) ||
            empty($_POST['product_brand']) ||
            empty($_POST['product_ref']) ||
            empty($_POST['product_buyprice']) ||
            empty($_POST['product_msrp']) ||
            empty($_POST['product_price_eco']) ||
            empty($_POST['product_desc_0'])
        ) {
            //au moins un des champs est vide
            \Session::addFlash('error', 'champ(s) obligatoire(s) non rempli(s) !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }

        //traiter le formulaire
        //preparation un tableau
        $data['Name'] = $_POST['product_ref'];
        $data['Brand_Id'] = $_POST['product_brand'];
        $data['ProductLine_Id'] = $_POST['shelf'];
        $data['Buy_price'] = $_POST['product_buyprice'];
        $data['MSRP'] = $_POST['product_msrp'];
        $data['Eco_tax'] = $_POST['product_price_eco'];
        $data['QuantityInStock'] = $_POST['product_stock'];
        $data['Status'] = $_POST['product_status'];
        $data['Primary_content'] = $_POST['product_desc_0'];
        $data['Description_title1'] = $_POST['product_desc_1_title'];
        $data['Description_title2'] = $_POST['product_desc_2_title'];
        $data['Description_content1'] = $_POST['product_desc_1_text'];
        $data['Description_content2'] = $_POST['product_desc_2_text'];
        $data['Id'] = intval($_POST['id']);



        //si upload modifier le fichier
        if (!empty($_FILES['product_visuel']['name'])) {
            //tentative d'upload
            if ($this->uploadFile('product_visuel', intval($_POST['id']) . ".png")) {
                //mise à jour de la base de données
                $data['Visuel'] = intval($_POST['id']) . ".png";
            }
        }

        //product_desc_1_file
        if (!empty($_FILES['product_desc_1_file']['name'])) {
            //tentative d'upload
            if ($this->uploadFile('product_desc_1_file', intval($_POST['id']) . "_1.png")) {
                //mise à jour de la base de données
                $data['Description_visuel1'] = intval($_POST['id']) . "_1.png";
            }
        }

        //product_desc_2_file
        if (!empty($_FILES['product_desc_2_file']['name'])) {
            //tentative d'upload
            if ($this->uploadFile('product_desc_2_file', intval($_POST['id']) . "_2.png")) {
                //mise à jour de la base de données
                $data['Description_visuel2'] = intval($_POST['id']) . "_2.png";
            }
        }


        //gestion des tags
        //tout effacer dans la table tag_product
        $this->model->deleteTagProduct(intval($_POST['id']));

        if (isset($_POST['product_tags'])) {
            foreach ($_POST['product_tags'] as $tag) {
                //lancer une insertion dans la table Tag_product
                $this->model->insertTagProduct(intval($tag), intval($_POST['id']));
            }
        }

        //test si il ya des diapos à supprimer
        if (isset($_POST['diap'])) {
            //on a au moins une diapo à supprimer
            $this->supDiapo($_POST['diap']);
        }

        //gestion du diaporama
        //test si uplad diaporama demandé :
        if (
            !empty($_FILES['product_photo_1_mini']['name']) &&
            !empty($_FILES['product_photo_1_max']['name'])
        ) {
            //upload des images avec des noms temporaires (on a pas encore l'Id)
            $this->uploadFile('product_photo_1_mini', "test_min.png");
            $this->uploadFile('product_photo_1_max', "test_max.png");

            //lancer une requete dans Diaporama_photos
            $diapModel = new \Models\Diap();

            $diap = [];
            $diap['Product_Id'] = intval($_POST['id']);

            $diapId = $diapModel->insert($diap);

            //renommer les fichiers
            if (file_exists('uploads/' . strtolower($this->nameCrud) . '/test_min.png')) {
                //copier le fichier dans le bon dossier avec le bon nom
                copy('uploads/' . strtolower($this->nameCrud) . '/test_min.png', 'uploads/diaporamas/' . $diapId . '_min.png');
                //supprimer le fichier temporaire
                unlink('uploads/' . strtolower($this->nameCrud) . '/test_min.png');
            }

            if (file_exists('uploads/' . strtolower($this->nameCrud) . '/test_max.png')) {
                //copier le fichier dans le bon dossier avec le bon nom
                copy('uploads/' . strtolower($this->nameCrud) . '/test_max.png', 'uploads/diaporamas/' . $diapId . '_max.png');
                //supprimer le fichier temporaire
                unlink('uploads/' . strtolower($this->nameCrud) . '/test_max.png');
            }

            //mettre à jour la base de données
            $diap = [];
            $diap['Id'] = $diapId;
            $diap['Photo_md'] = $diapId . '_min.png';
            $diap['Photo_lg'] = $diapId . '_max.png';

            $diapModel->update($diap);
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
