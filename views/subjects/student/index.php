<?php $subject_registered = $student->subjects_registered?>

<div class="d-flex align-items-center mb-4">
    <h4 class="mb-0">Lëndët</h4>
    <?php if (!$subject_registered): ?>
        <button onclick="alertAndRedirect(
            'Pas regjistrimit të lëndëve, ju nuk do të jeni në gjendje ti ndryshoni ato!',
            'Regjistro lëndët!',
            '/student/subjects/submit'
        )" class="btn btn-blue ml-auto my-shadow">Përfundo
        </button>
    <?php else: ?>
        <div class="alert alert-info ml-auto my-shadow mb-0" role="alert">
            <i class="fas fa-info-circle mr-1"></i> Lëndët janë regjistruar!
        </div>
    <?php endif; ?>
</div>

<?php
function checkIfRegistered($subject, $student)
{
    $registered = false;
    foreach ($student->student_subject as $studentSubject) {
        if ($studentSubject->subject_id == $subject->subject_id) {
            $registered = true;
        }
    }
    return $registered;
}
?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card my-shadow border-0">
            <table class="table my-table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Emërtimi</th>
                    <th scope="col">Kodi</th>
                    <th scope="col">Obligative/Zgjedhore</th>
                    <th scope="col">ECTS</th>
                    <?php if (!$subject_registered): ?>
                    <th scope="col"></th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($subjects as $key => $subject) : ?>
                    <?php $registered = checkIfRegistered($subject, $student) ?>

                    <?php if ($subject_registered && $registered): ?>
                        <tr>
                            <th class="text-center" scope="row"><?= $key + 1 ?></th>
                            <td><?= $subject->title ?></td>
                            <td><?= $subject->code ?></td>
                            <td><?= $subject->subject_type->description ?></td>
                            <td><?= $subject->ects_credits ?></td>
                        </tr>
                    <?php elseif (!$subject_registered): ?>
                        <tr>
                            <th class="text-center" scope="row"><?= $key + 1 ?></th>
                            <td><?= $subject->title ?></td>
                            <td><?= $subject->code ?></td>
                            <td><?= $subject->subject_type->description ?></td>
                            <td><?= $subject->ects_credits ?></td>
                            <td>
                                <?php if ($registered): ?>
                                    <a href="/student/subjects/<?= $subject->subject_id ?>/cancel"
                                       class="btn btn-sm btn-red">Anulo</a>
                                <?php else: ?>
                                    <a href="/student/subjects/<?= $subject->subject_id ?>/register"
                                       class="btn btn-sm btn-green">Regjistro</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
