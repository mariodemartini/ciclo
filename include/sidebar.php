<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">MENU</div>
                    <a class="nav-link" href="home.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                        HOME
                    </a>
                    <a class="nav-link" href="cadastro.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div>
                        CADASTRO
                    </a>
                    <a class="nav-link" href="avaliacao.php">
                        <div class="sb-nav-link-icon"><i class="fa fa-heartbeat"></i></div>
                        AVALIAÇÃO FÍSICA
                    </a>
                </div> 
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Olá,</div>
                <?php print $_SESSION['user'] ?>              
            </div>
        </nav>
    </div>
<div id="layoutSidenav_content">