<div class="col-6 card mx-auto my-4 p-4">
    <h5 class="card-title">Registrace</h5>
    <form method="post" action="<?php echo base_url() ?>uzivatel/registrace" autocomplete="off">
        <div class="form-group">
            <label for="registrace_username">Uživatelské jméno: </label>
            <input name="registrace_username" type="text" class="form-control" id="registrace_username"
                   placeholder="Uživatelské jméno" value="">
        </div>
        <div class="form-group">
            <label for="registrace_heslo">Heslo: </label>
            <input type="password" class="form-control" name="login_heslo" id="registrace_heslo" placeholder="Heslo"
                   >
        </div>
        <div class="form-group">
            <label for="registrace_email">Email: </label>
            <input name="registrace_email" type="email" class="form-control" id="registrace_email"
                   placeholder="Email" value="">
        </div>
        <div class="form-group">
            <label for="registrace_jmeno">Jméno: </label>
            <input name="registrace_jmeno" type="text" class="form-control" id="registrace_jmeno"
                   placeholder="Jméno" value="">
        </div>
        <div class="form-group">
            <label for="registrace_prijmeni">Příjmení: </label>
            <input name="registrace_prijmeni" type="text" class="form-control" id="registrace_prijmeni"
                   placeholder="Příjmení" value="<?=$this->session->flashdata('prijmeni')?>">
        </div>
        <button type="submit" class="btn btn-success">Registrovat se</button>
        <button type="button" class="btn btn-primary">Registrovat se přes Facebook</button>

    </form>
</div>