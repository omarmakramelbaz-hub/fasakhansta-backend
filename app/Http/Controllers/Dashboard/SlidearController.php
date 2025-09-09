<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSlidearRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\Slidear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SlidearController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:slidear-list', ['only' => ['index','show']]);
        $this->middleware('permission:slidear-list', ['only' => ['show']]);
        $this->middleware('permission:slidear-create', ['only' => ['create','store']]);
        $this->middleware('permission:slidear-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:slidear-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $request = request();
        $searchQuery = trim($request->query('search'));

        $dash_slidears = Slidear::query();

        if($request->query('from_date')){
            $dash_slidears = $dash_slidears->whereDate('created_at','>=',date($request->query('from_date')));
        }
        if($request->query('to_date')){
            $dash_slidears = $dash_slidears->whereDate('created_at','<=',date($request->query('to_date')));
        }

        $dash_slidears = $dash_slidears->where('title', 'like',  '%' . $searchQuery .'%');

        $dash_slidears = $dash_slidears->orderBy('id', 'desc')->paginate(30);
        return view('admin.slidears.index', compact('dash_slidears'));
    }


    public function create()
    {
        $slidear = new Slidear() ;
        return view('admin.slidears.create' , compact('slidear'));
    }

    public function store(StoreSlidearRequest $request)
    {
       
        
       
        
        $slidear = slidear::create($request->except('images'));
       if($request->hasFile('images') )
        {
            foreach($request->file('images') as $image){
            $this->convertImageToWebp($image,$slidear,'slidear_image','slidears');
            }
        }
        
        return redirect()->route('slidears.index')->with('success',trans('messages.AddSuccessfully'));

    }


    public function show(Slidear $slidear)
    {
        return view('admin.slidears.show', compact('slidear') );
    }


    public function edit(slidear $slidear)
    {

        return view('admin.slidears.edit' , compact('slidear'));

    }


    public function update(StoreSlidearRequest $request,Slidear $slidear)
    {
      if($request->hasFile('images') )
        {
            foreach($request->file('images') as $image){
            $this->convertImageToWebp($image,$slidear,'slidear_image','slidears');
            }
        }
       
        $slidear->update($request->except('images'));

        return redirect()->route('slidears.index')->with('success',trans('messages.UpdateSuccessfully'));
    }


    public function destroy(Slidear $slidear)
    {
        $slidear->delete();
        $slidear->clearMediaCollection('slidear_image');
        return redirect()->route('slidears.index')->with('success',trans('messages.DeleteSuccessfully'));
    }


    public function delete_all(Request $request)
    {
        $ids = $request->ids;
        Slidear::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }
    
     public function delete_image(Request $request){
        //   dd($request);
          $slidear=Slidear::find($request->slidear_id);
          $slidear->deleteMedia($request->id);
          return response()->json(['success'=> trans('messages.DeleteSuccessfully')]);
    
          
    }

  
}