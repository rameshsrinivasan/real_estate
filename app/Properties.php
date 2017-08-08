<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'properties';

    protected $fillable = ['user_id','property_name','property_type','property_purpose','sale_price','rent_price','address','map_latitude','map_longitude','bathrooms','bedrooms','area','description','featured_image'];
 
	public function scopeSearchByKeyword($query, $city_id,$type,$purpose,$price,$min_price,$max_price)
    {
    	 	
        if ($min_price!='' and $max_price!='') {
            $query->where(function ($query) use ($city_id,$type,$purpose,$price,$min_price,$max_price) {
                $query->where("city_id", "$city_id")
                    ->where("property_type", "$type")                    
                    ->where("property_purpose", "$purpose")                     
                    ->whereRaw("$price > $min_price")
                    ->whereRaw("$price <= $max_price");
                     
                     
            });
        }
        elseif ($min_price!='') {
            $query->where(function ($query) use ($city_id,$type,$purpose,$price,$min_price,$max_price) {
                $query->where("city_id", "$city_id")
                    ->where("property_type", "$type")                    
                    ->where("property_purpose", "$purpose")
                    ->whereRaw("$price > $min_price");
                     
            });
        }
        elseif ($max_price!='') {
            $query->where(function ($query) use ($city_id,$type,$purpose,$price,$min_price,$max_price) {
                $query->where("city_id", "$city_id")
                    ->where("property_type", "$type")                    
                    ->where("property_purpose", "$purpose")
                    ->whereRaw("$price <= $max_price");
                     
            });
        }
        else
        {
			 $query->where(function ($query) use ($city_id,$type,$purpose,$price,$min_price,$max_price) {
                $query->where("city_id", "$city_id")
                    ->where("property_type", "$type")                    
                    ->where("property_purpose", "$purpose");                     
                     
                     
            });
		}
        return $query;
    }

    public static function propertyPurpose($id) {
        return Properties::select('property_purpose')->find($id)->property_purpose;
    }

    public function plan(){
        return $this->belongsTo('App\Plan', 'plan_id');
    }
    public function payment(){
        return $this->belongsTo('App\Payment', 'payment_id');
    }
}
