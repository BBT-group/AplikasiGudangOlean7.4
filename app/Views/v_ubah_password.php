<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/logo.png">

    <title>Reset Password</title>

    <!-- Custom fonts for this template-->
    <link href="/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                        <!-- Nested Row within Card Body -->
                            <div class="col-lg-12">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div style="color: red;">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div style="color: green;">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                    </div>
                                    <form action="/user/updatePassword" method="post">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="old_password" name="old_password" placeholder="Password Lama">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" id="new_password" name="new_password" placeholder="Password Baru">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" id="confirm_new_password" name="confirm_new_password" placeholder="Konfirmasi Password">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">Submit</button>
                                        <a class="btn btn-danger btn-user btn-block" href="<?php echo base_url('beranda')?>">Batal</a>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/jquery/jquery.js"></script>
    <script src="/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/jquery-easing/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.js"></script>

</body>

</html>