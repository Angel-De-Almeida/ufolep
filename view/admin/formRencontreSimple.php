<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>

<h2><?= (isset($rencontre)) ? "Modification de la rencontre" : "Nouvelle rencontre" ?></h2>
<hr>

<form method="POST" action="">
    <table class="form-table">    
        <tr>
            <td><label>Heure</label></td>
            <td><input class="form-control" type="time" name="heure" value="<?= (isset($rencontre)) ? $rencontre[0]->heure : "" ?>" size="20" required/></td>
            <td><label>Date</label></td>
            <td><input class="form-control" type="date" name="date" value="<?= (isset($rencontre)) ? $rencontre[0]->date : "" ?>" size="20" required/></td>
            <td><label>Lieu</label></td>
            <td><input class="form-control" type="text" name="lieu" value="<?= (isset($rencontre)) ? $rencontre[0]->lieu : "" ?>" size="20" required/></td>
        </tr>  
        <tr>
            <td><label>Équipe A</label></td>
            <td>
                <select class="form-control" name="equipea" required>
                    <?php
                    foreach ($equipes as $equipe) : ?>
                        <option value="<?= $equipe->idEquipe?>"<?php if ($rencontre[0]->idEquipeA == $equipe->idEquipe) { echo " selected"; } ?>>
                            <?= $equipe->nomEquipe ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><label>Équipe B</label></td>
            <td>
                <select class="form-control" name="equipeb" required>
                    <?php
                    foreach ($equipes as $equipe) : ?>
                        <option value="<?= $equipe->idEquipe?>"<?php if ($rencontre[0]->idEquipeB == $equipe->idEquipe) { echo " selected"; } ?>>
                            <?= $equipe->nomEquipe ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Score de l'équipe A</label></td>
            <td><input class="form-control" type="number" name="scorea" value="<?= (isset($rencontre)) ? $rencontre[0]->scoreFinalA : "" ?>" size="20" required/></td>
            <td><label>Score de l'équipe B</label></td>
            <td><input class="form-control" type="number" name="scoreb" value="<?= (isset($rencontre)) ? $rencontre[0]->scoreFinalB : "" ?>" size="20" required/></td>
            <td><label>Forfait</label></td>
            <td><fieldset>
                    <label>Cette rencontre a-t-elle donné lieu à un forfait ?</label><br/>
                    <input type="radio" name="forfait" value="J" checked>Match joué<br/>
                    <input type="radio" name="forfait" value="A">Forfait équipe A<br/>
                    <input type="radio" name="forfait" value="B">Forfait équipe B<br/>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td><label>Points A</label></td>
            <td>  <?php 
            foreach ($equipes as $equipe) :
                if ($rencontre[0]->idEquipeA == $equipe->idEquipe) { ?>                
                    <input class="form-control" type="text" name="nbPointsA" value="<?= $equipe->nbPoints ?>" size="20" readonly/></td>
                <?php   }  
            endforeach; ?> 
            </td>
               
            <td><label>Points B</label></td>
            <td><?php  
            foreach ($equipes as $equipe) :
                if ($rencontre[0]->idEquipeB == $equipe->idEquipe) { ?> 
                    <input class="form-control" type="text" name="nbPointsB" value="<?= $equipe->nbPoints ?>" size="20" readonly/></td>
                <?php   }  
            endforeach; ?></td>
                
        </tr>
        <tr>
            <td><label>Journée</label></td>
            <td>
            <select class="form-control" name="journee" required>
                
                    <?php
                    foreach ($journees as $journee) : ?>
                        <option value="<?= $journee->idJournee ?>"<?php if ($rencontre[0]->idJournee == $journee->idJournee) { echo " selected"; } ?>>
                            <?= $journee->numJournee ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><label>Arbitre</label></td>
            <td>
            <select class="form-control" name="arbitre" required>
                    <option value="88">Aucun</option>
                   
                    <?php
                    foreach ($arbitres as $joueur) : ?>
                          <option value="<?= $joueur->idArbitre ?>"<?php if ($rencontre[0]->idArbitre == $joueur->idArbitre) { echo " selected"; } ?>> 
                            <?= $joueur->nom ?>&nbsp;<?= $joueur->prenom ?>
                          </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat"?>">Annuler</a>
                <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="<?= (isset($rencontre)) ? "modifierrencontre" : "creerrencontre" ?>"/>
            </td>
        </tr>
    </table>
 </form>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>