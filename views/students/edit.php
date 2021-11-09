<div class="w-25">
    <form method="POST" action="/admin/students/<?= $student->student_id ?>">
        <div class="form-group">
            <label for="first_name">Emri</label>
            <input class="form-control" type="text" name="first_name" id="first_name"
                   value="<?= $student->user->first_name ?>" required/>
        </div>
        <div class="form-group">
            <label for="last_name">Mbiemri</label>
            <input class="form-control" type="text" name="last_name" id="last_name"
                   value="<?= $student->user->last_name ?>" required/>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" placeholder="example@gmail.com" type="email" name="email" id="email"
                   value="<?= $student->user->email ?>" required/>
        </div>
        <div class="form-group">
            <label for="semester">Semestri</label>
            <select class="form-control" name="semester" id="semester" required>
                <option value="" disabled selected>Zgjidh një opsion</option>
                <?php foreach($semesters as $semester) : ?>
                    <option value="<?= $semester->semester_id ?>" <?= $semester->semester_id == $student->semester_id ? "selected" : "" ?>>
                        <?= $semester->description ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="generation">Gjenerata</label>
            <input readonly
                   disabled
                   class="form-control"
                   type="text"
                   name="generation"
                   id="generation"
                   value="<?= $student->generation->description ?>" />
        </div>
        <button type="submit" class="btn btn-primary">Ruaj</button>
    </form>
</div>
