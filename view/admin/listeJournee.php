<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php"; ?>
    
    <h2>
        <?= $championnat->nomChampionnat . " " . $championnat->typeChampionnat . " Division " . $championnat->idDivision."&nbsp;".
        ((isset($nomPoule) && $nomPoule != "") ? "Poule" . $nomPoule : "Poule unique"); ?>

    </h2>
    <hr>

<?php

$cpt = 1;

// Supporte jusqu'à 2 poules
$midPointer = count($journee) / 2;
$endPointer = count($journee) ;
if ($hasPoules) {
    $p1 = array_slice($journee, 0, $midPointer);
    $p2 = array_slice($journee, $midPointer, $endPointer);

    $poules = [
        "Phase 1" => $p1,
        "Phase 2" => $p2
    ];
} else {
   // $poules = ["Journée - Date " => $journee];
    $p1 = array_slice($journee, 0, $midPointer);
    $p2 = array_slice($journee, $midPointer, $endPointer);

    $poules = [
        "Phase Aller" => $p1,
        "Phase Retour" => $p2
    ];
}
?>

    <a class="button primarybuttonWhite" href="<?= BASE_URL . DS . "admin/listeChampionnat" ?>">Retour au tableau de bord</a>

<?php

echo '<div class="row"> ';

foreach ($poules as $nom => $p) {
    echo "<table class='data-table sober col" . ($hasPoules ? "-6" : "") . "'>
            <thead>
                <th class='text-center'>$nom</th>
            </thead>
            <tbody>";

   foreach ($p as $j):

     ?>



    <tr class="hover-accent card col" >
        <td class="card-header ">Journée <?= $cpt++ . " - " . date("d/m/y", strtotime($j->datePrev)) ?></td>

        <td class="button-container">
             <a href="<?php echo BASE_URL .
                "/admin/listeRencontre/?idchampionnat=" . $championnat->idChampionnat ."&idjournee="
                . $j->idJournee . ($hasPoules ? ("&nompoule" . $nomPoule ) : "")
            ?>" class="button primarybuttonBlue card-footer text-center ">Voir</a>
        </td>
    </tr>

    <?php


   endforeach;

    echo "  </tbody>
          </table>";
}

echo " </div>";

require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php";  ?>