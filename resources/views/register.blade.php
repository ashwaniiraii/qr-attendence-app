<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col justify-center font-[sans-serif] text-[#333] sm:h-screen p-4">
        <div class="max-w-md w-full mx-auto border border-gray-300 rounded-md p-6">
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-2">
                    <div>
                        <label class="text-sm mb-2 block">Name</label>
                        <input name="name" type="text"
                            class="bg-white border border-gray-300 w-full text-sm px-4 py-2 rounded-md outline-blue-500"
                            placeholder="Enter name" />
                    </div>
                    <div>
                        <label class="text-sm mb-2 block">Email Id</label>
                        <input name="email" type="email"
                            class="bg-white border border-gray-300 w-full text-sm px-4 py-2 rounded-md outline-blue-500"
                            placeholder="Enter email" />
                    </div>
                    <div>
                        <label class="text-sm mb-2 block">Mobile</label>
                        <input name="mobile" type="number"
                            class="bg-white border border-gray-300 w-full text-sm px-4 py-2 rounded-md outline-blue-500"
                            placeholder="Enter mobile" />
                    </div>
                    <div>
                        <label class="text-sm mb-2 block">Profile</label>
                        <input type="file" name="profile"
                            class="w-full text-gray-500 font-medium text-sm bg-gray-100 file:cursor-pointer cursor-pointer file:border-0 file:py-2 file:px-4 file:mr-4 file:bg-blue-500 file:hover:bg-blue-600 file:text-white rounded" />
                    </div>
                    <div>
                        <label class="text-sm mb-2 block">Password</label>
                        <input name="password" type="password"
                            class="bg-white border border-gray-300 w-full text-sm px-4 py-2 rounded-md outline-blue-500"
                            placeholder="Enter password" />
                    </div>
                    <div>
                        <label class="text-sm mb-2 block">Confirm Password</label>
                        <input name="password_confirmation" type="password"
                            class="bg-white border border-gray-300 w-full text-sm px-4 py-2 rounded-md outline-blue-500"
                            placeholder="Enter confirm password" />
                    </div>
                </div>
                <div class="!mt-6">
                    <button type="submit"
                        class="w-full py-2 px-4 text-sm font-semibold rounded text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
                        Create an account
                    </button>
                </div>
                <p class="text-sm mt-4 text-center">Already have an account? <a href="javascript:void(0);"
                        class="text-blue-600 font-semibold hover:underline ml-1">Login here</a></p>
            </form>
        </div>
    </div>
</body>

</html>
