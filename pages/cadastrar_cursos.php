 <?php

    include('lib/conexao.php');
    include('lib/upload.php');
    include('lib/protect.php');
    protect(1);

    if (isset($_POST['enviar'])) {

        $titulo = $mysqli->escape_string($_POST['titulo']);
        $desc_resumida = $mysqli->escape_string($_POST['desc_resumida']);
        $preco = $mysqli->escape_string($_POST['preco']);
        $conteudo = $mysqli->escape_string($_POST['conteudo']);

        $erro = [];
        if (empty($titulo))
            $erro[] = "Preencha o <b>título</b>!";

        if (empty($desc_resumida))
            $erro[] = "Preencha a escrição <b>resumida</b>!";

        if (empty($preco))
            $erro[] = "Preencha o <b>preço</b>!";

        if (empty($conteudo))
            $erro[] = "Preencha o <b>conteúdo</b>!";

        if (!isset($_FILES) || !isset($_FILES['imagem']) || $_FILES['imagem']['size'] == 0)
            $erro[] = "Selecione uma <b>imagem para o conteúdo</b>!";

        if (count($erro) == 0) {

            $deu_certo = enviarArquivo($_FILES['imagem']['error'], $_FILES['imagem']['size'], $_FILES['imagem']['name'], $_FILES['imagem']['tmp_name']);
            if ($deu_certo !== false) {

                $sql_code = "INSERT INTO cursos (titulo, desc_resumida, conteudo, dtcad, preco, imagem) VALUES (
                '$titulo', 
                '$desc_resumida', 
                '$conteudo', 
                NOW(), 
                '$preco', 
                '$deu_certo'
                )";

                $inserido = $mysqli->query($sql_code);
                if (!$inserido)
                    $erro[] = "Falha ao inserir no banco de dados: " . $mysqli->error;
                else
                    die("<script>location.href=\"index.php?p=gerenciar_cursos\";</script>");
            } else {
                $erro[] = "Falha ao enviar imagem.";
            }
        }
    }


    ?>
 <!-- Page-header start -->
 <div class="page-header card">
     <div class="row align-items-end">
         <div class="col-lg-8">
             <div class="page-header-title">
                 <div class="d-inline">
                     <h4>Cadastrar Cursos</h4>
                     <span>Preencha as informações e clique em Salvar.</span>
                 </div>
             </div>
         </div>
         <div class="col-lg-4">
             <div class="page-header-breadcrumb">
                 <ul class="breadcrumb-title">
                     <li class="breadcrumb-item">
                         <a href="index.php">
                             <i class="icofont icofont-home"></i>
                         </a>
                     </li>
                     <li class="breadcrumb-item">
                         <a href="index.php?p=gerenciar_cursos">
                             Gerenciar Cursos
                         </a>
                     </li>
                     <li class="breadcrumb-item">Cadastrar Cursos</a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
 <!-- Page-header end -->

 <div class="page-body">
     <div class="row">
         <div class="col-sm-12">
             <?php if (isset($erro) && count($erro) > 0) { ?>
                 <div class="alert alert-danger" role="alert">
                     <?php foreach ($erro as $e) {
                            echo "$e<br>";
                        } ?>
                 </div>
             <?php } ?>
             <div class="card">
                 <div class="card-header">
                     <h5>Formulário de Cadastro</h5>
                 </div>
                 <div class="card-block">
                     <form action="" method="POST" enctype="multipart/form-data">
                         <div class="row">
                             <div class="col-lg-4">
                                 <div class="form-group">
                                     <label for="">Título</label>
                                     <input type="text" name="titulo" class="form-control">
                                 </div>
                             </div>
                             <div class="col-lg-8">
                                 <div class="form-group">
                                     <label for="">Descrição Resumida</label>
                                     <input type="text" name="desc_resumida" class="form-control">
                                 </div>
                             </div>
                             <div class="col-lg-8">
                                 <div class="form-group">
                                     <label for="">Imagem</label>
                                     <input type="file" name="imagem" class="form-control">
                                 </div>
                             </div>
                             <div class="col-lg-4">
                                 <div class="form-group">
                                     <label for="">Preço</label>
                                     <input type="text" name="preco" class="form-control">
                                 </div>
                             </div>
                             <div class="col-lg-12">
                                 <div class="form-group">
                                     <label for="">Conteúdo</label>
                                     <textarea name="conteudo" rows="10" class="form-control"></textarea>
                                 </div>
                             </div>
                             <div class="col-lg-12">
                                 <a href="index.php?p=gerenciar_cursos" class="btn btn-primary btn-round"><i class="ti-arrow-left"></i> Voltar</a>
                                 <button type="submit" name="enviar" value="1" class="btn btn-success btn-round float-right"><i class="ti-save"></i> Salvar</button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>