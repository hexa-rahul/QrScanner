<html>
<head>
    <title>Qrcode</title>
<body>
    <div id="qr-reader" style="width:500px"></div>
    <div style="width: 500px" id="reader"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{ url('/') }}/jsqrcode-combined.min.js"></script>
<script src="{{ url('/') }}/html5-qrcode.min.js"></script>
<script>
    var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
        
function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);
    // ...
    //alert(`Scan result: ${decodedText}`);
    
    location.href = decodedText; // uncomment this;

    html5QrcodeScanner.clear();
    // ^ this will stop the scanner (video feed) and clear the scan area.
}

function onScanError(errorMessage) {
    // handle on error condition, with error message
}

var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

</script>
</head>
</html>