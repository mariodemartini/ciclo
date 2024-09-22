<?php
    include_once "../conexao/Conexao.php";
    include_once "../model/Aluno.php";
    include_once "../dao/AlunoDAO.php";

    $aluno = new Aluno();
    $alunodao = new AlunoDAO();

    $d = filter_input_array(INPUT_POST);

    if(isset($_POST['salvar'])){

        $aluno->setNome(($d['nome']));
        $aluno->setDataNascimento(($d['dataNascimento']));
        $aluno->setSexo(($d['sexo']));
        $aluno->setCpf(($d['cpf']));
        $aluno->setRg(($d['rg']));
        $aluno->setTelefone(($d['telefone']));
        $aluno->setCelular(($d['celular']));
        $aluno->setCep(($d['cep']));
        $aluno->setEstado(($d['estado']));
        $aluno->setCidade(($d['cidade']));
        $aluno->setEndereco(($d['endereco']));
        $aluno->setEmail(($d['email']));
        $senha = $d['senha'];
        $crypto = password_hash($senha, PASSWORD_DEFAULT);
        $aluno->setSenha($crypto);
        $aluno->setDataCadastro(($d['dataCadastro']));
        $aluno->setIdade(($d['dataNascimento']));
        $aluno->setSituacao(($d['situacao']));
        
        $alunodao->create($aluno);

        header("Location: ../cadastro-aluno.php");
    }

    else if(isset($_POST['editar'])) {

        $aluno->setIdAluno(($d['idAluno']));
        $aluno->setNome(($d['nome']));
        $aluno->setDataNascimento(($d['dataNascimento']));
        $aluno->setSexo(($d['sexo']));
        $aluno->setCpf(($d['cpf']));
        $aluno->setRg(($d['rg']));
        $aluno->setTelefone(($d['telefone']));
        $aluno->setCelular(($d['celular']));
        $aluno->setCep(($d['cep']));
        $aluno->setEstado(($d['estado']));
        $aluno->setCidade(($d['cidade']));
        $aluno->setEndereco(($d['endereco']));
        $aluno->setEmail(($d['email']));
        $aluno->setSenha(password_hash($d['senha'], PASSWORD_DEFAULT));
        $aluno->setSituacao(($d['situacao']));
    
        $alunodao->update($aluno);
    
        header("Location: ../buscar-aluno.php");
    }

    else if(isset($_GET['del'])){

        $aluno->setIdAluno($_GET['del']);

        $alunodao->delete($aluno);

        header("Location: ../buscar-aluno.php");

    } 
    
    else {
        //header("Location: ../buscar.php");
    }
    
?>