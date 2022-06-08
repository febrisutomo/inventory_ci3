<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('components/head.php') ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('components/sidebar.php') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('components/navbar.php') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-gray-800 mb-0"><i class="fas fa-upload"></i> Data Barang Keluar</h3>
                        <a href="<?= base_url('outcoming') ?>" class="btn btn-secondary"> <i class="fas fa-arrow-left mr-2"></i> Kembali</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Tambah Data Barang Keluar</h6>
                        </div>
                        <form action="<?= base_url('outcoming/create') ?>" method="POST" novalidate>
                            <div class="card-body">

                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label" for="date">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="date" id="date" class="form-control <?= form_error('date') ? 'is-invalid' : ''; ?>" value="<?= set_value('date'); ?>" required readonly>
                                        <?= form_error('date', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="customer">Customer</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2 <?= form_error('customer_id') ? 'is-invalid' : ''; ?>" name="customer_id" id="customer" required>
                                            <option value="">--Pilih Customer--</option>
                                            <?php foreach ($customers as $customer) : ?>
                                                <option value="<?= $customer->id ?>" <?= set_value('customer_id') == $customer->id ? 'selected' : '' ?>><?= kode($customer->id, 'SUP') ?> | <?= $customer->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('customer_id', '<small class="text-danger">', '</small>') ?>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="item">Barang</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2 <?= form_error('item_id') ? 'is-invalid' : ''; ?>" name="item_id" id="item" required>
                                            <option value="">--Pilih Barang--</option>
                                            <?php foreach ($items as $item) : ?>
                                                <option value="<?= $item->id ?>" data-stock="<?= $item->stock ?>" data-unit="<?= $item->unit ?>" <?= set_value('item_id') == $item->id ? 'selected' : '' ?>><?= kode($item->id, 'BRG') ?> | <?= $item->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('item_id', '<small class="text-danger">', '</small>') ?>
                                    </div>

                                </div>


                                <div class=" form-group row">
                                    <label class="col-sm-2 col-form-label" for="qty">Kuantitas</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="number" name="qty" id="qty" class="form-control <?= form_error('qty') ? 'is-invalid' : ''; ?>" value="<?= set_value('qty'); ?>" required>
                                            <div class="input-group-append">
                                                <span id="unit" class="input-group-text">Unit</span>
                                            </div>
                                        </div>
                                        <small class="d-block mt-1">Stok tersedia: <span id="stock">0</span></small>
                                        <?= form_error('qty', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view('components/footer.php') ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <?php $this->load->view('components/logout_modal.php') ?>

    <?php $this->load->view('components/scripts') ?>

    <script>
        document.getElementById('date').valueAsDate = new Date();

        $('#item').on('change', (e) => {
            const stock = $("#item option:selected").data('stock')
            const unit = $("#item option:selected").data('unit')
            $('#stock').text(stock);
            $('#unit').text(unit);
        })

        $(document).ready(function() {
            if ($('#item').val() !== '') {
                $('#item').trigger('change');
            }
        })

        const inputQty = document.getElementById('qty');
        inputQty.addEventListener('change', (e) => {
            const value = parseInt(e.target.value)
            const stock = parseInt(document.getElementById('stock').innerText);

            if (!isNaN(value)) {

                if (value == 0) {
                    e.target.value = 1
                }
                if (value > stock) {
                    e.target.value = stock
                }
            } else {
                e.target.value = 1
            }
        })
    </script>
</body>

</html>