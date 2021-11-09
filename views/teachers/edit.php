<div class="card my-shadow border-0 w-25">
    <div class="card-body">
        <form method="POST" action="/admin/teachers/<?= $teacher->teacher_id ?>">
            <div class="form-group">
                <label for="first_name">Emri</label>
                <input class="form-control" type="text" name="first_name" id="first_name"
                       value="<?= $teacher->user->first_name ?>" required/>
            </div>
            <div class="form-group">
                <label for="last_name">Mbiemri</label>
                <input class="form-control" type="text" name="last_name" id="last_name"
                       value="<?= $teacher->user->last_name ?>" required/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" placeholder="example@gmail.com" type="email" name="email" id="email"
                       value="<?= $teacher->user->email ?>" required/>
            </div>
            <div class="form-group">
                <label for="teacher_type">Roli</label>
                <select class="form-control" name="teacher_type" id="teacher_type" required>
                    <option value="" disabled selected>Zgjidh një opsion</option>
                    <?php foreach($teacherTypes as $teacherType) : ?>
                        <option value="<?= $teacherType->teacher_type_id ?>" <?= $teacherType->teacher_type_id == $teacher->teacher_type_id ? "selected" : "" ?>>
                            <?= $teacherType->description ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ruaj</button>
        </form>
    </div>
</div>


