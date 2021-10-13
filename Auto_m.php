
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Auto_m extends Model
{
    
	public function isDeleted($table,$where){		
		$results = DB::table($table)->where($where)->delete();	
		if($results==1){
			return true;
		}else{
			return false;
		}		     
    }	
	
	public function isExistsManyKey($table,$where){		
		$results = DB::table($table)->where($where)->first();
		if ($results === null) {
		   return false;
		}else{
			return true;
		}
	}
	
	public function add($table,$data){		
		$results = DB::table($table)->insert($data);		
		if($results==1){
			return true;
		}else{
			return false;
		}		     
    }

	public function edit($table,$data,$where){		
		$results = DB::table($table)->where($where)->update($data);		
		if($results==1){
			return true;
		}else{
			return false;
		}		     
    }	
	
	
  public function all_count($table,$where){       
       $count = DB::table($table)->where($where)->count();
	   return $count;
   }
   

	public function all_query($sql){       
       $results = DB::select($sql);
       return $results;
   }
	
	public function getvalue($column,$table,$id,$idValue){
		$results = DB::table($table)->select($column)->where($id, $idValue)->get();
		if($results->count()>0){
			return $results->first()->$column;
		}else{
			return '';
		}
		
	}
   
   
   public function all_data($table,$column,$where='',$orde='',$type='',$groupby='',$pagination=''){
       
       if($where && $groupby){
          
		  if($pagination){
			  $results = DB::table($table)
						->select($column)
						->where($where)
						->groupBy($groupby)
						->orderBy($orde, $type)
						->paginate($pagination);
		  }else{
			 $results = DB::table($table)
						->select($column)
						->where($where)
						->groupBy($groupby)
						->orderBy($orde, $type)
						->get(); 
		  }
		  		   
			
	   }else if ($where !='' && $groupby==''){
		    
			if($pagination){
				$results = DB::table($table)
						->select($column)
						->where($where)						
						->orderBy($orde, $type)
						->paginate($pagination);
			}else{
				$results = DB::table($table)
						->select($column)
						->where($where)						
						->orderBy($orde, $type)
						->get();
			}
		    
	   }else{
		   if($pagination){
			   $results = DB::table($table)
						->select($column)
						->orderBy($orde, $type)
						->paginate($pagination);
		   }else{
			   $results = DB::table($table)
						->select($column)
						->orderBy($orde, $type)
						->get();
		   }
          
             
       }
       
       
       return $results;
   }
}
