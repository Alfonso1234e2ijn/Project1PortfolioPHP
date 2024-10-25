<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-image: url('https://wallpapers.com/images/hd/stage-background-lgplkhaboiphsco0.jpg');
            color: #333;
            margin: 0;
        }

        h1 {
            font-size: 2.5em;
            margin: 20px 0;
            color: #007BFF;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h1>Escena360º</h1>
    <form action="../view/login_view.php" method="get">
        <input type="submit" value="Login">
    </form>
</body>

</html>