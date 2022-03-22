<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class PizzaController extends Controller
{
    public function pizza(){
        $data=Pizza::paginate(5);

        //data has or not condition

        if(count($data)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }

        return view('admin.pizza.pizzalist')->with(['pizza'=>$data,'status'=>$emptyStatus]);
    }

    public function createPizza(){
        $category= Category::get();
        return view('admin.pizza.create')->with(['category'=>$category]);
    }

    public function insetPizza(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' =>'required',
            'public' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'b1g1' =>'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $file=$request->file('image');
        $fileName=uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/uploads/',$fileName );


        $data=$this->requestPizzaData($request,$fileName);
        Pizza::create($data);

        return redirect()->route('admin#pizza')-> with(['createPizzaSuccess'=>'Pizza created....']);

    }

    public function deletePizza($id){
        $data= Pizza::select('image')->where('pizza_id',$id)->first();
        $fileName=$data['image'];


        Pizza::where('pizza_id',$id)->delete();//database delete

        if(File::exists(public_path().'/uploads/'.$fileName )){
            File::delete(public_path().'/uploads/'.$fileName );
        }


        return back()->with(['deleteSuccess'=>"Deleted Successfully Pizza...."]);
    }

    public function pizzaInfo($id){
        $data=Pizza::where('pizza_id',$id)->first();
        return view('admin.pizza.info')->with(['pizza'=>$data]);
    }

    public function editPizza($id){
        $category= Category::get();
        $data=Pizza::select('pizzas.*','categories.category_id','categories.category_name')
        ->join('categories','categories.category_id' ,'pizzas.category_id')
        ->where('pizza_id',$id)
        ->first();

        return view('admin.pizza.edit')->with(['pizza'=>$data,'category'=>$category]);
    }

    public function updatePizza($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' =>'required',
            'public' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'b1g1' =>'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $updateData=$this->requestUpdatePizzaData($request);

        if(isset($updateData['image'])){
            //get old image
            $data=Pizza::select('image')->where('pizza_id',$id)->first();
            $fileName=$data['image'];

            //old image delete
            if(File::exists(public_path().'/uploads/'.$fileName)){
                File::delete(public_path().'/uploads/'.$fileName);
            }

            //get new image
            $file=$request->file('image');
            $fileName=uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/uploads/',$fileName );


            //update to database
            $updateData['image']=$fileName;

            Pizza::where('pizza_id',$id)->update($updateData);
            return redirect()->route('admin#pizza')->with(['updatePizzaSuccess'=>"Update Successfully!!"]);

        }
            Pizza::where('pizza_id',$id)->update($updateData);
            return redirect()->route('admin#pizza')->with(['updatePizzaSuccess'=>"Update Successfully!!"]);



    }

    //search pizza
    public function searchPizza(Request $request){
        $searchKey=$request->table_search;
        $searchData=Pizza::orwhere('pizza_name','like','%'.$searchKey.'%')
                            ->orwhere('price',$searchKey,'%'.$searchKey.'%')
                            ->paginate(5);

        Session::put('PIZZA-SEARCH',$searchKey);

        $searchData->appends($request->all());

        if(count($searchData)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
        return view('admin.pizza.pizzalist ')->with(['pizza'=>$searchData,'status'=>$emptyStatus]);
    }

    public function downloadPizza(){
        if(Session::has('PIZZA-SEARCH')){
            $pizza= Pizza::orwhere('pizza_name','like','%'.Session::get('PIZZA-SEARCH').'%')
                            ->orwhere('price',Session::get('PIZZA-SEARCH'),'%'.Session::get('PIZZA-SEARCH').'%')
                            ->get();
        }else{
            $pizza= Pizza::get();
        }

        $csvExporter = new \Laracsv\Export();

        $csvExporter->build($pizza, [
            'pizza_id' => 'ID',
            'pizza_name' => 'Pizza Name',
            'price' => 'Price',
            'public_status' => 'Public Status',
            'discount_price' => 'required',
            'buy_one_get_one_status' =>'Buy1 Get1 Status',
            'waitingTime' => 'Waiting Time',
            'description' => 'Description',
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date'
        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'pizza.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }

    private function requestUpdatePizzaData($request){
        $arr=[
            'pizza_name' => $request->name,
            'price' => $request->price,
            'public_status' => $request->public,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->b1g1,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        if(isset($request->image)){
            $arr['image']=$request->image;
        }

       return $arr;
    }

    private function requestPizzaData($request,$fileName){
        return [

            'pizza_name' => $request->name,
            'image'=>$fileName,
            'price' => $request->price,
            'public_status' => $request->public,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->b1g1,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

}
