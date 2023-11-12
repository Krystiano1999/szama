<!-- resources/views/logged_in.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zalogowano pomyślnie</title>
</head>
<body>
    <h1>Witaj, {{ $user->name }}!</h1>

    <script>
        alert('Zalogowano pomyślnie');
    </script>
</body>
</html>
