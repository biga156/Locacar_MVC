        <form method="post" action="<?= hlien("agence", "edit") ?>">
            <input type="hidden" name="age_id" id="age_id" value="<?= $id ?>" />
            <div class='form-group'>
                <label for='age_nom'>Nom</label>
                <input id='age_nom' name='age_nom' type='text' size='50' value='<?= mhe($age_nom) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='age_departement'>Selectionnez votre departement</label>
                <select class="form-control" id='age_departement' name='age_departement'>
                    <?= Entity::HTMLselect("select * from departement", "dep_code", "dep_code", $age_departement); ?>
                </select>
            </div>
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>