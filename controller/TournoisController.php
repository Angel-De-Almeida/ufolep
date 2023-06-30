<?php 
class TournoisController extends Controller
{
    private $modTourn = null;


    function liste()
    {
        $this->modTourn = $this->loadModel("Tournois");
        $d["Tournois"] = $this->modTourn->find(array('orderby' => 'nomTournois'));
        if (empty($d['Tournois'])) {
            $this->e404('Page introuvable');
        }
        $this->set($d);
        $this->render("liste");
    }
}
?>