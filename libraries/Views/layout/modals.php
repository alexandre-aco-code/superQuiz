<!-- Modale pour s'inscrire' -->
<div class="modal" id="modalSignUp">
    <div class="modal-content">
        <a href="index.php" class="close">&times;</a>
        <p>Inscrivez vous pour profiter au maximum du super <span class="golden-text">Q</span>ui<span class="purple-text">Z</span>!</p>
        
        <form action="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=create" method="POST">
            <label for="email"><i class="fas fa-envelope"></i> Email (aucun spam garanti)</label>
            <input type="email" name="email" id="email" placeholder="email" />
            <label for="pseudo"><i class="fas fa-male"></i> Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" placeholder="pseudo" />
            <label for="password"><i class="fas fa-lock"></i> Mot de passe (sera crypté en interne pour une
                bonne sécurité)</label>
            <input type="password" name="password" id="password" placeholder="password" />
            <label for="email"><i class="fas fa-camera-retro"></i> Votre Avatar (pour vous reconnaître)</label>

            <!-- Choix de l'Avatar -->
            <div class="display_flex">
                <img src="https://images-na.ssl-images-amazon.com/images/M/MV5BNTczMzk1MjU1MV5BMl5BanBnXkFtZTcwNDk2MzAyMg@@._V1_UY256_CR2,0,172,256_AL_.jpg" alt="WillSmith">
                <img src="https://images-na.ssl-images-amazon.com/images/M/MV5BMjUzZTJmZDItODRjYS00ZGRhLTg2NWQtOGE0YjJhNWVlMjNjXkEyXkFqcGdeQXVyMTg4NDI0NDM@._V1_UY256_CR42,0,172,256_AL_.jpg" alt="GalGadot">
                <img src="https://images-na.ssl-images-amazon.com/images/M/MV5BOWViYjUzOWMtMzRkZi00MjNkLTk4M2ItMTVkMDg5MzE2ZDYyXkEyXkFqcGdeQXVyODQwNjM3NDA@._V1_UY256_CR36,0,172,256_AL_.jpg" alt="AdamDriver">
                <img src="https://images-na.ssl-images-amazon.com/images/M/MV5BNjk5NjE5NTczMV5BMl5BanBnXkFtZTcwODI0OTM0NA@@._V1_UY256_CR4,0,172,256_AL_.jpg" alt="Effy">
                <img src="https://images-na.ssl-images-amazon.com/images/M/MV5BOTU2MTI0NTIyNV5BMl5BanBnXkFtZTcwMTA4Nzc3OA@@._V1_UX172_CR0,0,172,256_AL_.jpg" alt="ChrisHemsworth">
            </div>
            <div class="display_flex">
                <input type="radio" name="avatar" value="1" id="avatar1" />
                <input type="radio" name="avatar" value="2" id="avatar2" />
                <input type="radio" name="avatar" value="3" id="avatar3" />
                <input type="radio" name="avatar" value="4" id="avatar4" />
                <input type="radio" name="avatar" value="5" id="avatar5" />
            </div>

            <button type="submit">S'inscrire!</button>
        </form>
    </div>
</div>

<!-- Modale pour login -->
<div class="modal" id="modalLogin">
    <div class="modal-content">
        <a href="index.php" class="close">&times;</a>
        <p>Merci de renseigner vos identifiants <span class="golden-text">Q</span>ui<span class="purple-text">Z</span>!</p>
        <form action="<?= $tplVars['WWW_URL']; ?>index.php?controller=user&task=login" method="POST">
            <label for="emaillogin"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="emaillogin" id="emaillogin" placeholder="email" />
            <label for="passwordlogin"><i class="fas fa-lock"></i> Mot de passe</label>
            <input type="password" name="passwordlogin" id="passwordlogin" placeholder="password" />
            <button type="submit">Se Connecter</button>
        </form>
    </div>
</div>