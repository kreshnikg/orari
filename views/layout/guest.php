<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>
    <script src="/public/js/app.js"></script>
</head>
<body class="body-auth">
<div id="guest"></div>
<div class="d-flex h-100">
    <div class="card shadow mx-auto my-auto login-card">
        <div class="card-body p-0">
            <div class="p-5">
                <div class="text-center">
                    <img src="/storage/img/clock-logo.png" width="125"/>
                    <h4 class="h4 mb-4">Mirë se erdhët!</h4>
                    <?php if($message = getRedirectMessages("error")) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $message ?>
                        </div>
                    <?php endif ?>
                </div>
                <form action="/login" method="POST">
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email"/>
                    <input type="password" name="password" class="form-control mb-3" placeholder="Fjalkalimi"
                           required/>
                    <div class="form-group form-check">
                        <input type="checkbox" id="check" class="form-check-input"/>
                        <label class="form-check-label" for="check">Më mbaj në mend</label>
                    </div>
                    <button class="btn btn-block login-btn">Identifikohu</button>
                </form>
                <hr/>
                <div class="text-center">
                    <a class="small" href="/register">Nuk keni llogari? Regjistrohuni këtu!</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
