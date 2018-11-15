<form method="post" action="<?=base_url().'film/vlozit_novy_film'?>">
    <label>Název filmu</label>
    <input type="text" name="nazev"><br>
    <label>Stopáž</label>

    <input type="number" name="stopaz"><br>
    <label for="herci">Herec</label><br>
    <select name="herci" id="herec"><br>
        <?php
        foreach ($herci as $herec) {
            echo '<option value="'.$herec['id_osobnost'].'">'.$herec['jmeno_osobnost'].' '.$herec['prijmeni_osobnost'].'</option>';
        }
        ?>
    </select>
    <label for="zanry">Žánr</label><br>
    <select id="zanry" name="zanr"><br>
        <?php
        foreach ($zanry as $zanr) {
            echo '<option value="'.$zanr['id_zanr'].'">'.$zanr['nazev_zanr'].'</option>';
        }
        ?>
    </select>

    <input type="submit">
</form>