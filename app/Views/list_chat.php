<?php

$this->extend('/layout/template');
$this->section('content');
?>
<div class="container-fluid">
    <div class="d-sm-flex justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Konsultasi Akademik Mahasiswa</h1>
    </div>
    <div class="row">
        <div class="col">
            <?php for ($i = 0; $i < sizeof($list); $i++) { ?>
                <div class="card border-left-primary mb-3 p-2 px-4">
                    <a href="<?= base_url() . '/chat/' . $name[$i][0] ?>" class="text-reset text-decoration-none">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-8">
                                        <h5 class="font-weight-bold text-dark"><?= $name[$i][1] ?></h5>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="text-muted float-right"><?= $list[$i]['send_at'] ?></h6>
                                    </div>
                                </div>
                                <h6 class="text-muted"><?= $list[$i]['text'] ?></h6>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php $this->endSection() ?>