<div class="w-25">
    <form method="POST" action="/admin/admins">
        <div class="form-group">
            <label for="first_name">Emri</label>
            <input class="form-control" type="text" name="first_name" id="first_name" required/>
        </div>
        <div class="form-group">
            <label for="last_name">Mbiemri</label>
            <input class="form-control" type="text" name="last_name" id="last_name" required/>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" placeholder="example@gmail.com" type="email" name="email" id="email" required/>
        </div>
        <div class="form-group">
            <label for="password">Fjalkalimi</label>
            <input class="form-control" type="password" name="password" id="password" required/>
        </div>
        <button type="submit" class="btn btn-primary">Ruaj</button>
    </form>
</div>


