<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:complaint-list|complaint-delete', ['only' => ['index']]);
        $this->middleware('permission:complaint-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $request = request();

        $fields = ['name','title', 'mobile','message'];
        $searchQuery = trim($request->query('search'));

        $complaints = Complaint::where(function($query) use($searchQuery, $fields) {
            foreach ($fields as $field)
                $query->orWhere($field, 'like',  '%' . $searchQuery .'%');
            })->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=',$from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);

        return view('admin.complaints.index', compact('complaints'));
    }

    public function show(Complaint $complaint)
    {
        return view('admin.complaints.show', compact('complaint'));
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()->route('complaints.index')->with('success',trans('messages.DeleteSuccessfully'));
    }


    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Complaint::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }

}