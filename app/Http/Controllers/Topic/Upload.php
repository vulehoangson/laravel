<?php
namespace App\Http\Controllers\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UploadController extends Controller
{
    public function process(Request $request )
    {
        return view('upload',[]);
    }
}