<?php
    function criptografar($texto){
        $letra = array('a','b','c','d','e','f', 'g','h','i','j','k','l', 'm','n','o','p','q','r', 's','t','u','v','x','y','w','z');
        $mais =  array('1','5','(',')','?','0', '2', '6', '{', '+', '#', '9', '=', '-', '7', '4', '&', '!', '^', '0', '@', '+', '}', '[', ']', '|');

        $encryp = str_replace($letra, $mais, $texto);
        return (string)$encryp;
    }

       function descriptografar($texto){
        $letra = array('a','b','c','d','e','f', 'g','h','i','j','k','l', 'm','n','o','p','q','r', 's','t','u','v','x','y','w','z');
        $code =  array('1','5','(',')','?','0', '2', '6', '{', '+', '#', '9', '=', '-', '7', '4', '&', '!', '^', '0', '@', '+', '}', '[', ']', '|');

        $encryp = str_replace($code, $letra, $texto);
        return (string)$encryp;
    }

?>