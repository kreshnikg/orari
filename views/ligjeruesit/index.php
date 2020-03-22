
<div class="d-flex justify-content-end mb-3">
    <a href="/ligjeruesit/create" class="btn btn-primary my-btn-primary-color">Shto ligjërues</a>
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Emri</th>
        <th scope="col">Roli</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($ligjeruesit as $key => $ligjeruesi) : ?>
        <tr>
            <th scope="row"><?= $key + 1?></th>
            <td><a class="my-link" href="/ligjeruesit/<?= $ligjeruesi->ligjeruesi_id ?>"><?= $ligjeruesi->perdoruesi->emri . " " . $ligjeruesi->perdoruesi->mbiemri?><a/></td>
            <td><?= $ligjeruesi->ligjeruesi_lloji->pershkrimi ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
