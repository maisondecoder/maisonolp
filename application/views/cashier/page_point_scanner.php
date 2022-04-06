<div class="container p-4">
    <h3 class="mt-2 mb-2 text-white">Point Transaction</h3>
    <?php echo '<div class="text-danger">' . validation_errors() . '</div>'; ?>
</div>
<div class="bg-white p-4" style="margin-bottom:95px; border-radius: 16px">
    <div id="reader" class="mb-3"></div>
    <form action="<?= base_url('cashier'); ?>" method="post">
        <div class="row mb-3">
            <label for="memberID" class="col-sm-3 col-form-label">QR ID</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <input id="memberID" name="qrid-input" type="text" class="form-control" placeholder="Scan Member's QR" aria-label="Member's ID" aria-describedby="button-addon2" readonly required>
                    <button class="btn btn-primary" type="button" id="btnscanqr"><i class="fas fa-qrcode fa-fw"></i> Scan</button>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputAmount3" class="col-sm-3 col-form-label">Nominal</label>
            <div class="col-sm-9">
                <input type="number" name="nominal-input" class="form-control" id="inputAmount3" placeholder="Total Spending Amount" min='0' required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputJurnal" class="col-sm-3 col-form-label">Invoice ID</label>
            <div class="col-sm-9">
                <input type="text" name="jurnal-input" class="form-control" id="inputJurnal" placeholder="Jurnal's Invoice ID" required>
            </div>
        </div>
        <div class="row p-3">
            <div class="p-4 card shadow">
                <h4>Transaction Summary</h4>

                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th style="width:60px">Member</th>
                            <td><span id="summary-fullname">N/A</span></td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td>Rp <span id="summary-nominal">0</span></td>
                        </tr>
                        <tr>
                            <th>Reward</th>
                            <td><span id="summary-csbpoint">0</span> M-Points</td>
                        </tr>
                    </tbody>
                </table>
                <button id="btn-process" type="submit" class="btn btn-danger" disabled>Process</button>
            </div>
        </div>

    </form>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    const html5QrCode = new Html5Qrcode("reader");
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        //console.log(`Code matched = ${decodedText}`, decodedResult);
        html5QrCode.stop().then((ignore) => {

            $.post("<?= base_url('cashier/summary_member/'); ?>", {
                    hash_input: "" + decodedText
                })
                .done(function(data) {
                    var u = JSON.parse(data);
                    //alert("Member Found: \n" + u.status);
                    $('#summary-fullname').html(u.name);
                    if (u.status == 1) {
                        $('#btn-process').prop('disabled', false);
                        $('#memberID').val(decodedText);
                    } else {
                        $('#btn-process').prop('disabled', true);
                        $('#memberID').val("");
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

    $('#inputAmount3').keyup(function() {
        if ($(this).val() <= 0) {
            var cashback = 0;
            $('#summary-nominal').text('0');
            $('#summary-csbpoint').text('0');
        } else {
            var cashback = $(this).val() / <?= $point_setting['ps_point_per']; ?> * <?= $point_setting['ps_point_multiplier']; ?>;
            $('#summary-nominal').text($.number($(this).val(), 0, ',', '.'));
            $('#summary-csbpoint').text($.number(cashback, 1, ',', '.'));
        }
    });
</script>