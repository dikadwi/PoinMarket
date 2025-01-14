<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Presentation</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }

        .slide {
            display: none;
            width: 100vw;
            height: 100vh;
            padding: 40px;
            box-sizing: border-box;
            text-align: center;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
        }

        .slide.active {
            display: flex;
        }

        .slide h1,
        .slide h2 {
            margin: 0;
            font-size: 3em;
        }

        .slide p,
        .slide ul li {
            font-size: 1.2em;
            line-height: 1.6;
            margin: 10px 0;
        }

        .slide ul {
            list-style: none;
            padding: 0;
        }

        .slide ul li {
            margin: 5px 0;
        }

        .slide h3 {
            font-size: 2em;
        }

        .nav {
            position: fixed;
            bottom: 20px;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .nav button {
            background-color: #ffcc00;
            color: #333;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.2s, background-color 0.3s;
        }

        .nav button:hover {
            background-color: #fff;
            transform: scale(1.1);
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.8);
            padding: 10px;
            color: #fff;
            font-size: 14px;
            text-align: center;
        }

        /* Background Styles for Slides */
        .slide.bg-1 {
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
        }

        .slide.bg-2 {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            background-attachment: fixed;
        }

        .slide.bg-3 {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            background-size: cover;
        }

        .slide.bg-4 {
            background: linear-gradient(135deg, #fa709a, #fee140);
            background-position: center;
        }

        .slide.bg-5 {
            background: linear-gradient(135deg, #a18cd1, #fbc2eb);
        }
    </style>
</head>

<body>
    <div class="slide bg-1 active">
        <h1>Welcome to My Portfolio</h1>
        <p>By [Your Name]</p>
    </div>
    <div class="slide bg-2">
        <h2>About Me</h2>
        <p>Name: [Your Name]</p>
        <p>Profession: [Your Profession]</p>
        <p>Experience: [X years in the field]</p>
    </div>
    <div class="slide bg-3">
        <h2>Skills</h2>
        <h3>Technical</h3>
        <ul>
            <li>[Skill 1]</li>
            <li>[Skill 2]</li>
            <li>[Skill 3]</li>
        </ul>
        <h3>Non-Technical</h3>
        <ul>
            <li>[Skill 1]</li>
            <li>[Skill 2]</li>
        </ul>
    </div>
    <div class="slide bg-4">
        <h2>Projects</h2>
        <h3>Project 1</h3>
        <p>Description: [Brief Description]</p>
        <p>Role: [Your Role]</p>
        <p>Outcome: [Results]</p>
        <h3>Project 2</h3>
        <p>Description: [Brief Description]</p>
        <p>Role: [Your Role]</p>
        <p>Outcome: [Results]</p>
    </div>
    <div class="slide bg-5">
        <h2>Education</h2>
        <p>Degree: [Your Degree]</p>
        <p>Institution: [Your Institution]</p>
        <p>Year: [Year of Completion]</p>
        <p>Thank you for your time!</p>
    </div>
    <div class="nav">
        <button onclick="prevSlide()">Previous</button>
        <button onclick="nextSlide()">Next</button>
    </div>
    <footer>
        &copy; 2025 [Your Name]. All rights reserved.
    </footer>
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }
    </script>
</body>

</html>