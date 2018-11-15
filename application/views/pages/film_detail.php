<div class="ml-2">
    <h1 class="display-3">
        <?= ucfirst($film_detail->nazev_film) ?> (<?= $film_detail->rok ?>)
    </h1>
</div>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home">Přehled</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#popis">Popis</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#hodnoceni">Hodnocení</a>
    </li>
</ul>
<div id="myTabContent mb-4" class="tab-content">
    <div class="tab-pane fade show active" id="home">
        <div class="row m-0">
            <div class="col-4 col-md-3">
                <div class="card mt-4">
                    <img src="<?= $film_detail->poster ?>" class="w-100">
                    <div class="card-body">
                        <h5 class="card-title">Poster</h5>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Žánr</h5>
                        <ul class="list-group">
                            <?php
                            foreach ($zanry as $zanr) {
                                echo '<li class="list-group-item">';
                                echo ucfirst($zanr['nazev_zanr']);
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-8 col-md-9">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Hodnocení uživatelů</h5>
                        <p class="card-text display-4">
                            <?php
                            echo round($prumerne_hodnoceni->prumer * 100, 1) . '%';
                            ?>
                        </p>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Režie</h5>
                        <?php
                        foreach ($reziseri as $reziser) {
                            echo '<a href="' . base_url() . 'osobnost/' . $reziser['id_osobnost']
                                . '" class="list-group-item">' . ucfirst($reziser['jmeno_osobnost'])
                                . ' ' . ucfirst($reziser['prijmeni_osobnost']) . '</a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Herecké obsazení</h5>
                        <div class="list-group">

                            <?php
                            foreach ($herci as $herec) {
                                echo '<a href="' . base_url() . 'osobnost/profil/' . $herec['id_osobnost']
                                    . '" class="list-group-item">' . ucfirst($herec['jmeno_osobnost'])
                                    . ' ' . ucfirst($herec['prijmeni_osobnost']) . '</a>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Premiéra</h5>
                        <p class="card-text"><?= $film_detail->premiera ?></p>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Délka</h5>
                        <p class="card-text"><?= $film_detail->delka_film ?>&nbsp;minut</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="tab-pane fade" id="popis">
        <div class="card m-4">
            <div class="card-body">
                <h5 class="card-title"><?= $film_detail->nazev_film ?></h5>
                <p>
                    <?= $film_detail->popis_film ?>
                </p>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="hodnoceni">

        <?php
        if (isset($this->session->id_uzivatel)) {

        ?>


        <a class="btn btn-primary m-4" data-toggle="collapse" href="#form-wrapper" role="button" aria-expanded="false"
           aria-controls="collapseExample">
            Vložit recenzi
        </a>
        <div class="card m-4 p-4 collapse" id="form-wrapper">
            <h5 class="card-title">
                Hodnocení a recenze filmu
                <?= ucfirst($film_detail->nazev_film) ?>
            </h5>
            <?php
            echo validation_errors();
            echo form_open(base_url() . 'film/nove_hodnoceni/' . $film_detail->id_film);
            ?>
            <div class="form-group">
                <label for="hodnoceni">Hodnocení:</label>
                <select class="custom-select-lg form-control" name="hodnoceni" id="hodnoceni">
                    <option value="0.0">0%</option>
                    <option value="0.1">10%</option>
                    <option value="0.2">20%</option>
                    <option value="0.3">30%</option>
                    <option value="0.4">40%</option>
                    <option value="0.5" selected>50%</option>
                    <option value="0.6">60%</option>
                    <option value="0.7">70%</option>
                    <option value="0.8">80%</option>
                    <option value="0.9">90%</option>
                    <option value="1.0">100%</option>
                </select>
                <label for="text_recenze">Textová recenze: </label>
                <textarea name="text_recenze" class="form-control"
                          placeholder="Sem můžete vložit volitelný text recenze...(max. 200 znaků)"
                          maxlength="200" id="text_recenze"></textarea>
                <input type="submit" class="btn btn-success mt-4" value="Vložit">
            </div>
            <?php
            echo '</form></div>';
            }
            ?>

        <?php

        foreach ($hodnoceni

        as $item_hodnoceni) {

        if ($this->session->id_uzivatel == $item_hodnoceni['id_uzivatel']) { ?>
        <div class="card text-white bg-success m-4">
            <?php
            } else {
            ?>
            <div class="card m-4">
                <?php
                }
                ?>
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $item_hodnoceni['ciselne_hodnoceni'] * 100 ?>%
                    </h5>
                    <p class="card-text">
                        <?= htmlspecialchars($item_hodnoceni['text_hodnoceni']) ?>
                    </p>
                    <small>
                        <?= htmlspecialchars(ucfirst($item_hodnoceni['username'])) ?>
                    </small>
                    <br>
                    +<?= $item_hodnoceni['palce'] ?>&nbsp;<i class="far fa-thumbs-up fa-fw"></i><br>

                    <form method="post" action="<?= base_url() . 'film/palec_nahoru/' . $film_detail->id_film ?>">

                        <input name="id_hodnoceni" type="hidden" value="<?= $item_hodnoceni['id_hodnoceni'] ?>">
                        <input name="autor" type="hidden" value="<?= $item_hodnoceni['id_uzivatel'] ?>">
                        <input name="prihlaseny_uzivatel" type="hidden" value="<?= $this->session->id_uzivatel ?>">
                        <input name="id_film" type="hidden" value="<?= $film_detail->id_film ?>">

                        <input type="submit" class="btn btn-danger mt-4" value="Označit hodnocení jako užitečné">
                    </form>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
