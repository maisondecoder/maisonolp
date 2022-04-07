<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<div class="container p-4">
    <h3 class="mt-2 mb-2 text-white">Voucher Transaction</h3>
    <?php echo '<div class="text-danger">' . validation_errors() . '</div>'; ?>
</div>
<div class="bg-white p-4" style="margin-bottom:95px; border-radius: 16px">
    <div id="reader" class="mb-3"></div>
    <form action="<?= base_url('cashier/voucher'); ?>" method="post">
        <div class="row mb-3">
            <label for="memberID" class="col-sm-3 col-form-label">Voucher</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <input id="voucherreff" name="voucher-input" type="text" class="form-control" placeholder="Scan Voucher's QR" aria-label="Voucher's ID" aria-describedby="button-addon2" readonly required>
                    <button class="btn btn-primary" type="button" id="btnscanqr"><i class="fas fa-qrcode fa-fw"></i> Scan</button>
                </div>
            </div>
        </div>
        <div class="row p-3">
            <div class="p-4 card shadow">
                <h4>Voucher Summary</h4>

                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Serial</th>
                            <td><span id="summary-reff">N/A</span></td>
                        </tr>
                        <tr>
                            <th style="width:60px">Title</th>
                            <td><span id="summary-title">N/A</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <img class="img-fluid" id="summary-img" src="" alt="">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button id="btn-process" type="submit" class="btn btn-danger" disabled>Claim Voucher</button>
            </div>
        </div>

    </form>
</div>


<script>
    const html5QrCode = new Html5Qrcode("reader");
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        console.log(`Code matched = ${decodedText}`, decodedResult);
        html5QrCode.stop().then((ignore) => {

            $.post("<?= base_url('cashier/summary_voucher/'); ?>", {
                    hash_input: "" + decodedText
                })
                .done(function(data) {
                    var u = JSON.parse(data);
                    //alert("Voucher Found: \n" + u.title);
                    $('#summary-title').html(u.title);
                    $('#summary-reff').html(u.reff);
                    $('#summary-img').attr('src', '<?= base_url('assets/voucher_program/'); ?>' + u.image);
                    if (u.status == 1) {
                        $('#btn-process').prop('disabled', false);
                        $('#voucherreff').val(decodedText);
                    } else {
                        $('#btn-process').prop('disabled', true);
                        $('#voucherreff').val("");
                    }

                });
        }).catch((err) => {

        });
    };
    const config = {
        fps: 10,
        qrbox: {
            width: 250,
            height: 250
        }
    };

    // Select back camera or fail with `OverconstrainedError`.
    $('#btnscanqr').click(function() {
        html5QrCode.start({
            facingMode: {
                exact: "user"
            }
        }, config, qrCodeSuccessCallback);
    });
</script>