<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>NhaTaxi</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cabecalho.css">
</head>
<body>
    <script src="js/map.js"></script>
    <div id="corpo">
        <?php
            $pagina = "home";
            include "include/cabecalho.php";
        ?>

        <section id="s1">
            <img src="img/mob.png" alt="Mobile">
            <div id="info">
                <h1>Um táxi à sua porta.</h1><br>
                <p>Prático, rápido e simples.</p>
            </div>
        </section>

        <section id="onde">
            <h2>Onde Estamos</h2>
            <div id="map"></div>
        </section>

        <section id="vantagem">
            <div id="cab">
                <h3>Prático e rápido! Conheça aqui algumas das vantagens de usar NhaTaxi</h3>
            </div>
            <p>Com alguns cliques táxi a porta.</p>
            <img src="img/cp.png" alt="PC">
            <div id="vant">
                <b>Pático</b>
                <p>Com o mínimo de esforço chama um táxi com seu despositivo preferido Smartphone ou Tablet, PC ou TV, etc...</p>
                <br>
                <b>Seguro</b>
                <p>Todos os táxis são registados podendo ser acompanhados seus trajetos.</p>
                 <br>
                <b>Rápido</b>
                <p>Além da maior rapidez através do aplicativo, os clientes tem sempre forma de entrar em contactar via 268 41 25.</p>
                 <br>
                <b>Agendamento</b>
                <p>Possibilidade de trabalhar com agendamentos de forma mais segura e eficaz.</p>
            </div>
        </section>
        <section id="breve">
            <div id="text">
                <h3>Em Breve</h3>
                    <br><br>
                <p>Nós não paramos de trabalhar! Em breve os seus passageiros poderão solicitar um táxi através de despositivo móvel</p>
                    <br>
                <p>Hoje o Passageiro já tem diversas opções disponiveis para solicitar um serviço: Aplicações para web om resolução adaptável para smartphone, tablet, pc, tvs entre outros. A nova Aplicação para Android que 
                funciona praticamente em qualquer dispositivo com este sistema.</p>
            </div>
            <img src="img/embreve.png" alt="">
        </section>

        <?php
            $onde = "Home";
            include "include/rodape.php";
        ?>
    </div>
    <!--Para caregar a api com as configurações do mapa-->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDEn3JLCny7H6BI0viIgiJ-_ct2SbQuVo&v=3&callback=initMap">
    </script>
</body>
</html>