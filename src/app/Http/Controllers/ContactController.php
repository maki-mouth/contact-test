<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all()->unique('content');

        return view('index', compact('categories'));
    }
    
    public function confirm(ContactRequest $request)
    {
        $contact = new Contact();
        $contact->fill($request->all())->save();

        $genderMap = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        return view('confirm', compact('contact', 'genderMap'));
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function register()
    {
        return view('/register');
    }

}
