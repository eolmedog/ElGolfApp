<!DOCTYPE html>
<html>
<head>
    <title>Thank you for your Purchase</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="margin: 0 auto; max-width: 600px; padding: 30px; text-align: center;">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmFSNXoydQz5rJkBw8GUHGqRZeVe2TEhsU5QvaBqCC8qwkji7JfVomkjfOWguwf3Q5Jqg&usqp=CAU" style="max-width: 100%; height: auto; margin: 0 auto; display: block;" alt="">

        <h2 style="font-size: 24px; margin-top: 20px;">Proof of Payment</h2>

        <p style="font-size: 16px; line-height: 1.6;">
            Dear <b>{{ $first_name.' '.$last_name }}</b>, <br>
            Thank you for your purchase. Your purchased hours have been added to our records. <br>
            Here is a summary of your payment:
        </p>

        <table style="width: 100%; background-color: white; margin-top: 20px; padding: 20px; border-radius: 5px; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 8px; text-align: left;">Item</th>
                    <th style="border: 1px solid black; padding: 8px; text-align: left;">Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid black; padding: 8px;">Amount Paid</td>
                    <td style="border: 1px solid black; padding: 8px;">${{ $amount }}</td> <!-- Placeholder for amount paid -->
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 8px;">Date</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $date }}</td> <!-- Placeholder for date -->
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding: 8px;">Hours Paid</td>
                    <td style="border: 1px solid black; padding: 8px;">{{ $hours }}</td> <!-- Placeholder for hours paid -->
                </tr>
            </tbody>
        </table>

        <p style="font-size: 16px; line-height: 1.6;">If you have any questions or concerns, please do not hesitate to contact us.</p>
        <p style="font-weight: bold;">Centro de Idiomas El Golf</p>
    </div>
</body>
</html>
