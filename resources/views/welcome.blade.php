<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
</head>
<body>
    @auth
        <h1>Bienvenue, {{ auth()->user()->name }}!</h1>
        <p>Email: {{ auth()->user()->email }}</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>

        <div style="margin-top: 20px;">
            <a href="/users">Gérer les utilisateurs</a>
        </div>
    @else
        <h1>Bienvenue sur notre application</h1>

        <div style="display: flex; gap: 20px;">
            <div style="border: 1px solid #ccc; padding: 20px;">
                <h2>Nouveau ici?</h2>
                <a href="/register">Créer un compte</a>
            </div>

            <div style="border: 1px solid #ccc; padding: 20px;">
                <h2>Déjà membre?</h2>
                <a href="/login">Se connecter</a>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <p>Ou connectez-vous rapidement avec:</p>
            <a href="{{ route('google.login') }}">Google</a> |
            <a href="{{ route('github.login') }}">GitHub</a>
        </div>
    @endauth

    @if(session('success'))
        <div style="color: green; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif
</body>
</html>
