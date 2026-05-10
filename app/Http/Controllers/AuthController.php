<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if (! $user->is_active) {
                Auth::logout();

                return back()->withErrors(['email' => 'Akun Anda dinonaktifkan'])->onlyInput('email');
            }

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegister()
    {
        if (! config('auth.registration_enabled')) {
            abort(404);
        }

        $programs = Program::where('is_active', true)->orderBy('name')->get();

        return view('auth.register', compact('programs'));
    }

    public function register(Request $request)
    {
        if (! config('auth.registration_enabled')) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'program_first_choice' => 'required|exists:programs,id',
            'program_second_choice' => 'nullable|exists:programs,id|different:program_first_choice',
            'portfolio_file_first' => 'nullable|file|mimes:pdf,mp4,mov,avi,mkv,webm|max:20480',
            'portfolio_file_second' => 'nullable|file|mimes:pdf,mp4,mov,avi,mkv,webm|max:20480',
        ]);

        $firstProgram = Program::findOrFail($validated['program_first_choice']);
        $secondProgram = $validated['program_second_choice'] ? Program::findOrFail($validated['program_second_choice']) : null;

        // Validasi portofolio untuk program pilihan pertama
        if ($firstProgram->portfolio_required && ! $request->hasFile('portfolio_file_first')) {
            return back()->withErrors(['portfolio_file_first' => 'Portofolio wajib diunggah untuk program pilihan pertama.'])->withInput();
        }

        // Validasi portofolio untuk program pilihan kedua
        if ($secondProgram && $secondProgram->portfolio_required && ! $request->hasFile('portfolio_file_second')) {
            return back()->withErrors(['portfolio_file_second' => 'Portofolio wajib diunggah untuk program pilihan kedua.'])->withInput();
        }

        // Validasi bahwa portofolio tidak diunggah jika program tidak memerlukannya
        if (! $firstProgram->portfolio_required && $request->hasFile('portfolio_file_first')) {
            return back()->withErrors(['portfolio_file_first' => 'Program pilihan pertama tidak memerlukan portofolio.'])->withInput();
        }

        if ($secondProgram && ! $secondProgram->portfolio_required && $request->hasFile('portfolio_file_second')) {
            return back()->withErrors(['portfolio_file_second' => 'Program pilihan kedua tidak memerlukan portofolio.'])->withInput();
        }

        return DB::transaction(function () use ($validated, $request, $firstProgram, $secondProgram) {
            $photo = $request->file('photo');
            $photoFilename = Str::slug($validated['name'] . ' ' . $validated['email']) . '-' . now()->format('YmdHis') . '.' . $photo->extension();
            $photoPath = $photo->storeAs('user_photos', $photoFilename, 'public');

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'image' => $photoPath,
                'role' => 'user',
            ]);

            // Handle portfolio untuk program pilihan pertama
            $portfolioPathFirst = null;
            $portfolioUploadedAtFirst = null;

            if ($request->hasFile('portfolio_file_first')) {
                $portfolioFile = $request->file('portfolio_file_first');
                $portfolioFilename = Str::slug($validated['name'] . ' ' . $validated['email'] . ' portfolio first') . '-' . now()->format('YmdHis') . '.' . $portfolioFile->extension();
                $portfolioPathFirst = $portfolioFile->storeAs('portfolios', $portfolioFilename, 'public');
                $portfolioUploadedAtFirst = now();
            }

            // Handle portfolio untuk program pilihan kedua
            $portfolioPathSecond = null;
            $portfolioUploadedAtSecond = null;

            if ($request->hasFile('portfolio_file_second')) {
                $portfolioFile = $request->file('portfolio_file_second');
                $portfolioFilename = Str::slug($validated['name'] . ' ' . $validated['email'] . ' portfolio second') . '-' . now()->format('YmdHis') . '.' . $portfolioFile->extension();
                $portfolioPathSecond = $portfolioFile->storeAs('portfolios', $portfolioFilename, 'public');
                $portfolioUploadedAtSecond = now();
            }

            $attachData = [];

            // Pilihan pertama - selalu include semua kolom
            $attachData[$validated['program_first_choice']] = [
                'choice_order' => 1,
                'portfolio_path' => $portfolioPathFirst,           // null jika tidak upload
                'portfolio_uploaded_at' => $portfolioUploadedAtFirst, // null jika tidak upload
            ];

            if ($portfolioPathFirst) {
                $attachData[$validated['program_first_choice']]['portfolio_path'] = $portfolioPathFirst;
                $attachData[$validated['program_first_choice']]['portfolio_uploaded_at'] = $portfolioUploadedAtFirst;
            }

            // Pilihan kedua - selalu include semua kolom
            if (!empty($validated['program_second_choice'])) {
                $attachData[$validated['program_second_choice']] = [
                    'choice_order' => 2,
                    'portfolio_path' => $portfolioPathSecond,
                    'portfolio_uploaded_at' => $portfolioUploadedAtSecond,
                ];
            }

            $user->programs()->attach($attachData);

            Auth::login($user);

            return redirect()->route('user.dashboard');
        });
    }

    public function settings()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return view('auth.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (! Hash::check($data['old_password'], $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok']);
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }

    // ---------------------------------------------------------------------
    // password reset helpers
    // ---------------------------------------------------------------------

    public function showForgotPassword()
    {
        if (! config('auth.password_reset_enabled')) {
            abort(404);
        }

        return view('auth.forgot-password');
    }

    public function sendForgotPasswordLink(Request $request)
    {
        if (! config('auth.password_reset_enabled')) {
            abort(404);
        }

        $request->validate(['email' => 'required|email']);

        $status = \Illuminate\Support\Facades\Password::sendResetLink(
            $request->only('email')
        );

        return $status === \Illuminate\Support\Facades\Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPassword(string $token)
    {
        if (! config('auth.password_reset_enabled')) {
            abort(404);
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        if (! config('auth.password_reset_enabled')) {
            abort(404);
        }

        $data = $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = \Illuminate\Support\Facades\Password::reset(
            $data,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                \Illuminate\Support\Facades\Auth::login($user);
            }
        );

        if ($status === \Illuminate\Support\Facades\Password::PASSWORD_RESET) {
            $user = Auth::user();

            return redirect($user->role === 'admin' ? route('admin.dashboard') : route('user.dashboard'))
                ->with('success', __($status));
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}
