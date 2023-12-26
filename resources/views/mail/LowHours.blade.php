<!DOCTYPE html>
<html>
<head>
    <title>Lesson Hours Notification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        /* Inline styles for maximum compatibility */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-12 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
            line-height: 1.5;
        }
        .btn-primary {
            text-decoration: none;
            padding: 10px 20px;
            color: black;
            background-color: green;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            display: inline-block;
            margin-bottom: 3rem; 
            margin-top: 1.5rem;
        }
        .btn-primary:hover {
            background-color: #00b309;
        }
    </style>
</head>
<body>
    <div style="background-color: white; padding: 20px; max-width: 600px; margin: 20px auto; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <div class="d-flex justify-content-center">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmFSNXoydQz5rJkBw8GUHGqRZeVe2TEhsU5QvaBqCC8qwkji7JfVomkjfOWguwf3Q5Jqg&usqp=CAU" style="display: block; margin-left: auto; margin-right: auto;" alt="">
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Alert: Your Lesson Hours are Running Low!</h2>
                <p>Hello <b>{{ $first_name.' '.$last_name }}</b>,</p>
                <p>We wanted to inform you that your purchased hours for lessons are running low. To ensure uninterrupted learning, please click the button below.</p>
                <div style="text-align: center;">
                <a href="{{ env('APP_URL') }}/pago-horas?uuid={{ $internal_code }}" style="text-decoration: none; padding: 10px 20px; color: white !important; background-color: blue !important; border-radius: 5px; border: none; cursor: pointer; display: inline-block; margin-bottom: 3rem; margin-top: 1.5rem;">Renew Now</a>
                </div>
                <p>If you have any questions or need assistance, feel free to contact us.</p>
                <p>Thank you for choosing us!</p>
                <p>Best Regards,<br> <span style="font-weight: bold;">Centro de Idiomas El Golf</span></p>
            </div>
        </div>
    </div>
</body>
</html>
