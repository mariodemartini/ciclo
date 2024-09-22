<?php
    include_once "../conexao/Conexao.php";
    include_once "../model/Professor.php";
    include_once "../dao/ProfessorDAO.php";

    $professor = new Professor();
    $professordao = new ProfessorDAO();

    $d = filter_input_array(INPUT_POST);

    if(isset($_POST['salvar'])){

        $professor->setNome(($d['nome']));
        $professor->setDataNascimento(($d['dataNascimento']));
        $professor->setSexo(($d['sexo']));
        $professor->setCpf(($d['cpf']));
        $professor->setCref(($d['cref']));
        $professor->setCelular(($d['celular']));
        $professor->setCep(($d['cep']));
        $professor->setEstado(($d['estado']));
        $professor->setCidade(($d['cidade']));
        $professor->setEndereco(($d['endereco']));
        $professor->setEmail(($d['email']));
        $professor->setSituacao(($d['situacao']));
        $professor->setSenha(password_hash($d['senha'], PASSWORD_DEFAULT));
        
        $professordao->create($professor);

        header("Location: ../cadastro-prof.php"); 
    }

    else if (isset($_POST['editar'])) {

        $professor->setIdProfessor(($d['idProfessor']));
        $professor->setNome(($d['nome']));
        $professor->setDataNascimento(($d['dataNascimento']));
        $professor->setSexo(($d['sexo']));
        $professor->setCpf(($d['cpf']));
        $professor->setCref(($d['cref']));
        $professor->setCelular(($d['celular']));
        $professor->setCep(($d['cep']));
        $professor->setEstado(($d['estado']));
        $professor->setCidade(($d['cidade']));
        $professor->setEndereco(($d['endereco']));
        $professor->setEmail(($d['email']));
        $professor->setSituacao(($d['situacao']));
        $professor->setSenha(password_hash($d['senha'], PASSWORD_DEFAULT));
    
        $professordao->update($professor);
    
        header("Location: ../buscar-prof.php");   
    }

    else if (isset($_GET['del'])){

        $professor->setIdProfessor($_GET['del']);

        $professordao->delete($professor);

        header("Location: ../buscar-prof.php");
    } else {
        header("Location: ../buscar-prof.php");
    }
    
?>