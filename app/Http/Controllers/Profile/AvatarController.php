<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        $path = Storage::disk('public')->put('images', $request->file('avatar'));

        if ($oldAvatar = auth()->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar);
        }

        auth()->user()->update([
            'avatar' => $path,
            'age' => $request->input('age')
        ]);
        return redirect(route('profile.edit'))->with('status', 'Avatar is updated');
    }
}
