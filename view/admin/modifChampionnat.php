<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

    <h2>Modifier un championnat</h2>
    <hr>

    <table class="form-table">
<?php
foreach ($championnats as $c) : ?>
        <form method="POST">
            <tr>
                <td><label>Nom</label></td>
                <td><input class="form-control" type="text" name="nomChampionnat" value="<?= $c->nomChampionnat; ?>" size="20" required/></td>
            </tr>
            <tr>
                <td>
                    <label>Type (Départemental, régional, etc.)</label>
                </td>
                <td>
                    <select class="form-control" name="typeChampionnat" required>
                        <?php
                        foreach ($typesChampionnat as $typeChampionnat) : ?>
                            <option value="<?= $typeChampionnat ?>">
                                <?= $typeChampionnat ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Nombre de journées</label></td>
                <?php foreach ($journees as $j) :?>
                <td><input class="form-control" type="number" name="nombreJournee"  value="<?= $j->nombreJournee; ?>" required /></td>
                <?php endforeach;?>
            </tr>
            <tr>
                <td><label>Division</label></td>
                <td>
                    <select class="form-control" name="idDivision" required>
                        <?php
                        foreach ($divisions as $division) : ?>
                            <option value="<?= $division->idDivision ?>">
                                <?= $division->nomDivision ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat" ?>">Annuler</a>
                    <input class="primarybuttonBlue" type="submit" value="Confirmer la modification" name="modifChampionnat" />
                </td>
            </tr>
        </form>
<?php endforeach;?>
    </table>

<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>