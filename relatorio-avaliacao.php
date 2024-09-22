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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">COMPARATIVO</h3></div>
                        <form class="card-body inline-block form-inline mb-3" action="relatorio-avaliacao.php" method="GET">
                            <label for="busca">Buscar por:</label>
                            <select class="form-control custom-select w-50 ml-2" name="busca" id="busca">
                                <option value="">Selecione o aluno</option>
                                <?php foreach ($alunodao->read() as $aluno): ?>
                                <option value="<?= $aluno->getIdAluno() ?>"><?= $aluno->getNome() ?></option>
                                <?php endforeach ?>
                            </select>
                            <button class="btn btn-primary" type="submit" name="busca"><i class="fas fa-search"></i></button>
                        </form>
                    <div class="card-body">
                        <form>
                            <!-- Div data e idade -->
                            <div class="row mb-3">
                                <div class="form-group col-md-1">
                                    <label for="inputId">ID</label>
                                    <input type="text" class="form-control" id="inputId">
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="inputNome">NOME</label>
                                    <input type="text" class="form-control" id="inputNome">
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="inputData">IDADE</label>
                                    <input type="number" class="form-control" id="inputData">
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="inputSexo">SEXO</label>
                                    <input type="text" class="form-control" id="inputData">
                                </div>
                            </div>
                            <!-- Div titulos das colunas -->
                            <div class="row d-flex justify-content-center">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-2 my-4 bg-dark text-white text-center">ANTERIOR</div>
                                <div class="col-sm-2 my-4 bg-dark text-white text-center">ATUAL</div>
                            </div>
                            <!-- Linha de data -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">Data</li>
                                </ul>
                                <div class="col-sm-2">
                                
                                    <select class="form-control" id="dataCadastro" name="dataCadastro">
                                        <option>Escolha</option>
                                        <?php foreach ($alunodao->read() as $aluno): ?>
                                        <?php foreach ($medidasdao->exibeData($aluno->getIdAluno()) as $medidas): ?>
                                        <option value="<?= $medidas->getDataCadastro() ?>"><?= $medidas->getDataCadastro() ?></option>
                                        <?php endforeach ?>
                                        <?php endforeach?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select class="form-control" id="dataCadastro" name="dataCadastro">
                                        <option>Escolha</option>
                                        <?php foreach ($medidasdao->exibeData($aluno->getIdAluno()) as $medidas): ?>
                                        <option value="<?= $medidas->getDataCadastro() ?>"><?= $medidas->getDataCadastro() ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Linha compativo peso -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">Peso (kg)</li>
                                </ul>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="Kg">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="Kg">
                                </div>
                            </div>
                            <!-- Linha compativo imc -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">IMC</li>
                                </ul>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="Kg/m2">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="Kg/m2">
                                </div>
                            </div>
                            <!-- Linha Abdomen -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">Abdomen</li>
                                </ul>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" placeholder="cm">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" placeholder="cm">
                                </div>
                            </div>
                            <!-- Linha RCQ -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">RCQ</li>
                                </ul>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" placeholder="cm">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" placeholder="cm">
                                </div>
                            </div>
                            <!-- Linha compativo % gordura -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">% Gordura</li>
                                </ul>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="%">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="%">
                                </div>
                            </div>
                            <!-- Linha compativo peso massa gorda -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">M. Gorda (kg)</li>
                                </ul>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="Kg">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="Kg">
                                </div>
                            </div>
                            <!-- Linha compativo % massa magra -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">% Massa Magra</li>
                                </ul>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="%">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="%">
                                </div>
                            </div>
                            <!-- Linha compativo peso massa magra -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">M. Magra (kg)</li>
                                </ul>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="Kg">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="Kg">
                                </div>
                            </div>
                            <!-- Linha compativo VO2 maximo -->
                            <div class="row d-flex justify-content-center">
                                <ul class="col-sm-2 list-group">
                                    <li class="list-group-item">VO² Máximo</li>
                                </ul>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="mL/kg·min">
                                </div>
                                <div class="col-sm-2">
                                    <input class="form-control p-2" type="number" step="0.01" placeholder="mL/kg·min">
                                </div>
                            </div>
                            <!-- Div dos botões de salvar -->
                            <div class="mt-4 mb-0">
                                <!-- <button type="button" class="btn btn-primary"><a class="btn btn-primary btn-block" href="#">Salvar</a></button> -->
                                <button type="button" class="btn btn-secondary"><a class="btn btn-secondary btn-block" href="relatorios.php">Voltar</a></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Include php rodapé -->
<?php
include_once('include/footer.php');
?>