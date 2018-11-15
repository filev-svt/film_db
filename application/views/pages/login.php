
<div class="col-4 card mx-auto my-4 p-4">
    <h5 class="card-title">Přihlášení</h5>
    <form method="post" action="<?php echo base_url()?>uzivatel/login">
        <div class="form-group">
            <label for="exampleInputEmail1">Uživatelské jméno: </label>
            <input name="login_username" type="text" class="form-control" id="login_username"
                   placeholder="Uživatelské jméno">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Heslo: </label>
            <input type="password" class="form-control" name="login_heslo" id="login_heslo" placeholder="Heslo">
        </div>
        <button type="submit" class="btn btn-success">Přihlásit se</button>
        <a class="btn btn-danger" href="<?php echo base_url()?>glogin">Přihlásit se přes Google</a>
    </form>
</div>