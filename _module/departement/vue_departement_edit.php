        <form method="post" action="<?=hlien("departement","edit")?>">
		<input type="hidden" name="dep_id" id="dep_id" value="<?= $id ?>" />
                        <div class='form-group'>
                            <label for='dep_code'>Code</label>
                            <input id='dep_code' name='dep_code' type='text' size='50' value='<?=mhe($dep_code)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='dep_nom'>Nom</label>
                            <input id='dep_nom' name='dep_nom' type='text' size='50' value='<?=mhe($dep_nom)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              