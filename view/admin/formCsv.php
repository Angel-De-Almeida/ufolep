<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_top.php";?>

    <form enctype="multipart/form-data" method="post" action="">
        <!-- <input type="text" name="test">  -->
        <input type="file" name="file"  accept=".csv" >
        <button type="submit" class="button primarybuttonBlue" value="submitcsv" name="submitcsv">Import</button>
    </form>
    <!-- <label>le fichier : <?php echo $leFichier."---".$leFichierSub ?></label><label>le chemin : <?php echo $leChemin ?>
    </label><label>la requête : <?php echo $insert."---".$avant."-///-".$apres."---".$leTest ?>Le contenu <?php echo $leContenu." nb = ".$nb ?></label> </p>  -->
<?php require_once ROOT . DS . "view" . DS . "layout" . DS . "admin" . DS . "_admin_bottom.php"; ?>