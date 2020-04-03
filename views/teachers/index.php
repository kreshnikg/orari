<div class="d-flex align-items-center mb-4">
    <h4 class="mb-0">Ligjëruesit</h4>
    <a href="/admin/teachers/create" class="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto ligjërues</a>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card my-shadow border-0">
            <table class="table my-table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Emri</th>
                    <th scope="col">Email</th>
                    <th scope="col">Roli</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($teachers as $key => $teacher) : ?>
                    <tr>
                        <th class="text-center" scope="row"><?= $key + 1 ?></th>
                        <td>
                            <a class="my-link" href="/teachers/<?= $teacher->teacher_id ?>">
                                <?= $teacher->user->first_name . " " . $teacher->user->last_name ?>
                            <a/>
                        </td>
                        <td><?= $teacher->user->email ?></td>
                        <td><?= $teacher->teacher_type->description ?></td>
                        <td>
                            <a style="color: #5e676f" href="/admin/teachers/<?= $teacher->teacher_id ?>/edit"><i class="fas fa-pen px-2"></i></a>
                            <a style="color: #5e676f" href="/admin/teachers/<?= $teacher->teacher_id ?>/delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
