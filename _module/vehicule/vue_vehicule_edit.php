        <form method="post" action="<?= hlien("vehicule", "edit") ?>">
            <input type="hidden" name="veh_id" id="veh_id" value="<?= $id ?>" />
            <div class='form-group'>
                <label for='veh_immatriculation'>Immatriculation</label>
                <input id='veh_immatriculation' name='veh_immatriculation' type='text' size='50' value='<?= mhe($veh_immatriculation) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='veh_model'>Model</label>
                <select class="form-control" id='veh_model' name='veh_model'>
                    <?= Entity::HTMLselect("SELECT distinct veh_model FROM vehicule order by veh_model", "veh_model", "veh_model", $veh_model); ?><br>
                </select>
            </div>
            <div class='form-group'>
                <label for='veh_site'>Site</label>
                <select class="form-control" id='veh_site' name='veh_site'>
                    <?= Entity::HTMLselect("select age_id, age_nom  from agence", "age_id", "age_nom", $veh_site); ?><br>
                </select>
            </div>
            <div class='form-group'>
                <label for='veh_agence'>Agence</label>
                <select class="form-control" id='veh_agence' name='veh_agence'>
                    <?= Entity::HTMLselect("select age_id, age_nom  from agence", "age_id", "age_nom", $veh_agence); ?><br>
                </select>
            </div>
            <div class='form-group'>
                <label for='veh_categorie'>Categorie</label>
                <select class="form-control" id='veh_categorie' name='veh_categorie'>
                    <?= Entity::HTMLselect("select cat_id, cat_nom  from categorie", "cat_id", "cat_nom", $veh_categorie); ?><br>
                </select>
            </div>
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>