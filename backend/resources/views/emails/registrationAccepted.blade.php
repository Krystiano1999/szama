<!DOCTYPE html>
<html>
<head>
    <title>Akceptacja Rejestracji Restauracji</title>
</head>
<body>
    <h1>Witaj {{ $username }}</h1>
    <p>Twoja rejestracja restauracji została zaakceptowana.</p>
    <p>Twoje dane do logowania:</p>
    <ul>
        <li>Login: {{ $username }}</li>
        <li>Hasło: {{ $password }}</li>
    </ul>
    <p>Zalecamy zmianę hasła po pierwszym logowaniu.</p>
</body>
</html>