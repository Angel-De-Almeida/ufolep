<?php 
class ChampionnatController extends Controller
{
    private $modChamp = null;


    function liste() // les championnats actuelles
    {
        $this->modChamp = $this->loadModel("Championnat");
        //$d["championnats"] = $this->modChamp->find(array('orderby' => 'idChampionnat desc'));
        // NB : penser à traiter le cas des poules quand il y en a
        $d["championnats"] = $this->modChamp->find(array('orderby' => 'nomChampionnat desc, championnat.idDivision',
            'conditions'=>'nomChampionnat LIKE "%'.date ("Y").'"; '));// La condition cherche si l'année du championnat
        // (dans le nom) est l'année actuelle
        if (empty($d['championnats'])) {
            $this->e404('Page introuvable');
        }

        $this->set($d);
        $this->render("liste");
    }
    function ancienneListe() // Les anciens championnats
    {
        $this->modChamp = $this->loadModel("Championnat");
        $d["ancienChampionnats"] = $this->modChamp->find(array('orderby' => 'nomChampionnat desc, championnat.idDivision',
            'conditions'=>'nomChampionnat NOT LIKE "%'.date ("Y").'"; ')); // La condition cherche si l'année du championnat
        // (dans le nom) n'est pas l'année actuelle
        if (empty($d['ancienChampionnats'])) {
            $this->e404('Page introuvable');
        }

        $this->set($d);
        $this->render("ancienneListe");
    }
}
?>