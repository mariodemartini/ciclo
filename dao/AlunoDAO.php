<?php

class AlunoDAO
{        
    public function create(Aluno $aluno)
    {
        try {
            $sql = "INSERT INTO alunos (
                nome, dataNascimento, idade, sexo, cpf, rg, telefone, celular, cep, estado, cidade, endereco, email, senha, dataCadastro, situacao)
                VALUES (
                :nome, :dataNascimento, :idade, :sexo, :cpf, :rg, :telefone, :celular, :cep, :estado, :cidade, :endereco, :email, :senha, :dataCadastro, :situacao)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":nome", $aluno->getNome());
            $p_sql->bindValue(":dataNascimento", $aluno->getDataNascimento());
            $p_sql->bindValue(":idade", $aluno->getIdade());
            $p_sql->bindValue(":sexo", $aluno->getSexo());
            $p_sql->bindValue(":cpf", $aluno->getCpf());
            $p_sql->bindValue(":rg", $aluno->getRg());
            $p_sql->bindValue(":telefone", $aluno->getTelefone());
            $p_sql->bindValue(":celular", $aluno->getCelular());
            $p_sql->bindValue(":cep", $aluno->getCep());
            $p_sql->bindValue(":estado", $aluno->getEstado());
            $p_sql->bindValue(":cidade", $aluno->getCidade());
            $p_sql->bindValue(":endereco", $aluno->getEndereco());
            $p_sql->bindValue(":email", $aluno->getEmail());
            $p_sql->bindValue(":senha", $aluno->getSenha());
            $p_sql->bindValue(":dataCadastro", $aluno->getDataCadastro());
            $p_sql->bindValue(":situacao", $aluno->getSituacao());

            return $p_sql->execute();
            
        } catch (Exception $e) {
            print "Erro ao Inserir aluno <br>" . $e . '<br>';
        }      
    }

    public function read() 
    {
        try {
            $sql = "SELECT * FROM alunos ORDER BY 'idAluno' ASC";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaAlunos($l);
            } 
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    private function listaAlunos($row)
    {
        $aluno = new Aluno();
        $aluno->setIdAluno($row['idAluno']);
        $aluno->setNome($row['nome']);
        $aluno->setDataNascimento($row['dataNascimento']);
        $aluno->setIdade($row['dataNascimento']);
        $aluno->setSexo($row['sexo']);
        $aluno->setCpf($row['cpf']);
        $aluno->setRg($row['rg']);
        $aluno->setTelefone($row['telefone']);
        $aluno->setCelular($row['celular']);
        $aluno->setCep($row['cep']);
        $aluno->setEstado($row['estado']);
        $aluno->setCidade($row['cidade']);
        $aluno->setEndereco($row['endereco']);
        $aluno->setEmail($row['email']);
        $aluno->setSenha($row['senha']);
        $aluno->setDataCadastro($row['dataCadastro']);
        $aluno->setSituacao($row['situacao']);

        return $aluno;
    }

    public function delete(Aluno $aluno)
    {
        try {
            $sql = "DELETE FROM alunos WHERE 'idAluno' = :idAluno";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":idAluno", $aluno->getIdAluno());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir aluno <br> $e <br>";
        }
    }

    public function update(Aluno $aluno)
    {
        try {
            $sql = "UPDATE alunos set
                    
                  nome=:nome,
                  dataNascimento=:dataNascimento,
                  sexo=:sexo,
                  cpf=:cpf,
                  rg=:rg,
                  telefone=:telefone,
                  celular=:celular,
                  cep=:cep,
                  estado=:estado,
                  cidade=:cidade,
                  endereco=:endereco,
                  email=:email,
                  senha=:senha,
                  situacao=:situacao
                                
                  WHERE idAluno = :idAluno";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":idAluno", $aluno->getIdAluno());
            $p_sql->bindValue(":nome", $aluno->getNome());
            $p_sql->bindValue(":dataNascimento", $aluno->getDataNascimento());
            $p_sql->bindValue(":sexo", $aluno->getSexo());
            $p_sql->bindValue(":cpf", $aluno->getCpf());
            $p_sql->bindValue(":rg", $aluno->getRg());
            $p_sql->bindValue(":telefone", $aluno->getTelefone());
            $p_sql->bindValue(":celular", $aluno->getCelular());
            $p_sql->bindValue(":cep", $aluno->getCep());
            $p_sql->bindValue(":estado", $aluno->getEstado());
            $p_sql->bindValue(":cidade", $aluno->getCidade());
            $p_sql->bindValue(":endereco", $aluno->getEndereco());
            $p_sql->bindValue(":email", $aluno->getEmail());
            $p_sql->bindValue(":senha", $aluno->getSenha());
            $p_sql->bindValue(":situacao", $aluno->getSituacao());
        
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }


    public function alunosAtivos() 
    {
        try {
            $sql = "SELECT * FROM alunos WHERE situacao = 'ATIVO' ORDER BY idAluno ASC";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaAlunos($l);
            } 
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function selecionaAluno($id)
    {
        try {
            $sql = "SELECT * FROM alunos WHERE idAluno = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            $p_sql->execute();
            $lista = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaAlunos($l);
            } 
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function filtro($data)
    {
        try {
            $sql = "SELECT * FROM alunos WHERE nome LIKE '%$data%' OR cpf LIKE '%$data%' OR situacao LIKE '%$data%' ORDER BY idAluno ASC";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->execute();
            $lista = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaAlunos($l);
            } 
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function filtroAtivo($data)
    {
        try {
            $sql = "SELECT * FROM alunos WHERE nome LIKE '%$data%' AND situacao = 'ATIVO' ORDER BY idAluno ASC";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->execute();
            $lista = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaAlunos($l);
            } 
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
}
?>
