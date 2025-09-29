<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        return view('register');
    }

    // TRAITEMENT DE L'INSCRIPTION
    public function register(Request $request)
    {
        $incomingField = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:150', 'confirmed'],
        ]);

        $incomingField['password'] = Hash::make($incomingField['password']);
        $user = User::create($incomingField);
        auth()->login($user);

        return redirect('/')->with('success', 'Compte créé avec succès!');
    }

    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('login');
    }

    // TRAITEMENT DE LA CONNEXION
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Connecté avec succès!');
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ])->onlyInput('email');
    }

    // DÉCONNEXION
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Déconnecté avec succès!');
    }

    // READ - Afficher tous les utilisateurs
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    // READ - Afficher un utilisateur spécifique
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    // UPDATE - Afficher le formulaire de modification
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    // UPDATE - Traitement de la modification
    public function update(Request $request, User $user)
    {
        $incomingField = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $user->update($incomingField);

        return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès');
    }

    // DELETE - Supprimer un utilisateur
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
