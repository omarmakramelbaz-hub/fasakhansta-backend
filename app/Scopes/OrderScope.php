<?php
 
namespace App\Scopes;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Resturant;
class OrderScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {  
         if(auth('admin')->check() && auth('admin')->user()->account_type =='resturant_owner' && auth('admin')->user()->owner_resturant_id){
            
            $resturants=Resturant::where('id',auth('admin')->user()->owner_resturant_id)->orWhere('parent_id', auth('admin')->user()->owner_resturant_id)->pluck('id')->toArray();
            $builder->where('type','current')->whereIn('resturant_id',$resturants);

        }elseif(auth('admin')->check() && auth('admin')->user()->account_type !='admin'){
             
            $builder->where('type','current')->where('resturant_id',auth('admin')->user()->base_resturant?->id)->orWhere('type','wallet')->orWhere('type','shipping');

        }
    }
}