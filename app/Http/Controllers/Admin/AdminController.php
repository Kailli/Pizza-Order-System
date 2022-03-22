<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function profile(){
        $id=auth()->user()->id;
        $userData=User::where('id',$id)->first();
        return view('admin.profile.index')->with(['user'=>$userData]);
    }

    public function updateProfile($id,Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //user data update Part
        $updateData=$this->requestUserData($request);
        User::where('id',$id)->update($updateData);
        return back()->with(['updateSuccess'=>'User Information Updated!....']);
        }

        public function changePassword($id,Request $request){

            $validator = Validator::make($request->all(), [
                'oldPassword' => 'required',
                'newPassword' => 'required',
                'confirmPassword' => 'required',

            ]);
            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }

        //return back()->with(['passwordError'=>'Need To All Password Filled!']);

        $oldPassword= $request->oldPassword;
        $newPassword= $request->newPassword;
        $confirmPassword= $request->confirmPassword;

        //To get within database to get
        $data=User::where('id',$id)->first();
        $hashValue=$data['password'];

        if(Hash::check($oldPassword,$hashValue)){
           if($newPassword != $confirmPassword){
            return back()->with(['notSame'=>"Password are not Same!"]);
           }
           else{
               if(strlen($newPassword) < 5){
                return back()->with(['lengthEr'=>"Password must have greater than 6!"]);
               }
               else{
                   $hash = Hash::make($newPassword);
                    User::where('id',$id)->update([
                        'password' => $hash,
                    ]);
               }
           }
        }
        else{
            return back()->with(['wrongPw'=>"Wrong Password!"]);
        }

        // $dbHashPassword=User::select('password')
        // ->where('id',$id)->first()->toArray();//To get within database to get

        //dd($dbHashPassword);

        }

        public function changePasswordPage(){
            return view('admin.profile.changePassword');
        }

    private function requestUserData($request){
        return[
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'address'=>$request->address,
        ];
    }


}
