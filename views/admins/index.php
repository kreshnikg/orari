
<div class="d-flex align-items-center mb-4">
    <h4 class="mb-0">Administratorët</h4>
    <a href="/admin/admins/create" class="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto administratorë</a>
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
                    <th scope="col">Krijuar më</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $key => $user) : ?>
                    <tr>
                        <th class="text-center" scope="row"><?= $key + 1?></th>
                        <td><?= $user->first_name . " " . $user->last_name?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->created_at ?></td>
                        <td>
                            <a style="color: #5e676f" href="/admin/admins/<?= $user->user_id ?>/edit"><i class="fas fa-pen px-2"></i></a>
                            <a style="color: #5e676f" href="/admin/admins/<?= $user->user_id ?>/delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

