<?php
error_reporting(E_ERROR | E_PARSE);

   require_once('../conexao.php');
   $postjson = json_decode(file_get_contents('php://input'), true); // variavel que vai receber os dados das caixas de texto

   $nome = $postjson['nome'];
   $sobrenome = $postjson['sobrenome'];
   $nascimento = $postjson['nascimento'];  
   $cpf = $postjson['cpf'];
   $email = $postjson['email'];
   $nivel = $postjson['nivel'];
   $senha = $postjson['senha'];
 
   $idusuarios = $postjson['idusuarios']; 
   $antigo = @$postjson['antigo'];
   $antigo2 = @$postjson['antigo2'];




   if($nome == ""){
      echo json_encode(array('mensagem'=>'Nome Não Informado!'));
      exit();
   }

   if($nascimento == ""){
    echo json_encode(array('mensagem'=>'Data de Nascimento Não Informada!'));
    exit();
 }

 if($cpf == ""){
    echo json_encode(array('mensagem'=>'CPF Não Informado!'));
    exit();
 }

   if($email == ""){
      echo json_encode(array('mensagem'=>'Email Não Informado!'));
      exit();
   }

   if($nivel == ""){
      echo json_encode(array('mensagem'=>'Nivel Não Informado!'));
      exit();
   }

   if($senha == ""){
      echo json_encode(array('mensagem'=>'Senha Não Informada!'));
      exit();
   }


   
   if($idusuarios == ""){
      $res = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, sobrenome = :sobrenome, nascimento = :nascimento, cpf = :cpf, email = :email, nivel = :nivel, senha = :senha");

   } else{ //prepare - trabalha com dados que venham de formulario
      $res = $pdo->prepare("UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome, nascimento = :nascimento, cpf = :cpf, email = :email, nivel = :nivel, senha = :senha WHERE idusuarios = :idusuarios");//Esta editando com base do ID que recebeu
       $res->bindValue(":idusuarios", $idusuarios);
    }
   $res->bindValue(":nome", $nome);
   $res->bindValue(":sobrenome", $sobrenome);
   $res->bindValue(":nascimento", $nascimento);
   $res->bindValue(":cpf", $cpf);
   $res->bindValue(":email", $email);
   $res->bindValue(":nivel", $nivel);
   $res->bindValue(":senha", $senha);
   $res->execute();

   
   $result = json_encode(array('mensagem'=>'Salvo com Sucesso', 'ok'=>true));

   header('Content-Type: application/json');
   
   echo $result;
   ?>