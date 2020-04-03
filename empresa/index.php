<?php
     include "../classe/conecao.php";
     
     //variaveis para capturar os erros
    $Erro = "* Preenchemento obrigatórios";   
    $NifErro = "";
    $NomeErro = "";
    $PropietarioErro = "";
    $IlhaErro = "";
    $CidadeErro = "";
    $ZonaErro = "";
    $UserErro = "";
    $PasswordErro = "";

    //variavel para verificar se todo esta pronto para o registro
    $registo = TRUE;
    if (isset($_POST['registar'])) {
        //Ver se todos (um a um) os campos estão preenchidos certos 
        if (empty($_POST['nif'])) {
            $NifErro = "Qual o NIF da Empresa";
            $registo = FALSE;
        }elseif(strlen($_POST['nif']) != 9){
            $NifErro = "Informe um NIF válido.";
            $registo = FALSE;
        }else{
            $nif = $_POST['nif'];
            $verificar = $con->query("SELECT * FROM tbl_empresa WHERE NIF = '$nif'");
            if ($verificar->num_rows > 0) {
                $NifErro = "Esta NIF já esta sendo usada.";
                $registo = FALSE;
            }
        }

        if (empty($_POST['nome'])) {
            $NomeErro = "Qual o nome da empresa?";
            $registo = FALSE;
        }else{
            $nome = $_POST['nome'];
        }

        if (empty($_POST['propietario'])) {
            $PropietarioErro = "Tens de informar o propietario.";
            $registo = FALSE;
        }elseif(strstr($_POST['propietario'], ' ') == FALSE){
            $PropietarioErro = "O nome tem de ser pelo menos primeiro e ultimo nome.";
            $registo = FALSE;
        }else{
            $propietario = $_POST['propietario'];
        }

        if (empty($_POST['ilha']) || $_POST['ilha'] == "Ilha") {
            $IlhaErro = "Tens de selecionar uma Ilha.";
            $registo = FALSE;
        }else{
            $ilha = $_POST['ilha'];
        }

        if (empty($_POST['cidade'])) {
            $CidadeErro = "Tens de Informar a cidade.";
            $registo = FALSE;
        }else{
            $cidade = $_POST['cidade'];
        }

        if (empty($_POST['zona'])) {
            $ZonaErro = "Tens de informar a localização da empresa.";
            $registo = FALSE;
        }else{
            $zona = $_POST['zona'];
        }

        if (empty($_POST['user'])) {
            $UserErro = "Tens de informar um nome de utilizador.";
            $registo = FALSE;
        }else{
            $user = $_POST['user'];
            $verificar = $con->query("SELECT * FROM tbl_empresa WHERE User = '$user'");
            if ($verificar->num_rows > 0) {
                $UserErro = "Este nome utilizador já esta cento usada.";
                $registo = FALSE;
            }
        }

        if (empty($_POST['senha'])) {
            $PasswordErro = "Tens de Informar uma Senha";
            $registo = FALSE;
        }else{
            $password = $_POST['senha'];
        }

        #caso tudo pronto para registro
        if ($registo == TRUE) {
            $data = date("Y-m-d");
            $Inserir = $con->query("INSERT INTO tbl_empresa(NIF, Nome, Propietario, DataRegisto, Ilha, Cidade, Zona, User, Password) 
                                    VALUES ('$nif', '$nome', '$propietario', '$data', '$ilha', '$cidade', '$zona', '$user', '$password')");
            if ($Inserir) {
                session_start();
                $_SESSION['enpresa'] = $nif;
                header("location: conta/");
            }else{
                $Erro = "Erro ao inserir os dados. Tente mas tarde.";
            }
        }else{
            $Erro = "Dados Indormados incorretos.";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>NhaTaxi - Empresa</title>
    <link rel="stylesheet" href="../css/empresa.css">
</head>
<body>
    <div id="corpo">
        <?php
            $pagina = "empresa";
            include "../include/cabecalho.php";
        ?>
        <section id="home">
            <h1>Trabalhe como você merece</h1>
            <h5>Torne a sua empresa moderna com serviso NhaTaxi</h5>
            
            <img src="../img/im.jpg" alt="Home">

            <form id="registo_empresa" method="POST">
                <h2>Registe-se Agora</h2>
                <p>De aos seus clientes está satisfação</p>
                
                 <span class="error"><?php if ($Erro != "") {            
                    echo $Erro; }?></span>

                    <br>

                <input name="nif" type="number" placeholder="Nif">
                <span class="error">* <br>
                        <?php if ($NifErro != "") {
                        echo $NifErro;
                        }  ?>
                    </span><br>

                <input name="nome" type="text" placeholder="Nome">
                <span class="error">* <br>
                        <?php if ($NomeErro != "") {
                        echo $NomeErro;
                        }  ?>
                    </span><br>

                <input name="propietario" type="text" placeholder="Proprietário">
                <span class="error">* <br>
                        <?php if ($PropietarioErro != "") {
                        echo $PropietarioErro;
                        }  ?>
                    </span><br>

                <select name="ilha" form="formulario">
                    <option>Ilha</option>
                    <option value="Brava">Brava</option>
                    <option value="Fogo">Fogo</option>
                    <option value="Santiago">Santiago</option>
                    <option value="Maio">Maio</option>
                    <option value="BoaVista">Boa Vista</option>
                    <option value="Sal">Sal</option>
                    <option value="SaoNicolau">São Nicolau</option>
                    <option value="SaoVicente">São Vicente</option>
                    <option value="SantoAntao">Santo Antão</option>
                </select>
                <span class="error">* <br>
                        <?php if ($IlhaErro != "") {
                        echo $IlhaErro;
                        }  ?>
                    </span><br>

                <input name="cidade" type="text" placeholder="Cidade">
                <span class="error">* <br>
                        <?php if ($CidadeErro != "") {
                        echo $CidadeErro;
                        }  ?>
                    </span><br>

                <input name="zona" type="text" placeholder="Zona">
                <span class="error">* <br>
                        <?php if ($ZonaErro != "") {
                        echo $ZonaErro;
                        }  ?>
                    </span><br>
                    <!--Para fazer dados de login-->
                <fieldset title="Dados Login">
                    <legend>Dados Login</legend>
                    <input name="user" type="text" placeholder="Nome Utilizador">
                    <span class="error">* <br>
                            <?php if ($UserErro != "") {
                            echo $UserErro;
                            }  ?>
                        </span><br>

                    <input name="senha" type="password" placeholder="Senha">
                    <span class="error">* <br>
                            <?php if ($PasswordErro != "") {
                            echo $PasswordErro;
                            }  ?>
                        </span><br>
                </fieldset>
                <input name="registar" type="submit" value="Registar">
            </form>
        </section>

         <?php
            $onde = "";
            include "../include/rodape.php";
        ?>
    </div
</body>
</html>
