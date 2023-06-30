<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2>Nouveau Tournoi</h2>
<hr>

<table class="form-table">
    <form method="POST">
        <tr>
            <td><label>Nom</label></td>
            <td><input class="form-control" type="text" name="libelle" value="" size="20" required/></td>
        </tr>
        <tr>
            <td><label for="dateTournoi">Date du tournoi</label></td>
            <td><input class="form-control" type="date" name="dateTournoi" value="" required/></td>
        </tr>
        <tr>
            <td><label for="lieu">Lieu du tournoi</label></td>
            <td><input class="form-control" type="text" name="lieu" value="" required/></td>
        </tr>
        <tr>
            <td><label for="jugeArbitre">Juge arbitre</label></td>
            <td><input class="form-control" type="text" name="jugeArbitre" value="" required/></td>
        </tr>
        <tr>
            <td>
                <label>Type (Départemental, régional, etc.)</label>
            </td>
            <td>
                <select class="form-control" name="categorie" required>
                    <?php foreach ($categories ?? [] as $categorie) : ?>
                        <option value="<?= $categorie ?>">
                            <?= $categorie ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeTournoi" ?>">Annuler</a>
                <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="creerTournoi" />
            </td>
        </tr>
    </form>
</table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>
