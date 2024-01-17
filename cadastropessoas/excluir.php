<?php
   require_once('../conexao.php');
   $postjson = json_decode(file_get_contents('php://input'), true); // variavel que vai receber os dados das caixas de texto

   $idusuarios = @$postjson['idusuarios']; 


   
   
    $res = $pdo->query("DELETE FROM usuarios where idusuarios = '$idusuarios'");

   
   $result = json_encode(array('mensagem'=>'Excluido com Sucesso', 'ok'=>true));
   echo $result;
?>