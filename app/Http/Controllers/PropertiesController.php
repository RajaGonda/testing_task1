<?php

namespace App\Http\Controllers;


use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $apiKey;
    private $aplPath;
    public function __construct()
    {
        $this->apiKey = '';
        $this->aplPath ='https://trial.craig.mtcserver15.com/api/';
    }
    public function dummyImage($size = '600x400', $bg = 'cccccc', $coor = '000', $text = 'No Property Image')
    {
//    $responce = '';
        $imageUrl = "https://dummyimage.com/{$size}/{$bg}/{$coor}&text={$text}";
        return $imageUrl;
    }
    public function lists(Request $request, $id=null)
    {
        if($id != ''){
            $list = Property::where('id', $id)->with('getPropertyType')->first();

                if(!empty($list->image)){
                    $list->image_full = Property::uploadDir('url') . '/' . $list->image;
                    $list->image_thumbnail = Property::uploadDir('url') . '/thumbnail/' . $list->image;
                }else{

                    $list->image_full = self::dummyImage();
                    $list->image_thumbnail =self::dummyImage();
                }



            return response()->json(['error'=>false, 'item'=>$list]);
        }

       $lists = Property::with('getPropertyType')->paginate(2);

        $lists->map(function ($imageItem) {
            if(!empty($imageItem->image)){
                $imageItem->image_full = Property::uploadDir('url') . '/' . $imageItem->image;
                $imageItem->image_thumbnail = Property::uploadDir('url') . '/thumbnail/' . $imageItem->image;
            }else{
                $imageItem->image_full = self::dummyImage();
                $imageItem->image_thumbnail =self::dummyImage();
            }

        });

       return response()->json(['error'=>false, 'list'=>$lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'property_type_id' => 'required',
            'county' => 'required',
            'country' => 'required',
            'town' => 'required',
            'description' => 'required',
            'address' => 'required',
            'image' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'num_bedrooms' => 'required',
            'num_bathrooms' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);

        $post = new Property();
        $post->property_type_id= $request->input('property_type_id');
        $post->county= $request->input('county');
        $post->country= $request->input('country');
        $post->town= $request->input('town');
        $post->description= $request->input('description');
        $post->address= $request->input('address');
        if ($request->hasFile('image')) {
            $post->image = Property::uploadImage($request, 'image');
        }
        $post->latitude= $request->input('latitude');
        $post->longitude= $request->input('longitude');
        $post->num_bedrooms= $request->input('num_bedrooms');
        $post->num_bathrooms= $request->input('num_bathrooms');
        $post->price= $request->input('price');
        $post->type= $request->input('type');
        $post->save();
        return response()->json(['error'=>false, 'msg'=>'The post successfully added']);
    }


    public function update($id, Request $request)
    {
        $request->validate([
            'property_type_id' => 'required',
            'county' => 'required',
            'country' => 'required',
            'town' => 'required',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'num_bedrooms' => 'required',
            'num_bathrooms' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);
        $post = Property::find($id);
        $post->property_type_id = $request->input('property_type_id');
        $post->county= $request->input('county');
        $post->country= $request->input('country');
        $post->town= $request->input('town');
        $post->description= $request->input('description');
        $post->address= $request->input('address');
        if ($request->hasFile('image')) {
            $post->image = Property::uploadImage($request, 'image', $post->image);
        }
        $post->latitude= $request->input('latitude');
        $post->longitude= $request->input('longitude');
        $post->num_bedrooms= $request->input('num_bedrooms');
        $post->num_bathrooms= $request->input('num_bathrooms');
        $post->price= $request->input('price');
        $post->type= $request->input('type');
        $post->save();
        return response()->json(['error'=>false, 'msg'=>'The post successfully updated']);
    }

    public function delete($id)
    {
        $post = Property::find($id);

        $uploadPath = Property::uploadDir();


        if ($post->image != '') {
            File::delete($uploadPath . '/' . $post->image);
            File::delete($uploadPath . '/thumbnail/' . $post->image);
        }

        $post->delete();
        return response()->json(['error'=>false, 'msg'=>'The post successfully deleted']);
    }

}
