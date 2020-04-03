<?php
    $acao = "";
    
    $erro = "";

    if (isset($_POST['entrar'])) {

        if ($pagina == "cliente") {

           $logar = TRUE;
            if (!empty($_POST['user'])) {
                $user = $_POST['user'];
                if (is_numeric($user)) {
                    //se valor no campo user for BI

                    //verificar se o Bi já foi registrado
                    try{
                        $verificar = $con->query("SELECT * FROM tbl_usuario WHERE BI = '$user'");
                        if ($verificar->num_rows == 0) {
                            $erro = "Este Bi não se encontar registado.";
                            $logar = FALSE;
                        }
                    }catch(Exception $ex){
                        $erro = "Erro ao verificar o ID do usuario. Tente mas Tarde";
                        $logar = FALSE;
                    }
                }else{
                    //se valor no campo user for E-mail
                    try{
                        $verificar = $con->query("SELECT * FROM tbl_usuario WHERE Email = '$user'");
                        if ($verificar->num_rows == 0) {
                            $erro = "Este Email não foi registado.";
                            $logar = FALSE;
                        }
                    }catch(Exception $ex){
                        $erro = "Erro ao verificar o ID do usuario. Tente mas Tarde";
                        $logar = FALSE;
                    }
                    
                }

                if (empty($_POST['password'])) {
                    $erro = "Tens de fornecer seu password.";
                    $logar = FALSE;
                }else{
                    $password = $_POST['password'];
                }

            }else{
                //erro campo user vazio
                $erro = "Tens de inserir os dados primeiro.";
                $logar = FALSE;
            }

            //Caso tudo esta certo
            if ($logar == TRUE) {
                //verificar em qual pagina foi feita o login
                        $acao = "conta/";
                        $verificar = $con->query("SELECT * FROM tbl_usuario WHERE (BI = '$user' OR Email = '$user') AND Password = '$password'");
                        if ($verificar->num_rows < 1) {
                            $erro = 'Password Errada. Desejas <a href="#">Recuperar Password</a>';
                        }else{
                            $verificar = $verificar->fetch_assoc();
                            session_start();
                            $_SESSION['user'] = $verificar["BI"];
                            //$erro = $verificar["Password"];
                            header("location: $acao");
                        }
            }

        } elseif($pagina == "empresa") {
              //Se for clikado apartir da pagina Empresa
            $logar = TRUE;

            if (!empty($_POST['user'])) {
                $user = $_POST['user'];
                    try{
                        $verificar = $con->query("SELECT * FROM tbl_empresa WHERE User = '$user'");
                        if ($verificar->num_rows == 0) {
                            $erro = "Este usuario não foi registado.";
                            $logar = FALSE;
                        }
                    }catch(Exception $ex){
                        $erro = "Erro ao verificar do usuario. Tente mas Tarde";
                        $logar = FALSE;
                    }
                    

                if (empty($_POST['password'])) {
                    $erro = "Tens de fornecer seu password.";
                    $logar = FALSE;
                }else{
                    $password = $_POST['password'];
                }

            }else{
                //erro campo user vazio
                $erro = "Tens de inserir os dados primeiro.";
                $logar = FALSE;
            }

            //Caso tudo esta certo
            if ($logar == TRUE) {
                //verificar em qual pagina foi feita o login
                        $acao = "conta/";
                        $verificar = $con->query("SELECT * FROM tbl_empresa WHERE User = '$user' AND Password = '$password'");
                        if ($verificar->num_rows < 1) {
                            $erro = 'Password Errada. Desejas <a href="#">Recuperar Password</a>';
                        }else{
                            $verificar = $verificar->fetch_assoc();
                            session_start();
                            $_SESSION['empresa'] = $verificar["NIF"];
                            //$erro = $verificar["NIF"];
                            header("location: $acao");
                        }

            }

        } elseif($pagina == "particular") {
             //Se for clikado apartir da pagina Particular ou Motorista
            $logar = TRUE;

            if (!empty($_POST['user'])) {
                $user = $_POST['user'];

                if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
                     
                      try{
                        $verificar = $con->query("SELECT * FROM tbl_motorista WHERE Email = '$user'");
                        if ($verificar->num_rows == 0) {
                            $erro = "Este Email não foi registado.";
                            $logar = FALSE;
                        }
                    }catch(Exception $ex){
                        $erro = "Erro ao verificar do usuario. Tente novamente mas Tarde";
                        $logar = FALSE;
                    }

                } else {

                     try{
                        $verificar = $con->query("SELECT * FROM tbl_motorista WHERE NomeUtilizador = '$user'");
                        if ($verificar->num_rows == 0) {
                            $erro = "Este NomeUtilizador não foi registado.";
                            $logar = FALSE;
                        }
                    }catch(Exception $ex){
                        $erro = "Erro ao verificar do usuario. Tente novamente mas Tarde";
                        $logar = FALSE;
                    }

                }                    

                if (empty($_POST['password'])) {
                    $erro = "Tens de fornecer seu password.";
                    $logar = FALSE;
                }else{
                    $password = $_POST['password'];
                }

            }else{
                //erro campo user vazio
                $erro = "Tens de inserir os dados primeiro.";
                $logar = FALSE;
            }

             //Caso tudo esta certo
            if ($logar == TRUE) {
                //verificar em qual pagina foi feita o login
                $acao = "conta/";
                $verificar = $con->query("SELECT * FROM tbl_motorista WHERE (Email = '$user' OR NomeUtilizador = '$user') AND Password = '$password'");
                if ($verificar->num_rows < 1) {
                    $erro = 'Password Errada. Desejas <a href="#">Recuperar Password</a>';
                }else{
                    $verificar = $verificar->fetch_assoc();
                    session_start();
                    $_SESSION['motorista'] = $verificar["BI"];
                    header("location: $acao");
                }

            }
        }//Fim login       
    }//Fim isset button Entrar

?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="../css/cabecalho.css">

     <script src="../js/funcoes.js"></script>
</head>
<body>
    
<?php

    if ($pagina == "home") {
       echo '
            <header>
                <h1><a href="#"><samp>Nha</samp>Taxi</a></h1>
                <nav>
                    <li><a href="/taxi/cliente/">Cliente</a></li>
                    <li><a href="/taxi/empresa">Empresa</a></li>
                    <li><a href="/taxi/particular">Particular</a></li>
                </nav>
                 <div id="inp">
                    <input id="motorista" type="submit" value="Seja Motorista">
                 </div>
            </header>
       ';
    }elseif ($pagina == "cliente") {
        $placeholder = "Email ou BI";
       echo '
            <header>
                <h1><a href="../"><samp>Nha</samp>Taxi</a></h1>
                <nav>
                    <li><a class="ativo" href="/taxi/cliente/">Cliente</a></li>
                    <li><a href="/taxi/empresa">Empresa</a></li>
                    <li><a href="/taxi/particular">Particular</a></li>
                </nav>
                <div id="inp">
                    <a id="entre" href="javascript:void(0)" onclick="visivelLogin();">Entrar</a>
                    <input id="motorista" type="submit" value="Seja Motorista">
                 </div>
            </header>
       ';
    }
    elseif ($pagina == "empresa") {
        $placeholder = "Nome Utilizador";
       echo '
            <header>
                <h1><a href="../"><samp>Nha</samp>Taxi</a></h1>
                <nav>
                    <li><a href="/taxi/cliente/">Cliente</a></li>
                    <li><a class="ativo" href="/taxi/empresa">Empresa</a></li>
                    <li><a href="/taxi/particular">Particular</a></li>
                </nav>
                <div id="inp">
                    <a id="entre" href="javascript:void(0)" onclick="visivelLogin();">Entrar</a>
                    <input id="motorista" type="submit" value="Seja Motorista">
                 </div>
            </header>
       ';
    }elseif ($pagina == "particular") {
        $placeholder = "Email ou Nome Utilizador";
        echo '
            <header>
                <h1><a href="../"><samp>Nha</samp>Taxi</a></h1>
                <nav>
                    <li><a href="/taxi/cliente/">Cliente</a></li>
                    <li><a href="/taxi/empresa">Empresa</a></li>
                    <li><a class="ativo"  href="/taxi/particular">Particular</a></li>
                </nav>
                <div id="inp">
                    <a id="entre" href="javascript:void(0)" onclick="visivelLogin();">Entrar</a>
                    <input id="motorista" type="submit" value="Seja Motorista">
                 </div>
        </header>
       ';
    }
?>

    <div id="login" class="invisivel">
        <form id="frmLogin" method="POST">
            <input type="text" placeholder="<?php echo $placeholder ?>" name="user">
            <input type="password" placeholder="Password" name="password">
            <input type="submit" value="Entrar" name="entrar">
        </form>
        <spam><?php echo $erro; ?></spam>
    </div>

    <script>
       var error = '<?php echo $erro; ?>';
       if(error != ""){
           document.getElementById('login').style.display = "block";
       }else{
            document.getElementById('login').style.display = "none";
       }
    </script>
</body>
</html>

