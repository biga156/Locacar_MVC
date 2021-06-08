        <form method="post" action="<?= hlien("definir", "edit") ?>">
            <input type="hidden" name="def_id" id="def_id" value="<?= $id ?>" />
            <div class='form-group'>
                <label for='def_tarif'>Tarif</label>
                <input id='def_tarif' name='def_tarif' type='text' size='50' value='<?= mhe($def_tarif) ?>' class='form-control' />
            </div>
          
            <div>
                <label for='def_plage_horaire'>Plage horaire</label>

                <select class="form-control" id='def_plage_horaire' name='def_plage_horaire'>
                    <?= Definir::listePlg($def_plage_horaire);    ?>
                </select>
            </div>

             <div>
                <label for='def_categorie'>Categorie</label>

                <select class="form-control" id='def_categorie' name='def_categorie'>
                    <?= Definir::listeCat($def_categorie);    ?>
                </select>
            </div>
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>