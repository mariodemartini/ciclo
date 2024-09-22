<?php
// include_once('include/restrito.php');
include_once('include/header.php');
include_once('include/navbar.php');
include_once('include/sidebar.php');
?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">CADASTRO</h3></div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <a class="btn btn-success btn-block" href="cadastro-aluno.php"><button type="button" class="btn btn-success btn-lg btn-block">NOVO ALUNO</button></a>
                        </div>
                        <div class="row mb-3">
                            <a class="btn btn-info btn-block" href="buscar-aluno.php"><button type="button" class="btn btn-info btn-lg btn-block">PESQUISAR ALUNO</button></a>
                        </div> 
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
