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
                        <i class="fab fa-wpexplorer"></i><br>
                        Explorer</a>
                    <ul>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php"><i class="fab fa-wpexplorer"></i>Mode
                                d'emploi</a></li>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=commentary&task=index"><i class="fab fa-wpexplorer"></i>Livre d'Or</a></li>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=about"><i class="fab fa-wpexplorer"></i>A propos de Quiz by ACo</a></li>
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
                            <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=question&task=index&topic=<?= $topic['Id']; ?>&indexQuestion=1"><i class="fas fa-seedling"></i> <?= $topic['Name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <!-- MENU DE NAVIGATION : CLASSEMENT -->
                <li>
                    <a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=rankings">
                        <i class="fas fa-poll-h"></i><br>
                        Classement</a>
                    <ul>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=rankings"><i class="fas fa-poll-h"></i>Classement ( Mondial bien sûr )</a></li>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=topic&task=index&topic=1"><i class="fas fa-poll-h"></i>Mes résultats par Topic</a></li>
                    </ul>
                </li>
                <!-- MENU DE NAVIGATION : MON COMPTE -->
                <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=infosUser">
                        <i class="fas fa-user-circle"></i><br>
                        Mon Compte</a>
                    <ul>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=create&topic=1&indexQuestion=1#modalSignUp"><i class="fas fa-user-circle"></i>S'inscrire</a></li>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=login&topic=1&indexQuestion=1#modalLogin"><i class="fas fa-user-circle"></i>Se Connecter</a></li>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=infosUser"><i class="fas fa-user-circle"></i>Mes informations</a></li>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>index.php?controller=Admin\Dashboard&task=index" target="_blank"><i class="fas fa-puzzle-piece"></i>Administration BackOffice</a>
                        </li>
                        <li><a href="<?= $tplVars['WWW_URL']; ?>libraries/Out.php"><i class="fas fa-power-off"></i>Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>