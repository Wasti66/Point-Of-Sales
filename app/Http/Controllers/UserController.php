<?php

namespace App\Http\Controllers;
use App\Helper\JWTToken;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{

    function UserLoginPage(){
        return view('pages.auth.userLogin-page');
    }
    function UserRegistrationPage(){
        return view('pages.auth.UserRegistration-page');
    }
    function VerifyOtpPage(){
        return view('pages.auth.verifyOtpPage');
    }
    function sentOtpPage(){
        return view('pages.auth.sendOtp-page');
    }
    function ResetPasswordPage(){
        return view('pages.auth.resetPasswordPage');
    } 
    function logOut(){
        return redirect('/userLogin')->cookie('token','',-1);
    }
    /*function userDashboard(){
        return view('pages.dashboard.dashboard');
    }*/
    function userProfilePage(){
        return view('pages.dashboard.userProfilePage');
    }
    function userChangePassword(){
        return view('pages.dashboard.settingsPage');
    }

    //backend api
    //User Registration api
    public function UserRegistration(Request $request){
        try{
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'userName' => $request->input('userName'),
                'password' => $request->input('password'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Registration successfully'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                //'message' => $e->getMessage(),
                'message' => 'User registration failed'
            ], 401);
        }
        
    }

    //user login api
    public function UserLogin(Request $request){

        try{
            $user = User::where(function ($query) use ($request) {
                $query->where('email', $request->input('email'))
                      ->orWhere('userName', $request->input('email'));
            })
            ->where('password', $request->input('password'))
            ->select('id')->first();
    
            if($user != null){
    
                $token = JWTToken::createToken(
                    $request->input('email'),
                    $request->input('userName'),
                    $user->id
                );
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successfully',
                    //'token' => $token
                ], 200)->cookie('token',$token,60*24*30);
    
    
            }else{
                return response()->json([
                    'status' => 'failed',
                    //'message' => $e->getMessage(),
                    'message' => 'unauthorized'
                ], 401);
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
                //'message' => $e->getMessage()
            ],500);
            
        }
        
    }

    //send otp code
    function sendOtpCode(Request $request){

        try{

            $email = $request->input('email');
            $otp = rand(1000,9999);
            $count = User::where('email','=',$email)->count();
    
            if($count == 1){
                //send otp code user email
                Mail::to($email)->send(new OTPMail($otp));
                
                //otp code update database table
                User::where('email','=',$email)->update(['otp'=>$otp]);
                return response()->json([
                    'status' => 'success',
                    'message' => '4 digit OTP code has been send your email'
                ],200);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid Email'
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                //'message' => 'OTP code send failed'
                'message' => $e->getMessage()
            ],500);
        }


    }
    //verify otp
    function verifyOTP(Request $request){
        
        try{

            $email = $request->input('email');
            $otp = $request->input('otp');
            $count = User::where('email','=',$email)->where('otp','=',$otp)->count();

            if($count == 1){

                //database otp update 
                User::where('email','=',$email)->update(['otp'=>'0']);

                //password reset token issue
                $token = JWTToken::createTokenSetPass($request->input('email'));
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP code verification successfully',
                    //'token' => $token
                ],200)->cookie('token',$token,60*24*30);;

            }else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'OTP code Invalid'
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ],500);
        }

    }

    //resetPassword
    function ResetPassword(Request $request){
        try{

            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email','=',$email)->update(['password'=>$password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Password change successfully'
            ],200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                //'message' => 'OTP code send failed'
                'message' => $e->getMessage()
            ],500);
        }
        
    }
    //user profile
    function userProfile(Request $request){
        $email = $request->header('email');
        $user = User::where('email', '=', $email)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Request successfully',
            'data' => $user
        ],200);
    }
    //update profile
    function updateProfile(Request $request){
        try{

            $email = $request->header('email');

            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $userName = $request->input('userName');
            $phone = $request->input('phone');

            

            User::where('email', '=', $email)->update([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'userName' => $userName,
                'phone' => $phone
            ]);

            

            return response()->json([
                'status' => 'success',
                'message' => 'Update successfully'
            ],200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'
            ],200);
        }
        
    }
    //change password
    function changePassword(Request $request){
        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $id = $request->header('id');

        $user = User::find($id);

        if (!$user) {
            return response()->json(['status' => 'failed', 'message' => 'User not found'], 404);
        }

        if ($user->password !== $current_password) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Current password does not match'
            ], 400);
        }

        $user->password = $new_password;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password changed successfully'
        ], 200);
    }


}
