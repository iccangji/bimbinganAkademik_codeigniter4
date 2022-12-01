<?php

$this->extend('/layout/template');
$this->section('content');
?>
<div class="container-fluid">
    <div class="d-sm-flex justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data</h1>
    </div>
    <div class="row">
        <div class="col">
            <form action="<?php if (empty($nim)) {
                                echo ('/crud/edit');
                            } else {
                                echo ('/crud/edit_mhs');
                            } ?>" method="post">
                <?php if (empty($nim)) { ?>
                    <label for="nip">NIP</label>
                <?php } else { ?>
                    <label for="nim">NIM</label>
                <?php }
                if (empty($nim)) { ?>
                    <div class="input-group mb-3">
                        <input id="nip" name="nip" type="text" class="form-control" placeholder="Masukkan NIP..." aria-label="Username" aria-describedby="basic-addon1" value="<?= $nip ?>">
                    </div>
                    <label for="nama">Nama</label>
                    <div class="input-group mb-3">
                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan Nama..." aria-label="Username" aria-describedby="basic-addon1" value="<?= $nama ?>">
                    </div>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="nip2" value="<?= $nip ?>"><?php } else { ?>
                    <div class="input-group mb-3">
                        <input id="nim" name="nim" type="text" class="form-control" placeholder="Masukkan NIM..." aria-label="Username" aria-describedby="basic-addon1" value="<?= $data['nim'] ?>">
                    </div>
                    <label for="nama">Nama</label>
                    <div class="input-group mb-3">
                        <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan Nama..." aria-label="Username" aria-describedby="basic-addon1" value="<?= $data['nama'] ?>">
                    </div>
                    <label for="nama">Dosen Pembimbing</label>
                    <select class="w-100 form-control d-inline w-50 bg-border-primary" name="dosen" id="dosen">
                        <?php for ($i = 0; $i < $len_dosen; $i++) { ?>
                            <option value="<?= $dosen[$i]['nip'] ?>" <?php if ($dosen[$i]['nip'] == $data['id_pa']) {
                                                                                    echo ("selected= \"selected\"");
                                                                                } ?>><?= $dosen[$i]['nama'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="nim2" value="<?= $data['nim'] ?>">
                <?php } ?>
                <button class="w-100 mt-2 btn btn-primary" type="submit">Edit</button>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>