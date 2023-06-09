 <?php

    include('lib/conexao.php');
    include('lib/protect.php');
    protect(1);

    $sql_cursos = "SELECT * FROM cursos";
    $sql_query = $mysqli->query($sql_cursos) or die($mysqli->error);
    $num_cursos = $sql_query->num_rows;

    ?>
 <!-- Page-header start -->
 <div class="page-header card">
     <div class="row align-items-end">
         <div class="col-lg-8">
             <div class="page-header-title">
                 <div class="d-inline">
                     <h4>Gerenciar cursos</h4>
                     <span>Administre os cursos cadastrados na plataforma</span>
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
                     <li class="breadcrumb-item">Gerenciar Cursos
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
             <div class="card">
                 <div class="card-header">
                     <h5>Todos os Cursos</h5>
                     <span> <a href="index.php?p=cadastrar_cursos">Clique aqui </a>para cadastrar novos cursos.</span>
                 </div>
                 <div class="card-block table-border-style">
                     <div class="table-responsive">
                         <table class="table">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Imagem</th>
                                     <th>Título</th>
                                     <th>Preço</th>
                                     <th>Gerenciar</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php if ($num_cursos == 0) { ?>
                                     <tr>
                                         <td colspan="5" scope="row">Nenhum curso cadastrado.</td>
                                     </tr>
                                     <?php } else {

                                        while ($curso = $sql_query->fetch_assoc()) {
                                        ?>
                                         <tr>
                                             <th scope="row"><?php echo $curso['id']; ?></th>
                                             <td><img src="<?php echo $curso['imagem']; ?>" height="50" alt=""></td>
                                             <td><?php echo $curso['titulo']; ?></td>
                                             <td>R$ <?php echo number_format($curso['preco'], 2, ',', '.'); ?></td>
                                             <td> <a href="index.php?p=editar_cursos&id=<?php echo $curso['id']; ?>">Editar</a> <a href="index.php?p=deletar_cursos&id=<?php echo $curso['id']; ?>">Deletar</a> </td>
                                         </tr>
                                 <?php }
                                    } ?>
                             </tbody>
                         </table>
                     </div>
                 </div>