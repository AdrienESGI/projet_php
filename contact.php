<?php
require_once("includes/config.php");
include("includes/header.php");

<h1>Contact</h1>

<div class="form-container">
    <form method="post" action="mailto:votre.email@exemple.com" enctype="text/plain">
        <label>Nom</label>
        <input type="text" name="nom" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Message</label>
        <textarea name="message" required></textarea>

        <button type="submit">Envoyer</button>
    </form>
</div>

<?php include("includes/footer.php"); ?>
