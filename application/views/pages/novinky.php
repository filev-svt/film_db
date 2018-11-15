<?php
foreach ($clanky as $clanek) {
    ?>
    <div class="card m-4">

    <div class="card-body">
    <h5 class="card-title">
        <?= htmlspecialchars($clanek['nadpis']) ?>
    </h5>
    <p class="card-text">
        <?= htmlspecialchars($clanek['text_clanek']) ?>
    </p>
    <h6>
        Tagy:
    </h6>
    <a href="<?= base_url() . 'osobnost/' . $clanek['id_osobnost'] ?>">
        <?= $clanek['jmeno_osobnost'].' '.$clanek['prijmeni_osobnost'] ?>
    </a>
    <a href="<?= base_url() . 'film/' . $clanek['id_film'] ?>">
        <?= $clanek['nazev_film'] ?>
    </a>
    </div>
    </div>
    <?php
}
?>