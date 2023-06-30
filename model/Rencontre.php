<?php 
class Rencontre extends Model {
    var $table = "rencontre INNER JOIN journee ON rencontre.idJournee = journee.idJournee "
            . "INNER JOIN championnat ON journee.idChampionnat = championnat.idChampionnat";
            //. "INNER JOIN detailmatch ON rencontre.idRencontre = detailmatch.idRencontre";
}