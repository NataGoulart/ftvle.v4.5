<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="salvar_imagem.css"> <!-- CONECTA CSS -->
    <title>Notícias</title>
</head>
<body>
<div class="cabecalho">
        <div class="logo" onclick="Aparecer();"> 
            <div class="menu"></div>
            <div class="menu"></div>
            <div class="menu"></div>
        </div>
        <div class="logoprinc"><img src="img/ntc.png" width="280px"></div>
        <a href="index.html"><div class="logofut"><img src="img/logo1.png" width="60px"></div></a>
    </div>
    
</body>
</html>
<?php
        // ATENÇÃO: o tipo da coluna na tabela deve ser MEDIUMBLOB
        include("conecta.php");

        $produto = $_POST["produto"];
        $codigo = $_POST["codigo"];

        // Lê o conteúdo do arquivo de imagem e armazena na variável $imagem
		$imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
		
		$comando = $pdo->prepare("INSERT INTO codigos(produto,codigo,foto) VALUES(:produto,:codigo,:foto)");
        $comando->bindParam(":produto", $produto);
        $comando->bindParam(":codigo", $codigo);
        $comando->bindParam(":foto", $imagem, PDO::PARAM_LOB);
		$resultado = $comando->execute();



        
        // As linhas abaixo você usará sempre que quiser mostrar a imagem

        $comando = $pdo->prepare("SELECT * FROM codigos");
		$resultado = $comando->execute();
        while( $linhas = $comando->fetch() )
        {
            $dados_imagem = $linhas["foto"];
            $i = base64_encode($dados_imagem);

            $produto =  $linhas["produto"];
            $codigo =  $linhas["codigo"];

            echo("<div class=\"title\"> $produto <br> </div>");
            echo(" <div class=\"red\"> $codigo  <br> </div>");
            echo(" <img src=\"data:image/jpeg;base64,$i\" class=\"ntc1\"> <br> <br> ");
        }
		
?>