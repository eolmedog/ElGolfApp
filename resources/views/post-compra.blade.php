<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .example-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <h1 class="display-4">Thank You for Your Purchase!</h1>
                <p class="lead">Your purchase has been processed successfully.</p>
                <p class="lead mt-4">Would you like to receive:</p>
                <form action="#" method="POST" id="hiddenForm">
                    @csrf <!-- Include CSRF token for security -->
                    <input type="hidden" name="internal_code" value="{{ $internal_code }}">
                    <input type="hidden" name="invoice_receipt" id="invoice_receipt" value="">
                </form>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <button type="button" onclick="setAdditionalParam('bill')" class="btn btn-primary btn-lg btn-block mb-1">A Bill</button>
                        <p class="lead small mb-1">I'm a natural person and need a bill for my purchase</p>
                        <img src="https://i1.wp.com/www.retailmax.cl/wp-content/uploads/2020/07/boleta-589x1024.jpg?resize=418%2C727&ssl=1" alt="Example of Bill" class="example-image">
                    </div>
                    
                    <div class="col-md-6">
                        <button type="button" onclick="setAdditionalParam('invoice')" class="btn btn-success btn-lg btn-block mb-1">An Invoice</button>
                        <p class="lead small mb-1">I'm here on behalf of a business and need an invoice</p>
                        <img src="https://denegocios.cl/wp-content/uploads/2023/02/lol.webp" alt="Example of Invoice" class="example-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setAdditionalParam(value) {
            document.getElementById('invoice_receipt').value = value; //Validate on server!!
            document.getElementById('hiddenForm').submit();
        }
    </script>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>