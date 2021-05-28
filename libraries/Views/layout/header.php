<header class="header">
    <div class="container display">
        <!-- Logo -->
        <a href="<?= $tplVars['WWW_URL']; ?>index.php">
            <img src="assets/images/quiz-logo-made-by-me.svg" alt="quiz-logo-made-by-me" />
        </a>
        <!-- MENU DE NAVIGATION -->
        <nav>
            <ul>
                <!-- MENU DE NAVIGATION : EXPLORER -->
                <li>
                    <a href="<?= $tplVars['WWW_URL']; ?>index.php">
                        <i class="fas fa-igloo"></i><br>
                        Accueil</a>
                    <ul>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=commentary&task=index"><i
                                    class="fas fa-book"></i>Livre d'Or</a></li>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=about"><i
                                    class="far fa-address-card"></i>A propos de Quiz by ACo</a></li>
                    </ul>
                </li>
                <!-- MENU DE NAVIGATION : TOPICS -->
                <li>
                    <a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=topic&task=index&topic=1">
                        <i class="fas fa-seedling"></i><br>
                        Topics
                    </a>
                    <ul>
                        <?php foreach ($tplVars['topics'] as $topic) : ?>
                        <li><a
                                href="<?= $tplVars['WWW_URL']; ?>index.php?controller=question&task=index&topic=<?= $topic['Id']; ?>&indexQuestion=1"><i
                                    class="fas fa-seedling"></i> <?= $topic['Name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <!-- MENU DE NAVIGATION : CLASSEMENT -->
                <li>
                    <a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=rankings">
                        <i class="fas fa-globe-africa"></i><br>
                        Classement</a>
                </li>
                <!-- MENU DE NAVIGATION : MON COMPTE -->
                <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=infosUser">
                        <i class="fas fa-user-circle"></i><br>
                        Compte</a>
                    <ul>
                        <!-- Si personne n'est loggé alors les commandes S'inscrire et Se Connecter son disponibles, sinon elles se masquent -->
                        <?php if (!\Session::isConnected()) :
                        ?>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=signUpForm"><i
                                    class="fas fa-user-circle"></i>S'inscrire</a></li>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=loginForm"><i
                                    class="fas fa-user-circle"></i>Se Connecter</a></li>
                        <?php endif ?>

                        <!-- Si l'utilisateur est connecté, alors on affiche la possibilité de se déconnecter. -->
                        <?php if (\Session::isConnected()) :
                        ?>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=infosUser"><i
                                    class="fas fa-user-circle"></i>Mes informations</a></li>

                        <?php if (\Session::isAdmin()) : ?>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=Admin\Dashboard&task=index"
                                target="_blank"><i class="fas fa-puzzle-piece"></i>Administration BackOffice</a>
                        </li>
                        <?php endif ?>

                        <li><a href="<?= $tplVars['WWW_URL']; ?>libraries/Out.php"><i
                                    class="fas fa-power-off"></i>Déconnexion</a></li>
                        <?php endif ?>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>