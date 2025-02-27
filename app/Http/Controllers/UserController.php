<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function showLogin (){
        return view('auth/login');
    }


public function login(Request $request)
{
    $validator = Validator::make($request->all(), [ // Ajout de `$`
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
        $request->session()->regenerate();
        session()->flash('status', 'Vous êtes connecté avec succès.');
        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'Les identifiants sont incorrects.',
    ])->withInput();
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Déconnexion réussie.');
    }

    
    public function showResetPassword(){
        return view('auth/resetPassword');
    }
   

    public function showRegistrationForm(Request $request)
{
    try {
        $token = $request->query('token');
        
        if (!$token) {
            return redirect()->route('login')
                ->with('error', 'Token d\'invitation manquant.');
        }
    
        $invitation = Invitation::where('token', $token)
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->firstOrFail();
    
        return view('auth.register', compact('invitation'));
        
    } catch (\Exception $e) {
        Log::error('Erreur lors de l\'affichage du formulaire d\'inscription', [
            'token' => $token,
            'error' => $e->getMessage()
        ]);
        
        return redirect()->route('login')
            ->with('error', 'Token d\'invitation invalide ou expiré.');
    }
}


public function register(Request $request)
{
    $validated = $request->validate([
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'token' => ['required', 'string']
    ]);

    try {
        DB::beginTransaction();

        // Vérification de l'invitation
        $invitation = Invitation::where('token', $validated['token'])
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$invitation) {
            throw new \Exception('Invitation non valide ou expirée');
        }

        // Vérification du rôle
        $role = Role::where('name', $invitation->role)->first();
        if (!$role) {
            throw new \Exception('Rôle non trouvé : ' . $invitation->role);
        }

        // Création de l'utilisateur
        $user = User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        if (!$user) {
            throw new \Exception('Échec de la création de l\'utilisateur');
        }

        // Attribution du rôle
        $user->roles()->attach($role->id);

        // Mise à jour de l'invitation
        $invitation->update([
            'is_used' => true,
            'used_at' => now()
        ]);

        DB::commit();
        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Inscription réussie!');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Erreur détaillée lors de l\'inscription', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'validated_data' => array_merge($validated, ['password' => '[HIDDEN]']),
            'token' => $validated['token'] ?? null,
            'email' => $validated['email'] ?? null
        ]);

        $errorMessage = env('APP_DEBUG') 
            ? 'Erreur : ' . $e->getMessage()
            : 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.';

        return redirect()->back()
            ->withInput($request->except('password', 'password_confirmation'))
            ->with('error', $errorMessage);
    }
}

}




