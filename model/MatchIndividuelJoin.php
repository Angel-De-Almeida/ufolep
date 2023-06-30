<?php
class MatchIndividuelJoin extends Model
{
    var $table = "match_individuel INNER JOIN tournoi ON match_individuel.idTournoi = tournoi.idTournoi";

}

    


