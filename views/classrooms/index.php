<div class="d-flex align-items-center mb-4">
    <h4 class="mb-0">Klasat</h4>
    <a href="/admin/classrooms/create" class="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto klasë</a>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card my-shadow border-0">
            <table class="table my-table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Numri</th>
                    <th scope="col">Lloji</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($classrooms as $key => $classroom) : ?>
                    <tr>
                        <th class="text-center" scope="row"><?= $key + 1 ?></th>
                        <td><?= $classroom->number ?></td>
                        <td><?= $classroom->classroom_type->description ?></td>
                        <td>
                            <a style="color: #5e676f" href="/admin/classrooms/<?= $classroom->classroom_id ?>/edit"><i class="fas fa-pen px-2"></i></a>
                            <button class="btn btn-link btn-sm" style="color: #5e676f" onclick="alertAndRedirect(
                                'Pas fshirjes së klasës <?= "\\'$classroom->number\\'" ?>, ju nuk do të jeni në gjendje ta riktheni atë!',
                                'Fshi klasën!',
                                '/admin/classrooms/<?= $classroom->classroom_id ?>/delete'
                                )">
                                <i class="fas fa-trash px-1"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
