
<div class="d-flex justify-content-end mb-3">
    <a href="/students/create" class="btn btn-primary my-btn-primary-color">Shto student</a>
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
    <?php foreach($students as $key => $student) : ?>
        <tr>
            <th scope="row"><?= $key + 1?></th>
            <td><?= $student->user->first_name . " " . $student->user->last_name?></td>
            <td><?= $student->generation->description ?></td>
            <td><?= $student->semester->study_year->description ?></td>
            <td><?= $student->semester->description ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
