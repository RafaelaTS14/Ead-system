 <?php

    include('lib/conexao.php');
    include('lib/protect.php');
    protect(1);

    $sql_usuarios = "SELECT * FROM usuarios";
    $sql_query = $mysqli->query($sql_usuarios) or die($mysqli->error);
    $num_usuarios = $sql_query->num_rows;

    ?>
 <!-- Page-header start -->
 <div class="page-header card">
     <div class="row align-items-end">
         <div class="col-lg-8">
             <div class="page-header-title">
                 <div class="d-inline">
                     <h4>Gerenciar usuários</h4>
                     <span>Administre os usuários cadastrados na plataforma</span>
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
                     <li class="breadcrumb-item">Gerenciar Usuários
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
                     <h5>Todos os usuários</h5>
                     <span> <a href="index.php?p=cadastrar_usuarios">Clique aqui </a>para cadastrar novos usuários.</span>
                 </div>
                 <div class="card-block table-border-style">
                     <div class="table-responsive">
                         <table class="table">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Nome</th>
                                     <th>E-mail</th>
                                     <th>Créditos</th>
                                     <th>Data de Cadastro</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php if ($num_usuarios == 0) { ?>
                                     <tr>
                                         <td colspan="5" scope="row">Nenhum usuário cadastrado.</td>
                                     </tr>
                                     <?php } else {

                                        while ($usuarios = $sql_query->fetch_assoc()) {
                                        ?>
                                         <tr>
                                             <th scope="row"><?php echo $usuarios['id']; ?></th>
                                             <td><?php echo $usuarios['nome']; ?></td>
                                             <td><?php echo $usuarios['email']; ?></td>
                                             <td>R$ <?php echo number_format($usuarios['creditos'], 2, ',', '.'); ?></td>
                                             <td> <a href="index.php?p=editar_usuarios&id=<?php echo $usuarios['id']; ?>">Editar</a> <a href="index.php?p=deletar_usuarios&id=<?php echo $usuarios['id']; ?>">Deletar</a> </td>
                                         </tr>
                                 <?php }
                                    } ?>
                             </tbody>
                         </table>
                     </div>
                 </div>