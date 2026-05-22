<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payroll Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-10 rounded shadow text-center w-full max-w-md">
        <h1 class="text-3xl font-bold mb-4">Payroll Management System</h1>

        <p class="text-gray-600 mb-6">
            Manage employees, payroll, attendance, reports, and audit logs.
        </p>

        <div class="flex justify-center gap-3">
            <a href="{{ route('login') }}"
               class="bg-blue-500 text-white px-5 py-2 rounded">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="bg-green-500 text-white px-5 py-2 rounded">
                Register
            </a>
        </div>
    </div>

</body>
</html>