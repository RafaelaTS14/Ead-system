 <?php

    protect(0);

    if (!isset($_SESSION))
        session_start();

    $id_usuario = $_SESSION['usuario'];
    $cursos_query = $mysqli->query("SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM relatorio WHERE id_usuario = '$id_usuario')") or die($mysqli->error);
    ?>

 <!-- Page-header start -->
 <div class="page-header card">
     <div class="row align-items-end">
         <div class="col-lg-8">
             <div class="page-header-title">
                 <div class="d-inline">
                     <h4>Meus cursos</h4>
                     <span>Estes são os cursos que você já possui</span>
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
                     <li class="breadcrumb-item">Meus cursos
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
 <!-- Page-header end -->

 <div class="page-body">
     <div class="row">
         <?php while ($curso = $cursos_query->fetch_assoc()) { ?>
             <div class="col-sm-4">
                 <div class="card">
                     <div class="card-header">
                         <h5><?php echo $curso['titulo']; ?></h5>
                     </div>
                     <div class="card-block">
                         <img class="img-fluid mb-4" src="<?php echo $curso['imagem']; ?>" alt="">
                         <p>
                             <?php echo $curso['desc_resumida']; ?>
                         </p>
                         <form action="index.php">
                             <input type="hidden" name="p" value="acessar">
                             <input type="hidden" name="id" value="<?php echo $curso['id']; ?>">
                             <button type="submit" class="btn form-control btn-out-dashed btn-primary btn-square">Acessar</button>
                         </form>
                     </div>
                 </div>
             </div>
         <?php } ?>
     </div>
 </div>