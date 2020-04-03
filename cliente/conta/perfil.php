<?php
    include "../../classe/conecao.php";
    session_start();

    if (!$_SESSION['user']) {
        header("Location: ../");
    }

    if (isset($_POST['btnsair'])) {
       session_unset();
       session_destroy();
       header("Location: ../");
    }

    $bi= $_SESSION['user'];
    $query=" SELECT * FROM tbl_usuario where BI ='$bi'";
    $Selecionar = $con->query($query);
    $get = $Selecionar->fetch_assoc();  
    if($get['Sexo']==1){
        $sexo= "Masculino";
    }else{
        $sexo= "Feminino";
    }


    if(isseT($_POST['guardar'])){
        $bi = $con->real_escape_string(trim($_POST['bi']));
        $nome = $con->real_escape_string(trim($_POST['nome']));
        $apelido = $con->real_escape_string(trim($_POST['apelido']));
        $dat = $con->real_escape_string(trim($_POST['DataNascimento']));
        $gender = ($_POST["sexo"] == "Masculino") ? 1 : 0;
        $emai = $con->real_escape_string(trim($_POST['email']));
        $password = $con->real_escape_string(trim($_POST['password']));
        $password1 = $con->real_escape_string(trim($_POST['password1']));

        if($password == $password1){
              $query = "UPDATE tbl_usuario 
                  SET BI ='$bi', Nome='$nome', Apelido='$apelido', DataNascimento='$dat', Sexo='$gender', Email='$emai', Password='$password'
                  WHERE  BI='$bi'
                   ";
                if($con->query($query) === TRUE){
                    header("Location: perfil.php");
                }else{
                     echo '<script>
                alert("Ocorreu um erro!");
            </script>';
                }
        }else{
            echo '<script>
                alert("As senhas não conferem!");
            </script>';
        }
      
        
    }                  
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>NhaTaxi - Perfil</title>
    <link rel="stylesheet" href="../../css/conta.css">
    <link rel="stylesheet" href="../../css/cliente.css">
    <script type="text/javascript" src="../../js/funcoes.js"></script>
</head>
<body>
    <div id="corpo">
        <header>
            <h1><a href="../../"><samp>Nha</samp>Taxi</a></h1>
            <nav>
                <li><a href="#">Viagens</a></li>
                <li><a  href="#">Pedir Taxi</a></li>
                <li><a class="ativo" href="perfil.php">Dados Pessoais</a></li>
                <li><a href="avaliacao.php">Avaliacões</a></li>
            </nav>
             <form id="inp" method="POST">
                <input name="btnsair" type="submit" value="Sair">
            </form>
        </header>
        
        <section id="perfil" >
            <div id="dados-perfil" >
                <form  method="POST">
                    <label>BI</label><br>
                    <input id="inp" type="text" name="bi" value="<?php echo $get["BI"] ?>">
                        <br>
                    <label>Nome</label><br>
                    <input id="inp" type="text" name="nome" value="<?php echo $get["Nome"] ?>">
                        <br>
                    <label>Apelido</label><br>
                    <input id="inp" type="text" name="apelido" value="<?php echo $get["Apelido"] ?>">
                        <br>
                    <label>Data Nascimento</label><br>
                    <input id="inp" type="text" name="DataNascimento" value="<?php echo $get["DataNascimento"] ?>">
                        <br>
                    <label>Sexo</label><br>
                    <select name="sexo" id="">
                        <option value="<?php
                                echo $sexo;
                            ?>">
                            <?php
                                echo $sexo;
                            ?>
                        </option>
                        <option value="<?php
                                if($sexo == 'Masculino'){
                                    echo 'Feminino';
                                }else{
                                    echo 'Masculino';
                                }
                            ?>">
                              <?php
                                if($sexo == "Masculino"){
                                    echo "Feminino";
                                }else{
                                    echo "Masculino";
                                }
                            ?>
                        </option>
                    </select>
                   <br>
                    <label>Email</label><br>
                    <input id="inp" type="text" name="email" value="<?php echo $get["Email"] ?>">
                        <br>
                    <label>Senha</label><br>
                    <input type ="password" name="password" value="<?php echo $get["Password"] ?>">
                        <br>

                    <label>Confirme Senha</label><br>
                    <input type ="password" name="password1">
                        <br>
                    <input id="alt" onclick="javascript:edit()"; type="button" name="alterar" value="Alterar">
                    <input id="save" type="submit" name="guardar" value="Guardar">
                                        
               </form>                            

            </div>
        </section>

         <?php
            $onde = "";
            include "../../include/rodape.php";
        ?>
    </div>
</body>
</html>