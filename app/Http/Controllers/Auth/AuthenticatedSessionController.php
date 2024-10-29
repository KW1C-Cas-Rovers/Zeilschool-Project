<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerate the session
            $request->session()->regenerate();

            // Check if boat_id exists in the request
            if ($request->has('boat_id')) {
                return redirect()->intended(route('calendar', ['boat_id' => $request->input('boat_id')]));
            }

            // Redirect to the dashboard if there's no boat_id
            return redirect()->intended(route('dashboard'));
        }

        // Return back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
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

    public function authenticated(Request $request, $user)
    {
        // If there is a redirect URL in the session, use that; otherwise, go to the default route
        return redirect()->intended($request->input('redirect', route('dashboard')));
    }
}
