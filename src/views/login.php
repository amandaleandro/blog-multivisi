<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fazer Login</title>

    <!-- styles -->
    <link rel="stylesheet" href="/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/libs/fontawesome/css/all.css">
    <link rel="stylesheet" href="/public/css/backend/login.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/reset.css">
</head>
<body>
        <div class="container d-flex align-items-center justify-content-center" style="height: 100vh; max-width: 415px">
            <form action="" method="post" id="form_login" class="position-relative form_login p-5 shadow-lg rounded bg-white" autocomplete="off">
                <h2>FAZER LOGIN</h2>
                <p class="welcome-text text-muted">Entre em sua conta para poder, monitorar, criar ou ver as metricas.</p>
                <label class="d-block w-100">
                    <input type="email" name="user" id="user" placeholder="Example@youremail.com" class="w-100 form-control rounded-0 form-control-lg">
                </label>
                <label class="d-block w-100 mt-4">
                    <input type="password" name="pass" id="pass" placeholder="*******" class="w-100 form-control rounded-0 form-control-lg">
                </label>
               
               
                <input type="submit" value="Acessar conta" class="btn border-0 mt-2 float-right shadow-sm">
            </form>
        </div>
        <div id="particles-js"></div>
        
    <!-- js -->
   <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"> </script> 
    <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="/libs/fontawesome/js/fontawesome.min.js"></script>
    <script src="/libs/jquery/jquery-form.js"></script>
    <script src="/public/js/helpers.js"></script>
    <script src="/public/js/private/login.js"></script>
</body>
</html>