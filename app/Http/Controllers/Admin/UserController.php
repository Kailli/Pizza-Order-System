<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userList(){
        $userData=User::where('role','user')->paginate(7);
        return view('admin.user.userList')->with(['user'=>$userData]);
    }

    public function adminList(){
        $adminData=User::where('role','admin')->paginate(7);
        return view('admin.user.admin_list')->with(['admin'=>$adminData]);
    }

    public function userSearch(Request $request){
        $searchData= $this->searchData($request->searchData,'user',$request);
        return view('admin.user.userList')->with(['user'=>$searchData]);

    }

    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>"User Deleted!"]);
    }

    public function adminSearch(Request $request){

        $searchData= $this->searchData($request->searchData,'admin',$request);
        return view('admin.user.admin_list')->with(['admin'=>$searchData]);

    }

    private function searchData($key,$role,$request){
        $searchData= User::where('role',$role)
                     ->where(function ($query) use($key) {
                        $query ->orwhere('name', 'like', '%'.$key.'%')
                                ->orwhere('email', 'like', '%'.$key.'%')
                                ->orwhere('phone', 'like', '%'.$key.'%')
                                ->orwhere('address', 'like', '%'.$key.'%');
                    })
                    ->paginate(7);
        $searchData->appends($request->all());
        return $searchData;
    }
}
