<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Login Page
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Left Side -->
        <div class="bg-blue-500 p-8 flex flex-col justify-center items-center w-full md:w-1/2">
            <h2 class="text-white text-3xl font-bold mb-6">
                WELCOME
            </h2>
            <form class="w-full max-w-sm">
                <div class="mb-4">
                    <input class="w-full px-4 py-2 rounded-full text-center text-black" placeholder="Username" type="text" />
                </div>
                <div class="mb-4">
                    <input class="w-full px-4 py-2 rounded-full text-center text-black" placeholder="Password" type="password" />
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-white">
                        <input class="form-checkbox" type="checkbox" />
                        <span class="ml-2">
                            Remember
                        </span>
                    </label>
                    <a class="text-white" href="#">
                        Forgot Password?
                    </a>
                </div>
                <button class="w-full bg-green-500 text-white py-2 rounded-full font-bold">
                    SUBMIT
                </button>
            </form>
        </div>
        <!-- Right Side -->
        <div class="bg-white p-8 flex justify-center items-center w-full md:w-1/2">
            <img alt="Illustration of a woman pointing at a large mobile phone screen and a man sitting with a laptop" height="400" src="https://storage.googleapis.com/a1aa/image/mbF73hot3hoxK90ZHuua0ybpea2ybzJBT2RDdSTSMfdKZC5TA.jpg" width="400" />
        </div>
    </div>
</body>

</html>