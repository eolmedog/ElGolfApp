<!DOCTYPE html>
<html>
<head>
    <title>Purchase Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    {{-- Add company logo here --}}
    <div class="container mt-5">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmFSNXoydQz5rJkBw8GUHGqRZeVe2TEhsU5QvaBqCC8qwkji7JfVomkjfOWguwf3Q5Jqg&usqp=CAU" class="img-fluid mx-auto d-block" alt="">
        <div class="alert alert-info">
            <h2 class='mb-3'>Welcome <strong>{{$first_name}} {{$last_name}}</strong></h2>
            <strong>Important Message:</strong> Please select the number of hours you want to purchase.
        </div>

        <form action="{{ route('purchase') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="hours">Number of Hours</label>
                <input type="number" class="form-control" id="hours" name="hours" placeholder="Enter the number of hours" required>
                @error('hours')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="hidden" name="email" value={{$email}}>
           
                <input type="hidden" name="internal_code" value={{$internal_code}}>
                <button id="purchase"type="submit" class="btn btn-success m-2">Purchase</button>
            </div>

            <div class="form-group">
                <p class="font-weight-bold">Or choose a Package:</p>
                <div class="btn-group">
                    <a id="add20" class="btn btn-primary m-2">Purchase 20</a>
                    <a id="add40" class="btn btn-primary m-2">Purchase 40</a>
                    <a id="add60" class="btn btn-primary m-2">Purchase 60</a>
                </div>
            </div>

            
        </form>
    </div>
    <script>
        $('#add20').click(function() {
            $('#hours').val(20);
            $('#purchase').click();
        });
        $('#add40').click(function() {
            $('#hours').val(40);
            $('#purchase').click();
        });
        $('#add60').click(function() {
            $('#hours').val(60);
            $('#purchase').click();
        })

    </script>
</body>
</html>
