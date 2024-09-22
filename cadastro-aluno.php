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
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <!-- Div do Titulo da página -->
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">CADASTRAR NOVO ALUNO</h3></div>
                    <!-- Div do formulario principal -->
                    <div class="card-body">
                        <form action="controller/AlunoController.php" method="POST">
                            <!-- Campo data -->
                            <div class="row mb-3">
                                <div class="form-group col-md-3">
                                    <label for="inputData">Data Cadastro <strong style="color: red;">*</strong> </label>
                                    <input type="date" class="form-control" id="inputData" name="dataCadastro">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="situ">Situação <strong style="color: red;">*</strong> </label>
                                    <select class="form-control h-50" id="situ" name="situacao" type="text" required>
                                        <option value="ATIVO">ATIVO</option>
                                        <option value="INATIVO">INATIVO</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Campo Nome -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputNome" type="text" placeholder="nome" name="nome" required/>
                                        <label for="inputNome">Nome Completo <strong style="color: red;">*</strong> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-3">
                                <!-- Campo data nascimento -->
                                <div class="col-md-6">
                                    <label for="inputDataNascimento">Data de Nascimento <strong style="color: red;">*</strong> </label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputDataNascimento" type="date" placeholder="Data de Nascimento" name="dataNascimento" required/>
                                    </div>
                                </div>
                                <!-- Campo sexo -->
                                <div class="col-md-6">
                                <label for="inputSexo">Sexo<strong style="color: red;">*</strong> </label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <select class="form-control h-50" id="inputSexo" name="sexo" type="text" required>
                                            <option value=""></option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo CPF -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputCpf" type="text" placeholder="CPF" name="cpf" required/>
                                        <label for="inputCpf">CPF <strong style="color: red;">*</strong> </label>
                                    </div>
                                </div>
                                <!-- Campo RG -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" id="inpuRg" type="text" placeholder="RG" name="rg"/>
                                        <label for="inputRg">RG</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo telefone -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputTelefone" type="text" placeholder="(xx)xxxx-xxxx" name="telefone"/>
                                        <label for="inputTelefone">Telefone</label> 
                                    </div>
                                </div>
                                <!-- Campo celular -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input class="form-control" id="inputCelular" type="text" placeholder="(xx)xxxx-xxxx" name="celular" required/> 
                                        <label for="inputCelular">Celular<strong style="color: red;">*</strong></label> 
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo CEP -->
                                <div class="col-md-3">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputCep" type="text" placeholder="CEP" name="cep"/>
                                        <label for="inputCep">CEP</label>
                                    </div>
                                </div>
                                <!-- Campo estado -->
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <label for="inputEstado"></label>
                                        <select class="form-control h-50" id="inputEstado" name="estado" type="text" >
                                            <option value="">Estado</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Campo cidade -->
                                <div class="col-md-5">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputCidade" type="text" placeholder="Cidade" name="cidade"/>
                                        <label for="inputCidade">Cidade</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo endereço -->
                                <div class="col-md-8">
                                    <div class="form-floating">
                                        <input class="form-control" id="inputEndereco" type="text" placeholder="endereco" name="endereco"/>
                                        <label for="inputEndereco">Rua, Nº, Bairro</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo email -->
                                <div class="col-md-8">
                                    <div class="form-floating">
                                        <input class="form-control" id="Email" type="email" placeholder="email" name="email" required/>
                                        <label for="Email">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo senha -->
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="senha" type="password" placeholder="Senha" name="senha" required minlength="3" maxlength="8"/>
                                        <label for="senha">Senha</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Botões de salvar -->
                            <div class="mt-4 mb-0">
                                <button type="submit" name="salvar" class="btn btn-success btn-lg">Salvar</button>
                                <button type="button" class="btn btn-secondary btn-sm"><a class="btn btn-secondary btn-block" href="cadastro.php">Voltar</a></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3"></div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Include php rodapé -->
<?php
include_once('include/footer.php');
?>
