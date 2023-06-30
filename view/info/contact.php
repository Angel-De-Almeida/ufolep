<section class="row static-content">
    <div class="col-2"></div>
    <div class="col-8">
<h2>Contact</h2>
<hr>
<table class="form-table ">
<p>Pour plus de renseignement ou pour des demandes particulières, veillez <strong>remplir ce formulaire.</strong></p>
<form method="post"  enctype="multipart/form-data" action="" >
    <tr>
        <td><label>Prénom</label></td>
        <td><input class="form-control" type="text" name="prenomContact" value="" size="20" required/></td>
    </tr>
    <tr>
        <td><label>Nom</label></td>
        <td><input class="form-control" type="text" name="nomContact" value="" size="20" required/></td>
    </tr>
    <tr>
        <td><label>Mail</label></td>
        <td><input class="form-control" type="email" name="mailContact" value="" size="20" required/></td>
    </tr>
    <tr>
        <td><label>Objet</label></td>
        <td><input class="form-control" type="text" name="objMail" value="" size="20" required/></td>
    </tr>

    <tr>
        <td><label>Message</label></td>
        <td><textarea class="form-control" type="text" name="message"  rows="10" cols="50" required></textarea>

            </td>
    </tr>
    <tr>

        <td><label>Piece(s) Jointe(s)</label></td>
        <td>
            <input type="file" name="PJMail[]" multiple>
        </td>
    </tr>

    <tr>
       <td>
        <button class="primarybuttonBlue" type="submit"   name="saisie">Envoyer</button>
       </td>
    </tr>


</form>
</table>
        </div>
    <div class="col-2"></div>
</section>