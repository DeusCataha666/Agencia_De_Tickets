<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Serve the authenticated user's profile photo directly from storage.
     * Works in production without needing a public symlink.
     */
    public function photo()
    {
        $user = Auth::user();

        if (!$user->photo || !Storage::disk('public')->exists($user->photo)) {
            abort(404);
        }

        $file     = Storage::disk('public')->get($user->photo);
        $mime     = Storage::disk('public')->mimeType($user->photo);
        $modified = Storage::disk('public')->lastModified($user->photo);

        return response($file, 200)
            ->header('Content-Type', $mime)
            ->header('Cache-Control', 'private, max-age=86400')
            ->header('Last-Modified', gmdate('D, d M Y H:i:s', $modified) . ' GMT');
    }

    /**
     * Update the authenticated user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user        = Auth::user();
        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            // Eliminar foto anterior
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->photo = $request->file('photo')->store('profile_photos', 'public');
        }

        $user->save();

        return response()->json([
            'message'   => 'Perfil actualizado con éxito.',
            // URL que pasa por Laravel — funciona con y sin symlink
            'photo_url' => $user->photo ? route('profile.photo') : null,
        ]);
    }
}
