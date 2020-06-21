<?php

namespace App\Http\Controllers\Food;
use App\Food\Product;
use App\Food\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(){
        return view('food.product', ['category' => $this->category()]);
    }
    public function rows(){
        //return \DB::table('view_product')->orderBy('id','desc')->paginate(5);
        return Product::orderBy('id','desc')->paginate(5);
    }

    public function rowsByCate($cate) {
        if($cate == "__all") {
            return \DB::table('view_product')->get();
        }else {
            return \DB::table('view_product')->where('category' , $cate)->get();
        }
    }

    public function category() {

       return Category::select('id','name','name_kh')->get();
    }


    public function save(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'price' => 'required|numeric',
            'photo' => 'required',
            'category' => 'required',
        ]);
        if($request->photo){
            $name = time().$request->name . '.'
             . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ";")))[1])[1];
            Image::make($request->photo)->save(public_path('img/food/').$name);
        }
      

        $product = Product::create([
            'name' => $request['name'],
            'name_kh' => $request['name_kh'],
            'price' => $request['price'],
            'photo' => $name,
            'dsc' => $request['dsc'],
            'category' => $request['category'],
           
            
        ]);
        
        return response()->json(['product' => $product]);
 }
   public function update(Request $request, $id)
   {
       $product = Product::find($id);
       $this->validate($request, [
        'name' => 'required|string|max:255',
        'name_kh' => 'required|string|max:255',
        'price' => 'required|numeric',
        'photo' => 'required',
    ]);
    $curPhoto = $product->photo;
    if($request->photo != $curPhoto) {
        $name = time().$request->name . '.'
        . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ";")))[1])[1];
       Image::make($request->photo)->save(public_path('img/food/').$name);
       $request->merge(['photo' => $name]);
        
       $photo = public_path('img/food/'). $curPhoto;
       if(file_exists($photo)){
           @unlink($photo);
       }

    }
    $product->update($request->all());
    return response()->json(['product' => $product]);
   }

}
