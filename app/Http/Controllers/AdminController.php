<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function showDashboard()
    {
        return view('admin/dashboard');
    }

    public function showFormInvite()
    {
        return view('admin/formInvitation');
    }


    public function sendInvitation(Request $request)
    {
        try {
            Log::info('Début de sendInvitation', ['request' => $request->all()]);
    
            $validated = $request->validate([
                'email' => [
                    'required',
                    'email',
                    function ($attribute, $value, $fail) {
                        if (\App\Models\User::where('email', $value)->exists()) {
                            $fail('Cet email appartient déjà à un utilisateur existant.');
                        }
                    }
                ],
                'role' => 'required|in:developer,client'
            ]);
    
            $invitation = new \App\Models\Invitation();
            $invitation->email = $validated['email'];
            $invitation->token = \Illuminate\Support\Str::random(32);
            $invitation->role = $validated['role'];
            $invitation->is_used = false;
            $invitation->expires_at = now()->addHours(24);
    
            $saved = $invitation->save();
    
            if (!$saved) {
                throw new \Exception('Échec de la sauvegarde de l\'invitation');
            }
    
            try {
                Mail::to($validated['email'])->send(new InvitationMail($invitation));
                Log::info('Email envoyé avec succès', ['email' => $validated['email']]);
            } catch (\Exception $e) {
                Log::error('Erreur lors de l\'envoi de l\'email', [
                    'error' => $e->getMessage(),
                    'email' => $validated['email']
                ]);
                throw new \Exception('Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
            }
    
            return redirect()->route('admin.dashboard')
                ->with('success', 'Invitation envoyée avec succès !');
    
        } catch (\Exception $e) {
            Log::error('Erreur dans sendInvitation', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return redirect()->back()
                ->with('error', 'Erreur: ' . $e->getMessage())
                ->withInput();
        }
    }
    }

