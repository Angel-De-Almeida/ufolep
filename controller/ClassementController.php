<?php

class ClassementController extends Controller
{
    private $modClassement = null;

    function liste()
    {
        if (isset($_GET['idChampionnat'])) {
        $idChampionnat=$_GET['idChampionnat'];

        }
        else{
            $idChampionnat="";
        }
        $this->modClassement = $this->loadModel('Classement');
        $this->modChampionnat = $this->loadModel("Championnat");

        $conditions = array("idChampionnat" => $idChampionnat);
        $params = array( 'conditions' => $conditions);

        $d["championnat"] = $this->modChampionnat->find($params);


            $projection = 'equipe.nomEquipe, equipe.nomPoule, equipe.idChampionnat, equipe.nbPoints, (equipe.matchesGagnes - equipe.matchesPerdus) as goalAverage';
            $orderby = 'equipe.nbPoints DESC, (equipe.matchesGagnes - equipe.matchesPerdus) DESC';
            $groupby = 'equipe.idEquipe';
            $params = array( 'projection' => $projection, 'conditions' => $conditions, 'orderby'=>$orderby, 'groupby'=>$groupby);

        $projection = 'equipe.nomEquipe, equipe.nomPoule, equipe.idChampionnat, engagement.nbPoints, (engagement.matchesGagnes - engagement.matchesPerdus) as goalAverage';
        $orderby = 'engagement.nbPoints DESC, (engagement.matchesGagnes - engagement.matchesPerdus) DESC';
        $groupby = 'equipe.idEquipe';
        $params = array( 'projection' => $projection, 'conditions' => $conditions, 'orderby'=>$orderby, 'groupby'=>$groupby);
        $d['classement'] = $this->modClassement->find($params);

        if (empty($d['classement'])) {
            $this->e404('Page introuvable');
        }
        
        $this->set($d);
    }

    function classementPoule()
    {
        $equipes = array();
        $equipesPoules = array();
        if (isset($_GET['nomPoule'])) {
            $idChampionnat = $_GET['idChampionnat'];
            $nomPoule = $_GET['nomPoule'];

            $modPoule = $this->loadModel('Poule');
            $projection = 'nomPoule';
            $conditions = array('idChampionnat' => $idChampionnat, 'nomPoule' => $nomPoule);
            $groupby = 'nomPoule';
            $params = array('projection' => $projection, 'conditions' => $conditions, 'groupby' => $groupby);
            $poule = $modPoule->find($params);
            $d['poule'] = $poule;

            if (empty($d['poule'])) {
                $this->e404('Poule introuvable');
            } else {
                $modEquipe = $this->loadModel('Equipe');
                $d['equipes'] = $modEquipe->find(array('conditions' => 1));
                $modEquipe->table .= " INNER JOIN poule ON poule.idEquipe = equipe.IdEquipe";
                $conditions = array('nomPoule' => $poule[0]->nomPoule);
                $groupby = "equipe.idEquipe";
                $orderby = "equipe.nbPoints desc";
                $params = array('conditions' => $conditions, 'groupby' => $groupby, 'orderby' => $orderby);
                $equipes = $modEquipe->find($params);
                //var_dump($equipes);
            }

        } else {
            $idChampionnat = $_GET['idChampionnat'];
            $modEnga = $this->loadModel('Classement');
            $modEnga->table .= " INNER JOIN championnat ON engagement.idChampionnat = championnat.idChampionnat";
            $projection = "equipe.nomEquipe, engagement.nbPoints, (engagement.matchesGagnes - engagement.matchesPerdus) as goalAverage";
            $orderby = "engagement.nbPoints DESC, (engagement.matchesGagnes - engagement.matchesPerdus) DESC";
            $conditions = array('championnat.idChampionnat' => $idChampionnat);
            $params = array('projection' => $projection,'conditions' => $conditions, 'orderby' => $orderby);
            $equipes = $modEnga->find($params);
            if (empty($equipes)) {
                $this->e404('Equipes Introuvable');
            }
        }
        array_push($equipesPoules, $equipes);
        $d['equipesPoules'] = $equipesPoules;

        $modChamp = $this->loadModel('Championnat');
        $conditions = array('championnat.idChampionnat' => $idChampionnat);
        $params = array('conditions' => $conditions);
        $d['championnat'] = $modChamp->findFirst($params);
        $this->set($d);
    }

}