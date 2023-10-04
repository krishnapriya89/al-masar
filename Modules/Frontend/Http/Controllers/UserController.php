<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{

     /**
      * Add New Address
      *
      */
      public function addNewAddress()
      {
        return view('frontend::add-new-address');
      }
}
