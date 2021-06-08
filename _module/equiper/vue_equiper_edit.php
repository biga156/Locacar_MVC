        <form method="post" action="<?= hlien("equiper", "edit") ?>">
            <input type="hidden" name="equ_id" id="equ_id" value="<?= $id ?>" />
          
            <div>
            <label for='equ_location'>Location</label>

            <select class="form-control" id='equ_location' name='equ_location'>
                <?= Equiper::listeLoc($equ_location);    ?>
            </select>
            </div>
          
            <div>
            <label for='equ_option'>Option</label>

            <select class="form-control" id='equ_option' name='equ_option'>
                <?= Equiper::listeOpt($equ_option);    ?>
            </select>
            </div>
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>