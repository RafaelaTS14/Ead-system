<?php

$msg = false;

if (isset($_POST['email'])) {

    include('lib/conexao.php');
    include('lib/generateRandomString.php');
    include('lib/enviarEmail.php');

    $email = $mysqli->escape_string($_POST['email']);
    $sql_query = $mysqli->query("SELECT id, nome FROM usuarios WHERE email = '$email'");
    $result = $sql_query->fetch_assoc();

    if ($result['id']) {

        $nova_senha = generateRandomString(6);
        $nova_senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);
        $id_usuario = $result['id'];
        $mysqli->query("UPDATE usuarios SET senha = '$nova_senha_criptografada' WHERE id = '$id_usuario'");

        enviarEmail($email, "Sua nova senha", "
        <h1>Olá" . $result['nome'] . "! </h1>
        <p>Uma nova senha foi definida para a sua conta.</p>
        <p><b> Nova senha: </b>" . $nova_senha . "</p>
        ");

        $msg = "Caso seu e-mail exista em nosso sistema, você receberá uma nova senha em alguns minutos!";
    } else {
        $msg = "Caso seu e-mail exista em nosso sistema, você receberá uma nova senha em alguns minutos!";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Esqueci minha senha</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="layout/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="layout/assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="layout/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="layout/assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="layout/assets/css/style.css">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form method="post" class="md-float-material">
                            <div class="text-center">
                                <img height="60" src="layout/assets/images/auth/logo-dark.png" alt="logo.png">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Esqueceu sua senha?</h3>
                                    </div>
                                </div>
                                <hr/>
                                <?php if ($msg !== false) {
                                     ?>
                                    <div class="alert alert-success" role="alert">
                                    <?php echo $msg; ?>
                                    </div>
                                    <?php
                                    } 
                                 ?>
                                    <p style="color: black">Digite seu e-mail para redefinição de senha:</p>
                                    <div class="input-group">
                                        <input name="email" type="email" class="form-control" placeholder="Seu e-mail">
                                        <span class="md-line"></span>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 forgot-phone text-right">
                                        <a href="login.php" class="text-right f-w-600 text-inverse"> Voltar</a>
                                    </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Redefinir</button>
                                </div>
                            </div>


                    </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- Authentication card end -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="layout/assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="layout/assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="layout/assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="layout/assets/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="layout/assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="layout/assets/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="layout/assets/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="layout/assets/js/common-pages.js"></script>
</body>

</html>