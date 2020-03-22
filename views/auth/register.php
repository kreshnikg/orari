<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/src/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="/src/css/bootstrap.css"/>
</head>
<body class="body-auth">
<div class="d-flex h-100">
    <div class="card shadow mx-auto my-auto login-card">
        <div class="card-body p-0">
            <div class="p-5">
                <div class="text-center">
                    <img src="/storage/img/clock-logo.png" width="125" />
                    <h4 class="h4 mb-4">Mirë se erdhët!</h4>
                </div>
                <form action="/login" method="POST">
                    <input type="text" name="emri" class="form-control mb-3" placeholder="Emri" required/>
                    <input type="text" name="mbiemri" class="form-control mb-3" placeholder="Mbiemri" required/>
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required/>
                    <input type="password" name="fjalkalimi" class="form-control mb-3" placeholder="Fjalkalimi" required/>
                    <div class="form-group form-check">
                        <input type="checkbox" id="check" class="form-check-input"/>
                        <a href="#" target="_blank">Termat dhe kushtet e përdorimit</a>
                    </div>
                    <button class="btn btn-block login-btn">Regjistrohu</button>
                </form>
                <hr/>
                <div class="text-center">
                    <a class="small" href="/login">Keni llogari? Identifikohuni këtu!</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
