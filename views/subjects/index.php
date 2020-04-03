<div class="d-flex align-items-center mb-4">
    <h4 class="mb-0">Lëndët</h4>
    <a href="/admin/subjects/create" class="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto lëndë</a>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card my-shadow border-0">
            <table class="table my-table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Emërtimi</th>
                    <th scope="col">Kodi</th>
                    <th scope="col">Krijuar më</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($subjects as $key => $subject) : ?>
                    <tr>
                        <th class="text-center" scope="row"><?= $key + 1 ?></th>
                        <td><?= $subject->title ?></td>
                        <td><?= $subject->code ?></td>
                        <td><?= $subject->created_at ?></td>
                        <td>
                            <a style="color: #5e676f" href="/admin/subjects/<?= $subject->subject_id ?>/edit"><i class="fas fa-pen px-2"></i></a>
                            <a style="color: #5e676f" href="/admin/subjects/<?= $subject->subject_id ?>/delete"><i class="fas fa-trash px-2"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

