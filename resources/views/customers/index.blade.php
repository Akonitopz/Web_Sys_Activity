<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f9;
            margin:0;
            padding:30px;
        }
        .container{
            max-width:1000px;
            margin:auto;
            background:#fff;
            padding:25px;
            border-radius:12px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
        }
        h1{
            margin-bottom:20px;
            color:#222;
        }
        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }
        .btn{
            text-decoration:none;
            padding:10px 16px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-size:14px;
            transition:0.3s;
            color:white;
        }
        .btn-add{background:#1f2937;}
        .btn-add:hover{background:#111827;}
        .btn-view{background:#6b7280;}
        .btn-view:hover{background:#4b5563;}
        .btn-edit{background:#2563eb;}
        .btn-edit:hover{background:#1d4ed8;}
        .btn-delete{background:#dc2626;}
        .btn-delete:hover{background:#b91c1c;}
        table{
            width:100%;
            border-collapse:collapse;
            overflow:hidden;
            border-radius:10px;
        }
        th, td{
            padding:14px;
            text-align:left;
            border-bottom:1px solid #e5e7eb;
        }
        th{
            background:#111827;
            color:white;
        }
        tr:hover{
            background:#f9fafb;
        }
        .actions{
            display:flex;
            gap:8px;
            flex-wrap:wrap;
        }
        .success{
            background:#dcfce7;
            color:#166534;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
        }
        .empty{
            text-align:center;
            color:#6b7280;
            padding:20px;
        }
        form{display:inline;}
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <h1>Customer List</h1>
            <a href="{{ route('customers.create') }}" class="btn btn-add">+ Add Customer</a>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <table>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            @forelse($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->gender }}</td>
                <td>{{ $customer->date_of_birth }}</td>
                <td>{{ $customer->address }}</td>
                <td class="actions">
                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-view">View</a>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-edit">Edit</a>

                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Delete this customer?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty">No customers found.</td>
            </tr>
            @endforelse
        </table>
    </div>
</body>
</html>