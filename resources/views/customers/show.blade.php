<!DOCTYPE html>
<html>
<head>
    <title>Customer Details</title>
    <style>
        body{
            font-family:Arial, sans-serif;
            background:#f4f6f9;
            padding:30px;
        }
        .container{
            max-width:700px;
            margin:auto;
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
        }
        .row{
            margin-bottom:15px;
            padding:12px;
            background:#f9fafb;
            border-radius:8px;
        }
        .label{
            font-weight:bold;
            color:#374151;
        }
        .btn{
            margin-top:20px;
            padding:10px 16px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:14px;
            text-decoration:none;
            display:inline-block;
            color:white;
            background:#111827;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Details</h1>

        <div class="row"><span class="label">Name:</span> {{ $customer->name }}</div>
        <div class="row"><span class="label">Gender:</span> {{ $customer->gender }}</div>
        <div class="row"><span class="label">Date of Birth:</span> {{ $customer->date_of_birth }}</div>
        <div class="row"><span class="label">Address:</span> {{ $customer->address }}</div>

        <a href="{{ route('customers.index') }}" class="btn">Back to List</a>
    </div>
</body>
</html>