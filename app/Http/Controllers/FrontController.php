<?php

namespace App\Http\Controllers;

use App\Modules\admin\About\Model\About;
use App\Modules\admin\Contact\Model\Contact;
use App\Modules\admin\Home\Model\Home;
use App\Modules\admin\Portfolio\Model\Portfolio;
use App\Modules\admin\Questions\Model\Question;
use App\Modules\admin\Resume\Model\Resume;
use App\Modules\admin\Services\Model\Service;
use App\Modules\admin\Settings\Model\Setting;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $about = About::first();
        $contact = Contact::first();
        $home = Home::first();
        $portfolio = Portfolio::with('categories')->get();
        $questions = Question::first();
        $resume = Resume::first();
        $services = Service::first();
        $settings = Setting::first();


        return view('front.index', compact('about', 'contact', 'home', 'portfolio', 'questions', 'resume','services', 'settings'));

    }
}
