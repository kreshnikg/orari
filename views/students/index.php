
<div class="d-flex align-items-center mb-4">
    <h4 class="mb-0">Studentët</h4>
    <a href="/admin/students/create" class="btn btn-primary ml-auto my-btn-primary-color my-shadow">Shto student</a>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card my-shadow border-0">
            <table class="table my-table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Emri</th>
                    <th scope="col">Gjenerata</th>
                    <th scope="col">Viti</th>
                    <th scope="col">Semestri</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($students as $key => $student) : ?>
                    <tr>
                        <th class="text-center" scope="row"><?= $key + 1?></th>
                        <td><?= $student->user->first_name . " " . $student->user->last_name?></td>
                        <td><?= $student->generation->description ?></td>
                        <td><?= $student->semester->study_year->description ?></td>
                        <td><?= $student->semester->description ?></td>
                        <td>
                            <a style="color: #5e676f" href="/admin/students/<?= $student->student_id ?>/edit"><i class="fas fa-pen px-2"></i></a>
                            <a style="color: #5e676f" href="/admin/students/<?= $student->student_id ?>/delete"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

