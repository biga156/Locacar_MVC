<form method="post" action="">

    <div class="row">
        <div class="col">
            <label for='cat_id'>Selectionne une categorie</label>
            <select class="form-control" id='cat_id' name='cat_id'>
                <?= Entity::HTMLselect("select cat_id,cat_nom from categorie", "cat_id", "cat_nom", $cat_nom); ?>
            </select>
        </div>
        <div class="col">
            <label for='dep_id'>Selectionne ton departement</label>
            <select class="form-control" id='dep_id' name='dep_id'>
                <?= Entity::HTMLselect("select dep_nom, age_departement,  from departement, agence where age_departement=dep_id", "dep_id", "dep_nom", $dep_id); ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for='age_id_depart'>Agence de départ</label>
            <select class="form-control" id='age_id_depart' name='age_id_depart'>
                <?= Entity::HTMLselect("select age_id, age_nom from agence", "age_id", "age_nom", $age_id); ?>
            </select>
        </div>
        <div class="col">
            <label for='age_id_arrivee'>Agence d'arrivée</label>

            <select class="form-control" id='age_id_arrivee' name='age_id_arrivee'>
                <?= Entity::HTMLselect("select age_id,age_nom from agence", "age_id", "age_nom", $age_nom); ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for='loc_date_heure_debut'>Date depart</label>
            <input id='loc_date_heure_debut' name='loc_date_heure_debut' type='dateTime' size='50' value='<?php echo date('Y-m-d'); ?>' class='form-control' />
        </div>
        <div class="col">
            <label for='loc_date_heure_fin'>Date retour</label>
            <input id='loc_date_heure_fin' name='loc_date_heure_fin' type='date' size='50' value='<?php echo date('Y-m-d'); ?>' class='form-control' />
        </div>
    </div>


    <input class="btn btn-success" type="submit" name="btSubmit" value="Chercher" />
</form>