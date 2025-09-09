<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\AddressRequest;
use App\Http\Resources\Api\Auth\UserAddressResource;
use Illuminate\Http\Request;
use Notification;
use App\Http\Traits\ApiResponses;
use App\Models\UserAddress;
use App\Models\Area;
use App\Models\ResturantArea;
use App\Models\User;
use App\Http\Traits\UploadImageTrait;
use Carbon\Carbon;
use Exception;

class AddressController extends Controller
{
    //
    use ApiResponses;use UploadImageTrait;

    public function index(){
        try{
            // if(! empty(request('area_id')) ){
            //     $addresses= auth('api')->user()->addresses->whereIn('area_id',request('area_id'));
            // }
            if (!empty(request('area_id'))) {
                $cairoAreas = Area::where('cairo_id', 408)->pluck('id')->toArray();
                $restaurantAreas = ResturantArea::where('resturant_id', auth('api')->user()->carts()->first()->resturant_id)
                                                ->pluck('area_id')->toArray();
                $allowedAreas = array_merge([request('area_id')], $cairoAreas, $restaurantAreas);
                $addresses = auth('api')->user()->addresses
                                ->whereIn('area_id', $allowedAreas);
            }


            if( empty(request('area_id')) || $addresses->count()==0){
                $addresses= (auth('api')->user()->addresses);
            }
            $user = UserAddressResource::collection($addresses);
        return $this->successResponse($user,trans('messages.success data'));

      }catch(\Exception $e){
          return $e;
         return $this ->errorResponse(__('messages.SomeThingWrong'));
     } 
    }

 public function store(AddressRequest $request){
    try{
        $address=UserAddress::create($request->input()+['user_id'=>auth('api')->user()->id]);

        $city_name = getCityName($address->lat,$address->lng);         

        $area = Area::where('title_ar', 'like', '%' . $city_name . '%')->orWhere('title_en', 'like', '%' . $city_name . '%')->first();
        if($area){
            $address->area_id = $area->id;
            $address->save();
        }
        $user =new UserAddressResource($address);
        return $this->successResponse($user,trans('messages.AddSuccessfully'));
    }catch(\Exception $e){
        return $this ->errorResponse(__('messages.SomeThingWrong'));
    } 
   
}

public function show($id){
    try{
        $address=auth('api')->user()->addresses()->where('id',$id)->first();
        if($address){
            $user = new UserAddressResource($address);
            
            return $this->successResponse($user,trans('messages.success data'));
        }else{
         return $this ->errorResponse(__('messages.SomeThingWrong'));
        }
    }catch(\Exception $e){
        return $this ->errorResponse(__('messages.SomeThingWrong'));
    } 
   
}

public function update($id,AddressRequest $request){
    try{
        $address=auth('api')->user()->addresses()->where('id',$id)->first();
        if($address){
        $address->update($request->input());
        $user = UserAddressResource::collection(auth('api')->user()->addresses);
        
         $city_name = getCityName($address->lat,$address->lng);         

        $area = Area::where('title_ar', 'like', '%' . $city_name . '%')->orWhere('title_en', 'like', '%' . $city_name . '%')->first();
        if($area){
            $address->area_id = $area->id;
            $address->save();
        }
         return $this->successResponse($user,trans('messages.UpdateSuccessfully'));
        }else{
         return $this ->errorResponse(__('messages.SomeThingWrong'));
        }
    }catch(\Exception $e){
        return $this ->errorResponse(__('messages.SomeThingWrong'));
    } 
   
}
public function destroy($id){
    try{
        $address=auth('api')->user()->addresses()->where('id',$id)->first();
        if($address){
            $address->delete();
            $user = UserAddressResource::collection(auth('api')->user()->addresses);
            
            return $this->successResponse($user,trans('messages.DeleteSuccessfully'));
        }else{
         return $this ->errorResponse(__('messages.SomeThingWrong'));
        }
    }catch(\Exception $e){
        return $this ->errorResponse(__('messages.SomeThingWrong'));
    } 
   
}
}