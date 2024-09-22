<?php

    class ProfessorDAO
    {
        public function create(Professor $professor){
            try {
                $sql = "INSERT INTO professor (
                    nome, dataNascimento, sexo, cpf, cref, celular, cep, estado, cidade, endereco, email, situacao, senha)
                    VALUES (
                    :nome, :dataNascimento, :sexo, :cpf, :cref, :celular, :cep, :estado, :cidade, :endereco, :email, :situacao, :senha)";

                $p_sql = Conexao::getConexao()->prepare($sql);
                $p_sql->bindValue(":nome", $professor->getNome());
                $p_sql->bindValue(":dataNascimento", $professor->getDataNascimento());
                $p_sql->bindValue(":sexo", $professor->getSexo());
                $p_sql->bindValue(":cpf", $professor->getCpf());
                $p_sql->bindValue(":cref", $professor->getCref());
                $p_sql->bindValue(":celular", $professor->getCelular());
                $p_sql->bindValue(":cep", $professor->getCep());
                $p_sql->bindValue(":estado", $professor->getEstado());
                $p_sql->bindValue(":cidade", $professor->getCidade());
                $p_sql->bindValue(":endereco", $professor->getEndereco());
                $p_sql->bindValue(":email", $professor->getEmail());
                $p_sql->bindValue(":situacao", $professor->getSituacao());
                $p_sql->bindValue(":senha", $professor->getSenha());

                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Erro ao Inserir professor <br>" . $e . '<br>';
            }      
        }

        public function read() {
            try {
                $sql = "SELECT * FROM professor ORDER BY idProfessor ASC";
                $result = Conexao::getConexao()->query($sql);
                $lista = $result->fetchAll(PDO::FETCH_ASSOC);
                $f_lista = array();
                foreach ($lista as $l) {
                    $f_lista[] = $this->listaProfessores($l);
                } 
                return $f_lista;
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar Buscar Todos." . $e;
            }
        }

        private function listaProfessores($row) {
            $professor = new Professor();
            $professor->setIdProfessor($row['idProfessor']);
            $professor->setNome($row['nome']);
            $professor->setDataNascimento($row['dataNascimento']);
            $professor->setSexo($row['sexo']);
            $professor->setCpf($row['cpf']);
            $professor->setCref($row['cref']);
            $professor->setCelular($row['celular']);
            $professor->setCep($row['cep']);
            $professor->setEstado($row['estado']);
            $professor->setCidade($row['cidade']);
            $professor->setEndereco($row['endereco']);
            $professor->setEmail($row['email']);
            $professor->setSituacao($row['situacao']);
            $professor->setSenha($row['senha']);

            return $professor;
        }

        public function delete(Professor $professor){
            try {
                $sql = "DELETE FROM professor WHERE  idProfessor = :idProfessor";
                $p_sql = Conexao::getConexao()->prepare($sql);
                $p_sql->bindValue(":idProfessor", $professor->getIdProfessor());
                return $p_sql->execute();
            } catch (Exception $e) {
                echo "Erro ao Excluir professor <br> $e <br>";
            }
        }

        public function update(Professor $professor)
        {
            try {
                $sql = "UPDATE professor SET
                    
                    idProfessor=:idProfessor,
                    nome=:nome,
                    dataNascimento=:dataNascimento,
                    sexo=:sexo,
                    cpf=:cpf,
                    cref=:cref,
                    celular=:celular,
                    cep=:cep,
                    estado=:estado,
                    cidade=:cidade,
                    endereco=:endereco,
                    email=:email,
                    situacao=:situacao,
                    senha=:senha
                                
                    WHERE idProfessor = :idProfessor";
                $p_sql = Conexao::getConexao()->prepare($sql);
                $p_sql->bindValue(":idProfessor", $professor->getIdProfessor());
                $p_sql->bindValue(":nome", $professor->getNome());
                $p_sql->bindValue(":dataNascimento", $professor->getDataNascimento());
                $p_sql->bindValue(":sexo", $professor->getSexo());
                $p_sql->bindValue(":cpf", $professor->getCpf());
                $p_sql->bindValue(":cref", $professor->getCref());
                $p_sql->bindValue(":celular", $professor->getCelular());
                $p_sql->bindValue(":cep", $professor->getCep());
                $p_sql->bindValue(":estado", $professor->getEstado());
                $p_sql->bindValue(":cidade", $professor->getCidade());
                $p_sql->bindValue(":endereco", $professor->getEndereco());
                $p_sql->bindValue(":email", $professor->getEmail());
                $p_sql->bindValue(":situacao", $professor->getSituacao());
                $p_sql->bindValue(":senha", $professor->getSenha());
            
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
            }
        }

        public function filtro($data) {
            try {
                $sql = "SELECT * FROM professor WHERE nome LIKE '%$data%' OR cpf LIKE '%$data%' OR situacao LIKE '$data%' ORDER BY idProfessor ASC";
                $result = Conexao::getConexao()->query($sql);
                $lista = $result->fetchAll(PDO::FETCH_ASSOC);
                $f_lista = array();
                foreach ($lista as $l) {
                    $f_lista[] = $this->listaProfessores($l);
                } 
                return $f_lista;
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar Buscar Todos." . $e;
            }
        }
        
    }

?>