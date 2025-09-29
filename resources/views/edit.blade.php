<!DOCTYPE html>
<html>
<head>
    <title>Modifier Utilisateur</title>
</head>
<body>
    <h1>Modifier l'Utilisateur</h1>

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nom:</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
        </div>

        <button type="submit">Modifier</button>
    </form>

    <a href="/users">Retour à la liste</a>
</body>
</html>
