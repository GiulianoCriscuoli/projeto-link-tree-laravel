<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('assets/css/admin.login.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;600;800&display=swap" rel="stylesheet">   
    <title>Linktree - Login</title>
</head>
<body>
    <div class="block-login">
        <h1>Faça seu Login</h1>

        @if($error)
            <div class="error">{{ $error }}</div>
        @endif

        <form method="POST">
            @csrf

            <input type="text" name="email" placeholder="Informe seu email">
            <input type="password" name="password" placeholder="Informe sua senha">

            <button type="submit">Logar</button>

            <div>
                Ainda não tem cadastro? <a href="{{ route('register') }}">Cadastre-se agora</a> 
            </div>
        </form>
    </div>
</body>
</html>