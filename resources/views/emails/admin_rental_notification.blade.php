<!DOCTYPE html>
<html>
<head>
    <title>New Rental Notification</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .footer { margin-top: 20px; padding: 20px; background-color: #f8f9fa; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Rental Notification</h2>
        </div>
        
        <div class="content">
            <p>A new car rental has been booked:</p>
            
            <h3>Customer Information</h3>
            <p><strong>Name:</strong> {{ $rental->user->name }}</p>
            <p><strong>Email:</strong> {{ $rental->user->email }}</p>
            <p><strong>Phone:</strong> {{ $rental->user->phone_number ?? 'Not provided' }}</p>
            
            <h3>Car Details</h3>
            <p><strong>Vehicle:</strong> {{ $rental->car->brand }} {{ $rental->car->model }}</p>
            <p><strong>Car ID:</strong> {{ $rental->car->id }}</p>
            
            <h3>Rental Period</h3>
            <p><strong>Start Date:</strong> {{ $rental->start_date->format('F j, Y') }}</p>
            <p><strong>End Date:</strong> {{ $rental->end_date->format('F j, Y') }}</p>
            <p><strong>Total:</strong> ${{ number_format($rental->total_cost, 2) }}</p>
        </div>
        
        <div class="footer">
            <p>This is an automated notification. No reply is needed.</p>
        </div>
    </div>
</body>
</html>