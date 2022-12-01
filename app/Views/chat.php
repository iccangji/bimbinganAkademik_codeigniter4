<?php

$this->extend('/layout/template');
$this->section('content');
?>
<div class="d-sm-flex position-sticky justify-content-between m-4 mb-2 p-0">
    <h1 class="h3 mb-0 text-gray-800">Chat</h1>
</div>
<div class="container-fluid mh-75 h-75 overflow-hidden">
    <div class="row">
        <div class="col overflow-auto p-2 h-50" id="scroll">
            <div class="d-flex flex-column" id="live_data">
                <!-- time -->
                <?php
                for ($i = 0; $i < sizeof($content); $i++) {
                    if ($content[$i]['sender'] == session()->get('user')) {
                ?> <div class="">
                            <p class="col-6 p-2 msg right text-light text-right bg-primary">
                                <?= $content[$i]['text'] ?>
                                <br><span class="msg right text-gray-0"><?= $content[$i]['send_at'] ?> </span>
                            </p>
                        </div>
                    <?php
                    } else { ?>
                        <div class="">
                            <p class="pt-2 pb-4 col-6 msg left text-light bg-info"><?= $content[$i]['text'] ?><br>
                                <span"><?= $content[$i]['send_at'] ?></span>
                            </p>
                        </div>
                <?php  }
                } ?>
            </div>
        </div>
        <!-- <div class="h-100 mh-100 w-100 h-100 d-inline-block p-5"></div> -->
        <div class="w-100 card h-25 m-2 border-left-primary inputText mx-auto">
            <form method="post" id="message" class="w-100">
                <div class="input-group p-2">
                    <input type="text" name="text" id="text" class="form-control p-4" placeholder="Masukkan pesan" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                    <input type="hidden" name="sender" value="<?= session()->get('user'); ?>">
                    <input type="hidden" name="receiver" value="<?= $receiver ?>">
                    <div class="input-group-append">
                        <!-- <button class="btn btn-outline-none" type="button" id="sendFile">
                            <iconify-icon icon="akar-icons:file" style="color: grey;" width="20"></iconify-icon>
                        </button> -->
                        <button class="btn btn-primary btn-outline-secondary" type="submit" id="sendMsg">
                            <iconify-icon icon="fluent:send-20-filled" style="color: white;"></iconify-icon>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- <div class="w-100 card m-2 border-left-primary inputFile">
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input border-0" id="inputGroupFile02">
                    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                </div>
                <div class="input-group-append border-0">
                    <button class="btn p-1 btn-danger" id="sendText">
                        <iconify-icon icon="iconoir:cancel" style="color: white;" width="20"></iconify-icon>
                    </button>
                </div>
                <div class="input-group-append border-0">
                    <button class="btn btn-primary" id="">
                        <iconify-icon icon="fluent:send-20-filled" style="color: white;"></iconify-icon>
                    </button>
                </div>
            </div>
        </div> -->
    </div>
</div>
<script>
    // $('.inputFile').hide();


    $('document').ready(function() {
        $('#scroll').scrollTop($('#scroll')[0].scrollHeight);
        // let autocounter = 1
        // var autoscroll = setInterval(function() {
        //     if ($('.msg')) {
        //         autocounter++
        //         $('#scroll').scrollTop($('#scroll')[0].scrollHeight);
        //         if (autocounter > 2) {
        //             clearInterval(autoscroll)
        //             console.log(2);
        //         }
        //     }
        // }, 1000)
        // var row = 1
        // var record = [0, 0]
        setInterval(getMessage, 1500)


        var size = <?= $size ?>;

        function getMessage() {
            $.ajax({
                type: 'POST',
                url: '<?= base_url()  ?>/chat/showMessage',
                data: {
                    target: '<?= $receiver ?>'
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data.length > size);
                    console.log(data.length);
                    if (data.length > size) {
                        if (data[data.length - 1].sender == '<?= session()->get('user') ?>') {
                            $('#live_data').append('<div class=""><p class="col-6 p-2 msg right text-light text-right bg-primary">' + data[data.length - 1].text + '<br><span class="msg right text-gray-0">' + (data[data.length - 1].send_at).slice(0, 16) + '</span></p></div>')
                        } else {
                            $('#live_data').append('<div class=""><p class="pt-2 pb-4 col-6 msg left text-light bg-info">' + data[data.length - 1].text + '<br><span">' + (data[data.length - 1].send_at).slice(0, 16) + '</span></p></div>')
                        }
                        size = data.length
                    }
                    console.log(size)
                    // while (true) {
                    //     if ($('#scroll').scrollTop() == 0) {
                    //         $('#scroll').scrollTop($('#scroll')[0].scrollHeight);
                    //     } else {
                    //         break
                    //     }
                    // }
                    let scroll = $('#scroll').scrollTop()
                    let autoscroll = setInterval(function() {
                        if ($('#scroll').scrollTop() == scroll) {
                            // autocounter++
                            $('#scroll').scrollTop($('#scroll')[0].scrollHeight);
                            // if (autocounter > 2) {
                            //     clearInterval(autoscroll)
                            //     console.log(2);
                            // }
                        } else {
                            clearInterval(autoscroll)
                            console.log('ok');
                        }
                    }, 1000)
                    // $('#live_data').html('')
                    // record[0] = data.length

                }
            });
            // console.log(record[1]);
            // if (record[1]) {
            //     if (record[0] > record[1]) {
            //         scrollBot()
            //     }
            // }
            // record[1] = record[0]
            // console.log(record[0])
        }

        // function scrollBot() {
        //     $('#scroll').scrollTop($('#scroll')[0].scrollHeight);
        // }

        // perulangan isi dari data
        // percabangan jika data.sender = user maka pengirim

        // $('#sendFile').click(function() {
        //     $('.inputFile').show();
        //     $('.inputText').hide();
        // });
        // $('#sendText').click(function() {
        //     $('.inputFile').hide();
        //     $('.inputText').show();
        // });
        $("#message").submit(function(event) {
            event.preventDefault();
            var data = $(this).serialize();
            if ($('text')) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>/chat/sendMessage",
                    data: data,
                    cache: false,
                    success: function(data) {
                        $('input[name=text]').val('');
                    }
                });
            }
        })
    })
</script>
<?php $this->endSection() ?>