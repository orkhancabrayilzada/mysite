<?php

namespace App\Modules\admin\About\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\admin\about\Model\about;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $about = About::first();
        return view('About::index',compact('about'));
    }
    public function update(Request $request)
    {
        // id verilənini alırıq
        $aboutId = $request->input('id');

        // about modelini id-ə əsasən tapırıq
        $about = About::find($aboutId);

        if ($about) {
            $about->name = $request->input('name');
            $about->title = $request->input('title');
            $about->description = $request->input('description');
            $about->phone = $request->input('phone');
            $about->email = $request->input('email');
            $about->age = $request->input('age');
            $about->occupation = $request->input('occupation');
            $about->nationality = $request->input('nationality');
            $about->short_description = $request->input('short_description');
            $about->long_description = $request->input('long_description');
            $about->status = $request->input('status');

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');  // public diskinde images klasörüne kaydediyoruz
                $about->image = $imagePath;
            }


            // Yekunlaşdırıb saxlayırıq
            $about->save();

            // Yönləndirmə və ya digər əməliyyat
            return redirect()->route('admin.about')->with('success', 'Məlumat uğurla yeniləndi.');
        }

        // Əgər belə bir qeyd yoxdursa, səhv mesajı
        return back()->with('error', 'Qeyd tapılmadı.');
    }
}
