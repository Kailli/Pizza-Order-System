<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function createContact(Request $request){

        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_email'=> 'required',
            'user_message' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $data=$this->requestUserData($request);
        Contact::create($data);
        return back()->with(['contactSuccess'=>"Message Send!"]);
    }

    public function contactList(){
        $data = Contact::orderBy('contact_id','desc')->paginate(7);
        if(count($data)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
        return view('admin.contact.list') -> with(['contact'=> $data, 'status'=>$emptyStatus]);
    }

    public function contactSearch(Request $request){
        $searchData = Contact::orWhere('user_name','like','%'.$request->searchData.'%')
                        ->orWhere('user_email','like','%'.$request->searchData.'%')
                        ->orWhere('user_message','like','%'.$request->searchData.'%')
                        ->paginate(7);
        $searchData -> appends($request->all());
        if(count($searchData)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
        return view('admin.contact.list')-> with(['contact' => $searchData, 'status'=>$emptyStatus]);
    }

    private function requestUserData($request){
        return[
            'user_id' => auth()->user()->id,
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_message'=> $request->user_message,
        ];
    }
}
