<div class="w-25">
    <form method="POST" action="/subjects/<?= $subject->subject_id ?>">
        <div class="form-group">
            <label for="title">Emërtimi</label>
            <input class="form-control" type="text" name="title" id="title" value="<?= $subject->title ?>" />
        </div>
        <div class="form-group">
            <label for="code">Kodi</label>
            <input class="form-control" type="text" name="code" id="code" value="<?= $subject->code ?>" />
        </div>
        <button type="submit" class="btn btn-primary">Ruaj</button>
    </form>
</div>
