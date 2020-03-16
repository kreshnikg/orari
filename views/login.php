<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./src/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="./src/css/bootstrap.css"/>
    <style>
        body {
            background: rgb(45,193,193);
            background: linear-gradient(135deg, rgba(45,193,193,1) 0%, rgba(5,135,223,1) 100%);
        }
    </style>
</head>
<body>
<div class="d-flex h-100">
    <div class="card shadow mx-auto my-auto login-card" style="width: 500px">
        <div class="card-body p-0">
            <div class="p-5">
                <div class="text-center">
                    <img src="./storage/img/clock-logo.png" width="125" />
                    <h4 class="h4 mb-4">Mirë se erdhët!</h4>
                </div>
                <form action="/login" method="POST">
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required/>
                    <input type="password" name="fjalkalimi" class="form-control mb-3" placeholder="Fjalkalimi" required/>
                    <div class="form-group form-check">
                        <input type="checkbox" id="check" class="form-check-input"/>
                        <label class="form-check-label" for="check">Më mbaj në mend</label>
                    </div>
                    <button class="btn btn-block login-btn">Identifikohu</button>
                </form>
                <hr/>
                <div class="text-center">
                    <a class="small" href="register.html" style="color: #43485b">Nuk keni llogari? Regjistrohuni këtu!</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
