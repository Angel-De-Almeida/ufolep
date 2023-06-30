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
                    <input class="form-control" type="text" name="equipea" value="<?= $equipeR[0]->nomEquipe ?>" size="20" readonly/>
                </td>
                <td><label>Équipe B</label></td>
                <td>
                    <input class="form-control" type="text" name="equipea" value="<?= $equipeV[0]->nomEquipe ?>" size="20" readonly/>
                </td>
                <td><label><!-- detailRenc --></label></td>
                <td>
                    <?php
                    /* foreach ($equipeR as $elem) :
                         echo $elem."--";
                     endforeach;*/
                    // echo $idEquipeR."--".$equipeR[0]->nomEquipe."**".$idClubR."//".$rencontre[0]->idJournee;
                    //$idClubR=$equipeR[0]->idClub;
                    ?>
                </td>
            </tr>
            <tr>
                <td ><label> forfait ?</label></td>
                <fieldset>
                    <td><input type="radio" name="forfait" value="A">Forfait équipe A</td><td>&ensp;</td>
                    <td><input type="radio" name="forfait" value="B">Forfait équipe B</td>
                    <td colspan="3"><input type="radio" name="forfait" value="J" checked>Match joué</td>
                </fieldset>
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
                    <input class="form-control" type="text" name="journee" value="<?= $journee[0]->numJournee;?>" size="20" readonly/>
                </td>
                <td><label>Arbitre</label></td>
                <td>
                    <select class="form-control" name="arbitre" required>
                        <option value="88">Choisissez un arbitre</option>

                        <?php
                        foreach ($joueurs as $joueur) :
                            if($joueur->idClub==$idClubR) {
                                echo '<option value="'.$joueur->idJoueur.'">';
                                echo $joueur->nom.'&nbsp'.$joueur->prenom;
                                echo '</option>';
                            }
                        endforeach; ?>  </td>
            </tr>
            <tr>
                <td ><label>Joueur A</label></td>
                <td >
                    <select class="form-control" name="joueurA" required>
                        <option value="88">Choisissez un joueur</option>

                        <?php
                        foreach ($joueurs as $joueur) :
                            if($joueur->idClub==$idClubR) {
                                echo '<option value="'.$joueur->idJoueur.'">';
                                echo $joueur->nom.'&nbsp'.$joueur->prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td><label>Joueur X</label></td>
                <td >
                    <select class="form-control" name="joueurX" required>
                        <option value="88">Choisissez un joueur</option>

                        <?php
                        foreach ($joueurs as $joueur) :
                            if($joueur->idClub==$equipeV[0]->idClub) {
                                echo '<option value="'.$joueur->idJoueur.'">';
                                echo $joueur->nom.'&nbsp'.$joueur->prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td ><label>Joueur B</label></td>
                <td  >
                    <select class="form-control" name="joueurB" required>
                        <option value="88">Choisissez un joueur</option>
                        <?php
                        foreach ($joueurs as $joueur) :
                            if($joueur->idClub==$idClubR) {
                                echo '<option value="'.$joueur->idJoueur.'">';
                                echo $joueur->nom.'&nbsp'.$joueur->prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                </td>
                <td><label>Joueur Y</label></td>
                <td >
                    <select class="form-control" name="joueurY" required>
                        <option value="88">Choisissez un joueur</option>
                        <?php
                        foreach ($joueurs as $joueur) :
                            if($joueur->idClub==$equipeV[0]->idClub) {
                                echo '<option value="'.$joueur->idJoueur.'">';
                                echo $joueur->nom.'&nbsp'.$joueur->prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td>&ensp;</td>
            </tr>
            <tr>
                <td  ><label>Joueur C</label></td>
                <td >
                    <select class="form-control" name="joueurC" required>
                        <option value="88">Choisissez un joueur</option>
                        <?php
                        foreach ($joueurs as $joueur) :
                            if($joueur->idClub==$idClubR) {
                                echo '<option value="'.$joueur->idJoueur.'">';
                                echo $joueur->nom.'&nbsp'.$joueur->prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td><label>Joueur Z</label></td>
                <td >
                    <select class="form-control" name="joueurZ" required>
                        <option value="88">Choisissez un joueur</option>

                        <?php
                        foreach ($joueurs as $joueur) :
                            if($joueur->idClub==$equipeV[0]->idClub) {
                                echo '<option value="'.$joueur->idJoueur.'">';
                                echo $joueur->nom.'&nbsp'.$joueur->prenom;
                                echo '</option>';
                            }
                        endforeach; ?>
                    </select>
                </td>
                <td>&ensp;</td>
            </tr>


            <tr><td colspan ="4"> <h5>Cliquer sur enregistrer pour sauvegarder les donnees et saisir les matchs</h5></td>
                <td>

                    <input class="primarybuttonBlue" type="submit" value="Enregistrer" name="<?= (isset($rencontre)) ? "modifierrencontre" : "creerrencontre" ?>"/>
                </td>
                <td> <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat"?>">Annuler</a>
                </td>
            </tr>
        </table><br/>

        </div>
        <br/>


    </form>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>