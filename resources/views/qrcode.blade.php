<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1" />

<head>
    <title>QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-custom {
            background: linear-gradient(135deg, #2ed63c 0%, #e0e0e0 100%);
        }
    </style>
</head>

<body class="bg-custom flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center md:max-w-md lg:max-w-lg card">
        <div class="mb-4">
            <div class="flex items-center justify-center">
                {!! $qrCode !!}
            </div>
        </div>
        <div class="mt-4">
            <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
            <p class="text-gray-600">{{ $user->email }}</p>
            <p class="text-red-900"> {!! $randomString !!}</p>
        </div>
    </div>
</body>

</html>
