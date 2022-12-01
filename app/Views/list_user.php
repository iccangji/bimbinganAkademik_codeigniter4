<?php

$this->extend('/layout/template');
$this->section('content');
?>
<div class="container-fluid">
    <div class="d-sm-flex justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List User</h1>
    </div>
    <div class="row">
        <div class="col">
            <?php for ($i = 0; $i < $len_data; $i++) { ?>
                <div class="card border-left-primary mb-3 p-2 px-4">
                    <div class="row">
                        <div class="col-8">
                            <h6 class="font-weight-bold"><?= $data[$i]['name'] ?></h6>
                            <small>user: <?= $data[$i]['user'] ?> | pass: <?= $data[$i]['pass'] ?></small>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php $this->endSection() ?>