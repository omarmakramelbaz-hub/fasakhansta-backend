<?php

namespace App\Http\Controllers\Dashboard;
use App\Interfaces\BannerRepositoryInterface;
use App\Models\Banner;
use App\Http\Requests\Dashboard\About\StoreBannerRequest;
use App\Http\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    use UploadImageTrait;
    private BannerRepositoryInterface $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository) 
    {
        $this->middleware('permission:banner-list', ['only' => ['index','show']]);
        $this->middleware('permission:banner-create', ['only' => ['create','store']]);
        $this->middleware('permission:banner-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:banner-delete', ['only' => ['destroy','delete_all']]);
        $this->bannerRepository = $bannerRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = $this->bannerRepository->getAllBanners($request);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = new Banner() ;
        return view('admin.banners.create', compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $bannerDetails = $request->except('_token');

        $banner = $this->bannerRepository->createBanner($bannerDetails);
        
        return redirect('admin/banners')->with('success',trans('messages.AddSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBannerRequest  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBannerRequest $request, Banner $banner)
    {
        $bannerDetails = $request->except('_token','_method');
        $this->bannerRepository->updateBanner($banner->id, $bannerDetails);
        
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $this->bannerRepository->deleteBanner($banner->id);
      
        return redirect('admin/banners')->with('success',trans('messages.DeleteSuccessfully'));
        
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        
        $this->bannerRepository->deleteAllBanners($ids);
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);

    }
}