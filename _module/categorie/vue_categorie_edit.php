        <form method="post" action="<?=hlien("categorie","edit")?>">
		<input type="hidden" name="cat_id" id="cat_id" value="<?= $id ?>" />
                        <div class='form-group'>
                            <label for='cat_nom'>Nom</label>
                            <input id='cat_nom' name='cat_nom' type='text' size='50' value='<?=mhe($cat_nom)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              