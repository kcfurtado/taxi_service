<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <style>
        footer{
            width: 100%;
            background: #333;
            color: white;
            height: 500px;
            padding-top: 50px;
        }

        footer div#link{
            width: 80%;
            padding: 10px 5px;
            margin: auto;
            text-align: center;
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
        }

        footer div#link a{
            color: white;
            text-decoration: none;
            font-size: 30px;
            float: left;
            margin-left: 50px;
        }
        footer div#link input#pas{margin-left: 50px; margin-right: 50px;}
        footer div#link input[type=button]{
            border: none;
            width: 180px;
            height: 40px;
            outline: none;
            cursor: pointer;
            color: white;
            font-size: 16px;
            background: #12939a;
        }

      footer  div#contato{
            margin-top: 50px;
            width: 400px;
            float: left;
            margin-left: 200px;
        }
        
       footer div#contato a{
           text-orientation: none;
           color: white;
        }

        footer div#for{
            width: 500px;
            float: left;
            margin-top: 50px;
        }

       footer form{
            margin-top: 10px;
            width: 100%;
        }
        footer form input[type=text], form input#e_mail{
            padding: 10px 3px;
            margin-bottom: 5px;
            width: 99%;
            border: none;
        }
        footer form textarea#ar{
            width: 99%;
        }
        footer form input[type=submit]{
            width: 100px;
            height: 30px;
            float: right;
            margin-bottom: 10px;
            color: white;
            border: none;
            background: #12939a;
        }
        footer div#divisao{
            clear: both;
            width: 80%;
            padding-top: 40px;
            padding-bottom: 10px;
            margin: auto;
            border-top: 1px solid #ccc;
            text-align: center;
        }
    </style>
</head>
<body>
    <footer>
        <div id="link">
            <?php
                if ($onde == "Home") {
                   echo' <a href="#"><samp>Nha</samp>Taxi</a>';
                }else{
                    echo '<a href="../"><samp>Nha</samp>Taxi</a>';
                }
            ?>
            <input id="pas" type="button" value="Seja Passageiro">
            <input id="mot" type="button" value="Seja Motorista">
        </div>
        <div id="contato">
            <p>Contatos:</p><br>
            <p><b>Morada:</b><br> <br>
                Santiago-Praia-Palmarejo<br>
                Rua 5 de julho</p><br>
            <a href="mailto:central@nhataxi.cv">central@nhataxi.cv</a>
        </div>
        <div id="for">
            <p>Se estiver interessado, gostariamos de ouvir o que tem a dizer. Escreva-nos agora mesmo!</p>
            <form action="index.php" method="POST">
                <input type="text" placeholder="Nome" required><br>
                <input id="e_mail" type="email" placeholder="Email" required><br>
                <textarea name="text" id="ar" cols="20" rows="5" placeholder="Mensagens" required></textarea><br>
                <input type="submit" value="Enviar">
            </form>
        </div>
        <div id="divisao">
            <p>&copy 2016. All rights reserved | Design by CVSoft.</p>
            </div>
    </footer>
</body>
</html>