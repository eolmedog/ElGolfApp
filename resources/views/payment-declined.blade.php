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
        @if ($reason=='declined')
            <h2>Payment Declined</h2>
            <p class="lead">Unfortunately, your payment could not be processed.</p>
            <img src="https://via.placeholder.com/150" alt="Payment Declined" class="img-fluid mb-3">
            <p>Please check your payment details and try again.</p>
            
        @endif
        @if ($reason=='pending')
            <h2>There is something wrong with the transaction</h2>
            <p class="lead mb-2">There is something odd about your transaction, but we are working to solve it. </p>
            <p class="mb-4">If the payment went through, maybe our partners are taking their time to let us know.</p>
                
            <img src="https://via.placeholder.com/150" alt="Payment Pending" class="img-fluid mb-3">
            <p class="mb-2">Please press the button below to try again.</p>
            
        @endif
        <a href='#' class="btn btn-lg retry-button">Try Again</a>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>