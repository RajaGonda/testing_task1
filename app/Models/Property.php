<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Image;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_type_id',
        'county',
        'country',
        'town',
        'description',
        'address',
        'image',
        'latitude',
        'longitude',
        'num_bedrooms',
        'num_bathrooms',
        'price',
        'type',
    ];

    public static function uploadDir($url = null)
    {
        $folder = '/uploads/property';
        if ($url == 'url') {
            return url($folder . '/');
        } else {
            return public_path($folder);
        }
    }

    public static function uploadImage($request, $input, $oldImage = null)
    {
        if ($request->hasFile($input)) {
            $imagefilesTypes = array(
                'jpeg', 'png', 'jpg', 'gif'
            );

            $file = $request->file($input);
            $uploadPath = self::uploadDir();
            $extension = $file->getClientOriginalExtension();
            $fileName = 'gallery_' . uniqid() . '_' . time() . '.' . $extension;
            $file->move($uploadPath, $fileName);
            $optmize_image = $uploadPath . '/' . $fileName;
            $optmize_thumbnail_image = $uploadPath . '/thumbnail/' . $fileName;

            if (in_array($extension, $imagefilesTypes)) {
                $img = Image::make($optmize_image);
                $img->orientate();
                $img->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($optmize_thumbnail_image, 100);
            }
            if ($oldImage != null) {
                if ($oldImage != null && $fileName != '') {
                    File::delete($uploadPath . '/' . $oldImage);
                }
            }
            return $fileName;
        }
    }


    public function getPropertyType()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id', 'id');
    }
}
