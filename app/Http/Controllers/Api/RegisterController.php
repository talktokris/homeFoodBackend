<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
  /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

     
    public function clientRegisterEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role_id'] = 2;
        $user = User::create($input);
        $success['token'] =  $user->createToken('HomeFoodMobileApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function clientLoginEmail(Request $request)
    {

 
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id'=>2])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('HomeFoodMobileApp')->plainTextToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
        
    }

    //  ============ Vender Login ===============

    public function venderRegisterEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role_id'] = 1;
        $user = User::create($input);
        $success['token'] =  $user->createToken('HomeFoodMobileApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }

        /*========== Vender Otp Login & Register =============*/

        public function venderOtpRequest(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'country_id' => 'required|numeric|min:1|digits_between: 1,999',
                'mobile_no' => 'required|numeric|min:1|digits_between: 1,99999999999',
              
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            $input = $request->all();
            $findNumber =User::where([['mobile_no','=', $input['mobile_no']],['country_id','=', $input['country_id']]])->count(); 
           // return $findNumber;

           $genOtp = $this->optGenrate(); // genrate new otp

           if($findNumber>0){

            $user = User::where('country_id', $input['country_id'])
            ->where('mobile_no', $input['mobile_no'])
            ->update(['otp' => $genOtp]);
            return $this->sendResponse($user, 'Otp Requested successfully.');

           } 
           else 
           {
            $input['role_id'] = 2;
            $input['app_margin_per'] = $this->getMarginPer();
            $input['otp'] = $genOtp;
            $user = User::create($input);
            return $this->sendResponse($user, 'Otp Requested successfully.');
           }
       
           
        }

        public function venderOtpLogin(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'country_id' => 'required|numeric|min:1|digits_between: 1,999',
                'mobile_no' => 'required|numeric|min:1|digits_between: 1,99999999999',
                'otp' => 'required|string|min:6|max:6',
              
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
             $findNumber =User::where([['mobile_no','=', $request->mobile_no],['country_id','=',  $request->country_id],['role_id','=', 2],['otp','=',  $request->otp]])->count(); 
            // return $findNumber;
 
            if($findNumber>=1){ 
                $user = User::where([['mobile_no','=', $request->mobile_no],['country_id','=',  $request->country_id],['role_id','=', 2],['otp','=',  $request->otp]])->first();  
                Auth::login($user); 
               // $user = Auth::user(); 
                $success['token'] =  $user->createToken('HomeFoodVenderApp')->plainTextToken; 
                $success['name'] =  $user->name;
       
                return $this->sendResponse($success, 'User login successfully.');
            } 
            else{ 
                return $this->sendError('Unauthorised.', ['error'=>'Incorrect OTP']);
            } 

           
        }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function venderLoginEmail(Request $request)
    {

 
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id'=>2])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('HomeFoodMobileApp')->plainTextToken; 
            $success['name'] =  $user->name;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
        
    }
       /*========== Client Otp Login & Register =============*/

       public function clientOtpLogin(Request $request)
       {
           $validator = Validator::make($request->all(), [
               'name' => 'required',
               'email' => 'required|email|unique:users',
               'password' => 'required',
               'c_password' => 'required|same:password',
           ]);
      
           if($validator->fails()){
               return $this->sendError('Validation Error.', $validator->errors());       
           }
      
           $input = $request->all();
           $input['password'] = bcrypt($input['password']);
           $input['role_id'] = 1;
           $user = User::create($input);
           $success['token'] =  $user->createToken('HomeFoodMobileApp')->plainTextToken;
           $success['name'] =  $user->name;
      
           return $this->sendResponse($success, 'User register successfully.');
       }


       public function optGenrate(){

        return 123456 ;
        
       }

       public function getMarginPer(){

        return 10 ;
        
       }
  
}