<?php
    include "../classe/conecao.php";
    
    //variaveis para armazenar mensagens de erros
    $Erro = "* Preenchemento obrigatórios";   
    $BiErro = "";
    $NomeErro = "";
    $ApelidoErro = "";
    $EmailErro = "";
    $PasswordErro = "";  
    $DataNascimentoErro = "";
    $SexoErro = "";
    
    
    //botão btnRegista existe
    if (isset($_POST['btnRegista'])) {

        //para indicar se pode ou não inserir dados no bd
        $Pronto = TRUE;

        //Verificar se os dados foram fornecidos e estaão corretas

        //verifica se campo esta vazio
        if (empty($_POST["bi"])) {
            //Mensagens de erro que será mostrado
           $BiErro = "Tens de Informar seu numéro de BI.";
           //não pode inserir dados no bd
           $Pronto = FALSE;
        }else {
            //verificar se o numero de bi fornecido já não estever registado
            //Pegar o campo com nome bi
            $Bi = $_POST["bi"];
            //consultar na base de dados
            $verificar = $con->query("SELECT * FROM tbl_usuario WHERE BI = '$Bi'");
            //verificar se a consulta retornar alguma linha con dados
            if($verificar->num_rows > 0){
                $BiErro = 'Este numéro de BI já está sendo utilizado. <a href="#">Fazer Login</a>';
                 $Pronto = FALSE;
            }else{
                $Bi = $_POST["bi"];
            }
           
        }

        if (empty($_POST["nome"])) {
           $NomeErro = "Tens de Informar seu Nome.";
            $Pronto = FALSE;
        }else {
            $Nome = $_POST["nome"];
        }

        if (empty($_POST["apelido"])) {
           $ApelidoErro = "Tens de Informar seu Apelido.";
            $Pronto = FALSE;
        }else {
            $Apelido = $_POST["apelido"];
        }

        if (empty($_POST["email"])) {
           $EmailErro = "Tens de Informar seu Email.";
            $Pronto = FALSE;
        }else {
            $Email = $_POST["email"];
            $verificar = $con->query("SELECT * FROM tbl_usuario WHERE Email = '$Email'");
            if($verificar->num_rows > 0){
                $EmailErro = 'Este Email já esta sendo usado. <a href="#">Fazer Login</a>';
                $Pronto = FALSE;
            }else{
                $Email = $_POST["email"];
            }
        }

        if (empty($_POST["senha"])) {
           $PasswordErro = "Tens de inserir um password.";
            $Pronto = FALSE;
        }else {
            $Password = md5($_POST["senha"]);
        }

        if (empty($_POST["datanascimento"])) {
           $DataNascimentoErro = "Tens de Informar a data do seu Nascimento.";
            $Pronto = FALSE;
        }else {
            $DataNascimanto = $_POST["datanascimento"];
        }

         if (empty($_POST["sexo"])) {
           $SexoErro = "Tens de escolher seu sexo.";
           $Pronto = FALSE;
        }else {
            if ($_POST["sexo"] == "Masculino") {
                $Sexo = "Masculino";
            }else{
                $Sexo = "Feminino";
            }
        }


        //Verificar se todos os dados estão dia cordos
        if ($Pronto == TRUE) {
            $data = date("Y-m-d");
            $Inserir = $con->query("INSERT INTO tbl_usuario(BI, Nome, Apelido, DataNascimento, Sexo, DataRegisto, Password, Email) VALUES ('$Bi', '$Nome', '$Apelido', '$DataNascimanto', '$Sexo', '$data', '$Password', '$Email')");

            if($Inserir){
                //caso sucesso
                session_start();
                $_SESSION['user'] = $Bi;
                header("location: conta/");

            }else{
               $Erro = 'Não foi possível inserir os dados.';
                //echo '<script> alert("Não foi possível inserir os dados Error."); </script>';
            }
        }else{
            $Erro = 'Não foi possível guardas os dados.';
                
        }
    }

?>


<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>NhaTaxi - Cliente</title>
    <link rel="stylesheet" href="../css/cliente.css">
</head>
<body>
    <div id="corpo">
        <?php
            $pagina = "cliente";
            include "../include/cabecalho.php";
        ?>

            <section id="home">
                <h1>Comece a usar o NhaTaxi</h1>
                <h5>Viaje como você merece</h5>
                <img src="../img/im.jpg" alt="Home">
                
                <form id="registo_user" method="POST">
                    <h2>Registe-se Agora</h2>
                     <p>E torne-se um passageiro</p>
                    <span class="error"><?php if ($Erro != "") {            
                    echo $Erro; }?></span>

                    <br>

                    <input type="number" placeholder="BI" name="bi">
                    <span class="error">* <br><?php if ($BiErro != "") {
                    echo $BiErro;
                    }  ?></span><br>

                    <input type="text" placeholder="Nome" name="nome">
                    <span class="error">* <br><?php if ($NomeErro != "") {
                    echo $NomeErro;
                    }  ?></span><br>

                    <input type="text" placeholder="Apelido" name="apelido">
                    <span class="error">* <br><?php if ($ApelidoErro != "") {
                    echo $ApelidoErro;
                    }  ?></span><br>

                    <input type="email" placeholder="E-mail" name="email">
                    <span class="error">* <br>
                        <?php if ($EmailErro != "") {
                        echo $EmailErro;
                        }  ?>
                    </span><br>

                    <input type="password" placeholder="Senha" name="senha">
                    <span class="error">* <br>
                        <?php if ($PasswordErro != "") {
                        echo $PasswordErro;
                        }  ?>
                    </span><br>

                    <label for="DataNascimento">Data Nascimento</label>
                    <input type="date" name="datanascimento" >
                    <span class="error">* <br><?php if ($DataNascimentoErro != "") {
                    echo $DataNascimentoErro;
                    }  ?></span><br>

                    <label for="">Sexo</label>
                    <input type="radio" value="Masculino" name="sexo" id="mas"><label id="lsexo" for="mas">Masculino</label>
                    <input type="radio" value="Feminino" name="sexo" id="fem"><label id="lsexo" for="fem">Feminino</label>
                    <span class="error">* <br><?php if ($SexoErro != "") {
                    echo $SexoErro;
                    } ?></span><br>

                    <input type="submit" name="btnRegista" value="Registar-se">

                </form>
        </section>
        
        <section id="info">
            <div id="cont">
                <h2>A melhor maneira de chegar a seu destino</h2>
                <div id="col1">
                    <img src="../img/tab.png" alt="">    
                    <summary>Sempre desponivel</summary>    
                    <p>Sempre disponível acesse a qualquer hora e em qualquer lugar</p>     
                </div>
                <div id="col2">
                    <img src="../img/tab.png" alt="">
                    <summary>Viaja com segurança</summary>    
                    <p>A sua segurança esta em primeiro plano, antes, durante e depois de cada viagem.</p>  
                </div>
                <div id="col3">
                    <img src="../img/tab.png" alt="">  
                    <summary>Acabou as esperas</summary>    
                    <p>Agora podes chamar um taxi que ele estará a hora na sua porta</p>              
                </div>
                <div id="col3">
                    <img src="../img/tab.png" alt="">  
                    <summary>Avalie suas viageis</summary>    
                    <p>Avalie a sua viagem de forma anónimo ou assinado. O seu feedback ajuda-nos a tornar suas viagens ainda melhor</p>              
                </div>
            </div>
        </section>

        <section id="estimativa">
            <form id="est" method="POST">
                <h2>Estimativa de preço de Viagens</h6>
                <div id="part">
                    <input id="par" type="text" placeholder="Partida" name="partida" required>
                    <img id="local" src="../img/local.png" alt="Pegar minha localização">
                </div><br>
                <input id="des" type="text" placeholder="Destino" name="destino" required><br>
                <input type="submit" value="Calcular" name="calcular">
            </form>

            <div id="mapa">
               
            </div>
        </section>

         <?php
            $onde = "";
            include "../include/rodape.php";
        ?>
    </div
</body>
</html>