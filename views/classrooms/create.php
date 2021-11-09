<div class="w-25">
    <form method="POST" action="/admin/classrooms">
        <div class="form-group">
            <label for="number">Numri</label>
            <input class="form-control" type="text" name="number" id="number" required/>
        </div>
        <div class="form-group">
            <label for="classroom_type">Lloji</label>
            <select class="form-control" name="classroom_type" id="classroom_type" required>
                <option value="" disabled selected>Zgjidh një opsion</option>
                <?php foreach ($classroomTypes as $classroomType) : ?>
                    <option value="<?= $classroomType->classroom_type_id ?>"><?= $classroomType->description ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ruaj</button>
    </form>
</div>


