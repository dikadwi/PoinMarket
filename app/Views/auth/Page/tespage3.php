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

<body class="bg-purple-600 flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg flex w-full max-w-4xl">
        <div class="hidden md:flex md:w-1/2 bg-gray-100 items-center justify-center p-10">
            <img alt="Colorful abstract shapes with faces" class="w-3/4" height="300" src="https://storage.googleapis.com/a1aa/image/fMEfyLnrpGlfbIrseFGFbz3XrJlyjcGldJCcL5dReaXdOVIfE.jpg" width="300" />
        </div>
        <div class="w-full md:w-1/2 p-10">
            <div class="flex justify-center mb-6">
                <div class="text-4xl font-bold text-purple-600">
                    Pm
                </div>
            </div>
            <h2 class="text-2xl font-bold text-center mb-2">
                Welcome back!
            </h2>
            <p class="text-center text-gray-600 mb-6">
                Please enter your details
            </p>
            <form>
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">
                        Email
                    </label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" id="email" type="email" />
                </div>
                <div class="mb-4 relative">
                    <label class="block text-gray-700" for="password">
                        Password
                    </label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" id="password" type="password" />
                    <i class="fas fa-eye absolute right-3 top-10 text-gray-500 cursor-pointer">
                    </i>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input class="form-checkbox text-gray-600" type="checkbox" />
                        <span class="ml-2 text-gray-600">
                            Remember for 30 days
                        </span>
                    </label>
                    <a class="text-gray-600" href="#">
                        Forgot password?
                    </a>
                </div>
                <button class="w-full bg-black text-white py-2 rounded-lg mb-4">
                    Log In
                </button>
                <button class="w-full bg-white border border-gray-300 text-gray-700 py-2 rounded-lg flex items-center justify-center">
                    <img alt="Google logo" class="mr-2" height="20" src="https://storage.googleapis.com/a1aa/image/C9H10sKVGn5rP97CkdmymZnd4p2CGJTvT9wMCQkbYDocqQeJA.jpg" width="20" />
                    Log in with Google
                </button>
            </form>
            <p class="text-center text-gray-600 mt-6">
                Don't have an account?
                <a class="text-black font-bold" href="#">
                    Sign Up
                </a>
            </p>
        </div>
    </div>
</body>

</html>