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
        <h2>Payment Declined</h2>
        <p class="lead">Unfortunately, your payment could not be processed.</p>
        <img src="https://via.placeholder.com/150" alt="Payment Declined" class="img-fluid mb-3">
        <p>Please check your payment details and try again.</p>
        
        <a href="#" class="btn btn-lg retry-button">Try Again</a>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>