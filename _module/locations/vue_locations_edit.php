        <form method="post" action="<?= hlien("locations", "edit") ?>">
            <input type="hidden" name="loc_id" id="loc_id" value="<?= $id ?>" />
            <div class='form-group'>

                <label for='loc_type'>Type</label>
                <select class="form-control" id='loc_type' name='loc_type'>
                    <?= Locations::listeType($loc_type) ?>
                </select>
            </div>
            <div class='form-group'>
                <label for='loc_date_demande'>Date_demande</label>
                <input id='loc_date_demande' name='loc_date_demande' type='text' size='50' value='<?= mhe($loc_date_demande) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='loc_date_maj'>Date_maj</label>
                <input id='loc_date_maj' name='loc_date_maj' type='text' size='50' value='<?= date('Y/m/d H:i') ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='loc_statut'>Statut</label>
                <select class="form-control" id='loc_statut' name='loc_statut'>
                    <?= Locations::listeStatut($loc_statut) ?>
                </select>
            </div>
            <div class='form-group'>
                <label for='loc_date_heure_debut'>Date_heure_debut</label>
                <input id='loc_date_heure_debut' name='loc_date_heure_debut' type='text' size='50' value='<?= mhe($loc_date_heure_debut) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='loc_date_heure_fin'>Date_heure_fin</label>
                <input id='loc_date_heure_fin' name='loc_date_heure_fin' type='text' size='50' value='<?= mhe($loc_date_heure_fin) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='loc_gestionnaire'>Gestionnaire</label>
                <select class="form-control" id='loc_gestionnaire' name='loc_gestionnaire'>
                    <?= Locations::listeGest($loc_gestionnaire);    ?>
                </select>
            </div>
            <div class='form-group'>
                <label for='loc_agence_depart'>Agence depart</label>

                <select class="form-control" id='loc_agence_depart' name='loc_agence_depart'>
                    <?= Locations::listeAgeDep($loc_agence_depart);    ?>
                </select>
            </div>
            <div class='form-group'>
                <label for='loc_agence_arrivee'>Agence arrivee</label>

                <select class="form-control" id='loc_agence_arrivee' name='loc_agence_arrivee'>
                    <?= Locations::listeAgeArr($loc_agence_arrivee);    ?>
                </select>
            </div>
            <div class='form-group'>
                <label for='loc_client'>Client</label>

                <select class="form-control" id='loc_client' name='loc_client'>
                    <?= Locations::listeClient($loc_client);    ?>
                </select>
            </div>
            <div class='form-group'>
                <label for='loc_vehicule'>Vehicule</label>
                <input id='loc_vehicule' name='loc_vehicule' type='text' size='50' value='<?= mhe($loc_vehicule) ?>' class='form-control' />
            </div>
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>