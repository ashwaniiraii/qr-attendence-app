<!DOCTYPE html>
<html>

<head>
    <title>QR Code</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>

<body>
    <div id="qrCodeContainer" data-user-id=""></div>
    <button id="scanButton">Scan QR Code</button>
    <div id="reader" style="width:500px; height:500px;"></div>

    <script>
        $(document).ready(function() {
            function generateQRCode(userId) {
                $.ajax({
                    url: '/generate/' + userId,
                    method: 'GET',
                    success: function(response) {
                        $('#qrCodeContainer').html(response);
                        $('#qrCodeContainer').attr('data-user-id',
                            userId); // Store user ID in data attribute
                    },
                    error: function(xhr) {
                        console.error('Error generating QR code:', xhr);
                    }
                });
            }

            // Extract user ID from URL
            function getUserIdFromUrl() {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get('id');
            }

            // Get the user ID from the URL
            var userId = getUserIdFromUrl();

            if (userId) {
                // Generate QR code on page load
                generateQRCode(userId);
            } else {
                console.error('User ID not found in URL');
            }

            $('#scanButton').click(function() {
                const html5QrCode = new Html5Qrcode("reader");

                html5QrCode.start({
                        facingMode: "environment"
                    }, // Use rear camera
                    {
                        fps: 10, // Optional, frame per seconds for qr code scanning
                        qrbox: 250 // Optional, if you want bounded box UI
                    },
                    qrCodeMessage => {
                        // Handle the scanned QR code message
                        console.log(`QR Code detected: ${qrCodeMessage}`);

                        // Assuming the QR code contains the URL to the scan route
                        $.ajax({
                            url: qrCodeMessage,
                            method: 'GET',
                            success: function(response) {
                                alert('Attendance recorded successfully');
                            },
                            error: function(xhr) {
                                console.error('Error scanning QR code:', xhr);
                            }
                        });

                        // Stop the scanner after successful scan
                        html5QrCode.stop().then(ignore => {
                            // QR Code scanning is stopped.
                        }).catch(err => {
                            // Stop failed, handle it.
                        });
                    },
                    errorMessage => {
                        // parse error, ignore it.
                        console.log(`QR Code no longer in front of camera.`);
                    }
                ).catch(err => {
                    // Start failed, handle it.
                    console.error(`Unable to start scanning, error: ${err}`);
                });
            });
        });
    </script>
</body>

</html>
