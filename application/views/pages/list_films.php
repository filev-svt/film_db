<?php
echo '<table class="table">';
echo '<thead><tr><th>Název</th><th>Rok</th><th>Žánr</th><th>Hrají</th><th>Hodnocení</th></tr></thead>';
foreach ($films as $film) {
    echo '<tr>';
    echo '<td><a href="' . base_url() . 'film/detail/' . $film['id_film'] . '">' . $film['nazev_film']
        . '</a></td><td>' . $film['rok'] . '</td><td>';
    $for_indicator = 0;
    foreach ($zanry[$film['id_film']] as $zanr) {
        echo ucfirst($zanr['nazev_zanr']) . '<br>';
        $for_indicator++;
        if ($for_indicator == 2) {
            break;
        }
    }

    echo '</td><td>';
    $for_indicator = 0;
    foreach ($herci[$film['id_film']] as $herec) {
        echo '<a href="' . base_url() . 'osobnost/profil/' . $herec['id_osobnost'] . '">' . $herec['jmeno_osobnost'] . ' ' . $herec['prijmeni_osobnost'] . '</a><br>';
        $for_indicator++;
        if ($for_indicator == 2) {
            break;
        }
    }

    echo '</td><td>' . round($film['hodnoceni']*100,1) . '%</td>';
    echo '</tr>';
}
echo '</table>';