<?php include VIEW_PART_DIR . 'header.php'; ?>
<a class="bouton" href="#form-signer">Signer le livre</a>
<h2>Messages des visiteurs</h2>
<?php if ($messages) : ?>
    <ul class="messages">
        <?php foreach($messages as $message) : ?>
            <li>
                <blockquote>
                    <h3><?= $message['titre'] ?></h3>
                    <p><?= $message['message'] ?></p>
                    <footer>
                        <div class="author">
                            <?= $message['auteur'] ?>
                        </div>
                        <time datetime="<?= $message['date'] ?>">
                            <?=  localDate($message['date']) ?>
                        </time>
                    </footer>
                </blockquote>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Votre livre d'or est vide...</p>
<?php endif; ?>

<h2 id="form-signer">Signer le livre d'or</h2>

<?php if($errors): ?>
    <div class="errors">
        <h3>Il y a un problème avec votre message</h3>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="#form-signer">
    <div>
        <label for="auteur">Nom et prénom</label>
        <input name="auteur" id="auteur" type="text" value="<?= $nouveauMsg['auteur'] ?>">
    </div>
    <div>
        <label for="titre">Titre</label>
        <input name="titre" id="titre" type="text" value="<?= $nouveauMsg['titre'] ?>">
    </div>
    <div>
        <label for="message">Message</label>
        <textarea name="message" id="message"><?= $nouveauMsg['message'] ?></textarea>
    </div>
    <div>
        <input class="bouton" name="submit" type="submit" value="Envoyer votre message">
    </div>
</form>

<?php include VIEW_PART_DIR . 'footer.php' ?>