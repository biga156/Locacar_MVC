        <form method="post" action="<?=hlien("options","edit")?>">
		<input type="hidden" name="opt_id" id="opt_id" value="<?= $id ?>" />
                        <div class='form-group'>
                            <label for='opt_nom'>Nom</label>
                            <input id='opt_nom' name='opt_nom' type='text' size='50' value='<?=mhe($opt_nom)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='opt_tarif'>Tarif</label>
                            <input id='opt_tarif' name='opt_tarif' type='text' size='50' value='<?=mhe($opt_tarif)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              