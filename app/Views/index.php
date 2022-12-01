<?php

$this->extend('layout/template');
$this->section('content');

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert text-white bg-success"><?= session()->getFlashdata('msg') ?></div>
    <?php endif; ?>
    <div class="d-sm-flex justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dasbor Bimbingan</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <?php if (session()->get('level') == 'admin') : ?>
                <form method="post" action="/home/dosen">
                    <label for="dosen">Pilih Dosen Pembimbing</label>
                    <p>
                        <select class="form-control d-inline w-50 bg-border-primary" name="dosen" id="dosen">
                            <?php for ($i = 0; $i < sizeof($dosen); $i++) { ?>
                                <option value="<?= $dosen[$i]['nip'] ?>" <?php if (isset($nip)) {
                                                                                if ($dosen[$i]['nip'] == $nip) {
                                                                                    echo ("selected= \"selected\"");
                                                                                } ?> <?php } ?>><?= $dosen[$i]['nama'] ?></option><?php } ?>
                        </select>
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </p>
                </form>
            <?php endif; ?>
            <?php if (session()->get('level') != 'admin' or isset($nip)) : ?>
                <h5>Dosen Pembimbing Akademik</h3>
                    <div class="card border-left-success mb-3 p-4">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="font-weight-bold"><?= $nama_dosen ?></h5>
                                <small><?= $nip_dosen ?></small>
                            </div>
                            <?php if (session()->get('level') == 'mhs') : ?>
                                <div class="col-4 d-flex justify-content-end">
                                    <button class="py-0 px-3 align-items-center btn btn-success btn-icon-split">
                                        <a href="<?= base_url() ?>/chat/<?= $nip_dosen ?>">
                                            <iconify-icon icon="bi:chat-fill" style="color: white;" width="20"></iconify-icon>
                                        </a>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->get('level') == 'admin') : ?>
                                <div class="col-4 d-flex justify-content-end">
                                    <button class="mx-2 d-flex justify-content-end px-2 align-items-center btn btn-warning btn-icon-split">
                                        <a href="<?= base_urL() . '/dosen/' . $nip_dosen ?>/edit/">
                                            <iconify-icon icon="ant-design:edit-filled" style="color: white;" width="20"></iconify-icon>
                                        </a>
                                    </button>
                                    <button class="d-flex justify-content-end px-2 align-items-center btn btn-danger btn-icon-split">
                                        <a href="<?= base_urL() . '/dosen/' . $nip_dosen ?>/del/">
                                            <iconify-icon icon="fluent:delete-16-filled" style="color: white;" width="20"></iconify-icon>
                                        </a>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <h5>Mahasiswa Bimbingan</h3>
                        <div class="w-100 my-3 bg-light">
                            <!-- 
                    Topbar Search -->
                            <form method="post" action="<?php
                                                        if (session()->get('level') != 'admin') {
                                                            echo base_url() ?>/home/search" <?php } else {
                                                                                            echo base_url() . '/pages/search' ?>" <?php } ?> class="d-none d-sm-inline-block form-inline w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-1 small" placeholder="Masukkan Nama..." aria-label="Search" aria-describedby="basic-addon2" name="search" id="search">
                                    <?php if (isset($nip)) : ?>
                                        <input type="hidden" name="nip" value="<?= $nip ?>"> <?php endif; ?>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                        for ($i = 0; $i < sizeof($mahasiswa); $i++) { ?>
                            <div class="card border-left-primary mb-3 p-2 px-4">
                                <div class="row">
                                    <div class="col-8">
                                        <h6 class="font-weight-bold"><?= $mahasiswa[$i]['nama'] ?></h6>
                                        <small><?= $mahasiswa[$i]['nim'] ?></small>
                                    </div>
                                    <?php if (session()->get('level') == 'dosen') : ?>
                                        <div class="col-4 d-flex justify-content-end">
                                            <button class="d-flex justify-content-end px-2 align-items-center btn btn-primary btn-icon-split">
                                                <a href="<?= base_url() ?>/chat/<?= $mahasiswa[$i]['nim'] ?>">
                                                    <iconify-icon icon="bi:chat-fill" style="color: white;" width="20"></iconify-icon>
                                                </a>
                                            </button>
                                        </div>

                                    <?php endif; ?>
                                    <?php if (session()->get('level') == 'admin') : ?>
                                        <div class="col-4 d-flex justify-content-end">
                                            <button class="mx-2 d-flex justify-content-end px-2 align-items-center btn btn-warning btn-icon-split">
                                                <a href="<?= base_urL() . '/dosen/' . $nip_dosen ?>/edit/<?= $mahasiswa[$i]['nim'] ?>">
                                                    <iconify-icon icon="ant-design:edit-filled" style="color: white;" width="20"></iconify-icon>
                                                </a>
                                            </button>
                                            <button class="d-flex justify-content-end px-2 align-items-center btn btn-danger btn-icon-split">
                                                <a href="<?= base_urL() . '/dosen/' . $nip_dosen ?>/del/<?= $mahasiswa[$i]['nim'] ?>">
                                                    <iconify-icon icon="fluent:delete-16-filled" style="color: white;" width="20"></iconify-icon>
                                                </a>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                    <?php if (session()->get('level') == 'admin' and isset($nip_dosen)) : ?>
                        <div class="w-100">
                            <a href="<?= base_urL() . '/dosen/' . $nip_dosen ?>/create/">
                                <button class="w-100 p-2 btn btn-primary btn-icon-split">
                                    <iconify-icon icon="akar-icons:circle-plus-fill" style="color: white;" width="20"></iconify-icon>
                                </button>
                            </a>
                        </div>
                    <?php endif; ?>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <?php $this->endSection() ?>