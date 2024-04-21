<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" ></script>
</head>
<body>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-2">
                <p class="mb-0">Simple</p>
                <a href="" id="container" >{!! $simple !!}</a><br/>
                {{-- <button id="download" class="mt-2 btn btn-info text-light" onclick="downloadSVG()">Download SVG</button> --}}
            </div>

        </div>
    </div>
    {{-- <script>
        function updateQRCode() {
            var randomNumber = Math.floor(Math.random() * 9000) + 1000; // Generate a random number
            console.log('Updating QR code with random number:', randomNumber);
            document.getElementById('qrCode').src = "/qr-code/" + randomNumber; // Update the image source
        }

        // Update the QR code image every 10 seconds
        setInterval(updateQRCode, 10000);

        // Initial update
        updateQRCode();
    </script> --}}

</body>
</html>