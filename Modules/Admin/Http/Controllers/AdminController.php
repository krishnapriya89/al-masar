<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{

     //Delete Image
     public function deleteImage(Request $request)
     {
         $column = $request->column;
         $model = $request->model;
         $id  = $request->id;
         $model = 'App\\Models\\'.$model;
         $data = $model::find($id);
         if($data){
             if($data->$column)
             {
                 $data->deleteImage($column);
                 $data->$column = null;
                 $data->save();
                 return true;
             }
             else{
                 return false;
             }
         }
         else{
             return false;
         }
     }

     
}
