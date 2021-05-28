<aside>

    <!-- ASIDE BOX 1 POUR LE PROFIL DE l'USER -->
    <div class="identification box">
        <h2>Profil <i class="fas fa-users"></i></h2>
        <?php
        //si je suis connecté, j'affiche image + pseudo + score
        //sinon j'affiche pas connecté
        if (\Session::isConnected()) :
        ?>
        <!-- image de l'utilisateur -->
        <img src="<?= $_SESSION['user']['AvatarURL']; ?>" alt="profil picture">

        <!-- phrase aléatoire de bienvenue -->
        <?php include('randomWelcomeSentence.php'); ?>

        <h3><?= $text ?><span class="golden-text"><?= $_SESSION['user']['Pseudo']; ?></span></h3>

        <!-- AVANCEMENT DE L'UTILISATEUR -->
        <p class="avancement"><?= $tplVars['progressionUser']; ?> %</p>
        <!-- sinon si l'utilisateur n'est pas connecté j'affiche ce message -->
        <?php
        else :
        ?>
        <p>Utilisateur non connecté <i class="far fa-frown"></i></p>
        <?php
        endif;
        ?>
    </div>


    <!-- ASIDE BOX 2 POUR LES COMMENTAIRES  -->
    <div class="commentary_box box">
        <h2>Livre d'Or <i class="fas fa-book"></i></h2>
        <p>Laissez un message dans l'espace Accueil / Livre d'Or.</p>
        <div class="commentary_box_quotes">
            <?php foreach ($tplVars['commentaries'] as $key => $commentary) : ?>
            <blockquote>
                <cite>"<?= $commentary["Content"]; ?>"</cite>
                <!-- permet de choper la date, en enlevant l'heure -->
                <?php $date = explode(" ", $commentary['Created_at']); ?>
                <p class="commentary__author">le <?= $date[0]; ?> par
                    <?= $tplVars['commentaryCreatedBy'][$key] ?></p>
            </blockquote>
            <?php endforeach; ?>
        </div>
    </div>

</aside>