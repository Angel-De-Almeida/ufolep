<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2>Modifier un tournois</h2>
    <hr>

    <table class="form-table">
<?php
foreach ($tournois as $t) : ?>
        <form method="POST">
            <tr>
                <td><label>Nom</label></td>
                <td><input class="form-control" type="text" name="nomTournois" value="<?= $t->nomTournois; ?>" size="20" required/></td>
            </tr>
            <tr>
                <td>
                    <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeTournois" ?>">Annuler</a>
                    <input class="primarybuttonBlue" type="submit" value="Confirmer la modification" name="modifTournois" />
                </td>
            </tr>
        </form>
<?php endforeach;?>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>