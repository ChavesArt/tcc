<header style="margin-bottom: 10%;"  class="container">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <a href="index.php" class="navbar-brand">
            <img  id="logo" src="img/logo.png" width="100px" height="90px" alt="logo SASIEQ">
        </a>
        <?php if(isset($_SESSION['email'])){ 
            $nome = explode(" ",$_SESSION['nome']);?>

            <h4 class="text-white">Bem-vindo  <?= $nome[0]; ?>!</h4>

            <?php } ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-links"
            aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbar-links">
            <div class="navbar-nav">
                <?php if(isset($_SESSION['tipo_cliente'])){ 

                    if ($_SESSION['tipo_cliente'] == 0){
                    echo "<a href= 'admin_usuario.php' class='nav-item nav-link me-2' data-bs-toggle='tooltip' data-bs-placement='bottom' title='página de administrador' id='home-menu'><i class='fa-solid fa-user-tie'></i></i></a>";
                } 
                }?>
                <a href="index.php" class="nav-item nav-link me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Início" id="home-menu"><i class="fa-solid fa-house"></i></a>
                <a href="index.php#sobre-area" class="nav-item nav-link me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sobre nós" id="about-menu"><i class="fa-solid fa-address-card"></i></a>
                <a href="formcad.php" class="nav-item nav-link me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cadastrar-se" id="cad-menu"><i class="fa-solid fa-user-plus"></i></a>
                <?php if(!isset($_SESSION['email'])){ ?>
                <a href="login.php" class="nav-item nav-link me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Login" id="login-menu"><i class="fa-solid fa-right-to-bracket"></i></a>
                <?php } ?>
                <?php if(isset($_SESSION['email'])){?>
                    <a href="perfil.php" class="nav-item nav-link me-2" data-bs-toggle="tooltip" data-bs-placement="left" title="Perfil" id="login-menu"><i class="bi bi-person-circle"></i></a>
                    <a href="logout.php" class="nav-item nav-link me-2" data-bs-toggle="tooltip" data-bs-placement="left" title="Deslogar-se" id="login-menu"><i class="fa-solid fa-door-open"></i></a>
                <?php } ?>
                
            </div>
        </div>
    </nav>

</header>
