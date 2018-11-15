
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


    <title>
        <?php
        if (isset($title)) {
            echo $title;
        } else {
            echo 'Filmová databáze';
        }
        ?>
    </title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?php echo base_url(); ?>">Filmová databáze</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>novinky">Novinky</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>vloz_film">Vložit nový film</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Žebříčky
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>film/list">50 nejlepších filmů</a>
                    <a class="dropdown-item" href="#">50 nejhorších filmů</a>
                </div>
            </li>
            <li>
                <form method="post" class="form-inline my-2 my-lg-0" action="<?php echo base_url()?>search">
                    <input class="form-control mr-sm-2" type="text" placeholder="..." name="search">
                    <button class="btn btn-danger my-2 my-sm-0" type="submit"><i class="fas fa-search fa-fw"></i>
                    </button>
                </form>
            </li>
        </ul>
        <?php
        if (!isset($this->session->id_uzivatel)) {
            ?>
            <div class="dropdown">
                <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users fa-fw"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?php echo base_url() ?>login">Přihlásit se</a>
                    <a class="dropdown-item" href="<?php echo base_url() ?>registrace">Registrovat se</a>
                </div>
            </div>
            <?php
        } else {

            ?>
            <div class="dropdown">
                <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                    echo $this->session->jmeno_uzivatel . ' ' . $this->session->prijmeni_uzivatel
                    ?>
                    <i class="fas fa-users fa-fw"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?php echo base_url() ?>profil">Profil</a>
                    <a class="dropdown-item" href="<?php echo base_url() ?>uzivatel/logout">Odhlásit se</a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</nav>
<?php
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>' .  $this->session->flashdata('message') . '</strong>' .
  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}
?>