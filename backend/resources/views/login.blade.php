<!-- resources/views/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
    @if(session('error'))
        <script>
            alert('{{ session('error') }}');
        </script>
    @endif

    <form action="{{ route('zaloguj-uzytkownika') }}" method="post">
        @csrf
        <label for="name">Login:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password"  required>

        <button type="submit">Zaloguj</button>
    </form>
</body>
</html>
