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
        <h1 class="card-header mt-4">NOVA AVALIÇÃO FÍSICA</h1>
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
                                <button class="btn  btn-warning btn-sm" data-toggle="modal"
                                    data-target="#anamnese><?= $aluno->getIdAluno() ?>"> Anamnese </button>
                                <button class="btn  btn-danger btn-sm" data-toggle="modal"
                                    data-target="#medidas><?= $aluno->getIdAluno() ?>"> Medidas </button>
                                <button class="btn  btn-primary btn-sm" data-toggle="modal"
                                    data-target="#vo><?= $aluno->getIdAluno() ?>"> Teste VO2 </button>
                                <button class="btn  btn-success btn-sm" data-toggle="modal"
                                    data-target="#resultado><?= $aluno->getIdAluno() ?>"> Resultado </button>
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
                                <button class="btn  btn-warning btn-sm" data-toggle="modal"
                                    data-target="#anamnese><?= $aluno->getIdAluno() ?>"> Anamnese </button>
                                <button class="btn  btn-danger btn-sm" data-toggle="modal"
                                    data-target="#medidas><?= $aluno->getIdAluno() ?>"> Medidas </button>
                                <button class="btn  btn-primary btn-sm" data-toggle="modal"
                                    data-target="#vo><?= $aluno->getIdAluno() ?>"> Teste VO2 </button>
                                <button class="btn  btn-success btn-sm" data-toggle="modal"
                                    data-target="#resultado><?= $aluno->getIdAluno() ?>"> Resultado </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <?php } ?> 
            </table>
        </div>
        <div>
            <!-- Modal Anamnese -->
            <?php foreach ($alunodao->read() as $aluno): ?>
                <div class="modal fade" id="anamnese><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ANAMNESE</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="controller/AnamneseController.php" method="POST">
                                    <!-- Campo Nome -->
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="number" placeholder="nome"
                                                    name="idAluno" readonly value="<?= $aluno->getIdAluno() ?>" require />
                                                <label for="inputNome">ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="nome"
                                                    name="nome" readonly value="<?= $aluno->getNome() ?>" require />
                                                <label for="inputNome">Nome Completo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputIdade" type="text" placeholder="Sexo"
                                                    name="idade" readonly value="<?= $aluno->getIdade() ?>" require />
                                                <label for="inputIdade">Idade</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="date" placeholder=""
                                                    name="dataCadastro" required />
                                                <label for="inputData">Data Cadastro</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">OBJETIVOS <strong style="color: red;">*</strong> :</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="objetivo">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <!-- Campo de atividade fisica -->
                                        <div class="col-md-10">
                                            <label for="inputData">PRATICA ATIVADE FÍSICA? QUANTO TEMPO?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="atividade">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <!-- Campo de atividade fisica -->
                                        <div class="col-md-10">
                                            <label for="inputData">FUMA? QUANTOS CIGARROS/DIA?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="fumante">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <!-- Campo de atividade fisica -->
                                        <div class="col-md-10">
                                            <label for="inputData">CONSOME BEBIDA ALCOOLICA? QUAL FREQUENCIA?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="alcool">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <!-- Campo de atividade fisica -->
                                        <div class="col-md-10">
                                            <label for="inputData">HIPERTENSÃO ARTERIAL?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="hipertensao">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <!-- Campo de atividade fisica -->
                                        <div class="col-md-10">
                                            <label for="inputData">COLESTEROL ALTO?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="colesterol">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <!-- Campo de atividade fisica -->
                                        <div class="col-md-10">
                                            <label for="inputData">DIABETES?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="diabetes">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <!-- Campo de atividade fisica -->
                                        <div class="col-md-10">
                                            <label for="inputData">DOENÇA CARDÍACA?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="cardiaco">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">HISTÓRICO FAMILIAR: (colesterol, diabetes,
                                                etc)</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="historicoFam">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <!-- Campo de atividade fisica -->
                                        <div class="col-md-10">
                                            <label for="inputData">JÁ FEZ ALGUMA CIRURGIA? TEMPO?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="cirurgia">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">FRATURA OU LUXAÇÃO?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="fratura">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">LESÃO MUSCULAR OU LIGAMENTAR?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="lesao">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">SENTE ALGUMA DOR NO CORPO?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="dor">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">LIMITAÇÃO DE MOVIMENTOS?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="movimentos">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">ARTRITE OU TENDINITE? ONDE?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="artrite">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">USO DE MEDICAMENTOS? QUAIS?</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="medicamentos">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">ALGUM OUTRO SINTOMA? (falta de ar, tonturas,
                                                taquicardia, ansiedade, etc) </label>
                                            <input type="text" class="form-control" id="inputAtividade" name="outros">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="inputData">HABITOS ALIMENTARES:</label>
                                            <input type="text" class="form-control" id="inputAtividade" name="alimentacao">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <br>
                                            <button class="btn btn-primary" type="submit" name="salvar">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <!-- Modal Medidas -->
        <div>
            <?php foreach ($alunodao->read() as $aluno): ?>
                <div class="modal fade" id="medidas><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">MEDIDAS</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="controller/MedidasController.php" method="POST">
                                    <!-- Campo Nome -->
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="idAluno"
                                                    name="idAluno" readonly value="<?= $aluno->getIdAluno() ?>" require />
                                                <label for="inputNome">ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="nome"
                                                    name="nome" readonly value="<?= $aluno->getNome() ?>" require />
                                                <label for="inputNome">Nome Completo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputSexo" type="text" placeholder="sexo"
                                                    name="sexo" readonly value="<?= $aluno->getSexo() ?>" require />
                                                <label for="inputSexo">Sexo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputIdade" type="text" placeholder="Sexo"
                                                    name="idade" readonly value="<?= $aluno->getIdade() ?>" require />
                                                <label for="inputIdade">Idade</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="date" placeholder="data"
                                                    name="dataCadastro" required />
                                                <label for="inputData">Data Cadastro</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4>Dados Iniciais</h4>
                                        <div class="col-sm">
                                            <div class="form-group row">
                                                <label for="inputPeso" class="col-sm-4 col-form-label">Peso (kg)</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.01" class="form-control" id="inputPeso"
                                                        placeholder="kg" name="peso">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAltura" class="col-sm-4 col-form-label">Altura</label>
                                                <div class="col-sm-4">
                                                    <input type="number" class="form-control" id="inputAltura"
                                                        placeholder="centimetros" name="altura">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputFc" class="col-sm-4 col-form-label">F.C.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" class="form-control" id="inputFc" placeholder="bpm"
                                                        name="freqCard">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSupra" class="col-sm-4 col-form-label">Pressão
                                                    Arterial</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" id="inputPA"
                                                        placeholder="ex: 120/80" name="pressaoArterial">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Coluna Circunferencias -->
                                        <div class="col-sm">
                                            <h4>Circunferências</h4>
                                            <div class="form-group row">
                                                <label for="inputTorax" class="col-sm-4 col-form-label">Torax N.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputTorax"
                                                        placeholder="cm" name="torax">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputCintura" class="col-sm-4 col-form-label">Cintura</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputCintura"
                                                        placeholder="cm" name="cintura">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAbd" class="col-sm-4 col-form-label">Abdomen</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputAbdomen"
                                                        placeholder="cm" name="abdomen">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputQuadril" class="col-sm-4 col-form-label">Quadril</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputQuadril"
                                                        placeholder="cm" name="quadril">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputBracoD" class="col-sm-4 col-form-label">Braço
                                                    D.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputBracoD"
                                                        placeholder="cm" name="bracoDireito">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputBracoE" class="col-sm-4 col-form-label">Braço
                                                    E.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputBracoE"
                                                        placeholder="cm" name="bracoEsquerdo">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAntebD" class="col-sm-4 col-form-label">Anteb.
                                                    D.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputAntebD"
                                                        placeholder="cm" name="antebracoDireito">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAntebE" class="col-sm-4 col-form-label">Anteb.
                                                    E.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputAntebE"
                                                        placeholder="cm" name="antebracoEsquerdo">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputCoxaD" class="col-sm-4 col-form-label">Coxa D.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputCoxaD"
                                                        placeholder="cm" name="coxaDireita">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputCoxaE" class="col-sm-4 col-form-label">Coxa E.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputCoxaE"
                                                        placeholder="cm" name="coxaEsquerda">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPantD" class="col-sm-4 col-form-label">Pantur.
                                                    D.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputPantD"
                                                        placeholder="cm" name="panturrilhaDireita">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPantE" class="col-sm-4 col-form-label">Pantur.
                                                    E.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputPantE"
                                                        placeholder="cm" name="panturrilhaEsquerda">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4>Dobras Cutâneas</h4>
                                        <div class="col-sm">
                                            <div class="form-group row">
                                                <label for="inputPeitoral" class="col-sm-4 col-form-label">Peitoral</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputPeitoral"
                                                        placeholder="mm" name="peitoral">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAxM" class="col-sm-4 col-form-label">Axilar
                                                    Media</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputAxM"
                                                        placeholder="mm" name="axilarMedia">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputAbd" class="col-sm-4 col-form-label">Abdominal</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputAbdomen"
                                                        placeholder="mm" name="abdominal">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSupra" class="col-sm-4 col-form-label">Supra
                                                    Iliaca</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputSupra"
                                                        placeholder="mm" name="supraIliaca">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSub" class="col-sm-4 col-form-label">Sub Escap.</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputSub"
                                                        placeholder="mm" name="subEscapular">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputTricipital"
                                                    class="col-sm-4 col-form-label">Tricipital</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control"
                                                        id="inputTricipital" placeholder="mm" name="tricipital">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputCoxa" class="col-sm-4 col-form-label">Coxa</label>
                                                <div class="col-sm-4">
                                                    <input type="number" step="0.1" class="form-control" id="inputCoxa"
                                                        placeholder="mm" name="coxa">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <br>
                                            <button class="btn btn-primary" type="submit" name="salvar">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <!-- Modal VO2-->
    <div>
        <?php foreach ($alunodao->read() as $aluno): ?>
            <div class="modal fade" id="vo><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">TESTE VO2</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="controller/TesteVO2Controller.php" method="POST">
                                <!-- Campo Nome -->
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <div class="form-floating mb-3 mb-md-3">
                                            <input class="form-control" id="inputNome" type="text" placeholder="idAluno"
                                                name="idAluno" readonly value="<?= $aluno->getIdAluno() ?>" require />
                                            <label for="inputNome">ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-floating mb-3 mb-md-3">
                                            <input class="form-control" id="inputNome" type="text" placeholder="nome"
                                                name="nome" readonly value="<?= $aluno->getNome() ?>" require />
                                            <label for="inputNome">Nome Completo</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating mb-3 mb-md-3">
                                            <input class="form-control" id="inputIdade" type="text" placeholder="Sexo"
                                                name="idade" readonly value="<?= $aluno->getIdade() ?>" require />
                                            <label for="inputIdade">Idade</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3 mb-md-3">
                                            <input class="form-control" id="inputNome" type="date" placeholder="nome"
                                                name="dataCadastro" required />
                                            <label for="inputData">Data Cadastro</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Linha de Informação inicial -->
                                <div class="row mb-3">
                                    <h3>TESTE PROGRESSIVO DE ESTEIRA</h3>
                                    <p>Início com velocidade de aquecimento e a cada 2 minutos aumentar a velocidade
                                        em 1 km/h até o limite máximo do aluno</p>
                                    <p>Escala de esforço de 0 (muito fácil) a 10 (muito difícil)</p>
                                </div>
                                <!-- Linha dados de repouso -->
                                <div class="row mb-3">
                                    <h4>Dados Iniciais</h4>
                                    <div class="form-group col-md-3 text-left">
                                        <label for="inputVelInicio" class="col-sm-8 col-form-label text-left">Vel.
                                            Inicio</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="inputVelInicio" placeholder="km/h"
                                                name="velocidadeInicial">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5 text-left">
                                        <label for="inputFCRepouso" class="col-sm-8 col-form-label">FC
                                            Repouso</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="inputFCRepouso" placeholder="bpm"
                                                name="fcInicial">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!-- Dados do teste -->
                                <div class="row">
                                    <h4>Teste</h4>
                                    <div class="form-group col-md-3 text-left">
                                        <label for="inputTempo" class="col-sm- col-form-label">Tempo</label>
                                    </div>
                                    <div class="form-group col-md-3 text-left">
                                        <label for="inputVel" class="col-sm- col-form-label">Vel. Final</label>
                                    </div>
                                    <div class="form-group col-md-3 text-left">
                                        <label for="inputVel" class="col-sm- col-form-label">F.C</label>
                                    </div>
                                    <div class="form-group col-md-3 text-left">
                                        <label for="inputVel" class="col-sm- col-form-label">Esforço</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="inputTempo" placeholder="min"
                                            name="tempoTeste">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="inputVel" placeholder="km/h"
                                            name="velocidadeFinal">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="inputFC" placeholder="bpm"
                                            name="fcFinal">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="inputVelInicio" placeholder="0-10"
                                            name="esforcoTeste">
                                    </div>
                                </div>
                        </div>
                        <div class="row mb-3 ml-2">
                            <div class="col-md-2">
                                <br>
                                <button class="btn btn-primary" type="submit" name="salvar">Salvar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <!-- Modal Resultado -->
    <div>
        <?php foreach ($alunodao->read() as $aluno): ?>
            <div class="modal fade" id="resultado><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">RESULTADO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="controller/MedidasController.php" method="POST">
                                <div>
                                    <!-- Campo Nome -->
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="number"
                                                    placeholder="idAluno" name="idAluno" value="<?= $aluno->getIdAluno() ?>"
                                                    require readonly />
                                                <label for="inputNome">ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputNome" type="text" placeholder="nome"
                                                    name="nome" value="<?= $aluno->getNome() ?>" require readonly />
                                                <label for="inputNome">Nome Completo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputSexo" type="text" placeholder="sexo"
                                                    name="sexo" readonly value="<?= $aluno->getSexo() ?>" require />
                                                <label for="inputSexo">Sexo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3 mb-md-3">
                                                <input class="form-control" id="inputIdade" type="text" placeholder="Sexo"
                                                    name="idade" readonly value="<?= $aluno->getIdade() ?>" require />
                                                <label for="inputIdade">Idade</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php foreach ($medidasdao->exibeDados($aluno->getIdAluno()) as $medidas): ?>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-secondary text-white">DATA</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" placeholder="" nome="dataCadastro"
                                                    readonly value="<?= $medidas->getDataCadastro() ?>">
                                            </div>
                                            <div class="col-sm-2">

                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Peso(kg)</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" placeholder="" nome="peso" readonly
                                                    value="<?= $medidas->getPeso() ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <!-- <input class="form-control p-2" type="text" placeholder=""> -->
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">Abdomen</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" placeholder="" nome="abdomen"
                                                    readonly value="<?= $medidas->getAbdomen() ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <input class="form-control p-2" type="text" placeholder="" readonly
                                                    value="<?= $medidasdao->classAbd($medidas->getAbdomen(), $aluno->getSexo()) ?>">
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <ul class="col-sm-2 list-group">
                                                <li class="list-group-item bg-light text-dark">F. C.</li>
                                            </ul>
                                            <div class="col-sm-3">
                                                <input class="form-control p-2" type="text" placeholder="" nome="freqCard"
                                                    readonly value="<?= $medidas->getFreqCard() ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <input class="form-control p-2" type="text" placeholder="" readonly
                                                    value="<?= $medidasdao->classFc($medidas->getFreqCard(), $aluno->getIdade()) ?>">
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">IMC</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" placeholder="" readonly nome="imc"
                                                value="<?php $medidasdao->imc($aluno->getIdAluno()) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="form-control p-2" type="text" placeholder="" readonly
                                                value="<?php $medidasdao->classImc($aluno->getIdAluno()) ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">RCQ</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" placeholder="" nome="rcq" readonly
                                                value="<?php $medidasdao->rcq($aluno->getIdAluno()) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="form-control p-2" type="text" placeholder="" readonly
                                                value="<?php $medidasdao->classRcq($aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade()) ?>">
                                        </div>
                                    </div>

                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">%Gordura</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" placeholder="" readonly
                                                nome="percentGord"
                                                value="<?php $medidasdao->percentGord($aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade()) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="form-control p-2" type="text" placeholder="" readonly
                                                value="<?php $medidasdao->classPerc($aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade()) ?>">
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">M.Gorda</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" placeholder="" nome="massaGorda"
                                                readonly
                                                value="<?php $medidasdao->gordura($medidas->getPeso(), $aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade()) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- <input class="form-control p-2" type="text" placeholder=""> -->
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">M.Magra</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" placeholder="" nome="massaMagra"
                                                readonly
                                                value="<?php $medidasdao->magra($medidas->getPeso(), $aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade()) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- <input class="form-control p-2" type="text" placeholder=""> -->
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <ul class="col-sm-2 list-group">
                                            <li class="list-group-item bg-light text-dark">VO²max</li>
                                        </ul>
                                        <div class="col-sm-3">
                                            <input class="form-control p-2" type="text" placeholder="" nome="vo2" readonly
                                                value="<?php $testevo2dao->resultadoVO($aluno->getIdAluno()) ?>">
                                        </div>
                                        <div class="col-sm-2">
                                            <input class="form-control p-2" type="text" placeholder="" readonly
                                                value="<?php $testevo2dao->classVO($aluno->getIdAluno(), $aluno->getSexo(), $aluno->getIdade()) ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <div class="col-sm-1 mt-4 mb-0">
        <button type="button" class="btn btn-secondary"><a class="btn btn-secondary btn-block"
                href="avaliacao.php">Voltar</a></button>
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
        window.location = 'nova-avaliacao.php?search='+search.value;    
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