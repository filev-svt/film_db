<div class="ml-2">
    <h1 class="display-3">
        <?php echo $osobnost_profil->jmeno_osobnost . ' ' . $osobnost_profil->prijmeni_osobnost ?>
    </h1>
</div>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#home">Přehled</a>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#zivotopis">Životopis</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#filmografie">Filmografie</a>
    </li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade show active" id="home">
        <div class="row m-0">
            <div class="col-5 col-sm-4 col-md-3">
                <div class="card mt-4">
                    <img src="<?= $osobnost_profil->fotografie ?>" class="rounded w-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $osobnost_profil->jmeno_osobnost
                                . ' ' . $osobnost_profil->prijmeni_osobnost
                            ?>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-7 col-sm-8 col-md-9">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            Osobní údaje
                        </h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>Místo narození:</b>&nbsp;&nbsp;<?= $osobnost_profil->misto_narozeni ?>
                            </li>
                            <li class="list-group-item">
                                <b>Datum narození:</b>&nbsp;&nbsp;<?= $osobnost_profil->datum_narozeni ?>
                            </li>
                            <?php
                            if (!empty($osobnost_profil->datum_umrti)) {
                                echo '<li>';
                                echo '<b>Datum úmrtí:</b>' . '&nbsp;&nbsp;' . $osobnost_profil->datum_umrti;
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            Nejlépe hodnocený film
                        </h5>
                        <div class="list-group">
                            <?php
                            echo '<a href="' . base_url() . 'film/detail/' . $nejlepsi_film_osobnosti->id_film
                                . '" class="list-group-item">' . $nejlepsi_film_osobnosti->nazev_film
                                . ' (' . round($nejlepsi_film_osobnosti->prumer*100, 1) . '%)</a>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="zivotopis">
        <div class="col-sm-12">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $osobnost_profil->jmeno_osobnost
                            . ' ' . $osobnost_profil->prijmeni_osobnost
                        ?>
                    </h5>
                    <p>
                        <?= $osobnost_profil->zivotopis ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="filmografie">
        <div class="col-sm-12">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">
                        Filmografie
                    </h5>
                    <?php

                    echo '<table class="table">';
                    echo '<tr><th>Název</th><th>Rok</th><th>Žánr</th><th>Hodnocení</th></tr>';
                    foreach ($filmografie as $film) {
                        echo '<tr>';
                        echo '<td><a class="" href="' . base_url() . 'film/detail/' . $film['id_film'] . '">' . $film['nazev_film']
                            . '</a></td><td>' . $film['rok'] . '</td><td>';
                        $for_indicator = 0;
                        foreach ($zanry[$film['id_film']] as $zanr) {
                            echo ucfirst($zanr['nazev_zanr']) . '<br>';
                            $for_indicator++;
                            if ($for_indicator == 2) {
                                break;
                            }
                        }
                        echo '</td><td>' . round($film['prumer']*100, 1) . '%</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>