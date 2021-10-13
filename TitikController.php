<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Auto_m;
use Session;

class TitikController extends Controller
{
   public function __construct()
    {
		$this->Auto_m= new Auto_m();
    }

   public function titik(Request $request){
        $id 				= $request->input('id');    
        $results=$this->Auto_m->all_data('tbl_aset','*',array('id'=>$id),'id','asc');
        return json_encode($results); 
   }
}
