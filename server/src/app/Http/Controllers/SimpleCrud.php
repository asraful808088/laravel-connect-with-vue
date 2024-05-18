<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Users;

class SimpleCrud extends Controller
{
    
    public function index()
    {
        $getResult = Users::all();
       
        return response()->json([
            "users"=> $getResult
 
         ]);
    }

    
    public function create()
    {
        
    }

   
    public function store(Request $request)
    {
        $email = $request->get("email");
        $number = $request->get("number");
        $username = $request->get("username");
        $filePath = $request->file('file')->store('uploads');
        $fileName = basename($filePath);
        Users::insert([
           
            "email"=>  $email,
            "number"=>  $email,
            "username"=>$username,
            "image"=> $fileName
        ]);
        
       
      
        return response()->json([
           "users"=>Users::all()

        ]);
    }

  
    public function show($id)
    {
        
    }

 
    public function edit($id)
    {
        
    }

   
    public function update(Request $request, $id)
    {
        
    }

   
    public function destroy($id)
    {

        Log::channel('mycustomchannel')->info($id);
        Users::destroy($id);
        $getResult = Users::all();
       
        return response()->json([
            "users"=> $getResult
 
         ]);
    }
}
