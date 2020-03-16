<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Emërtimi</th>
        <th scope="col">Kodi</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($lendet as $lenda) : ?>
        <tr>
            <th scope="row"><?= $lenda->lenda_id?></th>
            <td><?= $lenda->emertimi?></td>
            <td><?= $lenda->kodi?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
