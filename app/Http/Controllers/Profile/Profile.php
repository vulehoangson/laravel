<?php
namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        
    }

    public function process($iUserId)
    {
        return view('profile',[]);
    }
}