<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akaun Disahkan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: black;
        }

        .wrapper {
            padding: 20px;
            max-width: 100%;
            overflow-x: hidden;
            background-color: #f4f6f9;
            text-align: center; /* Center the content */
        }

        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            display: inline-block; /* Ensure the card doesn't take full width */
            text-align: left; /* Reset text alignment for card content */
        }

        @media print {
            /* Hide the print button and other non-essential elements */
            .print-button-container {
                display: none;
            }

            /* Limit the width of the printed content */
            body {
                max-width: 800px;
                margin: auto;
            }

            /* Adjust text color for printing */
            p,
            h5,
            ul,
            ol,
            h6 {
                color: black;
            }
        }

        p, ul, li, h4, h2, h4, h6 {
            color: black;
        }

        img {
            display: block; /* Ensure the image is treated as a block element */
            margin: 0 auto; /* Center the image horizontally */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <section class="content p-2" id="printable-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="content">
                            <div class="row-sm-auto">
                                <div class="col-sm-auto">
                                    <div class="row" style="display: flex; justify-content:center">
                                        {{-- <img src="{{ asset('assets/img/logo_sekolah.png') }}" class="img-fluid" style="width: 110px; height: 110px;" alt=""> --}}
                                        <img src="{{$message->embed(asset('assets/img/logo_sekolah.png'))}}" class="img-fluid" style="width: 110px; height: 110px;" alt="">

                                    </div>
                                    <div class="row pt-3" style="text-align: center;">
                                        <h4>Akaun anda telah disahkan</h4>
                                    </div>
                                    <div class="row pt-5">
                                        <h5>Hai, {{$user->name}}</h5>
                                    </div>
                                    <div class="row pt-1">
                                        <p>Akaun anda telah disahkan oleh pentadbir sistem. Anda boleh log masuk menggunakan emel dan kata laluan yang telah didaftarkan.</p>
                                    </div>
                                    <div class="row pt-1">
                                        <p>Jika anda mengalami masalah ketika log masuk, boleh hubungan kami di <a href="sppibg@gmail.com">sppibg@gmail.com</a></p>
                                    </div>
                                    <div class="row pt-1" style="text-align: center;">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center">
                                            <tbody>
                                                <tr>
                                                    <td style="background-color:#007BFF;border-radius:3px;text-align:center;">
                                                        <a href="{{route('login')}}" style="background-color:#007BFF;border:1px solid #007BFF;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">Log Masuk</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
