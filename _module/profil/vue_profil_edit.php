        <form method="post" action="<?=hlien("profil","edit")?>">
		<input type="hidden" name="pro_id" id="pro_id" value="<?= $id ?>" />
                        <div class='form-group'>
                            <label for='pro_nom'>Nom</label>
                            <input id='pro_nom' name='pro_nom' type='text' size='50' value='<?=mhe($pro_nom)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              