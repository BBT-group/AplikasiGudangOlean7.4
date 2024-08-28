                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold text-primary">Data Stok Barang</h6>
                        </div>
                        <div class="card-body pt-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Barang</th>
                                            <th>Nama</th>

                                            <th>Stok</th>

                                            <th>Kategori</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                        if (!empty($barang)) : ?>
                                            <?php foreach ($barang as $item) : ?>
                                                <tr>

                                                    <td class="p-1 pl-3"><?= $item['id_barang'] ?></td>
                                                    <td class="p-1 pl-3"><?= $item['nama'] ?></td>
                                                    <td class="p-1 pl-3"><?= $item['stok'] ?></td>
                                                    <td class="p-1 pl-3"><?= $item['nama_kategori'] ?></td>
                                                    <td class="p-1 pl-3">
                                                        <form action=<?= base_url('/barang_masuk/savedata') ?> method="post">
                                                            <input type="text" name="id_barang" id="id_barang" value="<?= $item['id_barang'] ?>" hidden>
                                                            <input type="text" name="nama" id="nama" value="<?= $item['nama'] ?>" hidden>
                                                            <input type="text" name="stok" id="stok" value="<?= $item['stok'] ?>" hidden>
                                                            <input type="text" name="jenis" id="jenis" value="barang" hidden>
                                                            <input type="text" name="satuan" id="satuan" value="<?= $item['nama_satuan'] ?>" hidden>
                                                            <input type="text" name="harga_beli" id="harga_beli" value="<?= $item['harga_beli'] ?>" hidden>
                                                            <button type="submit" class="btn btn-primary btn-sm" style="display: flexbox; text-align: center;">Submit</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php
                                        if (!empty($inventaris)) : ?>
                                            <?php foreach ($inventaris as $item) : ?>
                                                <tr>

                                                    <td class="p-1 pl-3"><?= $item['id_inventaris'] ?></td>
                                                    <td class="p-1 pl-3"><?= $item['nama_inventaris'] ?></td>


                                                    <td class="p-1 pl-3"><?= $item['stok'] ?></td>

                                                    <td class="p-1 pl-3">alat</td>

                                                    <td class="p-1 pl-3">
                                                        <form action=<?= base_url('/barang_masuk/savedata') ?> method="post">
                                                            <input type="text" name="id_barang" id="id_barang" value="<?= $item['id_inventaris'] ?>" hidden>
                                                            <input type="text" name="nama" id="nama" value="<?= $item['nama_inventaris'] ?>" hidden>
                                                            <input type="text" name="stok" id="stok" value="<?= $item['stok'] ?>" hidden>
                                                            <input type="text" name="jenis" id="jenis" value="alat" hidden>
                                                            <input type="text" name="satuan" id="satuan" value="alat" hidden>
                                                            <input type="text" name="harga_beli" id="harga_beli" value="<?= $item['harga_beli'] ?>" hidden>
                                                            <button type="submit" class="btn btn-primary btn-sm" style="display: flexbox; text-align: center;">Submit</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Team IT PT. Olean</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Bootstrap core JavaScript-->
                <script src="/jquery/jquery.js"></script>
                <script src="/bootstrap/js/bootstrap.bundle.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="/jquery-easing/jquery.easing.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="/js/sb-admin-2.js"></script>

                <!-- Page level plugins -->
                <script src="/datatables/jquery.dataTables.js"></script>
                <script src="/datatables/dataTables.bootstrap4.js"></script>

                <!-- Page level custom scripts -->
                <script src="/js/demo/datatables-demo.js"></script>

                </body>

                </html>