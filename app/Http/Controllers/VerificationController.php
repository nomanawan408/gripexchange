<?php

namespace App\Http\Controllers;

use App\Mail\verificationMail;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    //
    public function index(){
        return view('dashboard.verification.index');
    }

    public function emailVerificationShow(){
        return view('dashboard.verification.email-verification'); 
    }

    
    // PHONE VERIFICATION -----------------------------------------------------------
    
    // public function sendCode(Request $request)
    // {
    //     $request->validate(['phone_number' => 'required|regex:/^03[0-9]{2}-[0-9]{7}$/']);
        
    //     $code = rand(100000, 999999);
    //     $phoneNumber = $request->phone_number;
        
    //     // Store code in cache or database
    //     Cache::put('phone_verification_' . $phoneNumber, $code, 300); // 5 minutes

    //      // Send SMS using Twilio
    //      $this->twilio->messages->create(
    //         $phoneNumber,
    //         [
    //             'from' => env('TWILIO_PHONE_NUMBER'),
    //             'body' => "Your verification code is: $code"
    //         ]
    //     );

    //     return response()->json(['success' => true, 'message' => 'Verification code sent successfully!']);
   
    // }

    // public function verifyCode(Request $request)
    // {
    //     $request->validate([
    //         'phone_number' => 'required',
    //         'phone_code' => 'required',
    //     ]);

    //     $code = Cache::get('phone_verification_' . $request->phone_number);

    //     if ($code && $code == $request->phone_code) {
    //         // Verification successful, mark user as verified
    //         $user = User::where('phone_number', $request->phone_number)->first();
    //         $user->phone_verified_at = now();
    //         $user->save();

    //         return redirect()->route('dashboard')->with('status', 'Phone number verified successfully!');
    //     } else {
    //         return redirect()->back()->withErrors(['phone_code' => 'Invalid verification code.']);
    //     }
    // }


// PHONE VERIFICATION -----------------------------------------------------------


    public function identityVerificationShow(){
        return view('dashboard.verification.identity-verification'); 
    }

    public function identityVerification(Request $request){
        $request->validate([
            'cnic_front' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'cnic_back' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg']
        ]);
            $user = auth()->user();
            $cnic_front_name = null;
            $cnic_back_name = null;

            if ($request->hasFile('cnic_front')) {
                $cnic_front_name = time() . '-front-' . $user->id . '.' . $request->cnic_front->extension();
                $request->cnic_front->move(public_path('identity/' . $user->id), $cnic_front_name);
                $user->cnic_front = $cnic_front_name;
            }

            if ($request->hasFile('cnic_back')) {
                $cnic_back_name = time() . '-back-' . $user->id . '.' . $request->cnic_back->extension();
                $request->cnic_back->move(public_path('identity/' . $user->id), $cnic_back_name);
                $user->cnic_back = $cnic_back_name;
            }

            $user->save();

        return redirect()->route('verification.index')->with('message', 'Identity Verification Successfully Submited');
    }


    public function sendEmailVerification(Request $request){
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect()->back()->with('error', 'Email is invalid, try with valid email.!');
        }

        if($user->hasVerifiedEmail()){
            return redirect()->back()->with('error', 'Email already verified');
        }

        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.index')->with('message', 'Verification link sent to your email('. $request->email.')');
    }

    public function __invoke(EmailVerificationRequest $request)
    {
        $request->fulfill();

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard.index')->with('success', 'Your email has been verified successfully!');
    }

    
       
    
}
