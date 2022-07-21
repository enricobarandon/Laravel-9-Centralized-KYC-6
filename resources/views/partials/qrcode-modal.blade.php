<!-- View QR code -->
<div class="modal fade" id="myModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Player QR Code</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="qrcode-div" id="qrcode-div" style="background: #ffffff; padding: 10px;">
                    <img src="data:image/png;base64,{{ $qrCode }}" alt="barcode" />
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="MyPrintFunction('qrcode-div')" class="btn btn-primary" id="print">Print</button>
            </div>
        </div>

    </div>

</div>
