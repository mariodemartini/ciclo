<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>CICLO</title>
        <link href="css/styles.css" rel="stylesheet"/>
        <link rel="shortcut icon" href="imagem/favicon.ico" type="image/x-icon">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body{
            background-image: url(imagem/bg-1.jpg);
            background-size: cover;
        }
    </style>
    </head>
    <body class="bg-white"> 
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4 ">LOGIN CICLO</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="login.php">
                                            <div class="row mb-3 justify-content-center">
                                                <label class="text-center" for="inputUsuario">Usuário</label>
                                                <select class="form-control w-75" id="inputUsuario" name="usuario">
                                                    <option value="">Selecione</option>
                                                    <option value="professor">Professor</option>
                                                </select>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="nome@exemplo.com" name="email"/>
                                                <label for="inputEmail">E-mail</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="senha" name="senha"/>
                                                <label for="inputPassword">Senha</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" type="submit" name="entrar">Entrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
