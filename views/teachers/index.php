<div class="d-flex justify-content-end mb-3">
    <a href="/teachers/create" class="btn btn-primary my-btn-primary-color">Shto ligjërues</a>
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
    <?php foreach ($teachers as $key => $teacher) : ?>
        <tr>
            <th scope="row"><?= $key + 1 ?></th>
            <td>
                <a class="my-link" href="/teachers/<?= $teacher->teacher_id ?>">
                    <?= $teacher->user->first_name . " " . $teacher->user->last_name ?>
                <a/>
            </td>
            <td><?= $teacher->teacher_type->description ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
