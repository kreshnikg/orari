<div class="w-25">
    <form method="POST" action="/admin/subjects">
        <div class="form-group">
            <label for="title">Emërtimi</label>
            <input class="form-control" type="text" name="title" id="title" required/>
        </div>
        <div class="form-group">
            <label for="code">Kodi</label>
            <input class="form-control" type="text" name="code" id="code" required/>
        </div>
        <div class="form-group">
            <label for="subject_type">Lloji</label>
            <select class="form-control" name="subject_type" id="subject_type" required>
                <option value="" disabled selected>Zgjidh një opsion</option>
                <?php foreach ($subjectTypes as $subjectType) : ?>
                    <option value="<?= $subjectType->subject_type_id ?>"><?= $subjectType->description ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="ects_credits">ECTS kreditë</label>
            <input class="form-control" type="number" name="ects_credits" id="ects_credits"/>
        </div>
        <button type="submit" class="btn btn-primary">Ruaj</button>
    </form>
</div>


