<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>Meus Taxís</title>
    <link rel="stylesheet" href="../../css/conta.css">
    <link rel="stylesheet" href="../../css/particular_sub.css">
    <script src="../../js/funcoes.js"></script>
</head>
<body>
    <div id="corpo">
        <header>
            <h1><a href="../../"><samp>Nha</samp>Taxi</a></h1>
            <nav>
                <li><a href="index.php">Viagens</a></li>
                <li><a class="ativo" href="meuTaxi.php">Meus Taxís</a></li>
                <li><a href="pessoais.php">Dados Pessoais</a></li>
                <li><a href="#">Avaliacões</a></li>
            </nav>
             <form id="inp" method="POST">
                <input name="btnsair" type="submit" value="Sair">
            </form>
        </header>
        
        <section id="meutaxi">
            
            <table id="tbltaxi">
                
                <?php
                session_start();
                $bi= $_SESSION['motorista'];
                $con= new mysqli("localhost", "root", "", "bd_taxi");
                    $Selecionar = $con->query("SELECT * FROM tbl_motorista WHERE BI = $bi ");

                    if ($Selecionar->num_rows > 0) {
                         while ($linha = $Selecionar->fetch_assoc()) {
                        echo '
                            <tr>
                                <td>'.$linha["NomeUtilizador"].'</td>
                            </tr>
                             <tr>
                                <td>'.$linha["Password"].'</td>
                            </tr>
                            <tr>
                                <td>'.$linha["BI"].'</td>
                            </tr>
                            </tr>
                                <td>'.$linha["Nome"].'</td>
                            </tr>
                            <tr>
                                <td>'.$linha["Apelido"].'</td>
                            </tr>
                             <tr>
                                <td>'.$linha["DataNascimento"].'</td>
                            </tr>
                             <tr>
                                <td>'.$linha["NumeroCarta"].'</td>
                            </tr>
                             <tr>
                                <td>'.$linha["Email"].'</td>
                            </tr>
                            <tr>
                                <td>'.$linha["DataRegisto"].'</td>
                            </tr>
                            <tr>
                                <td><a class="manipular" href="alterarPessoais.php?
                                veiculo='.$linha["BI"].'">Alterar</a> <a class="manipular" href="eliminarPessoais.php?veiculo='.$linha["BI"].'">Eliminar</a></td>
                            </tr>
                        ';
                    }
                    } else {
                        echo '
                            <tr>
                                <td>Não possivel carregar seus dados<br>Tentar novamente!</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        ';
                    }
                    
                   
                ?>
            </table>
        </section>

            
         <?php
            $onde = "";
            include "../../include/rodape.php";
        ?>
    </div>

</body>
</html>