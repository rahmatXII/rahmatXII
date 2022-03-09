<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashdata('success')) {
?>
    <div class="alert alert-succes alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success')?>
        <button type="button" class="close" data-dismiss="alert" aria-label="close">close</button>
    </div>
<?php            
}
?>
<button href="/fmenu" class="btn btn-primary" data-toggle="modal" data-target="#addMenu">tambah menu</button>    
<table class="table table-stripped table-hover">
    <thead>
        <th>No</th>
        <th>nama</th>
        <th>harga</th>
        <th>jumlah</th>
        <th>jenis</th>
        <th>keterangan</th>
        <th>option</th>
    </thead>

    <?php
    $no= 1;
    foreach ($data as $row) :
    ?>  
        <tbody>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td><?= $row['jenis'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td>
                    <button class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#editMenu-<?= $row['id'] ?>">Edit</button>
                    <a href="<?= base_url('menu/delete/' . $row['id']) ?>" onclick="return confirm ('yakin mau hapus?')" class="btn btn-danger btn-sm btn-delete">Delete</a>
                </td>
            </tr>

        </tbody>
        <div class="modal fade" id="editmenu-<?= $row['id'] ?>" tanindex="-1" aria-labelledby="example" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example">Edit menu</h5>
                        <button class="close" data-dismiss="modal" aria-label="close"></button>
                    </div>
                    <form action="<?= base_url('menu/edit/' . $row['id']) ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="inputkan nama" value="<?= $row['nama'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="harga">harga</label>
                                <input type="number" name="harga" class="form-control" id="harga" placeholder="inputkan harga" value="<?= $row['harga'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="inputkan jumlah" value="<?= $row['jumlah'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="jenis">jenis</label>
                                <select name="jenis" id="jenis" class="form-control" value="<?= $row['jenis'] ?>">
                                    <option value="makanan">makanan</option>
                                    <option value="minuman">minuman</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="inputkan keterangan" value="<?= $row['keterangan'] ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
        $no++;
    endforeach;
    ?>

</table>
<div class="modal fade" id="addMenu" tanindex="-1" aria-labelledby="example" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example">tambah menu</h5>
                <button class="close" data-dismiss="modal" aria-label="close"></button>
            </div>
            <form action="<?= base_url('menu') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">nama</label>
                        <input type="text" name="nama" class="from-control" id="nama" placeholder="inputkan nama">
                    </div>
                    <div class="form-group">
                        <label for="harga">harga</label>
                        <input type="number" name="harga" class="from-control" id="harga" placeholder="inputkan harga">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">jumlah</label>
                        <input type="number" name="jumlah" class="from-control" id="jumlah" placeholder="inputkan jumlah">
                    </div>
                    <div class="form-group">
                        <label for="jenis">jenis</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="makanan">makanan</option>
                            <option value="minuman">minuman</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">keterangan</label>
                        <input type="text" name="keterangan" class="from-control" id="keterangan" placeholder="inputkan keterangan">
                    </diV>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </form>
        </div>
    </div>
</div>

    
<?= $this->endSection() ?>