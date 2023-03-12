<?php

namespace App\Http\Controllers;

// use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Mail\Notification;
use PDF;
// use Mail;
class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(Request $request)
     {
         $title = 'Email Send';
        return view('email',compact('title'));

     }

    public function template($msg){
        
        return view('emailtemplate',compact('msg'));
    }

    public function email(Request $request)
    {
        // dd($request->all());

        $path = public_path('uploads/');
        $attachment = $request->file('attachment');

        $name = time().'.'.$attachment->getClientOriginalExtension();;

        // create folder
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $attachment->move($path, $name);
        $files = [
           $path.'/'.$name ,
        ];

         $email  =  $request->email;
        $subject = $request->subject;
        // $msg = $request->message;
         $content=$request->message;
       
         
            Mail::send(array(),array(), function($message) use ($content,$email,$subject,$files)
            {
               

                $message->to($email)
                        ->subject($subject)
                        ->from(Config::get('mail.from.address'),Config::get('mail.from.name'))
                        ->text($content);
                     foreach ($files as $file){
                    $message->attach($file);
                      }   
            });
            toastr()->success('Mail Sent successful');
                return redirect(route('email.view'));
    }


 
}
