<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Declined</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .payment-declined-container {
            margin-top: 50px;
            text-align: center;
        }

        .retry-button {
            margin-top: 30px;
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .retry-button:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container payment-declined-container">
        <h2>There is something wrong with the transaction</h2>
        <p class="lead">There is something odd about your transaction, but we are working to solve it. If the payment went through, maybe our partners are taking their time to let us know.
            Please press the button below to try again.</p>
        <img src="https://via.placeholder.com/150" alt="Payment Declined" class="img-fluid mb-3">
        <p>Press the button to refresh and try again.</p>
        
        <a href={{ route('payment-select'. ['uuid'=>$merchant_internal_code]) }} class="btn btn-lg retry-button">Try Again</a>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>