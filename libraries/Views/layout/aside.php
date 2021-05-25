<aside>

    <!-- ASIDE BOX 1 POUR LE PROFIL DE l'USER -->
    <div class="identification box">
        <h2>Profil</h2>
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
        <p><span class="golden-text">V</span>otre Nivea<span class="purple-text">u</span> (mis à
            jour à la fin d'un topic) :</p>
        <p class="avancement"><?= $tplVars['progressionUser']; ?> %</p>
        <!-- sinon si l'utilisateur n'est pas connecté j'affiche ce message -->
        <?php
        else :
        ?>
        <p>Utilisateur non connecté :(</p>
        <?php
        endif;
        ?>
    </div>


    <!-- ASIDE BOX 2 POUR LES COMMENTAIRES  -->
    <div class="commentary_box box">
        <h2>Commentaires</h2>
        <p>Aidez moi à améliorer le site, mettez votre avis dans l'espace Explorer/Livre d'Or ;)</p>
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