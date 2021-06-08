<?php if (isset($message)) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><?=$message?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
<h1>Login :</h1>
<form method="post">
   <p>
        <label for="uti_username">Login : </label>
        <input type="text" name="uti_username" id="uti_username" placeholder="admin/src2/gest10/nom52.prenom52">
    </p>
    <p>
       <label for='uti_passw'>Mot de passe </label>
       <input type='password' name='uti_passw' id='uti_passw' palceholder='12345678' required value=''>
    </p>
    <input type="submit" value="Login" name="btsubmit" class="btn btn-success">
</form>