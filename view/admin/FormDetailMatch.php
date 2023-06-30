<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>
<h2>Modifier le Match</h2>
<table class="form-table">
    <form method="POST" action="<?= BASE_URL . DS . "admin/FormDetailMatch/" . $matches->idmatch ?>">
        <tr>
            <td><label for="JR">Joueur A</label></td>
            <td><input class="form-control" type="text" name="JR" value="<?= isset($matches->JR) ? htmlspecialchars($matches->JR) : '' ?>" required/></td>
        </tr>
        <tr>
            <td><label for="JV">Joueur B</label></td>
            <td><input class="form-control" type="text" name="JV" value="<?= isset($matches->JV) ? htmlspecialchars($matches->JV) : '' ?>" required/></td>
        </tr>
        <tr>
            <td><label for="M1">M1</label></td>
            <td><input class="form-control" type="text" name="M1" value="<?= isset($matches->M1) ? htmlspecialchars($matches->M1) : '' ?>" required/></td>
        </tr>
        <tr>
            <td><label for="M2">M2</label></td>
            <td><input class="form-control" type="text" name="M2" value="<?= isset($matches->M2) ? htmlspecialchars($matches->M2) : '' ?>" required/></td>
        </tr>
        <tr>
            <td><label for="M3">M3</label></td>
            <td><input class="form-control" type="text" name="M3" value="<?= isset($matches->M3) ? htmlspecialchars($matches->M3) : '' ?>" required/></td>
        </tr>
        <tr>
            <td><label for="M4">M4</label></td>
            <td><input class="form-control" type="text" name="M4" value="<?= isset($matches->M4) ? htmlspecialchars($matches->M4) : '' ?>" required/></td>
        </tr>
        <tr>
            <td><label for="M5">M5</label></td>
            <td><input class="form-control" type="text" name="M5" value="<?= isset($matches->M5) ? htmlspecialchars($matches->M5) : '' ?>" required/></td>
        </tr>
        <tr>
            <td ><label> forfait ?</label></td>
            <fieldset>
                <td><input type="radio" name="forfait" value="A">Forfait club visité</td>
                <td><input type="radio" name="forfait" value="J" checked>Match joué</td>
                <td><input type="radio" name="forfait" value="B">Forfait club visiteur</td>
            </fieldset>
        </tr>
        <tr>
            <td><label for="parametre">Tour</label></td>
            <td>
                <select name="parametre" class="form-control" required>
                    <option value="128F">128F</option>
                    <option value="64F">64F</option>
                    <option value="32F">32F</option>
                    <option value="16F">16F</option>
                    <option value="8F">8F</option>
                    <option value="QF">QF</option>
                    <option value="DF">DF</option>
                    <option value="F">F</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="date">Date</label></td>
            <td><input class="form-control" type="date" name="date" value="<?= isset($matches->date) ? htmlspecialchars($matches->date) : '' ?>" required/></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="idTournoi" value="<?= isset($tournoi) ? $tournoi->idTournoi : '' ?>">
                <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeTournoi" ?>">Annuler</a>
                <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="formDetailMatch" />
            </td>
        </tr>
    </form>
</table>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>
