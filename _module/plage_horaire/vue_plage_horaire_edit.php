        <form method="post" action="<?=hlien("plage_horaire","edit")?>">
		<input type="hidden" name="plg_id" id="plg_id" value="<?= $id ?>" />
                      
                        <div class='form-group'>
                            <label for='plg_hmin'>Hmin</label>
                            <input id='plg_hmin' name='plg_hmin' type='text' size='50' value='<?=mhe($plg_hmin)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='plg_hmax'>Hmax</label>
                            <input id='plg_hmax' name='plg_hmax' type='text' size='50' value='<?=mhe($plg_hmax)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              