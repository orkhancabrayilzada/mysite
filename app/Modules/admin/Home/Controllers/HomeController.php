<?php

namespace App\Modules\admin\Home\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\admin\Home\Model\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $home = Home::first();
        return view('Home::index',compact('home'));
    }
    // Update metodu
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',  // Ensure 'title' is provided and is a string
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'status' => 'required|boolean',  // Assuming status is either 0 or 1
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if provided
        ]);
        // id verilənini alırıq
        $homeId = $request->input('id');

        // Home modelini id-ə əsasən tapırıq
        $home = Home::find($homeId);

        if ($home) {
            // Verilənləri güncəlləyirik
            $home->title = $request->input('title');
            $home->description = $request->input('description');
            $home->experience = $request->input('experience');
            $home->projects = $request->input('projects');
            $home->clients = $request->input('clients');
            $home->status = $request->input('status');

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');  // public diskinde images klasörüne kaydediyoruz
                $home->image = $imagePath;
            }


            // Yekunlaşdırıb saxlayırıq
            $home->save();

            // Yönləndirmə və ya digər əməliyyat
            return redirect()->route('admin.home')->with('success', 'Məlumat uğurla yeniləndi.');
        }

        // Əgər belə bir qeyd yoxdursa, səhv mesajı
        return back()->with('error', 'Qeyd tapılmadı.');
    }


}
