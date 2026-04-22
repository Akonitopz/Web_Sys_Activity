<!DOCTYPE html>
<html>
<head>
    <title>Create Customer</title>
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
        h1{margin-bottom:20px;}
        label{
            display:block;
            margin-top:12px;
            margin-bottom:6px;
            font-weight:bold;
        }
        input, select, textarea{
            width:100%;
            padding:10px;
            border:1px solid #d1d5db;
            border-radius:8px;
            font-size:14px;
        }
        input:focus, select:focus, textarea:focus{
            outline:none;
            border-color:#2563eb;
            box-shadow:0 0 0 3px rgba(37,99,235,0.15);
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
        }
        .btn-save{background:#111827;color:white;}
        .btn-back{background:#e5e7eb;color:#111827;}
        .btn-save:hover{background:#000;}
        .btn-back:hover{background:#d1d5db;}
        .error{
            color:red;
            font-size:14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Customer</h1>

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label>Address</label>
            <textarea name="address">{{ old('address') }}</textarea>
            @error('address') <div class="error">{{ $message }}</div> @enderror

            <label>Gender</label>
            <select name="gender">
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender') <div class="error">{{ $message }}</div> @enderror

            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
            @error('date_of_birth') <div class="error">{{ $message }}</div> @enderror

            <button type="submit" class="btn btn-save">Save Customer</button>
            <a href="{{ route('customers.index') }}" class="btn btn-back">Back</a>
        </form>
    </div>
</body>
</html>