        <form method="post" action="<?= hlien("utilisateur", "edit") ?>">
            <input type="hidden" name="uti_id" id="uti_id" value="<?= $id ?>" />
            <div class='form-group'>
                <label for='uti_nom'>Nom</label>
                <input id='uti_nom' name='uti_nom' type='text' size='50' value='<?= mhe($uti_nom) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='uti_prenom'>Prenom</label>
                <input id='uti_prenom' name='uti_prenom' type='text' size='50' value='<?= mhe($uti_prenom) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='uti_mail'>Mail</label>
                <input id='uti_mail' name='uti_mail' type='text' size='50' value='<?= mhe($uti_mail) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='uti_adresse'>Adresse</label>
                <input id='uti_adresse' name='uti_adresse' type='text' size='50' value='<?= mhe($uti_adresse) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='uti_username'>Username</label>
                <input id='uti_username' name='uti_username' type='text' size='50' value='<?= mhe($uti_username) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='uti_passw'>Passw</label>
                <input id='uti_passw' name='uti_passw' type='text' size='50' required class='form-control' />
            </div>
            <?php if($_SESSION['profil']==1){ ?>
            <div class='form-group'>
                <label for='uti_profil'>Profil</label>
                <select class='form-control' id='uti_profil' name='uti_profil'>
                    <?= Entity::HTMLselect("select * from profil", "pro_id", "pro_nom", $uti_profil) ?>
                </select>
            </div>
            <div class='form-group'>
                <label for='uti_agence'>Agence</label>
                <select class='form-control' id='uti_agence' name='uti_agence'>
                    <?= Entity::HTMLselect("select * from agence", "age_id", "age_nom", $uti_agence) ?>
                </select>
            </div>
            <?php } else { ?>
                
                <input id='uti_profil' name='uti_profil' type='hidden'  value='<?= mhe($uti_profil) ?>' class='form-control' />
                <input id='uti_profil' name='uti_agence' type='hidden'  value='<?= mhe($uti_agence) ?>' class='form-control' />
          <?php  } ?>
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>