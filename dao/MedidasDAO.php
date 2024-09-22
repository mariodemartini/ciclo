<?php

class MedidasDAO
{

    public function create(Medidas $medidas)
    {
        try {
            $sql = "INSERT INTO medidas (
                dataCadastro, peso, altura, freqCard, pressaoArterial, torax, cintura, abdomen, quadril, bracoDireito, bracoEsquerdo, antebracoDireito, antebracoEsquerdo, coxaDireita, coxaEsquerda, panturrilhaDireita, panturrilhaEsquerda, peitoral, axilarMedia, abdominal, supraIliaca, subEscapular, tricipital, coxa, idAluno)
                VALUES (
                :dataCadastro, :peso, :altura, :freqCard, :pressaoArterial, :torax, :cintura, :abdomen, :quadril, :bracoDireito, :bracoEsquerdo, :antebracoDireito, :antebracoEsquerdo, :coxaDireita, :coxaEsquerda, :panturrilhaDireita, :panturrilhaEsquerda, :peitoral, :axilarMedia, :abdominal, :supraIliaca, :subEscapular, :tricipital, :coxa, :idAluno)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":peso", $medidas->getPeso());
            $p_sql->bindValue(":dataCadastro", $medidas->getDataCadastro());
            $p_sql->bindValue(":altura", $medidas->getAltura());
            $p_sql->bindValue(":freqCard", $medidas->getFreqCard());
            $p_sql->bindValue(":pressaoArterial", $medidas->getPressaoArterial());
            $p_sql->bindValue(":torax", $medidas->getTorax());
            $p_sql->bindValue(":cintura", $medidas->getCintura());
            $p_sql->bindValue(":abdomen", $medidas->getAbdomen());
            $p_sql->bindValue(":quadril", $medidas->getQuadril());
            $p_sql->bindValue(":bracoDireito", $medidas->getBracoDireito());
            $p_sql->bindValue(":bracoEsquerdo", $medidas->getBracoEsquerdo());
            $p_sql->bindValue(":antebracoDireito", $medidas->getAntebracoDireito());
            $p_sql->bindValue(":antebracoEsquerdo", $medidas->getAntebracoEsquerdo());
            $p_sql->bindValue(":coxaDireita", $medidas->getCoxaDireita());
            $p_sql->bindValue(":coxaEsquerda", $medidas->getCoxaEsquerda());
            $p_sql->bindValue(":panturrilhaDireita", $medidas->getPanturrilhaDireita());
            $p_sql->bindValue(":panturrilhaEsquerda", $medidas->getPanturrilhaEsquerda());
            $p_sql->bindValue(":peitoral", $medidas->getPeitoral());
            $p_sql->bindValue(":axilarMedia", $medidas->getAxilarMedia());
            $p_sql->bindValue(":abdominal", $medidas->getAbdominal());
            $p_sql->bindValue(":supraIliaca", $medidas->getSupraIliaca());
            $p_sql->bindValue(":subEscapular", $medidas->getSubEscapular());
            $p_sql->bindValue(":tricipital", $medidas->getTricipital());
            $p_sql->bindValue(":coxa", $medidas->getCoxa());
            $p_sql->bindValue(":idAluno", $medidas->getAluno());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir medidas <br>" . $e . '<br>';
        }
    }

    public function read()
    {
        try {
            $sql = "SELECT * FROM medidas ORDER BY idMedidas ASC";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaMedidas($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    private function listaMedidas($row)
    {
        $medidas = new Medidas();
        $medidas->setIdMedidas($row['idMedidas']);
        $medidas->setDataCadastro($row['dataCadastro']);
        $medidas->setPeso($row['peso']);
        $medidas->setAltura($row['altura']);
        $medidas->setFreqCard($row['freqCard']);
        $medidas->setPressaoArterial($row['pressaoArterial']);
        $medidas->setTorax($row['torax']);
        $medidas->setCintura($row['cintura']);
        $medidas->setAbdomen($row['abdomen']);
        $medidas->setQuadril($row['quadril']);
        $medidas->setBracoDireito($row['bracoDireito']);
        $medidas->setBracoEsquerdo($row['bracoEsquerdo']);
        $medidas->setAntebracoDireito($row['antebracoDireito']);
        $medidas->setAntebracoEsquerdo($row['antebracoEsquerdo']);
        $medidas->setCoxaDireita($row['coxaDireita']);
        $medidas->setCoxaEsquerda($row['coxaEsquerda']);
        $medidas->setPanturrilhaDireita($row['panturrilhaDireita']);
        $medidas->setPanturrilhaEsquerda($row['panturrilhaEsquerda']);
        $medidas->setPeitoral($row['peitoral']);
        $medidas->setAxilarMedia($row['axilarMedia']);
        $medidas->setAbdominal($row['abdominal']);
        $medidas->setSupraIliaca($row['supraIliaca']);
        $medidas->setSubEscapular($row['subEscapular']);
        $medidas->setTricipital($row['tricipital']);
        $medidas->setCoxa($row['coxa']);
        $medidas->setAluno($row['idAluno']);

        return $medidas;
    }

    public function delete(Medidas $medidas)
    {
        try {
            $sql = "DELETE FROM medidas WHERE idMedidas = :idMedidas";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":idMedidas", $medidas->getIdMedidas());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir medidas <br> $e <br>";
        }
    }

    public function update(Medidas $medidas)
    {
        try {
            $sql = "UPDATE medidas set
                
                idMedidas=:idMedidas,
                dataCadastro=:dataCadastro,
                peso=:peso,
                altura=:altura,
                freqCard=:freqCard,
                pressaoArterial=:pressaoArterial,
                torax=:torax,
                cintura=:cintura,
                abdomen=:abdomen,
                quadril=:quadril,
                bracoDireito=:bracoDireito,
                bracoEsquerdo=:bracoEsquerdo,
                antebracoDireito=:antebracoDireito,
                antebracoEsquerdo=:antebracoEsquerdo,
                coxaDireita=:coxaDireita,
                coxaEsquerda=:coxaEsquerda,
                panturrilhaDireita=:panturrilhaEireita,
                panturrilhaEsquerda=:panturrilhaEsquerda,
                peitoral=:peitoral,
                axilarMedia=:axilarMedia,
                abdominal=:abdominal,
                supraIliaca=:supraIliaca,
                subEscapular=:subEscapular,
                tricipital=:tricipital,
                coxa=:coxa
                            
                WHERE idMedidas = :idMedidas";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":dataCadastro", $medidas->getDataCadastro());
            $p_sql->bindValue(":peso", $medidas->getPeso());
            $p_sql->bindValue(":altura", $medidas->getAltura());
            $p_sql->bindValue(":freqCard", $medidas->getFreqCard());
            $p_sql->bindValue(":pressaoArterial", $medidas->getPressaoArterial());
            $p_sql->bindValue(":torax", $medidas->getTorax());
            $p_sql->bindValue(":cintura", $medidas->getCintura());
            $p_sql->bindValue(":abdomen", $medidas->getAbdomen());
            $p_sql->bindValue(":quadril", $medidas->getQuadril());
            $p_sql->bindValue(":bracoDireito", $medidas->getBracoDireito());
            $p_sql->bindValue(":bracoEsquerdo", $medidas->getBracoEsquerdo());
            $p_sql->bindValue(":antebracoDireito", $medidas->getAntebracoDireito());
            $p_sql->bindValue(":antebracoEsquerdo", $medidas->getAntebracoEsquerdo());
            $p_sql->bindValue(":coxaDireita", $medidas->getCoxaDireita());
            $p_sql->bindValue(":coxaEsquerda", $medidas->getCoxaEsquerda());
            $p_sql->bindValue(":panturrilhaDireita", $medidas->getPanturrilhaDireita());
            $p_sql->bindValue(":panturrilhaEsquerda", $medidas->getPanturrilhaEsquerda());
            $p_sql->bindValue(":peitoral", $medidas->getPeitoral());
            $p_sql->bindValue(":axilarMedia", $medidas->getAxilarMedia());
            $p_sql->bindValue(":abdominal", $medidas->getAbdominal());
            $p_sql->bindValue(":supraIliaca", $medidas->getSupraIliaca());
            $p_sql->bindValue(":subEscapular", $medidas->getSubEscapular());
            $p_sql->bindValue(":tricipital", $medidas->getTricipital());
            $p_sql->bindValue(":coxa", $medidas->getCoxa());

            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    private function lista($row)
    {
        $medidas = new Medidas();
        $medidas->setIdMedidas($row['idMedidas']);
        $medidas->setDataCadastro($row['dataCadastro']);
        $medidas->setPeso($row['peso']);
        $medidas->setAbdomen($row['abdomen']);
        $medidas->setFreqCard($row['freqCard']);
        $medidas->setPressaoArterial($row['pressaoArterial']);

        return $medidas;
    }

    private function lista2($row)
    {
        $medidas = new Medidas();
        $medidas->setIdMedidas($row['idMedidas']);
        $medidas->setDataCadastro($row['dataCadastro']);
        $medidas->setPeso($row['peso']);
        $medidas->setFreqCard($row['freqCard']);
        $medidas->setPressaoArterial($row['pressaoArterial']);

        return $medidas;
    }


    public function exibeData($id)
    {
        try {
            $sql = "SELECT medidas.dataCadastro FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1";
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

    public function exibeDados($id)
    {
        try {
            $sql = "SELECT medidas.idMedidas, medidas.dataCadastro, medidas.peso, medidas.abdomen, medidas.freqCard, medidas.pressaoArterial FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1";
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

    public function rcq($id)
    {
        $sql = "SELECT medidas.cintura, medidas.quadril FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $cintura = $linha1['cintura'];
            $quadril = $linha1['quadril'];
        }
        if (isset($cintura) && isset($quadril)) {
            $rcq = $cintura / $quadril;
            $rcqFormatado = number_format($rcq, 2);

            print $rcqFormatado;
        } else {
            print '❌';
        }
    }

    public function imc($id)
    {
        $sql = "SELECT medidas.peso, medidas.altura FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $peso = $linha1['peso'];
            $altura = $linha1['altura'];
        }
        if (isset($peso) && isset($altura)) {
            $alt = $altura / 100;
            $imc = $peso / ($alt ** 2);
            $imcFormatado = number_format($imc, 2);

            print $imcFormatado;
        } else {
            print '❌';
        }
    }

    public function percentGord($id, $sexo, $idade)
    {
        $sql = "SELECT medidas.tricipital, medidas.axilarMedia, medidas.peitoral, medidas.abdominal, medidas.supraIliaca, medidas.subEscapular, medidas.coxa FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $tric = $linha1['tricipital'];
            $ax = $linha1['axilarMedia'];
            $peito = $linha1['peitoral'];
            $abd = $linha1['abdominal'];
            $supra = $linha1['supraIliaca'];
            $sub = $linha1['subEscapular'];
            $coxa = $linha1['coxa'];
        }
        if (isset($tric)) {
            $soma = $peito + $ax + $abd + $supra + $sub + $tric + $coxa;
            if ($sexo == 'M' || $sexo == 'm') {
                $dc = 1.112 - 0.00043499 * ($soma) + 0.00000055 * ($soma ** 2) - 0.00028826 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            } else if ($sexo == 'F' || $sexo == 'f') {
                $dc = 1.0970 - 0.00046971 * ($soma) + 0.00000056 * ($soma ** 2) - 0.00012828 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            }
            $perc = number_format($percentGord, 2);
            echo $perc;
            return $perc;
        } else {
            print '❌';
        }
    }

    public function gordura($peso, $id, $sexo, $idade)
    {
        $sql = "SELECT medidas.tricipital, medidas.axilarMedia, medidas.peitoral, medidas.abdominal, medidas.supraIliaca, medidas.subEscapular, medidas.coxa FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $tric = $linha1['tricipital'];
            $ax = $linha1['axilarMedia'];
            $peito = $linha1['peitoral'];
            $abd = $linha1['abdominal'];
            $supra = $linha1['supraIliaca'];
            $sub = $linha1['subEscapular'];
            $coxa = $linha1['coxa'];
        }
        if (isset($tric)) {
            $soma = $peito + $ax + $abd + $supra + $sub + $tric + $coxa;
            if ($sexo == 'M' || $sexo == 'm') {
                $dc = 1.112 - 0.00043499 * ($soma) + 0.00000055 * ($soma ** 2) - 0.00028826 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            } else if ($sexo == 'F' || $sexo == 'f') {
                $dc = 1.0970 - 0.00046971 * ($soma) + 0.00000056 * ($soma ** 2) - 0.00012828 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            }
            $perc = number_format($percentGord, 2);

            $massaGorda = ($peso * $perc) / 100;
            $pesoG = number_format($massaGorda, 2);
            print $pesoG;
        } else {
            print '❌';
        }
    }

    public function magra($peso, $id, $sexo, $idade)
    {
        $sql = "SELECT medidas.tricipital, medidas.axilarMedia, medidas.peitoral, medidas.abdominal, medidas.supraIliaca, medidas.subEscapular, medidas.coxa FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $tric = $linha1['tricipital'];
            $ax = $linha1['axilarMedia'];
            $peito = $linha1['peitoral'];
            $abd = $linha1['abdominal'];
            $supra = $linha1['supraIliaca'];
            $sub = $linha1['subEscapular'];
            $coxa = $linha1['coxa'];
        }
        if (isset($tric)) {
            $soma = $peito + $ax + $abd + $supra + $sub + $tric + $coxa;
            if ($sexo == 'M' || $sexo == 'm') {
                $dc = 1.112 - 0.00043499 * ($soma) + 0.00000055 * ($soma ** 2) - 0.00028826 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            } else if ($sexo == 'F' || $sexo == 'f') {
                $dc = 1.0970 - 0.00046971 * ($soma) + 0.00000056 * ($soma ** 2) - 0.00012828 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            }
            $perc = number_format($percentGord, 2);

            $massaGorda = ($peso * $perc) / 100;
            $massaMagra = ($peso - $massaGorda);
            $pesoM = number_format($massaMagra, 2);
            print $pesoM;
        } else {
            print '❌';
        }
    }

    public function classPerc($id, $sexo, $idade)
    {
        $sql = "SELECT medidas.tricipital, medidas.axilarMedia, medidas.peitoral, medidas.abdominal, medidas.supraIliaca, medidas.subEscapular, medidas.coxa FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1;";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $tric = $linha1['tricipital'];
            $ax = $linha1['axilarMedia'];
            $peito = $linha1['peitoral'];
            $abd = $linha1['abdominal'];
            $supra = $linha1['supraIliaca'];
            $sub = $linha1['subEscapular'];
            $coxa = $linha1['coxa'];
        }
        if (isset($tric)) {
            $soma = $peito + $ax + $abd + $supra + $sub + $tric + $coxa;
            if ($sexo == 'M' || $sexo == 'm') {
                $dc = 1.112 - 0.00043499 * ($soma) + 0.00000055 * ($soma ** 2) - 0.00028826 * ($idade);

                $percentGord = ((4.95 / $dc) - 4.5) * 100;
                $perc = number_format($percentGord, 2);

                if ($idade <= 25) {
                    if ($perc <= 10) {
                        $classPerc = 'OTIMO';
                    } else if ($perc <= 15) {
                        $classPerc = 'BOM';
                    } else if ($perc <= 20) {
                        $classPerc = 'REGULAR';
                    } else if ($perc <= 25) {
                        $classPerc = 'RUIM';
                    } else if ($perc > 25) {
                        $classPerc = 'RISCO';
                    }
                } else if ($idade <= 35) {
                    if ($perc < 15) {
                        $classPerc = 'OTIMO';
                    } else if ($perc <= 20) {
                        $classPerc = 'BOM';
                    } else if ($perc <= 24) {
                        $classPerc = 'REGULAR';
                    } else if ($perc <= 30) {
                        $classPerc = 'RUIM';
                    } else if ($perc > 30) {
                        $classPerc = 'RISCO';
                    }
                } else if ($idade <= 50) {
                    if ($perc < 18) {
                        $classPerc = 'OTIMO';
                    } else if ($perc <= 21) {
                        $classPerc = 'BOM';
                    } else if ($perc <= 25) {
                        $classPerc = 'REGULAR';
                    } else if ($perc <= 30) {
                        $classPerc = 'RUIM';
                    } else if ($perc > 30) {
                        $classPerc = 'RISCO';
                    }
                } else if ($idade > 50) {
                    if ($perc < 20) {
                        $classPerc = 'OTIMO';
                    } else if ($perc <= 24) {
                        $classPerc = 'BOM';
                    } else if ($perc <= 29) {
                        $classPerc = 'REGULAR';
                    } else if ($perc <= 34) {
                        $classPerc = 'RUIM';
                    } else if ($perc > 34) {
                        $classPerc = 'RISCO';
                    }
                }
            } else if ($sexo == 'F' || $sexo == 'f') {
                $dc = 1.0970 - 0.00046971 * ($soma) + 0.00000056 * ($soma ** 2) - 0.00012828 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
                $perc = number_format($percentGord, 2);

                if ($idade <= 25) {
                    if ($perc <= 15) {
                        $classPerc = 'OTIMO';
                    } else if ($perc <= 20) {
                        $classPerc = 'BOM';
                    } else if ($perc <= 25) {
                        $classPerc = 'REGULAR';
                    } else if ($perc <= 30) {
                        $classPerc = 'RUIM';
                    } else if ($perc > 30) {
                        $classPerc = 'RISCO';
                    }
                } else if ($idade <= 35) {
                    if ($perc < 15) {
                        $classPerc = 'OTIMO';
                    } else if ($perc <= 23) {
                        $classPerc = 'BOM';
                    } else if ($perc <= 29) {
                        $classPerc = 'REGULAR';
                    } else if ($perc <= 34) {
                        $classPerc = 'RUIM';
                    } else if ($perc > 34) {
                        $classPerc = 'RISCO';
                    }
                } else if ($idade <= 50) {
                    if ($perc < 18) {
                        $classPerc = 'OTIMO';
                    } else if ($perc <= 24) {
                        $classPerc = 'BOM';
                    } else if ($perc <= 29) {
                        $classPerc = 'REGULAR';
                    } else if ($perc <= 35) {
                        $classPerc = 'RUIM';
                    } else if ($perc > 35) {
                        $classPerc = 'RISCO';
                    }
                } else if ($idade > 50) {
                    if ($perc < 23) {
                        $classPerc = 'OTIMO';
                    } else if ($perc <= 27) {
                        $classPerc = 'BOM';
                    } else if ($perc <= 32) {
                        $classPerc = 'REGULAR';
                    } else if ($perc <= 36) {
                        $classPerc = 'RUIM';
                    } else if ($perc > 36) {
                        $classPerc = 'RISCO';
                    }
                }
            }
            print $classPerc;
        } else {
            print '❌';
        }
    }

    public function classRcq($id, $sexo, $idade)
    {
        $sql = "SELECT medidas.cintura, medidas.quadril FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $cintura = $linha1['cintura'];
            $quadril = $linha1['quadril'];
        }
        if (isset($cintura) && isset($quadril)) {
            $rcq = $cintura / $quadril;
            $rcqFormatado = number_format($rcq, 2);

            if ($sexo == 'M') {
                if ($idade < 30) {
                    if ($rcqFormatado < 0.83) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.88) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 0.94) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                } else if ($idade < 40) {
                    if ($rcqFormatado < 0.84) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.91) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 0.96) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                } else if ($idade < 50) {
                    if ($rcqFormatado < 0.88) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.95) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 1.00) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                } else if ($idade < 60) {
                    if ($rcqFormatado < 0.90) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.96) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 1.02) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                } else if ($idade >= 60) {
                    if ($rcqFormatado < 0.91) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.98) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 1.03) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                }
            } else {
                if ($idade < 30) {
                    if ($rcqFormatado < 0.71) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.77) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 0.82) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                } else if ($idade < 40) {
                    if ($rcqFormatado < 0.72) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.78) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 0.84) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                } else if ($idade < 50) {
                    if ($rcqFormatado < 0.73) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.79) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 0.87) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                } else if ($idade < 60) {
                    if ($rcqFormatado < 0.74) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.81) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 0.88) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                } else if ($idade >= 60) {
                    if ($rcqFormatado < 0.76) {
                        $classRcq = 'BAIXO';
                    } else if ($rcqFormatado < 0.83) {
                        $classRcq = 'REGULAR';
                    } else if ($rcqFormatado < 0.90) {
                        $classRcq = 'ALTO';
                    } else {
                        $classRcq = 'RISCO';
                    }
                }
            }
            print $classRcq;
        }
    }

    public function classAbd($abd, $sexo)
    {
        if ($sexo == 'F') {
            if ($abd < 80) {
                $classAbd = 'IDEAL';
            } else if ($abd >= 80 && $abd <= 88) {
                $classAbd = 'REGULAR';
            } else {
                $classAbd = 'RISCO';
            }
        } else {
            if ($abd < 94) {
                $classAbd = 'IDEAL';
            } else if ($abd >= 94 && $abd <= 102) {
                $classAbd = 'REGULAR';
            } else {
                $classAbd = 'RISCO';
            }
        }
        print $classAbd;
    }

    public function classFc($fc, $idade)
    {
        if ($idade < 35) {
            if ($fc < 55) {
                $classFc = '❌';
            } else if ($fc >= 55 && $fc <= 61) {
                $classFc = 'OTIMO';
            } else if ($fc > 61 && $fc <= 70) {
                $classFc = 'BOA';
            } else if ($fc > 70 && $fc <= 80) {
                $classFc = 'NORMAL';
            } else {
                $classFc = 'RUIM';
            }
        } else if ($idade >= 36 && $idade <= 45) {
            if ($fc < 55) {
                $classFc = '❌';
            } else if ($fc > 55 && $fc <= 62) {
                $classFc = 'OTIMO';
            } else if ($fc > 62 && $fc <= 75) {
                $classFc = 'BOA';
            } else if ($fc > 75 && $fc <= 82) {
                $classFc = 'NORMAL';
            } else {
                $classFc = 'RUIM';
            }
        } else if ($idade >= 46 && $idade <= 54) {
            if ($fc < 55) {
                $classFc = '❌';
            } else if ($fc > 55 && $fc <= 63) {
                $classFc = 'OTIMO';
            } else if ($fc > 63 && $fc <= 75) {
                $classFc = 'BOA';
            } else if ($fc > 75 && $fc <= 83) {
                $classFc = 'NORMAL';
            } else {
                $classFc = 'RUIM';
            }
        } else {
            if ($fc < 55) {
                $classFc = '❌';
            } else if ($fc > 55 && $fc <= 64) {
                $classFc = 'OTIMO';
            } else if ($fc > 64 && $fc <= 75) {
                $classFc = 'BOA';
            } else if ($fc > 75 && $fc <= 82) {
                $classFc = 'NORMAL';
            } else {
                $classFc = 'RUIM';
            }
        }
        print $classFc;
    }

    public function classImc($id)
    {
        $sql = "SELECT medidas.peso, medidas.altura FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.idMedidas DESC LIMIT 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $peso = $linha1['peso'];
            $altura = $linha1['altura'];
        }
        if (isset($peso) && isset($altura)) {
            $imc = $peso / ($altura ** 2);
            $imcFormatado = number_format($imc, 2);

            if ($imcFormatado < 18.5) {
                $classImc = 'ABAIXO';
            } else if ($imcFormatado >= 18.5 && $imcFormatado < 25) {
                $classImc = 'NORMAL';
            } else if ($imcFormatado >= 25 && $imcFormatado < 30) {
                $classImc = 'ACIMA';
            } else if ($imcFormatado >= 30 && $imcFormatado < 35) {
                $classImc = 'OBESO I';
            } else if ($imcFormatado >= 35 && $imcFormatado < 40) {
                $classImc = 'OBESO II';
            } else {
                $classImc = 'OBESO III';
            }
            print $classImc;
        }
    }

    public function exibeAnt($id)
    {
        try {
            $sql = "SELECT medidas.idMedidas, medidas.dataCadastro, medidas.peso, medidas.altura, medidas.freqCard, medidas.pressaoArterial FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1 OFFSET 1";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->lista2($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function exibeDataAnt($id)
    {
        try {
            $sql = "SELECT medidas.dataCadastro FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1 OFFSET 1";
            $result = Conexao::getConexao()->query($sql);
            while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
                $data = $linha1['dataCadastro'];
            }
            if (isset($data)) {
                print $data;
            } else {
                print '❌';
            }
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

    public function rcqAnt($id)
    {
        $sql = "SELECT medidas.cintura, medidas.quadril FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1 OFFSET 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $cintura = $linha1['cintura'];
            $quadril = $linha1['quadril'];
        }
        if (isset($cintura) && isset($quadril)) {
            $rcq = $cintura / $quadril;
            $rcqFormatado = number_format($rcq, 2);

            print $rcqFormatado;
        } else {
            print '❌';
        }
    }

    public function imcAnt($id)
    {
        $sql = "SELECT medidas.peso, medidas.altura FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1 OFFSET 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $peso = $linha1['peso'];
            $altura = $linha1['altura'];
        }
        if (isset($peso) && isset($altura)) {
            $alt = $altura / 100;
            $imc = $peso / ($alt ** 2);
            $imcFormatado = number_format($imc, 2);

            print $imcFormatado;
        } else {
            print '❌';
        }
    }

    public function percentGordAnt($id, $sexo, $idade)
    {
        $sql = "SELECT medidas.tricipital, medidas.axilarMedia, medidas.peitoral, medidas.abdominal, medidas.supraIliaca, medidas.subEscapular, medidas.coxa FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1 OFFSET 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $tric = $linha1['tricipital'];
            $ax = $linha1['axilarMedia'];
            $peito = $linha1['peitoral'];
            $abd = $linha1['abdominal'];
            $supra = $linha1['supraIliaca'];
            $sub = $linha1['subEscapular'];
            $coxa = $linha1['coxa'];
        }
        if (isset($tric)) {
            $soma = $peito + $ax + $abd + $supra + $sub + $tric + $coxa;
            if ($sexo == 'M' || $sexo == 'm') {
                $dc = 1.112 - 0.00043499 * ($soma) + 0.00000055 * ($soma ** 2) - 0.00028826 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            } else if ($sexo == 'F' || $sexo == 'f') {
                $dc = 1.0970 - 0.00046971 * ($soma) + 0.00000056 * ($soma ** 2) - 0.00012828 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            }
            $perc = number_format($percentGord, 2);
            echo $perc;
            return $perc;
        } else {
            print '❌';
        }
    }

    public function gorduraAnt($id, $sexo, $idade)
    {
        $sql = "SELECT medidas.peso, medidas.tricipital, medidas.axilarMedia, medidas.peitoral, medidas.abdominal, medidas.supraIliaca, medidas.subEscapular, medidas.coxa FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1 OFFSET 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $peso = $linha1['peso'];
            $tric = $linha1['tricipital'];
            $ax = $linha1['axilarMedia'];
            $peito = $linha1['peitoral'];
            $abd = $linha1['abdominal'];
            $supra = $linha1['supraIliaca'];
            $sub = $linha1['subEscapular'];
            $coxa = $linha1['coxa'];
        }
        if (isset($tric)) {
            $soma = $peito + $ax + $abd + $supra + $sub + $tric + $coxa;
            if ($sexo == 'M' || $sexo == 'm') {
                $dc = 1.112 - 0.00043499 * ($soma) + 0.00000055 * ($soma ** 2) - 0.00028826 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            } else if ($sexo == 'F' || $sexo == 'f') {
                $dc = 1.0970 - 0.00046971 * ($soma) + 0.00000056 * ($soma ** 2) - 0.00012828 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            }
            $perc = number_format($percentGord, 2);
            $massaGorda = ($peso * $perc) / 100;
            $pesoG = number_format($massaGorda, 2);
            print $pesoG;
        } else {
            print '❌';
        }
    }

    public function magraAnt($id, $sexo, $idade)
    {
        $sql = "SELECT medidas.peso, medidas.tricipital, medidas.axilarMedia, medidas.peitoral, medidas.abdominal, medidas.supraIliaca, medidas.subEscapular, medidas.coxa FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1 OFFSET 1";
        $result = Conexao::getConexao()->query($sql);
        $result->execute();
        while ($linha1 = $result->fetch(PDO::FETCH_ASSOC)) {
            $peso = $linha1['peso'];
            $tric = $linha1['tricipital'];
            $ax = $linha1['axilarMedia'];
            $peito = $linha1['peitoral'];
            $abd = $linha1['abdominal'];
            $supra = $linha1['supraIliaca'];
            $sub = $linha1['subEscapular'];
            $coxa = $linha1['coxa'];
        }
        if (isset($tric)) {
            $soma = $peito + $ax + $abd + $supra + $sub + $tric + $coxa;
            if ($sexo == 'M' || $sexo == 'm') {
                $dc = 1.112 - 0.00043499 * ($soma) + 0.00000055 * ($soma ** 2) - 0.00028826 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            } else if ($sexo == 'F' || $sexo == 'f') {
                $dc = 1.0970 - 0.00046971 * ($soma) + 0.00000056 * ($soma ** 2) - 0.00012828 * ($idade);
                $percentGord = ((4.95 / $dc) - 4.5) * 100;
            }
            $perc = number_format($percentGord, 2);

            $massaGorda = ($peso * $perc) / 100;
            $massaMagra = ($peso - $massaGorda);
            $pesoM = number_format($massaMagra, 2);
            print $pesoM;
        } else {
            print '❌';
        }
    }

    public function circAnt($id)
    {
        try {
            $sql = "SELECT medidas.dataCadastro, medidas.torax, medidas.cintura, medidas.abdomen, medidas.quadril, medidas.bracoDireito, medidas.bracoEsquerdo, medidas.antebracoDireito, medidas.antebracoEsquerdo, medidas.coxaDireita, medidas.coxaEsquerda, medidas.panturrilhaDireita, medidas.panturrilhaEsquerda FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1 OFFSET 1";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaMedidas($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar circunferencias." . $e;
        }
    }

    public function circunf($id)
    {
        try {
            $sql = "SELECT medidas.dataCadastro, medidas.torax, medidas.cintura, medidas.abdomen, medidas.quadril, medidas.bracoDireito, medidas.bracoEsquerdo, medidas.antebracoDireito, medidas.antebracoEsquerdo, medidas.coxaDireita, medidas.coxaEsquerda, medidas.panturrilhaDireita, medidas.panturrilhaEsquerda FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaMedidas($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar circunferencias." . $e;
        }
    }

    public function dobrasAnt($id)
    {
        try {
            $sql = "SELECT medidas.dataCadastro, medidas.peitoral, medidas.tricipital, medidas.abdominal, medidas.axilarMedia, medidas.supraIliaca, medidas.subEscapular, medidas.coxa FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1 OFFSET 1";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaMedidas($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar circunferencias." . $e;
        }
    }

    public function dobras($id)
    {
        try {
            $sql = "SELECT medidas.dataCadastro, medidas.peitoral, medidas.tricipital, medidas.abdominal, medidas.axilarMedia, medidas.supraIliaca, medidas.subEscapular, medidas.coxa FROM medidas, alunos WHERE medidas.idAluno = alunos.idAluno AND alunos.idAluno = '$id' ORDER BY medidas.dataCadastro DESC LIMIT 1";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaMedidas($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar circunferencias." . $e;
        }
    }
}
