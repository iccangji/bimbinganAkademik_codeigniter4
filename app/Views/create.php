<?php

$this->extend('/layout/template');
$this->section('content');
?>
<div class="container-fluid">
    <div class="d-sm-flex justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data</h1>
    </div>
    <div class="row">
        <div class="col">
            <form action="/crud/insert" method="post">
                <label for="nim">NIM</label>
                <div class="input-group mb-3">
                    <input id="nim" name="nim" type="text" class="form-control" placeholder="Masukkan NIM..." aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <label for="nama">Nama</label>
                <div class="input-group mb-3">
                    <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan Nama..." aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <input type="hidden" value="<?= $id_pa ?>" name="id_pa">
                <button class="w-100 btn btn-primary" type="submit">Tambah</button>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>