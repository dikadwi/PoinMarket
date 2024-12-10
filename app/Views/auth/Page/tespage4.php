<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Poin Market - Login
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <style>
        .carousel {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .carousel img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.5s ease-in-out;
        }

        .carousel img.hidden {
            opacity: 0;
        }

        .carousel img.visible {
            opacity: 1;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.carousel img');
            let currentIndex = 0;

            function showImage(index) {
                images.forEach((img, i) => {
                    img.classList.toggle('visible', i === index);
                    img.classList.toggle('hidden', i !== index);
                });
            }

            document.querySelector('.carousel').addEventListener('click', function() {
                currentIndex = (currentIndex + 1) % images.length;
                showImage(currentIndex);
            });

            showImage(currentIndex);
        });
    </script>
</head>

<body class="bg-gray-100 font-roboto relative">
    <div class="absolute inset-0 z-0">
        <img alt="Background image depicting gamification elements such as points, badges, leaderboards, and rewards" class="w-full h-full object-cover opacity-20" height="600" src="https://storage.googleapis.com/a1aa/image/UJ6IVzfPkvy3UylKTpHMbjlOyZAuV3CwrhF4ZumTOhntba8JA.jpg" width="800" />
    </div>
    <div class="min-h-screen flex items-center justify-center relative z-10">
        <div class="max-w-4xl w-full flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 p-6 relative">
                <div class="carousel">
                    <img alt="Infographic explaining Poin Market, including gamification elements like earning points, unlocking achievements, competing on leaderboards, and redeeming rewards" class="mx-auto visible" height="600" src="https://storage.googleapis.com/a1aa/image/DIxRYiVL1UagM1GVbXnFbeX0ArP0C6egrzfKXcsWi0hUspxnA.jpg" width="400" />
                    <img alt="Another infographic explaining Poin Market, focusing on user engagement and rewards" class="mx-auto hidden" height="600" src="https://storage.googleapis.com/a1aa/image/UJ6IVzfPkvy3UylKTpHMbjlOyZAuV3CwrhF4ZumTOhntba8JA.jpg" width="400" />
                </div>
            </div>
            <div class="w-full md:w-1/2 p-6 border-l border-gray-300">
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Login to your account
                    </h1>
                    <p class="text-gray-600">
                        Access your personalized dashboard
                    </p>
                </div>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700" for="email">
                            Email
                        </label>
                        <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" placeholder="Enter your email" type="email" />
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700" for="password">
                            Password
                        </label>
                        <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" placeholder="Enter your password" type="password" />
                    </div>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" id="remember" type="checkbox" />
                            <label class="ml-2 block text-gray-900" for="remember">
                                Remember me
                            </label>
                        </div>
                        <a class="text-blue-600 hover:underline" href="#">
                            Forgot password?
                        </a>
                    </div>
                    <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">
                        Login
                    </button>
                </form>
                <p class="text-center text-gray-600 mt-6">
                    Don't have an account?
                    <a class="text-blue-600 hover:underline" href="#">
                        Sign up
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>