<script>
    window.onload = function() {
    var myApp = {
        QRCode: QRCode,
    };

    var qrCodeData = 'https://example.com';
    var qrCode = new myApp.QRCode(document.getElementById('qrcode'), {
        text: qrCodeData,
        width: 256,
        height: 256,
    });
};
</script>