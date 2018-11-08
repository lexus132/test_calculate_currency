<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darkster Bootstrap 4 Theme Full Screen</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/theme.css" rel="stylesheet">
    <link href="/css/template.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.png">
    <style>
        header.bg-primary {
            /*background-image: url('/images/preview.jpg');*/
            background: #000000 !important;
        }
        .row {
            margin-top: 10px;
            margin-bottom: 15px;
        }
        h1{
            text-align: center;
        }
        #rezult {
            display: none;
        }
        #convert{
            display: none;
        }
        h3{
            text-align: left;
            margin-top: 10px;
            margin-left: 10px;
        }
    </style>
</head>



<body data-spy="scroll" data-target="#navbar1" data-offset="60">
    <header class="bg-primary">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12">
                    <div class="text-center m-0 vh-100 d-flex flex-column justify-content-center text-light">
                        <div class="container" id="main">
                            <div class="d-flex my-3">
                                <div class="jumbotron w-100 py-5 mx-auto copyable text-primary">
                                    <h1>Currency conversion</h1>
                            </div>
                        </div>
                        <div class="container" id="main">

                            @section('content')

                            @show

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/script.js"></script>

</body></html>