<?php $genderSuffix = $c_user["sexe"] === "M" ? "" : "e" ?>


<div id="admin-menu" class="container-fluid col-lg-3">
    <div class="col-lg-6" >
        <input class="primarybuttonWhite" type="button" value="<" onclick="fermer()" name="cacheMenu1" style="display: ; margin-bottom: 10px" />
        <input class="primarybuttonWhite" type="button" value=">" onclick="ouvrir()" name="cacheMenu2" style="display: none ; margin-bottom: 10px" />
    </div>


    <div class="welcome-container" style="display: " name="cacher">

        <span class="welcome-message">Session de <b
                    style='color: #00379a'><?= ucfirst(mb_strtolower($c_user["prenom"])) . " " . ucfirst(mb_strtolower($c_user["nom"])) ?></b></span>
        <br>
        <span>Vous êtes connecté<?= $genderSuffix ?> en tant
            <?=
            /*
            $c_user["typeCompte"] === "GÉRANT" ? "que <b style='color: #ffa500'>"
                . ucfirst(mb_strtolower($c_user["typeCompte"])) . $genderSuffix . "</b>" : "qu'<b style='color: #00a800'>"
                . ucfirst(mb_strtolower($c_user["typeCompte"])) . "</b>"
            */
            $c_user["typeCompte"] === "GÉRANT" ? "qu' <b style='color: #ffa500'>administrateur</b>" : "que&nbsp;<b style='color: #00a800'>correspondant club</b>" ?>
            .</span>
    </div>



<div style="display: " name="cacher">
    <h4 class="admin-menu-title">Panel de gestion</h4>
    <a href="<?= BASE_URL . DS ?>admin/listeChampionnat">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-home"></i></div>
            <div class="col nav-item">Tableau de bord</div>
        </div>
    </a>
    <hr>
    <a href="<?= BASE_URL . DS ?>admin/listeEquipe">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-users"></i></div>
            <div class="col nav-item">Équipes</div>
        </div>
    </a>
    <a href="<?= BASE_URL . DS ?>admin/listeJoueur">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-table-tennis"></i></div>
            <div class="col nav-item">Joueurs</div>
        </div>
    </a>
    <a href="<?= BASE_URL . DS ?>admin/listeTournoi">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-table-tennis"></i></div>
            <div class="col nav-item">Tournois</div>
        </div>
    </a>
    <hr>
    <?php if ($c_user["typeCompte"] === "GÉRANT"): ?>
        <a href="<?= BASE_URL . DS ?>admin/listePersonne">
            <div class="row mx-0">
                <div class="nav-item icon-container"><i class="fas fa-user-cog"></i></div>
                <div class="col nav-item">Gestion des personnes</div>
            </div>
        </a>
    <?php endif; ?>
    <?php if ($c_user["typeCompte"] === "GÉRANT"): ?>
        <a href="<?= BASE_URL . DS ?>admin/listeUtilisateur">
            <div class="row mx-0">
                <div class="nav-item icon-container"><i class="fas fa-user-shield"></i></div>
                <div class="col nav-item">Gestion des utilisateurs</div>
            </div>
        </a>
    <?php endif; ?>
    <a href="<?= BASE_URL . DS . "admin/formUtilisateur/" . $c_user["idCompte"] ?>">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-user-circle"></i></div>
            <div class="col nav-item">Mon compte</div>
        </div>
    </a>
    <hr>
    <a class="disconnect-link" href="<?= BASE_URL . DS ?>auth/logout">
        <div class="row mx-0">
            <div class="nav-item icon-container"><i class="fas fa-power-off"></i></div>
            <div class="col nav-item">Déconnexion</div>
        </div>
    </a>
</div>
</div>
<script>
    var cm1 = document.getElementsByName("cacheMenu1").item(0);
    var cm2 = document.getElementsByName("cacheMenu2").item(0);
    var elements = document.getElementsByName("cacher");



    function ouvrir() {

        cm2.style.display = "none";
        cm1.style.display = "";
        elements.item(0).style.display = "";
        elements.item(1).style.display = "";
    }
    function fermer() {

        cm1.style.display = "none";
        cm2.style.display = "";
        elements.item(0).style.display = "none";
        elements.item(1).style.display = "none";
    }
</script>