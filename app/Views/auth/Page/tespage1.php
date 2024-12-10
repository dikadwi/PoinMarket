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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-purple-500 to-indigo-500 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-3xl shadow-lg flex w-11/12 md:w-3/4 lg:w-2/3 overflow-hidden">
        <div class="hidden md:flex md:w-1/2 bg-purple-600 p-10 flex-col items-center justify-center">
            <img alt="Illustration of a person jumping with plants around" class="w-3/4 mb-6" height="300" src="https://storage.googleapis.com/a1aa/image/TvM2ffq1Zuo26UFNroI0vVif73sktMM2pcVo1q6MNKs31EynA.jpg" width="300" />
            <p class="text-white text-center">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
            </p>
        </div>
        <div class="w-full md:w-1/2 p-10">
            <div class="mb-6">
                <h2 class="text-purple-600 text-2xl font-bold">
                    Welcome back
                </h2>
            </div>
            <h3 class="text-gray-700 text-xl mb-4">
                Login your account
            </h3>
            <form>
                <div class="mb-4">
                    <label class="block text-gray-600 mb-2" for="username">
                        Username
                    </label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600" id="username" placeholder="Username" type="text" />
                </div>
                <div class="mb-6">
                    <label class="block text-gray-600 mb-2" for="password">
                        Password
                    </label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600" id="password" placeholder="Password" type="password" />
                </div>
                <div class="mb-4">
                    <button class="w-full bg-gradient-to-r from-purple-500 to-indigo-500 text-white py-2 rounded-lg hover:from-purple-600 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        Login
                    </button>
                </div>
                <div class="flex justify-between text-sm">
                    <a class="text-purple-600 hover:underline" href="#">
                        Create Account
                    </a>
                    <a class="text-purple-600 hover:underline" href="#">
                        Forgot Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>