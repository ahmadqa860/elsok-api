<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product_image extends Model
{

    static public function create_new($productId,$request=null){

        $ex = ['png', 'jpeg', 'jpg', 'gif', 'bmp'];
        
        $imagesCount = count($_FILES['uploadImages']['name']);

        if ($request->hasFile('uploadImages'))
        {
            for($count = 0;$count < $imagesCount;$count++){
                
                if (isset($_FILES['uploadImages']['name'][$count])) {
                
                    $file_info = pathinfo(($_FILES['uploadImages']['name'][$count]));
                    if (in_array(strtolower($file_info['extension']), $ex)) {
                        if (isset($_FILES['uploadImages']['tmp_name'][$count]) && is_uploaded_file($_FILES['uploadImages']['tmp_name'][$count])) {
                            $file = $request->file('uploadImages')[$count];
                            $image_name = date('d.m.Y.H.i.s') . '-' . $file->getClientOriginalName();
                            $request->file('uploadImages')[$count]->move(public_path() . '/storage/images', $image_name);
                            $image = new self();
                            $image->img_src = $image_name;
                            $image->product_id = $productId;
                            $image->save(); 
                        }
                    }
                }
            }
            $url = Storage::url($image_name);
            return $url;
        }else{
            return false;
        }
    }


    protected $hidden = [
        'id', 'created_at', 'updated_at', 'product_id'
    ];
}