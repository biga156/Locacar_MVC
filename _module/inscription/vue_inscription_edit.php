<h1>Créer un compte </h1>
<form enctype="multipart/form-data" action="<?= hlien("inscription", "edit") ?>" method="post">
    <input type="hidden" name="uti_id" id="uti_id" value="<?= $uti_id ?>" />
  
    <div class='form-group'>
        <label for='uti_nom'>Nom</label>
        <input id='uti_nom' name='uti_nom' type='text' size='50' value='<?= mhe($uti_nom) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='uti_prenom'>Prenom</label>
        <input id='uti_prenom' name='uti_prenom' type='text' size='50' value='<?= mhe($uti_prenom) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='uti_mail'>E-mail</label>
        <input id='uti_mail' name='uti_mail' type='email' size='50' value='<?= mhe($uti_mail) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='uti_adresse'>Adresse</label>
        <input id='uti_adresse' name='uti_adresse' type='text' size='50' value='<?= mhe($uti_adresse) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='uti_username'>nom d'utilisateur</label>
        <input id='uti_username' name='uti_username' type='text' size='50' value='<?= mhe($uti_username) ?>' class='form-control' />
    </div>

    <div class='form-group'>
        <label for='uti_passw'>Password</label>
        <input id='uti_passw' name='uti_passw' type='password' size='50' value='<?= mhe($uti_passw) ?>' class='form-control' />
    </div>
 
    <input class="btn btn-success" type="submit" name="btsubmit" value="Enregistrer" />
</form>