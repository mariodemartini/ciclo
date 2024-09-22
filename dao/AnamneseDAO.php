<?php

    class AnamneseDAO
    {
        public function create(Anamnese $anamnese){
            try {
                $sql = "INSERT INTO anamnese (
                    atividade, objetivo, fumante, alcool, historicoFam, hipertensao, colesterol, diabetes, cardiaco, cirurgia, fratura, lesao, dor, movimentos, artrite, medicamentos, outros, alimentacao, dataCadastro, idAluno)
                    VALUES (
                    :atividade, :objetivo, :fumante, :alcool, :historicoFam, :hipertensao, :colesterol, :diabetes, :cardiaco, :cirurgia, :fratura, :lesao, :dor, :movimentos, :artrite, :medicamentos, :outros, :alimentacao, :dataCadastro, :idAluno)";

                $p_sql = Conexao::getConexao()->prepare($sql);
                $p_sql->bindValue(":atividade", $anamnese->getAtividade());
                $p_sql->bindValue(":objetivo", $anamnese->getObjetivo());
                $p_sql->bindValue(":fumante", $anamnese->getFumante());
                $p_sql->bindValue(":alcool", $anamnese->getAlcool());
                $p_sql->bindValue(":historicoFam", $anamnese->getHistoricoFam());
                $p_sql->bindValue(":hipertensao", $anamnese->getHipertensao());
                $p_sql->bindValue(":colesterol", $anamnese->getColesterol());
                $p_sql->bindValue(":diabetes", $anamnese->getDiabetes());
                $p_sql->bindValue(":cardiaco", $anamnese->getCardiaco());
                $p_sql->bindValue(":cirurgia", $anamnese->getCirurgia());
                $p_sql->bindValue(":fratura", $anamnese->getFratura());
                $p_sql->bindValue(":lesao", $anamnese->getLesao());
                $p_sql->bindValue(":dor", $anamnese->getDor());
                $p_sql->bindValue(":movimentos", $anamnese->getMovimentos());
                $p_sql->bindValue(":artrite", $anamnese->getArtrite());
                $p_sql->bindValue(":medicamentos", $anamnese->getMedicamentos());
                $p_sql->bindValue(":outros", $anamnese->getOutros());
                $p_sql->bindValue(":alimentacao", $anamnese->getAlimentacao());
                $p_sql->bindValue(":dataCadastro", $anamnese->getDataCadastro());
                $p_sql->bindValue(":idAluno", $anamnese->getAluno());

                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Erro ao Inserir anamnese <br>" . $e . '<br>';
            }      
        }

        public function read($id) {
            try {
                $sql = "SELECT anamnese.* FROM anamnese, alunos WHERE anamnese.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY anamnese.dataCadastro DESC LIMIT 1";
                $result = Conexao::getConexao()->query($sql);
                $lista = $result->fetchAll(PDO::FETCH_ASSOC);
                $f_lista = array();
                foreach ($lista as $l) {
                    $f_lista[] = $this->listaAnamnese($l);
                } 
                return $f_lista;
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar Buscar Todos." . $e;
            }
        }

        private function listaAnamnese($row) {
            $anamnese = new Anamnese();
            $anamnese->setIdAnamnese($row['idAnamnese']);
            $anamnese->setAtividade($row['atividade']);
            $anamnese->setObjetivo($row['objetivo']);
            $anamnese->setFumante($row['fumante']);
            $anamnese->setAlcool($row['alcool']);
            $anamnese->setHistoricoFam($row['historicoFam']);
            $anamnese->setHipertensao($row['hipertensao']);
            $anamnese->setColesterol($row['colesterol']);
            $anamnese->setDiabetes($row['diabetes']);
            $anamnese->setCardiaco($row['cardiaco']);
            $anamnese->setCirurgia($row['cirurgia']);
            $anamnese->setFratura($row['fratura']);
            $anamnese->setLesao($row['lesao']);
            $anamnese->setDor($row['dor']);
            $anamnese->setMovimentos($row['movimentos']);
            $anamnese->setArtrite($row['artrite']);
            $anamnese->setMedicamentos($row['medicamentos']);
            $anamnese->setOutros($row['outros']);
            $anamnese->setAlimentacao($row['alimentacao']);
            $anamnese->setDataCadastro($row['dataCadastro']);
            $anamnese->setAluno($row['idAluno']);

            return $anamnese;
        }

        public function delete(Anamnese $anamnese){
            try {
                $sql = "DELETE FROM anamnese WHERE idAnamnese = :idAnamnese";
                $p_sql = Conexao::getConexao()->prepare($sql);
                $p_sql->bindValue(":idAnamnese", $anamnese->getIdAnamnese());
                return $p_sql->execute();
            } catch (Exception $e) {
                echo "Erro ao Excluir anamnese <br> $e <br>";
            }
        }

        public function update(Anamnese $anamnese)
        {
            try {
                $sql = "UPDATE anamnese set
                    
                      idAnamnese=:idAnamnese,
                      atividade=:atividade,
                      objetivo=:objetivo,
                      fumante=:fumante,
                      alcool=:alcool,
                      historicoFam=:historicoFam,
                      hipertensao=:hipertensao,
                      colesterol=:colesterol,
                      diabetes=:diabetes,
                      cardiaco=:cardiaco,
                      cirugia=:cirurgia,
                      fratura=:fratura,
                      lesao=:lesao,
                      dor=:dor,
                      movimentos=:movimentos,
                      artrite=:artrite,
                      medicamentos=:medicamentos,
                      outros=:outros,
                      alimentacao=:alimentacao,
                      dataCadastro=:dataCadastro,
                                    
                      WHERE idAnamnese = :idAnamnese";
                $p_sql = Conexao::getConexao()->prepare($sql);
                $p_sql->bindValue(":idAnamnese", $anamnese->getIdAnamnese());
                $p_sql->bindValue(":atividade", $anamnese->getAtividade());
                $p_sql->bindValue(":objetivo", $anamnese->getObjetivo());
                $p_sql->bindValue(":fumante", $anamnese->getFumante());
                $p_sql->bindValue(":alcool", $anamnese->getAlcool());
                $p_sql->bindValue(":historico_fam", $anamnese->getHistoricoFam());
                $p_sql->bindValue(":hipertensao", $anamnese->getHipertensao());
                $p_sql->bindValue(":colesterol", $anamnese->getColesterol());
                $p_sql->bindValue(":cirugia", $anamnese->getCirurgia());
                $p_sql->bindValue(":fratura", $anamnese->getFratura());
                $p_sql->bindValue(":lesao", $anamnese->getLesao());
                $p_sql->bindValue(":dor", $anamnese->getDor());
                $p_sql->bindValue(":movimentos", $anamnese->getMovimentos());
                $p_sql->bindValue(":artrite", $anamnese->getArtrite());
                $p_sql->bindValue(":medicamentos", $anamnese->getMedicamentos());
                $p_sql->bindValue(":outros", $anamnese->getOutros());
                $p_sql->bindValue(":alimentacao", $anamnese->getAlimentacao());
                $p_sql->bindValue(":dataCadastro", $anamnese->getDataCadastro());
            
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
            }
        }

        private function listaAnamnese2($row) {
            $anamnese2 = new Anamnese();

            $anamnese2->setAluno($row['nome']);

            return $anamnese2;
        }

        public function busca() {
            try {
                $sql = "SELECT idAluno FROM alunos WHERE nome = ':nome' ";
                $result = Conexao::getConexao()->query($sql);
                $lista = $result->fetchAll(PDO::FETCH_ASSOC);
                $f_lista = array();
                foreach ($lista as $l) {
                    $f_lista[] = $this->listaAnamnese2($l);
                } 
                return $f_lista;

            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar Buscar Todos." . $e;
            }
        }
  
    }

?>