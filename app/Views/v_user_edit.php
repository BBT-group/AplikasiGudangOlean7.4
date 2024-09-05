<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/logo.png">

    <title>Edit Akun</title>

    <!-- Custom fonts for this template-->
    <link href="/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Edit Akun</h1>
                                    </div>
                                    <form action="/user/update/<?= $user['id_ms_user'] ?>" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" value="<?= $user['username'] ?>" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?= $user['nama'] ?>" placeholder="Nama Akun">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password (Kosongkan jika tidak ingin mengubah)">
                                        </div>
                                        <?php if ($user['role'] != 'admin'): ?>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="aktif" <?= $user['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                                        <option value="tidak aktif" <?= $user['status'] == 'tidak aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control" id="role" name="role" required>
                                                        <option value="operator" <?= $user['role'] == 'operator' ? 'selected' : '' ?>>Operator</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <input type="text" class="form-control form-control-user" id="role" name="role" value="<?= $user['role'] ?>" hidden>
                                            <input type="text" class="form-control form-control-user" id="status" name="status" value="<?= $user['status'] ?>" hidden>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Batal</button>
                                        <button class="btn btn-primary btn-user btn-block">Update</button>
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