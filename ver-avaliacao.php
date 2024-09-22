<?php
// include_once('include/restrito.php');
include_once('include/header.php');
include_once('include/navbar.php');
include_once('include/sidebar.php');
include_once('./conexao/Conexao.php');
include_once('./model/Aluno.php');
include_once('./dao/AlunoDAO.php');
include_once('./model/Anamnese.php');
include_once('./dao/AnamneseDAO.php');
include_once('./model/Medidas.php');
include_once('./dao/MedidasDAO.php');
include_once('./model/TesteVO2.php');
include_once('./dao/TesteVO2DAO.php');

$aluno = new Aluno();
$alunodao = new AlunoDAO();
$anamnese = new Anamnese();
$anamnesedao = new AnamneseDAO();
$medidas = new Medidas();
$medidasdao = new MedidasDAO();
$testevo2 = new TesteVO2();
$testevo2dao = new TesteVO2DAO();
?>
<main>
    <div class="container-fluid px-4 text-center">
        <h1 class="card-header mt-4">RELATÓRIOS AVALIÇÃO FÍSICA</h1>
        <div class="card-header">
            <div class="input-group justify-content-center">
                <input class="form-control w-50 col-8" type="text" placeholder="Pesquisar" id="pesquisar"/>
                <button onclick="searchData()" class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <br>
        <div class="card mb-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <?php if(!empty($_GET['search'])){ $data = $_GET['search'];?>
                    <tbody>
                    <?php foreach ($alunodao->filtroAtivo($data) as $aluno): ?>
                        <tr>
                            <td><?= $aluno->getIdAluno() ?></td>
                            <td><?= $aluno->getNome() ?></td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#anamnese><?= $aluno->getIdAluno() ?>"> RESULTADOS </button>
                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#medidas><?= $aluno->getIdAluno() ?>"> MEDIDAS </button>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#dobras><?= $aluno->getIdAluno() ?>">DOBRAS</button>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#vo><?= $aluno->getIdAluno() ?>">VO²max</button>
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#anam><?= $aluno->getIdAluno() ?>">ANAMNESE</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <?php } else { ?>
                <tbody>
                    <?php foreach ($alunodao->alunosAtivos() as $aluno): ?>
                        <tr>
                            <td><?= $aluno->getIdAluno() ?></td>
                            <td><?= $aluno->getNome() ?></td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#anamnese><?= $aluno->getIdAluno() ?>"> RESULTADOS </button>
                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#medidas><?= $aluno->getIdAluno() ?>"> MEDIDAS </button>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#dobras><?= $aluno->getIdAluno() ?>">DOBRAS</button>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#vo><?= $aluno->getIdAluno() ?>">VO²max</button>
                                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#anam><?= $aluno->getIdAluno() ?>">ANAMNESE</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <?php } ?>
            </table>
        </div>
        <div>
            <!-- Modal Comparativo Resultado -->
            <?php foreach ($alunodao->read() as $aluno): ?>
                <div class="modal fade" id="anamnese><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Resultados</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <!-- Campo Nome -->
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="nome" name="idAluno" value="<?= $aluno->getIdAluno() ?>" require readonly/>
                                                <label for="inputNome">ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="nome" name="nome" value="<?= $aluno->getNome() ?>" require readonly/>
                                                <label for="inputNome">Nome Completo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputIdade" type="text" placeholder="Sexo" name="idade" value="<?= $aluno->getIdade() ?>" require readonly />
                                                <label for="inputIdade">Idade</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Div titulos das colunas -->
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-3 my-4 bg-dark text-white text-center">ANTERIOR</div>
                                        <div class="col-sm-3 my-4 bg-dark text-white text-center">ATUAL</div>
                                    </div>
                                    <!-- Linha de data -->
                                    <?php foreach ($medidasdao->exibeDados($aluno->getIdAluno()) as $medidas): ?>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-secondary text-white">Data</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" placeholder="" nome="dataCadastro" readonly value="<?= $medidasdao->exibeDataAnt($aluno->getIdAluno()) ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" placeholder="" nome="dataCadastro" readonly value="<?= $medidas->getDataCadastro() ?>">
                                        </div>
                                    </div>
                                    <?php foreach ($medidasdao->exibeAnt($aluno->getIdAluno()) as $medidasAnt): ?>
                                    <!-- Linha compativo peso -->
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Peso(kg)</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getPeso() ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $medidas->getPeso() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">F.C</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" nome="freqCard" readonly value="<?= $medidasAnt->getFreqCard() ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" nome="freqCard" readonly value="<?= $medidas->getFreqCard() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">P.A</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getPressaoArterial() ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $medidas->getPressaoArterial() ?>">
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                    <?php endforeach ?>
                                    <!-- Linha compativo imc -->
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">IMC</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" ttype="text" readonly nome="imc" value="<?php $medidasdao->imcAnt($aluno->getIdAluno())?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly nome="imc" value="<?php $medidasdao->imc($aluno->getIdAluno())?>">
                                        </div>
                                    </div>
                                    <!-- Linha RCQ -->
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">RCQ</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?php $medidasdao->rcqAnt($aluno->getIdAluno())?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?php $medidasdao->rcq($aluno->getIdAluno())?>">
                                        </div>
                                    </div>
                                    <!-- Linha compativo % gordura -->
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">%Gordura</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly nome="percentGord" value="<?php $medidasdao->percentGordAnt($aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade())?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly nome="percentGord" value="<?php $medidasdao->percentGord($aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade())?>">
                                        </div>
                                    </div>
                                    <!-- Linha compativo peso massa gorda -->
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">M.Gorda(kg)</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" nome="massaGorda" readonly value="<?php $medidasdao->gorduraAnt($aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade()) ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" nome="massaGorda" readonly value="<?php $medidasdao->gordura($medidas->getPeso(), $aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade())?>">
                                        </div>
                                    </div>
                                    <!-- Linha compativo peso massa magra -->
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">M.Magra(kg)</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" nome="massaMagra" readonly value="<?php $medidasdao->magraAnt($aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade()) ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" nome="massaMagra" readonly value="<?php $medidasdao->magra($medidas->getPeso(), $aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade())?>">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div>
            <!-- Modal Comparativo Medidas -->
            <div>
                <?php foreach ($alunodao->read() as $aluno): ?>
                    <div class="modal fade" id="medidas><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Circunferências</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <?php foreach($medidasdao->circAnt($aluno->getIdAluno()) as $medidasAnt) : ?>
                                    <form action="" method="POST">
                                        <!-- Campo Nome -->
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <div class="form-floating mb-3 mb-md-3">
                                                    <input class="form-control" id="inputNome" type="text" placeholder="nome" name="idAluno" value="<?= $aluno->getIdAluno() ?>" require readonly/>
                                                    <label for="inputNome">ID</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-floating mb-3 mb-md-3">
                                                    <input class="form-control" id="inputNome" type="text" placeholder="nome" name="nome" value="<?= $aluno->getNome() ?>" require readonly/>
                                                    <label for="inputNome">Nome Completo</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-floating mb-3 mb-md-3">
                                                    <input class="form-control" id="inputIdade" type="text" placeholder="Sexo" name="idade" value="<?= $aluno->getIdade() ?>" require readonly />
                                                    <label for="inputIdade">Idade</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Div titulos das colunas -->
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-3 my-4 bg-dark text-white text-center">ANTERIOR</div>
                                            <div class="col-sm-3 my-4 bg-dark text-white text-center">ATUAL</div>
                                        </div>
                                        <!-- Linha de data -->
                                        <div class="row d-flex justify-content-center">
                                        <?php foreach($medidasdao->circunf($aluno->getIdAluno()) as $medidas) : ?>
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-secondary text-white">Data</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getDataCadastro() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getDataCadastro() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Torax</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getTorax() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" ttype="text" readonly value="<?= $medidas->getTorax() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Abdomen</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getAbdomen() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getAbdomen() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Cintura</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getCintura() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" ttype="text" readonly value="<?= $medidas->getCintura() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Quadril</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getQuadril() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getQuadril() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Braço D</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getBracoDireito() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getBracoDireito() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Braço E</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" ttype="text" readonly value="<?= $medidasAnt->getBracoEsquerdo() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getBracoEsquerdo() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Anteb. D</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getAntebracoDireito() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getAntebracoDireito() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Anteb. E</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getAntebracoEsquerdo() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getAntebracoEsquerdo() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Coxa D</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getCoxaDireita() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getCoxaDireita() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Coxa E</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getCoxaEsquerda() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getCoxaEsquerda() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Pant. D</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getPanturrilhaDireita() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getPanturrilhaDireita() ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Pant. E</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getPanturrilhaEsquerda() ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getPanturrilhaEsquerda() ?>">
                                            </div>
                                        </div>
                                        <?php endforeach ?>
                                    </form>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div>
            <!-- Modal Comparativo Dobras -->
            <div>
                <?php foreach ($alunodao->read() as $aluno): ?>
                    <div class="modal fade" id="dobras><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Dobras Cutâneas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php foreach($medidasdao->dobrasAnt($aluno->getIdAluno()) as $medidasAnt) :?>
                                    <form action="" method="POST">
                                        <!-- Campo Nome -->
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <div class="form-floating mb-3 mb-md-3">
                                                    <input class="form-control" id="inputNome" type="text" placeholder="nome" name="idAluno" value="<?= $aluno->getIdAluno() ?>" require readonly/>
                                                    <label for="inputNome">ID</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-floating mb-3 mb-md-3">
                                                    <input class="form-control" id="inputNome" type="text" placeholder="nome" name="nome" value="<?= $aluno->getNome() ?>" require readonly/>
                                                    <label for="inputNome">Nome Completo</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-floating mb-3 mb-md-3">
                                                    <input class="form-control" id="inputIdade" type="text" placeholder="Sexo" name="idade" value="<?= $aluno->getIdade() ?>" require readonly />
                                                    <label for="inputIdade">Idade</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Div titulos das colunas -->
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-3 my-4 bg-dark text-white text-center">ANTERIOR</div>
                                            <div class="col-sm-3 my-4 bg-dark text-white text-center">ATUAL</div>
                                        </div>
                                        <?php foreach($medidasdao->dobras($aluno->getIdAluno()) as $medidas) :?>
                                        <!-- Linha de data -->
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-secondary text-white">Data</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getDataCadastro()?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getDataCadastro()?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Peitoral</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getPeitoral()?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getPeitoral()?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Ax. Media</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getAxilarMedia()?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getAxilarMedia()?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Abdominal</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getAbdominal()?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getAbdominal()?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">SupraIliaca</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getSupraIliaca()?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getSupraIliaca()?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">SubEscap.</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getSubEscapular()?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getSubEscapular()?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Tricipital</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getTricipital()?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getTricipital()?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Coxa</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidasAnt->getCoxa()?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" readonly value="<?= $medidas->getCoxa()?>">
                                            </div>
                                        </div>
                                        <?php endforeach ?>
                                    </form>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <!-- Modal Comparativo VO2 -->
        <div>
            <?php foreach ($alunodao->read() as $aluno): ?>
                <div class="modal fade" id="vo><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">VO² MAX</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php foreach($testevo2dao->testeAnt($aluno->getIdAluno()) as $testeA) :?>
                                <form action="" method="POST">
                                    <!-- Campo Nome -->
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="nome" name="idAluno" value="<?= $aluno->getIdAluno() ?>" require readonly/>
                                                <label for="inputNome">ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="nome" name="nome" value="<?= $aluno->getNome() ?>" require readonly/>
                                                <label for="inputNome">Nome Completo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputIdade" type="text" placeholder="Sexo" name="idade" value="<?= $aluno->getIdade() ?>" require readonly />
                                                <label for="inputIdade">Idade</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Div titulos das colunas -->
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-3 my-4 bg-dark text-white text-center">ANTERIOR</div>
                                        <div class="col-sm-3 my-4 bg-dark text-white text-center">ATUAL</div>
                                    </div>
                                    <?php foreach($testevo2dao->ultimoTeste($aluno->getIdAluno()) as $teste) :?>
                                    <!-- Linha de data -->
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-secondary text-white">Data</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $testeA->getDataCadastro()?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $teste->getDataCadastro()?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Vel.Inicial</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $testeA->getVelocidadeInicial()?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $teste->getVelocidadeInicial()?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Vel.Final</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $testeA->getVelocidadeFinal()?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $teste->getVelocidadeFinal()?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Esforço</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $testeA->getEsforcoTeste()?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $teste->getEsforcoTeste()?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Resultado</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $testevo2dao->resultadoAnt($aluno->getIdAluno()) ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" readonly value="<?= $testevo2dao->resultadoVO($aluno->getIdAluno()) ?>">
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </form>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <!-- Modal Relatorio Anamnese -->
        <div>
            <?php foreach ($alunodao->read() as $aluno): ?>
                <div class="modal fade" id="anam><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Anamnese</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <?php foreach($anamnesedao->read($aluno->getIdAluno()) as $anamnese) : ?>
                                <form action="" method="POST">
                                    <!-- Campo Nome -->
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="nome" name="idAluno" value="<?= $aluno->getIdAluno() ?>" require readonly/>
                                                <label for="inputNome">ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="nome" name="nome" value="<?= $aluno->getNome() ?>" require readonly/>
                                                <label for="inputNome">Nome Completo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputIdade" type="text" placeholder="Sexo" name="idade" value="<?= $aluno->getIdade() ?>" require readonly />
                                                <label for="inputIdade">Idade</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Linha de data -->
                                    <div class="row d-flex justify-content-center">
                                    <?php foreach($anamnesedao->read($aluno->getIdAluno()) as $anamnese) : ?>
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-secondary text-white">Data</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getDataCadastro() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Atividade</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getAtividade() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Objetivo</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getObjetivo() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Fumante</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getFumante() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Alcool</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getAlcool() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex  justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Hist. Fam.</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getHistoricoFam() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Hipertensão</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" ttype="text" readonly value="<?= $anamnese->getHipertensao() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Colesterol</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getColesterol() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Diabetes</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getDiabetes() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Cardíaco</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getCardiaco() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Cirurgia</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getCirurgia() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Fratura</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getFratura() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Lesao</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getLesao() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Dor</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getDor() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Mov.Limit.</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getMovimentos() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Artrite</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getArtrite() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Remédios</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getMedicamentos() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Alimentação</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getAlimentacao() ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">Outros</li>
                                        </ul>
                                        <div class="col-sm-6">
                                            <input class="form-control p-2" type="text" readonly value="<?= $anamnese->getOutros() ?>">
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </form>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    <div class="col-sm-1 mt-4 mb-0">
        <button type="button" class="btn btn-secondary"><a class="btn btn-secondary btn-block" href="avaliacao.php">Voltar</a></button>
    </div>
</main>
<script>
    var search = document.getElementById('pesquisar');
    search.addEventListener("keydown", function(event){
        if(event.key==="Enter"){
            searchData();
        }
    })
    function searchData()
    {
        window.location = 'ver-avaliacao.php?search='+search.value;    
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<!-- Include php rodapé -->
<?php
include_once('include/footer.php');
?>