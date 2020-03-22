
<div class="d-flex justify-content-end mb-3">
    <a href="/studentet/create" class="btn btn-primary my-btn-primary-color">Shto student</a>
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Emri</th>
        <th scope="col">Gjenerata</th>
        <th scope="col">Viti</th>
        <th scope="col">Semestri</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($studentet as $key => $studenti) : ?>
        <tr>
            <th scope="row"><?= $key + 1?></th>
            <td><?= $studenti->perdoruesi->emri . " " . $studenti->perdoruesi->mbiemri?></td>
            <td><?= $studenti->gjenerata->pershkrimi ?></td>
            <td><?= $studenti->semestri->viti->pershkrimi ?></td>
            <td><?= $studenti->semestri->pershkrimi ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
