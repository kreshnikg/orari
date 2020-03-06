<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./src/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="./src/css/bootstrap.css"/>
</head>
<body>
<div class="row my-auto">
    <div class="card overflow-hidden shadow mx-auto my-4 w-75">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h4 class="h4 mb-4">Mirë se erdhët!</h4>
                        </div>
                        <form action="index.html">
                            <input type="email" class="form-control mb-3 login-input" placeholder="Email" required/>
                            <input type="password" class="form-control mb-3 login-input" placeholder="Fjalkalimi"
                                   required/>
                            <div class="form-group form-check">
                                <input type="checkbox" id="check" class="form-check-input"/>
                                <label class="form-check-label" for="check">Më mbaj në mend</label>
                            </div>
                            <button class="btn btn-block login-btn">Kyçu</button>
                        </form>
                        <hr/>
                        <div class="text-center">
                            <a class="small" href="register.html">Nuk keni llogari? Regjistrohuni këtu!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
