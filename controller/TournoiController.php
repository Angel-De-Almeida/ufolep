<?php
class TournoiController extends Controller
{
    function listeTournoi()
    {    
        $this->modMatch = $this->loadModel('MatchIndividuel');
        $orderby = "match_individuel.idmatch";
        $params = array();
        $params = array('orderby' => $orderby);
        $d['Matchs'] = $this->modMatch->find($params);
    
        $this->modTournoi = $this->loadModel('Tournoi');
        $tournois = $this->modTournoi->find();
        $d['Tournois'] = json_decode(json_encode($tournois), true);

        if (empty($d['Matchs'])) {
            $this->e404('Page introuvable');
        }
    
        $this->set($d);
        $this->render("listeTournoi");
    }    

    public function listeMatchIndividuel($idTournoi)
    {

        if ($idTournoi === null) {
            $this->e404('Tournoi introuvable');
        }

        $tournoiModele = $this->loadModel("Tournoi");
        $tournoi = $tournoiModele->getTournoiById($idTournoi);
        
        if (!$tournoi) {
            $this->e404('Tournoi introuvable');
        }

        $matchModele = $this->loadModel('MatchIndividuel');
        $matches = $matchModele->find(array('conditions' => array('idTournoi' => $idTournoi), 'orderby' => 'idMatch'));

        $this->set('matches', $matches);
        $this->set('tournoi', $tournoi);
        $this->render("listeMatchIndividuel");
    }



}
?>
