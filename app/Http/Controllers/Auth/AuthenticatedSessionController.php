<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $role = $request->route('role');
        return view('auth.login', compact('role'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Ambil role dari route parameter
        $expectedRole = $request->route('role');
        
        // Authenticate user terlebih dahulu
        $request->authenticate();

        $request->session()->regenerate();

        // Validasi role jika ada parameter role di URL
        if ($expectedRole) {
            $userRole = Auth::user()->role;
            
            // Mapping role untuk validasi
            $roleMapping = [
                'admin' => 'admin',
                'guru' => 'guru', 
                'siswa' => 'siswa'
            ];
            
            // Cek apakah role user sesuai dengan halaman login
            if (isset($roleMapping[$expectedRole]) && $userRole !== $roleMapping[$expectedRole]) {
                // Logout user jika role tidak sesuai
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Redirect kembali dengan error message
                return redirect()->route('login', ['role' => $expectedRole])
                    ->withErrors([
                        'role' => "Anda tidak memiliki akses untuk login sebagai {$expectedRole}. Silakan gunakan halaman login yang sesuai dengan role Anda."
                    ]);
            }
        }

        // Redirect ke dashboard sesuai role
        return $this->redirectToDashboard();
    }

    /**
     * Redirect user to appropriate dashboard based on role
     */
    private function redirectToDashboard(): RedirectResponse
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'admin':
                return redirect()->intended(route('admin.dashboard'));
            case 'guru':
                return redirect()->intended(route('dashboard')); // Sementara ke dashboard biasa, nanti bisa buat guru.dashboard
            case 'siswa':
                return redirect()->intended(route('dashboard'));
            default:
                return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}