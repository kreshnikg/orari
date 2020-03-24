
<div class="d-flex justify-content-end mb-3">
    <a href="/subjects/create" class="btn btn-primary my-btn-primary-color">Shto lëndë</a>
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Emërtimi</th>
        <th scope="col">Kodi</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($subjects as $key => $subject) : ?>
        <tr>
            <th scope="row"><?= $key + 1?></th>
            <td><?= $subject->title?></td>
            <td><?= $subject->code?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
