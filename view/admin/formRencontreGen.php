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
		 <td><label>Joueur A</label></td>
            <td>
			<select class="form-control" name="joueurA" required>
            <option value="88">Choisissez un joueur</option>
                                       
                    <?php
                    foreach ($joueurs as $joueur) : ?>
                          <option value="<?= $joueur->idJoueur ?>"> 
                            <?= $joueur->nom ?>&nbsp;<?= $joueur->prenom ?>
                          </option>
                    <?php endforeach; ?>
                </select>
            </td>
			 <td><label>Joueur X</label></td>
            <td>
            <select class="form-control" name="joueurX" required>
                    <option value="88">Choisissez un joueur</option>
                   
                    <?php
                    foreach ($joueurs as $joueur) : ?>
                          <option value="<?= $joueur->idJoueur ?>"> 
                            <?= $joueur->nom ?>&nbsp;<?= $joueur->prenom ?>
                          </option>
                    <?php endforeach; ?>
                </select>
            </td>
		
		</tr>
		<tr>
		 <td><label>Joueur B</label></td>
            <td>
            <select class="form-control" name="joueurB" required>
                    <option value="88">Choisissez un joueur</option> 
                    <?php
                    foreach ($joueurs as $joueur) : ?>
                          <option value="<?= $joueur->idJoueur ?>"> 
                            <?= $joueur->nom ?>&nbsp;<?= $joueur->prenom ?>
                          </option>
                    <?php endforeach; ?>
                </select>
            </td>
			 <td><label>Joueur Y</label></td>
            <td>
            <select class="form-control" name="joueurY" required>
                    <option value="88">Choisissez un joueur</option>
                   
                    <?php
                    foreach ($joueurs as $joueur) : ?>
                          <option value="<?= $joueur->idJoueur ?>"> 
                            <?= $joueur->nom ?>&nbsp;<?= $joueur->prenom ?>
                          </option>
                    <?php endforeach; ?>
                </select>
            </td>
		
		</tr>
        <tr>
		 <td><label>Joueur C</label></td>
            <td>
            <select class="form-control" name="joueurC" required>
                    <option value="88">Choisissez un joueur</option> 
                    <?php
                    foreach ($joueurs as $joueur) : ?>
                          <option value="<?= $joueur->idJoueur ?>"> 
                            <?= $joueur->nom ?>&nbsp;<?= $joueur->prenom ?>
                          </option>
                    <?php endforeach; ?>
                </select>
            </td>
			 <td><label>Joueur Z</label></td>
            <td>
            <select class="form-control" name="joueurZ" required>
                    <option value="88">Choisissez un joueur</option>
                   
                    <?php
                    foreach ($joueurs as $joueur) : ?>
                          <option value="<?= $joueur->idJoueur ?>"> 
                            <?= $joueur->nom ?>&nbsp;<?= $joueur->prenom ?>
                          </option>
                    <?php endforeach; ?>
                </select>
            </td>
		</tr>
        <tr>
		 <td><label>Joueur AA</label></td>
            <td>
            <select class="form-control" name="joueurAA" required>
                    <option value="88">Choisissez un joueur</option>
                   
                    <?php
                    foreach ($joueurs as $joueur) : ?>
                          <option value="<?= $joueur->idJoueur ?>"> 
                            <?= $joueur->nom ?>&nbsp;<?= $joueur->prenom ?>
                          </option>
                    <?php endforeach; ?>
                </select>
            </td>
			 <td><label>Joueur ZZ</label></td>
            <td>
            <select class="form-control" name="joueurZZ" required>
                    <option value="88">Choisissez un joueur</option>
                   
                    <?php
                    foreach ($joueurs as $joueur) : ?>
                          <option value="<?= $joueur->idJoueur ?>"> 
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
    </table><br/>
    <div>
    <table border=1 class="data-table sober">
        <thead class="text-center">
            <tr>
                <th colspan=4>Equipe <?php
                                    foreach ($equipes as $e) {
                                        if ($e->idEquipe == $rencontre[0]->idEquipeA) {
                                            echo $e->nomEquipe;
                                        }
                                    }
                                    ?></th>
                <th colspan=4>Equipe <?php
                                    foreach ($equipes as $e) {
                                        if ($e->idEquipe == $rencontre[0]->idEquipeB) {
                                            echo $e->nomEquipe;
                                        }
                                    }
                                    ?></th>
            </tr>
            <tr>
                <th></th>
                <th>NOM PRENOM</th>
                <th>Licence</th>
                <th>Classement</th>
                <th></th>
                <th>NOM PRENOM</th>
                <th>Licence</th>
                <th>Classement</th>
            </tr>
        </thead>
        <tr>
        <?php         
       
            for ($cpt = 0; $cpt < 3; $cpt++) : ?>
            <td><?php if ($cpt == 0) {
                    echo 'A';
                } elseif ($cpt == 1) {
                    echo 'B';
                } else {
                    echo 'C';
                } ?></td>
            <?php   // ajout 11/08/2020
             if(isset($matchs[$cpt])) {
                foreach ($joueurs as $j) {
               
                  if ($j->idJoueur == $matchs[$cpt]->idJR) {
                    echo '<td>' . $j->nom . ' ' . $j->prenom . '</td>';
                    echo '<td>' . mb_strtoupper($j->licenceJoueur) . '</td>';
                    echo '<td>' . $j->nbPoints . '</td>';
                  }
                }
            }
             else
                {
                    echo '<td> --- </td>';
                    echo '<td> --- </td>';
                    echo '<td> --- </td>';
                }
              // ajout 11/08/2020
            ?>
            <td><?php if ($cpt == 0) {
                    echo 'X';
                } elseif ($cpt == 1) {
                    echo 'Y';
                } else {
                    echo 'Z';
                } ?></td>
            <?php
               if(isset($matchs[$cpt])) {
                foreach ($joueurs as $j) {
              // ajout 11/08/2020
            
                if ($j->idJoueur == $matchs[$cpt]->idJV) {
                    echo '<td>' . $j->nom . ' ' . $j->prenom . '</td>';
                    echo '<td>' . mb_strtoupper($j->licenceJoueur) . '</td>';
                    echo '<td>' . $j->nbPoints . '</td>';
                }
               }
              } // ajout 11/08/2020
               else
                {
                    echo '<td> --- </td>';
                    echo '<td> --- </td>';
                    echo '<td> --- </td>';
                }
             ?>
        </tr>
            <?php endfor; 
            // ajout 11/08/2020
        
        ?>
    </table>
</div>
<br/>

    <table border='1'class="data-table sober">
        <thead>
            <th></th>
            <th>Joueurs ABC</th>
            <th>Joueurs XYZ</th>
            <th>Manche 1</th>
            <th>Manche 2</th>
            <th>Manche 3</th>
            <th>Manche 4</th>
            <th>Manche 5</th>
            <th>Points ABC</th>
            <th>Points XYZ</th>
        </thead>
        <?php $cpt = 0;
        // ajout 11/08/2020
        if(isset($matchs)) {
        foreach ($matchs as $match) : ?>
            <tr>
                <td><?= $typeRencontre[$cpt];
                    $cpt++ ?></td>
                <td>
                    <?php foreach ($joueurs as $j) {
                        if ($j->idJoueur == $match->idJR) {
                            echo $j->nom;
                        }
                    } ?>
                </td>
                <td>
                    <?php foreach ($joueurs as $j) {
                        if ($j->idJoueur == $match->idJV) {
                            echo $j->nom;
                        }
                    } ?>
                </td>
                <td><?= $match->score1A . ' / ' . $match->score1B ?></td>
                <td><?= $match->score2A . ' / ' . $match->score2B ?></td>
                <td><?= $match->score3A . ' / ' . $match->score3B ?></td>
                <td><?= isset($match->score4A) ? $match->score4A . ' / ' . $match->score4B : '-'; ?></td>
                <td><?= isset($match->score5A) ? $match->score5A . ' / ' . $match->score5B : '-'; ?></td>
                <td><?= ($match->pointsA == 1) ? $match->pointsA : '-'; ?></td>
                <td><?= ($match->pointsB == 1) ? $match->pointsB : '-'; ?></td>
            </tr>
        <?php endforeach; 
           // ajout 11/08/2020
            }
        ?>
        <tr>
                <td>Double</td>
                <td colspan="2"></td>
                <td>? / ?</td>
                <td>? / ?</td>
                <td>? / ?</td>
                <td>? / ?</td>
                <td>? / ?</td>
                <td><?= '-'; ?></td>
                <td><?= '-'; ?></td>
        </tr>
        <tr>
            <td colspan="8">Score de le rencontre</td>
            <td><?= $rencontre[0]->scoreFinalA ?></td>
            <td><?= $rencontre[0]->scoreFinalB ?></td>
        </tr>
    </table>
 </form>
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>