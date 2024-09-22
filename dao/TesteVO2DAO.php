<?php

    class TesteVO2DAO
    {
        public function create(TesteVO2 $testeVO2){
            try {
                $sql = "INSERT INTO testeVO2 (
                    dataCadastro, velocidadeInicial, velocidadeFinal, fcInicial, fcFinal, tempoTeste, esforcoTeste, idAluno)
                    VALUES (
                    :dataCadastro, :velocidadeInicial, :velocidadeFinal, :fcInicial, :fcFinal,:tempoTeste, :esforcoTeste, :idAluno)";

                $p_sql = Conexao::getConexao()->prepare($sql);
                $p_sql->bindValue(":dataCadastro", $testeVO2->getDataCadastro());
                $p_sql->bindValue(":velocidadeInicial", $testeVO2->getVelocidadeInicial());
                $p_sql->bindValue(":velocidadeFinal", $testeVO2->getVelocidadeFinal());
                $p_sql->bindValue(":fcInicial", $testeVO2->getFcInicial());
                $p_sql->bindValue(":fcFinal", $testeVO2->getFcFinal());
                $p_sql->bindValue(":tempoTeste", $testeVO2->getTempoTeste());
                $p_sql->bindValue(":esforcoTeste", $testeVO2->getEsforcoTeste());
                $p_sql->bindValue(":idAluno", $testeVO2->getAluno());

                return $p_sql->execute();
                
            } catch (Exception $e) {
                print "Erro ao Inserir dados teste <br>" . $e . '<br>';
            }      
        }

        public function read() {
            try {
                $sql = "SELECT * FROM testeVO2 ORDER BY idTesteVO2 ASC";
                $result = Conexao::getConexao()->query($sql);
                $lista = $result->fetchAll(PDO::FETCH_ASSOC);
                $f_lista = array();
                foreach ($lista as $l) {
                    $f_lista[] = $this->listaTesteVo2($l);
                } 
                return $f_lista;
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar Buscar Todos." . $e;
            }
        }

        private function listaTesteVo2($row) {
            $testeVO2 = new TesteVO2();
            $testeVO2->setDataCadastro($row['dataCadastro']);
            $testeVO2->setVelocidadeInicial($row['velocidadeInicial']);
            $testeVO2->setVelocidadeFinal($row['velocidadeFinal']);
            $testeVO2->setFcInicial($row['fcInicial']);
            $testeVO2->setFcFinal($row['fcFinal']);
            $testeVO2->setTempoTeste($row['tempoTeste']);
            $testeVO2->setEsforcoTeste($row['esforcoTeste']);

            return $testeVO2;
        }

        private function lista($row) {
            $testeVO2 = new TesteVO2();
            $testeVO2->setDataCadastro($row['dataCadastro']);
            $testeVO2->setVelocidadeInicial($row['velocidadeInicial']);
            $testeVO2->setVelocidadeFinal($row['velocidadeFinal']);
            $testeVO2->setEsforcoTeste($row['esforcoTeste']);

            return $testeVO2;
        }

        public function delete(TesteVO2 $testeVO2){
            try {
                $sql = "DELETE FROM testeVO2 WHERE idTesteVO2 = :idTesteVO2";
                $p_sql = Conexao::getConexao()->prepare($sql);
                $p_sql->bindValue(":idTesteVO2", $testeVO2->getIdTesteVO2());
                return $p_sql->execute();
            } catch (Exception $e) {
                echo "Erro ao Excluir dados iniciais <br> $e <br>";
            }
        }

        public function update(TesteVO2 $testeVO2)
        {
            try {
                $sql = "UPDATE testeVO2 set
                    
                    idTesteVO2=:idTesteVO2,
                    dataCadastro=:dataCadastro,
                    velocidadeInicial=:velocidadeInicial, 
                    velocidadeFinal=:velocidadeFinal, 
                    fcInicial=:fcInicial, 
                    fcFinal=:fcfinal,  
                    tempoTeste=:tempoTeste, 
                    esforcoTeste=:esforcoTeste, 
                                
                    WHERE idTesteVO2 = :idTesteVO2";
                $p_sql = Conexao::getConexao()->prepare($sql);
                $p_sql->bindValue(":dataCadastro", $testeVO2->getDataCadastro());
                $p_sql->bindValue(":velocidadeInicial", $testeVO2->getVelocidadeInicial());
                $p_sql->bindValue(":velocidadeFinal", $testeVO2->getVelocidadeFinal());
                $p_sql->bindValue(":fcInicial", $testeVO2->getFcInicial());
                $p_sql->bindValue(":fcFinal", $testeVO2->getFcFinal());
                $p_sql->bindValue(":tempoTeste", $testeVO2->getTempoTeste());
                $p_sql->bindValue(":esforcoTeste", $testeVO2->getEsforcoTeste());
            
                return $p_sql->execute();
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
            }
        }

        public function resultadoVO($id){
            $sql = "SELECT testeVO2.velocidadeFinal FROM testeVO2, alunos WHERE testeVO2.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY testeVO2.idTesteVO2 DESC LIMIT 1";
            $result = Conexao::getConexao()->query($sql);
            $result->execute();
            
                while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)){
                    $vel = $linha1['velocidadeFinal'];
                } 
                if(isset($vel)){
                $vo = $vel * 3.5;
    
                $voFormatado = number_format($vo, 2);
    
                print $voFormatado; 
            } 
            else{
                echo '❌';
            }       
        }

        public function classVO($id, $sexo, $idade){
            $sql = "SELECT testeVO2.velocidadeFinal FROM testeVO2, alunos WHERE testeVO2.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY testeVO2.idTesteVO2 DESC LIMIT 1";
            $result = Conexao::getConexao()->query($sql);
            $result->execute();
                while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)){
                    $vel = $linha1['velocidadeFinal'];
                } 
                if(isset($vel)){
                $vo = $vel * 3.5;
                $voFormatado = number_format($vo, 2);

                if($sexo == 'F'){
                    if($idade < 29){
                        if($voFormatado < 30){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 38){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 49){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }
                    } else if($idade < 39){
                        if($voFormatado < 28){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 34){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 45){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }
                    } else if($idade < 49){
                        if($voFormatado < 24){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 31){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 42){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }

                    } else if($idade < 59){
                        if($voFormatado < 20){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 28){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 38){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }

                    } else{
                        if($voFormatado < 18){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 24){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 35){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }
                    }

                } else{
                    if($idade < 29){
                        if($voFormatado < 34){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 43){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 52){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }
                    } else if($idade < 39){
                        if($voFormatado < 30){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 38){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 48){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }
                    } else if($idade < 49){
                        if($voFormatado < 24){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 31){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 42){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }

                    } else if($idade < 59){
                        if($voFormatado < 27){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 39){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 44){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }

                    } else{
                        if($voFormatado < 23){
                            $classVO = 'FRACO';
                        } else if($voFormatado < 31){
                            $classVO = 'REGULAR';
                        } else if($voFormatado < 41){
                            $classVO = 'BOM';
                        } else{
                            $classVO = 'OTIMO';
                        }
                    }
                }
                print $classVO;
            } 
            else{
                echo '❌';
            }
        }

        public function ultimoTeste($id){
            try {
                $sql = "SELECT testeVO2.dataCadastro, testeVO2.velocidadeInicial, testeVO2.esforcoTeste, testeVO2.velocidadeFinal FROM testeVO2, alunos WHERE testeVO2.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY testeVO2.idTesteVO2 DESC LIMIT 1";
                $result = Conexao::getConexao()->query($sql);
                $lista = $result->fetchAll(PDO::FETCH_ASSOC);
                $f_lista = array();
                foreach ($lista as $l) {
                    $f_lista[] = $this->lista($l);
                } 
                return $f_lista;
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar Buscar Todos." . $e;
            }
        }

        public function testeAnt($id){
            try {
                $sql = "SELECT testeVO2.dataCadastro, testeVO2.velocidadeInicial, testeVO2.esforcoTeste, testeVO2.velocidadeFinal FROM testeVO2, alunos WHERE testeVO2.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY testeVO2.idTesteVO2 DESC LIMIT 1 OFFSET 1";
                $result = Conexao::getConexao()->query($sql);
                $lista = $result->fetchAll(PDO::FETCH_ASSOC);
                $f_lista = array();
                foreach ($lista as $l) {
                    $f_lista[] = $this->lista($l);
                } 
                return $f_lista;
            } catch (Exception $e) {
                print "Ocorreu um erro ao tentar Buscar Todos." . $e;
            }
        }

        public function resultadoAnt($id){
            $sql = "SELECT testeVO2.velocidadeFinal FROM testeVO2, alunos WHERE testeVO2.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY testeVO2.idTesteVO2 DESC LIMIT 1 OFFSET 1";
            $result = Conexao::getConexao()->query($sql);
            $result->execute();
            
                while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)){
                    $vel = $linha1['velocidadeFinal'];
                } 
                if(isset($vel)){
                $vo = $vel * 3.5;
    
                $voFormatado = number_format($vo, 2);
    
                print $voFormatado; 
            } 
            else{
                echo '❌';
            }       
        }

    }

?>