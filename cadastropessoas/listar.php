<?php
   require_once('../conexao.php');
   $postjson = json_decode(file_get_contents('php://input'), true); // variavel que vai receber os dados das caixas de texto

   $busca = '%' .$postjson['nome'].'%';
   $query = $pdo->query("SELECT * from usuarios where nome LIKE '$busca' or nome  order by idusuarios desc limit $postjson[start], $postjson[limit] ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 

        for($i=0; $i < $total_reg; $i++){
            foreach ($res[$i] as $key => $value){	}
            
            $dados[] = array(
                'idusuarios' => $res[$i]['idusuarios'],
                'nome' => $res[$i]['nome'], 
                'sobrenome' => $res[$i]['sobrenome'], 
                'nascimento' => $res[$i]['nascimento'],
                'cpf' => $res[$i]['cpf'],
                'email' => $res[$i]['email'],
                'nivel' => $res[$i]['nivel'],
                'senha' => $res[$i]['senha'],
            );
 
        }

        $result = json_encode(array('itens'=>$dados)); //Aula 34 -> 5:22
        echo $result;

    }else{
        $result = json_encode(array('itens' =>'0'));
        echo $result;
    }
   
?>   