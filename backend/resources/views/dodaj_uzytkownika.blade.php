<!-- resources/views/dodaj_uzytkownika.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Użytkownika</title>
</head>
<body>
    <form action="{{ route('dodaj-uzytkownika') }}" method="post">
        @csrf
        <label for="name">Imię:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Hasło:</label>
        <input type="password" name="password" required>

        <label for="phone_number">Numer telefonu:</label>
        <input type="text" name="phone_number">

        <label for="address">Adres zamieszkania:</label>
        <input type="text" name="address">

        <button type="submit">Dodaj Użytkownika</button>
    </form>
</body>
</html>
