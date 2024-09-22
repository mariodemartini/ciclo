<?php
    session_start();
    session_regenerate_id(true);

    if(isset($_POST['entrar']) && !empty($_POST['email']) && !empty($_POST['senha'])){

        include_once('./conexao/Conexao.php');

        $email = $_POST['email'];
    	$senha = $_POST['senha'];
        $usuario = $_POST['usuario'];

        if($_POST['usuario'] == 'professor'){
            $sql = "SELECT * FROM professor WHERE email = '$email' LIMIT 1";
            $result = Conexao::getConexao()->query($sql);
            $result->execute();
            $usuario = $result->fetch(PDO::FETCH_ASSOC);

            if($usuario['situacao'] == 'ATIVO'){

                if(password_verify($senha, $usuario['senha'])){
                
                    $_SESSION['email'] = $email;
                    $_SESSION['senha'] = $senha;
                    $_SESSION['user'] = $usuario['nome'];
                    $_SESSION['tipo'] = 'professor';
                    print "<script>location.href='home.php';</script>";

                } else {
                    unset($_SESSION['email']);
                    unset($_SESSION['senha']);
                    print "<script>alert('Email e/ou senha incorretos');</script>";
                    print "<script>location.href='index.php';</script>";  
                    
                }
            } else{
                print "<script>alert('Usuário inválido');</script>";
                print "<script>location.href='index.php';</script>"; 
            }  
        } 
        else if($_POST["usuario"] == 'alunos'){
            $sql = "SELECT * FROM alunos WHERE email = '$email' LIMIT 1";
            $result = Conexao::getConexao()->query($sql);
            $result->execute();
            $usuario = $result->fetch(PDO::FETCH_ASSOC);

            if($usuario['situacao'] == 'ATIVO'){

                if(password_verify($senha, $usuario['senha'])){
                
                    $_SESSION["email"] = $email;
                    $_SESSION["senha"] = $senha;
                    $_SESSION['user'] = $usuario['nome'];
                    $_SESSION['idAluno'] = $usuario['idAluno'];
                    $_SESSION['tipo'] = 'aluno';
                    print "<script>location.href='aluno/inicio.php';</script>";

                } else{
                    unset($_SESSION["email"]);
                    unset($_SESSION["senha"]);
                    print "<script>alert('Email e/ou senha incorretos');</script>";
                    print "<script>location.href='index.php';</script>";  
                    
                }
            } else{
                print "<script>alert('Usuário inválido');</script>";
                print "<script>location.href='index.php';</script>"; 
            } 

        } else{
            print "<script>alert('Selecione tipo de usuário');</script>"; 
            print "<script>location.href='index.php';</script>"; 
        }     
        
    } else {
        print "<script>alert('CAMPOS VAZIOS');</script>";
    	print "<script>location.href='index.php';</script>"; 
    }

?>