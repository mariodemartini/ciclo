<?php
// include_once('include/restrito.php');
include_once('include/header.php');
include_once('include/navbar.php');
include_once('include/sidebar.php');
include_once('./conexao/Conexao.php');
include_once('./model/Aluno.php');
include_once('./dao/AlunoDAO.php');

$aluno = new Aluno();
$alunodao = new AlunoDAO();
?>
<body>
    <main>
        <div class="container-fluid px-4 text-center">
            <!-- Titulo principal e barra de pesquisa -->
            <h1 class="card-header mt-4">ALUNOS CADASTRADOS</h1>
            <div class="card-header">
                <div class="input-group justify-content-center">
                    <input class="form-control w-50 col-8" type="text" placeholder="Pesquisar" id="pesquisar"/>
                    <button onclick="searchData()" class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <br>
            <div class="card mb-4">
                <!-- Inicio tabela -->
                <table class="table table-bordered">
                    <!-- Cabeçalho tabela -->
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Celular</th>
                            <th>Situação</th>
                            <th>Data Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <?php if(!empty($_GET['search'])){ $data = $_GET['search'];?>
                    <tbody>
                        <?php foreach ($alunodao->filtro($data) as $aluno): ?>
                            <tr>
                                <td><?= $aluno->getIdAluno() ?></td>
                                <td><?= $aluno->getNome() ?></td>
                                <td><?= $aluno->getCpf() ?></td>
                                <td><?= $aluno->getCelular() ?></td>
                                <td><?= $aluno->getSituacao() ?></td>
                                <td><?= $aluno->getDataCadastro() ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $aluno->getIdAluno() ?>">Editar</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <?php } else { ?>
                        <tbody>
                        <?php foreach ($alunodao->read() as $aluno): ?>
                            <tr>
                                <td><?= $aluno->getIdAluno() ?></td>
                                <td><?= $aluno->getNome() ?></td>
                                <td><?= $aluno->getCpf() ?></td>
                                <td><?= $aluno->getCelular() ?></td>
                                <td><?= $aluno->getSituacao() ?></td>
                                <td><?= $aluno->getDataCadastro() ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editar><?= $aluno->getIdAluno() ?>">Editar</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <?php } ?>
                </table>  
            </div>
            <!-- Modal -->
            <div>
                <?php foreach ($alunodao->read() as $aluno): ?>
                    <div class="modal fade" id="editar><?= $aluno->getIdAluno() ?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="controller/AlunoController.php" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-1">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputId" type="text" placeholder="id"
                                                        name="idAluno" value="<?= $aluno->getIdAluno() ?>" require
                                                        readonly />
                                                    <label for="inputId">Id</label>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputNome" type="text"
                                                        placeholder="nome" name="nome" value="<?= $aluno->getNome() ?>"
                                                        require />
                                                    <label for="inputNome">Nome Completo</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <select class="form-control h-50" id="situ" name="situacao" type="text">
                                                        <option value="<?= $aluno->getSituacao() ?>"></option>
                                                        <option value="ATIVO">ATIVO</option>
                                                        <option value="INATIVO">INATIVO</option>
                                                    </select>
                                                    <label for="inputSitu">Situação</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputDataNascimento" type="date"
                                                        placeholder="Data de Nascimento" name="dataNascimento"
                                                        value="<?= $aluno->getDataNascimento() ?>" require />
                                                    <label for="inputDataNascimento">Data de Nascimento</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputIdade" type="number"
                                                        placeholder="Idade" name="idade" value="<?= $aluno->getIdade() ?>"
                                                        require />
                                                    <label for="inputIdade">Idade</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputSexo" type="text"
                                                        placeholder="Sexo" name="sexo" value="<?= $aluno->getSexo() ?>"
                                                        require />
                                                    <label for="inputSexo">Sexo</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputCpf" type="text" placeholder="CPF"
                                                        name="cpf" value="<?= $aluno->getCpf() ?>" require />
                                                    <label for="inputCpf">CPF</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputRg" type="text" placeholder="RG"
                                                        name="rg" value="<?= $aluno->getRg() ?>" require />
                                                    <label for="inputRg">RG</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputCelular" type="text"
                                                        placeholder="(xx)xxxx-xxxx" name="telefone"
                                                        value="<?= $aluno->getTelefone() ?>" require />
                                                    <label for="inputTelefone">Telefone</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputCelular" type="text"
                                                        placeholder="(xx)xxxx-xxxx" name="celular"
                                                        value="<?= $aluno->getCelular() ?>" require />
                                                    <label for="inputCelular">Celular</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" type="email"
                                                        placeholder="nome@exemplo.com" name="email"
                                                        value="<?= $aluno->getEmail() ?>" require />
                                                    <label for="inputEmail">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputCep" type="text" placeholder="CEP"
                                                        name="cep" value="<?= $aluno->getCep() ?>" require />
                                                    <label for="inputCep">CEP</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputEstado" type="text"
                                                        placeholder="Estado" name="estado"
                                                        value="<?= $aluno->getEstado() ?>" require />
                                                    <label for="inputEstado">Estado</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputCidade" type="text"
                                                        placeholder="Cidade" name="cidade"
                                                        value="<?= $aluno->getCidade() ?>" require />
                                                    <label for="inputCidade">Cidade</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-9">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputEndereco" type="text"
                                                        placeholder="endereco" name="endereco"
                                                        value="<?= $aluno->getEndereco() ?>" require />
                                                    <label for="inputEndereco">Rua, Nº, Bairro</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPassword" type="password"
                                                        placeholder="Senha" name="senha" value=""
                                                        required/>
                                                    <label for="inputPassword">Senha</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="hidden" name="id" value="<?= $aluno->getIdAluno() ?>" />
                                                <button class="btn btn-primary" type="submit"
                                                    name="editar">Cadastrar</button>
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
                        href="cadastro.php">Voltar</a></button>
            </div>
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
        window.location = 'buscar-aluno.php?search='+search.value;    
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
</body>
<!-- Inclue php rodapé -->
<?php
include_once('include/footer.php');
?>