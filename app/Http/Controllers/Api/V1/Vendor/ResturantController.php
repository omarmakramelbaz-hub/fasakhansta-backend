<?php
namespace App\Http\Controllers\Api\V1\Vendor;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Resturant;
use App\Models\ResturantArea;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Auth\StoreUserResturantRequest;
use App\Http\Resources\Api\Vendor\ResturantResource;
use App\Http\Resources\Api\Vendor\UserResturantResource;
use App\Http\Traits\ApiResponses;
use Notification;
use JWTAuth;
use Auth;
use \Carbon\Carbon;
use App\Interfaces\ResturantRepositoryInterface;

class ResturantController extends Controller {

  use ApiResponses;
    private ResturantRepositoryInterface $ResturantRepository;
      public function __construct(ResturantRepositoryInterface $ResturantRepository) 
    {      
        $this->ResturantRepository = $ResturantRepository;
    }
  public function updateStatus(Request $request, Resturant $resturant) {
    $up_Resturant = $this->ResturantRepository->changeStatus($resturant->id,$request->status);
        $ResturantData = ResturantResource::make($resturant->fresh());
    return $this->successResponse($ResturantData,__('api.update status'));
  }
  
  public function updateResturant(Request $request, Resturant $resturant) {
    $up_Resturant = $this->ResturantRepository->updateResturant($resturant->id,$request->except('_token'));
    $user = User::where('id',$resturant->user_id )->first();
    // dd($user);
    $user->email = $request->email;
    $user->save();
    $ResturantData = ResturantResource::make($resturant->fresh());
    return $this->successResponse($ResturantData,__('api.update status'));
  }


    public function updateResturantLocation(Request $request, Resturant $resturant) {
         
        $city_name = getCityName($request->lat,$request->lng);         

        $area = Area::where('title_ar', 'like', '%' . $city_name . '%')->orWhere('title_en', 'like', '%' . $city_name . '%')->first();
        if(!$area){
            
            $area = Area::create([
                    'title_ar' => $city_name,
                    'title_en' => $city_name,
                    'parent_id' => 397,
                ]);
        }
        $up_Resturant = $resturant->update([
                'country_name'  => $request->country_name,
                'city_name'     => $request->city_name,
                'address'       => $request->address,
                'lat'           => $request->lat,
                'lng'           => $request->lng,
                'area_id'       => ($area)? $area->id: null,
            ]);
        if(! $resturant->resturant_areas()->exists() ){
            ResturantArea::create([
                'added_by'          => $resturant->user_id,
                'resturant_id'      => $resturant->id,
                'expected_delivery' => 0,
                'area_id'           => ($area)? $area->id: null,
	 	        'type'              => 'kilo',
            ]);
        }
        $ResturantData = ResturantResource::make($resturant->fresh());
        return $this->successResponse($ResturantData,__('api.update status'));
    }
  
}