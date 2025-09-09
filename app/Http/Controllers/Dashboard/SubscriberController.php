<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImageTrait;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Models\AdminMail;
class SubscriberController extends Controller
{
    use UploadImageTrait;

    function __construct()
    {
        $this->middleware('permission:contact-list|contact-delete', ['only' => ['index']]);
        $this->middleware('permission:contact-list', ['only' => ['show']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }

    public function showAllMails()
    {
        $subscribers = AdminMail::orderBy('id', 'desc')->paginate(30);

        return view('admin.subscribers.mails', compact('subscribers'));
    } 
    public function index()
    {
        $request = request();
        $searchQuery = trim($request->query('search'));

        $subscribers = Subscriber::where('email', 'like',  '%' . $searchQuery .'%')->when($request->query('from_date'), function($query, $from_date) {
                $query->where('created_at', '>=',$from_date);
            })->when($request->query('to_date'), function($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);

        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber -> delete();

        return redirect()->route('subscribers.index')->with('success',trans('messages.DeleteSuccessfully'));
    }


    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Subscriber::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }


    public function sendSubscriberEmail(Request $request){
        $ids = $request->ids;
        if($ids == null){
            $subscriberrs = Subscriber::get();
        }else{
            $subscriberrs = Subscriber::whereIn('id',explode(",",$ids))->get();
        }
        foreach ($subscriberrs as $key => $value) {
            $to_email = $value->email;
            $mail=Mail::send('emails.send_subscriber_email', ['email' => $value->email, 'data' => $request->message], function($message) use ($request, $to_email) {
                 $message->to($to_email);
                 $message->subject('Send Notification To Our Subscribers');
            });
            AdminMail::create([
                'admin_id' => auth('admin')->user()->id,
                'subscriber_id' => $value->id,
                'mail' => $request->message,
            ]);
        }

        return redirect()->back()->with('success',trans('messages.MessageSentSuccessfully'));
    }

}