<?php

namespace App\Http\Controllers\vendor\Chatify;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use App\ChMessage as Message;
use App\ChFavorite as Favorite;
use Chatify\Facades\ChatifyMessenger as Chatify;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
class MessagesController extends Controller
{
    protected $perPage = 30;
    protected $messengerFallbackColor = '#2180f3';

    /**
     * Authinticate the connection for pusher
     *
     * @param Request $request
     * @return void
     */
    public function pusherAuth(Request $request)
    {
        // Auth data
        $authData = json_encode([
            'user_id' => Auth::user()->id,
            'user_info' => [
                'fname' => Auth::user()->fname
            ]
        ]);
        // check if user authorized
        if (Auth::check()) {
            return Chatify::pusherAuth(
                $request['channel_name'],
                $request['socket_id'],
                $authData
            );
        }
        // if not authorized
        return response()->json(['message'=>'Unauthorized'], 401);
    }

    /**
     * Returning the view of the app with the required data.
     *
     * @param int $id
     * @return void
     */
    public function index( $id = null)
    {
        $routeName= FacadesRequest::route()->getName();
        $type = in_array($routeName, ['user','group'])
            ? $routeName
            : 'user';

         if(Auth::User()->user_type == USER_TYPE_ADMIN)
        {
        
            return view('home');
         
        }
        else
        {
          
        return view('Chatify::pages.app', [
            'id' => $id ?? 0,
            'type' => $type ?? 'user',
            'messengerColor' => Auth::user()->messenger_color ?? $this->messengerFallbackColor,
            'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
        ]);
        }
    
    }


    /**
     * Fetch data by id for (user/group)
     *
     * @param Request $request
     * @return collection
     */
    public function idFetchData(Request $request)
    {
        // Favorite
        $favorite = Chatify::inFavorite($request['id']);

        // User data
        if ($request['type'] == 'user') {
            $fetch = User::where('id', $request['id'])->first();
            if($fetch){
                // $userAvatar = asset('/storage/' . config('chatify.user_avatar.folder') . '/' . $fetch->avatar);
                if(Auth::User()->user_type == USER_TYPE_GAMER){
                    if($fetch->user_img != null || $fetch->user_img !='')
                    {
                     $userAvatar = asset('images/coach/'.$fetch->user_img);   
                    }
                    else
                    {
                          $userAvatar = asset('images/default/user.jpg'); 
                    }
                     
                }
                else if(Auth::User()->user_type == USER_TYPE_COACH){
                     if(Auth::User()->user_img != null || Auth::User()->user_img !='')
                    {
                     $userAvatar = asset('images/gamer/'.$fetch->user_img);   
                    }
                    else
                    {
                          $userAvatar = asset('images/default/user.jpg'); 
                    }
                }
              
            }
        }

        // send the response
        return Response::json([
            'favorite' => $favorite,
            'fetch' => $fetch ?? [],
            'user_avatar' => $userAvatar ?? null,
        ]);
    }

    /**
     * This method to make a links for the attachments
     * to be downloadable.
     *
     * @param string $fileName
     * @return void
     */
    public function download($fileName)
    {
        $path = storage_path() . '/app/public/' . config('chatify.attachments.folder') . '/' . $fileName;
        if (file_exists($path)) {
            return Response::download($path, $fileName);
        } else {
            return abort(404, "Sorry, File does not exist in our server or may have been deleted!");
        }
    }

    /**
     * Send a message to database
     *
     * @param Request $request
     * @return JSON response
     */
    public function send(Request $request)
    {
        // default variables
        $error = (object)[
            'status' => 0,
            'message' => null
        ];
        $attachment = null;
        $attachment_title = null;

        // if there is attachment [file]
        if ($request->hasFile('file')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();
            $allowed_files  = Chatify::getAllowedFiles();
            $allowed        = array_merge($allowed_images, $allowed_files);

            $file = $request->file('file');
            // if size less than 150MB
            if ($file->getSize() < 150000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $file->storeAs("public/" . config('chatify.attachments.folder'), $attachment);
                } else {
                    $error->status = 1;
                    $error->message = "File extension not allowed!";
                }
            } else {
                $error->status = 1;
                $error->message = "File extension not allowed!";
            }
        }

        if (!$error->status) {
            // send to database
            $messageID = mt_rand(9, 999999999) + time();
            Chatify::newMessage([
                'id' => $messageID,
                'type' => $request['type'],
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'body' => htmlentities(trim($request['message']), ENT_QUOTES, 'UTF-8'),
                'attachment' => ($attachment) ? json_encode((object)[
                    'new_name' => $attachment,
                    'old_name' => htmlentities(trim($attachment_title), ENT_QUOTES, 'UTF-8'),
                ]) : null,
            ]);

            // fetch message to send it with the response
            $messageData = Chatify::fetchMessage($messageID);

            // send to user using pusher
            Chatify::push('private-chatify', 'messaging', [
                'from_id' => Auth::user()->id,
                'to_id' => $request['id'],
                'message' => Chatify::messageCard($messageData, 'default')
            ]);
        }

        // send the response
        return Response::json([
            'status' => '200',
            'error' => $error,
            'message' => Chatify::messageCard(@$messageData),
            'tempID' => $request['temporaryMsgId'],
        ]);
    }

    /**
     * fetch [user/group] messages from database
     *
     * @param Request $request
     * @return JSON response
     */
    public function fetch(Request $request)
    {
        $query = Chatify::fetchMessagesQuery($request['id'])->latest();
        $messages = $query->paginate($request->per_page ?? $this->perPage);
        $totalMessages = $messages->total();
        $lastPage = $messages->lastPage();
        $response = [
            'total' => $totalMessages,
            'last_page' => $lastPage,
            'last_message_id' => collect($messages->items())->last()->id ?? null,
            'messages' => '',
        ];

        // if there is no messages yet.
        if ($totalMessages < 1) {
            $response['messages'] ='<p class="message-hint center-el"><span>Say \'hi\' and start messaging</span></p>';
            return Response::json($response);
        }
        if (count($messages->items()) < 1) {
            $response['messages'] = '';
            return Response::json($response);
        }
        $allMessages = null;
        foreach ($messages->reverse() as $message) {
            $allMessages .= Chatify::messageCard(
                Chatify::fetchMessage($message->id)
            );
        }
        $response['messages'] = $allMessages;
        return Response::json($response);
    }

    /**
     * Make messages as seen
     *
     * @param Request $request
     * @return void
     */
    public function seen(Request $request)
    {
        // make as seen
        $seen = Chatify::makeSeen($request['id']);
        // send the response
        return Response::json([
            'status' => $seen,
        ], 200);
    }

    /**
     * Get contacts list
     *
     * @param Request $request
     * @return JSON response
     */
    public function getContacts(Request $request)
    {
        $check = $_GET['check'];
        // get all users that received/sent message from/to [Auth user]
        if(Auth::User()->user_type == 2)
        {  
               $users = Message::join('fps_users',  function ($join) {
                    $join->on('ch_messages.from_id', '=', 'fps_users.id')
                        ->orOn('ch_messages.to_id', '=', 'fps_users.id');
                })
                ->where(function ($q) {
                    $q->where('ch_messages.from_id', Auth::user()->id)
                    ->orWhere('ch_messages.to_id', Auth::user()->id);
                })
                ->where('fps_users.id','!=',Auth::user()->id)
                ->select('fps_users.*',DB::raw('MAX(ch_messages.created_at) max_created_at'))
                ->orderBy('max_created_at', 'desc')
                ->groupBy('fps_users.id')
                ->paginate($request->per_page ?? $this->perPage);
                
                
                 // get all users that received/sent message from/to [Auth user]
                $users1 = DB::table('fps_orders')
                //  ->join('fps_coach_assign', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
                ->join('fps_users', 'fps_users.id', '=', 'fps_orders.user_id')
                   ->select('fps_users.*')
                // ->orderBy('max_created_at', 'desc')
                ->groupBy('fps_users.id')
                ->paginate($request->per_page ?? $this->perPage);
        }
        else if(Auth::User()->user_type == 3)
        {
            $users = Message::join('fps_users',  function ($join) {
                    $join->on('ch_messages.from_id', '=', 'fps_users.id')
                        ->orOn('ch_messages.to_id', '=', 'fps_users.id');
                })
                ->where(function ($q) {
                    $q->where('ch_messages.from_id', Auth::user()->id)
                    ->orWhere('ch_messages.to_id', Auth::user()->id);
                })
                ->where('fps_users.id','!=',Auth::user()->id)
                ->select('fps_users.*',DB::raw('MAX(ch_messages.created_at) max_created_at'))
                ->orderBy('max_created_at', 'desc')
                ->groupBy('fps_users.id')
                ->paginate($request->per_page ?? $this->perPage);
            
              $users1 = DB::table('fps_orders')
              ->join('fps_coach_assign', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
              ->join('fps_users', 'fps_coach_assign.coach_id', '=', 'fps_users.id')
              ->select('fps_users.*')
              ->where('fps_orders.user_id','=',Auth::user()->id)
              ->groupBy('fps_users.id')
              ->paginate($request->per_page ?? $this->perPage);
                       
        }
        
    
    
        
        
        // if($check==1)
        // {
        //     $users = Message::join('fps_users',  function ($join) {
        //             $join->on('ch_messages.from_id', '=', 'fps_users.id')
        //                 ->orOn('ch_messages.to_id', '=', 'fps_users.id');
        //         })
        //         ->where(function ($q) {
        //             $q->where('ch_messages.from_id', Auth::user()->id)
        //             ->orWhere('ch_messages.to_id', Auth::user()->id);
        //         })
        //         ->where('fps_users.id','!=',Auth::user()->id)
        //         ->select('fps_users.*',DB::raw('MAX(ch_messages.created_at) max_created_at'))
        //         ->orderBy('max_created_at', 'desc')
        //         ->groupBy('fps_users.id')
        //         ->paginate($request->per_page ?? $this->perPage);
                
                
        //          // get all users that received/sent message from/to [Auth user]
        //         $users1 = DB::table('fps_orders')
        //         //  ->join('fps_coach_assign', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
        //         ->join('fps_users', 'fps_users.id', '=', 'fps_orders.user_id')
        //           ->select('fps_users.*')
        //         // ->orderBy('max_created_at', 'desc')
        //         ->groupBy('fps_users.id')
        //         ->paginate($request->per_page ?? $this->perPage);
        // }
        // else
        // {
        //         // get all users that received/sent message from/to [Auth user]
        //         $users = DB::table('fps_orders')
        //         //  ->join('fps_coach_assign', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
        //         ->join('fps_users', 'fps_users.id', '=', 'fps_orders.user_id')
        //           ->select('fps_users.*')
        //         // ->orderBy('max_created_at', 'desc')
        //         ->groupBy('fps_users.id')
        //         ->paginate($request->per_page ?? $this->perPage);
        // }

   
        
        $usersList =$users->items();
      //  dd($usersList[0]['fname']);
        $usersList1 =$users1->items();
        $finalList = (array_merge($usersList,$usersList1));
        // $finalList = array_intersect($array1, $array2);
        // dd($usersList);
        $names = array();
        $counter = 0;
        if (count($finalList) > 0) {
            $contacts = '';
        
            foreach ($finalList as $user) {
               
                
               
                 if($counter>0)
                 {
                     if (!in_array($user->id, $names))
                      {
                      $contacts .= Chatify::getContactItem($user);
                    }
                    // else
                    // {
                    //      $contacts .= Chatify::getContactItem($user);
                    //     $contacts .= Chatify::getContactItem($user);
                    // }
                 }
                 else
                 {
                      $contacts .= Chatify::getContactItem($user);
                 }
                
                 array_push($names,$finalList[$counter]->id);
                 $counter++;
              
                 //  $contacts .= Chatify::getContactItem($user);
                 
             
           
            }
        }else{
            $contacts = '<p class="message-hint center-el"><span>Your contact list is empty</span></p>';
        }
        
        
        return Response::json([
            'contacts' => $contacts,
            'total' => $users->total() ?? 0,
            'last_page' => $users->lastPage() ?? 1,
        ], 200);
        
        
    } 

// List of All Gamers with Coach Perspective
 public function getGamers(Request $request)
    {
        // get all users that received/sent message from/to [Auth user]
        $users = DB::table('fps_orders')
        //  ->join('fps_coach_assign', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
        ->join('fps_users', 'fps_users.id', '=', 'fps_orders.user_id')
           ->select('fps_users.*')
// ->orderBy('max_created_at', 'desc')
->groupBy('fps_users.id')
->paginate($request->per_page ?? $this->perPage);


    

        $usersList =$users->items();
        print_r( $usersList);
        if (count($usersList) > 0) {
            $contacts = '';
            foreach ($usersList as $user) {
                console.log($user);
                $contacts .= Chatify::getContactItem($user);
            }
        }else{
            $contacts = '<p class="message-hint center-el"><span>Your contact list is empty</span></p>';
        }

        return Response::json([
            'contacts' => $contacts,
            'total' => $users->total() ?? 0,
            'last_page' => $users->lastPage() ?? 1,
        ], 200);
    }
    
    
    
// List of All Coach with Gamer Perspective
    public function getCoaches(Request $request)
    {
        // get all users that received/sent message from/to [Auth user]
        $users = DB::table('fps_orders')
        ->join('fps_coach_assign', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
        ->join('fps_users', 'fps_users.id', '=', 'fps_coach_assign.coach_id')
           ->select('fps_users.*')
// ->orderBy('max_created_at', 'desc')
->groupBy('fps_users.id')
->paginate($request->per_page ?? $this->perPage);


    

        $usersList =$users->items();
        print_r( $usersList);
        if (count($usersList) > 0) {
            $contacts = '';
            foreach ($usersList as $user) {
                console.log($user);
                $contacts .= Chatify::getContactItem($user);
            }
        }else{
            $contacts = '<p class="message-hint center-el"><span>Your contact list is empty</span></p>';
        }

        return Response::json([
            'contacts' => $contacts,
            'total' => $users->total() ?? 0,
            'last_page' => $users->lastPage() ?? 1,
        ], 200);
    }
 public function updateContactItem(Request $request)
    {
        // Get user data
        $user = User::where('id', $request['user_id'])->first();
        if(!$user){
            return Response::json([
                'message' => 'User not found!',
            ], 401);
        }
        $contactItem = Chatify::getContactItem($user);

        // send the response
        return Response::json([
            'contactItem' => $contactItem,
        ], 200);
    }
    /**
     * Get favorites list
     *
     * @param Request $request
     * @return void
     */
    public function getFavorites(Request $request)
    {
        $favoritesList = null;
        $favorites = Favorite::where('user_id', Auth::user()->id);
        foreach ($favorites->get() as $favorite) {
            // get user data
            $user = User::where('id', $favorite->favorite_id)->first();
            $favoritesList .= view('Chatify::layouts.favorite', [
                'user' => $user,
            ]);
        }
        // send the response
        return Response::json([
            'count' => $favorites->count(),
            'favorites' => $favorites->count() > 0
                ? $favoritesList
                : 0,
        ], 200);
    }

    /**
     * Search in messenger
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request)
    {
        $getRecords = null;
        $input = trim(filter_var($request['input'], FILTER_SANITIZE_STRING));
        
         if(Auth::User()->user_type == 2)
        {  
          
                         $records = DB::table('fps_orders')
                ->join('fps_users', 'fps_users.id', '=', 'fps_orders.user_id')
                    ->where('fps_users.fname', 'LIKE', "%{$input}%")
                   ->select('fps_users.*')
                ->groupBy('fps_users.id')
                ->paginate($request->per_page ?? $this->perPage);
        }
        else if(Auth::User()->user_type == 3)
        {
        
              $records = DB::table('fps_orders')
              ->join('fps_coach_assign', 'fps_coach_assign.order_id', '=', 'fps_orders.id')
              ->join('fps_users', 'fps_coach_assign.coach_id', '=', 'fps_users.id')
              ->select('fps_users.*')
              ->where('fps_orders.user_id','=',Auth::user()->id)
              ->where('fps_users.fname', 'LIKE', "%{$input}%")
              ->groupBy('fps_users.id')
              ->paginate($request->per_page ?? $this->perPage);

        
        }


                    
        foreach ($records->items() as $record) {
            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'type' => 'user',
                'user' => $record,
            ])->render();
        }
        if($records->total() < 1){
            $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
        }
        // send the response
        return Response::json([
            'records' => $getRecords,
            'total' => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }

    /**
     * Get shared photos
     *
     * @param Request $request
     * @return void
     */
    public function sharedPhotos(Request $request)
    {
        $shared = Chatify::getSharedPhotos($request['user_id']);
        $sharedPhotos = null;

        // shared with its template
        for ($i = 0; $i < count($shared); $i++) {
            $sharedPhotos .= view('Chatify::layouts.listItem', [
                'get' => 'sharedPhoto',
                'image' => asset('storage/attachments/' . $shared[$i]),
            ])->render();
        }
        // send the response
        return Response::json([
            'shared' => count($shared) > 0 ? $sharedPhotos : '<p class="message-hint"><span>Nothing shared yet</span></p>',
        ], 200);
    }

    /**
     * Delete conversation
     *
     * @param Request $request
     * @return void
     */
    public function deleteConversation(Request $request)
    {
        // delete
        $delete = Chatify::deleteConversation($request['id']);

        // send the response
        return Response::json([
            'deleted' => $delete ? 1 : 0,
        ], 200);
    }

    public function updateSettings(Request $request)
    {
        $msg = null;
        $error = $success = 0;

        // dark mode
        if ($request['dark_mode']) {
            $request['dark_mode'] == "dark"
                ? User::where('id', Auth::user()->id)->update(['dark_mode' => 1])  // Make Dark
                : User::where('id', Auth::user()->id)->update(['dark_mode' => 0]); // Make Light
        }

        // If messenger color selected
        if ($request['messengerColor']) {

            $messenger_color = explode('-', trim(filter_var($request['messengerColor'], FILTER_SANITIZE_STRING)));
            $messenger_color = Chatify::getMessengerColors()[$messenger_color[1]];
            User::where('id', Auth::user()->id)
                ->update(['messenger_color' => $messenger_color]);
        }
        // if there is a [file]
        if ($request->hasFile('avatar')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();

            $file = $request->file('avatar');
            // if size less than 150MB
            if ($file->getSize() < 150000000) {
                if (in_array($file->getClientOriginalExtension(), $allowed_images)) {
                    // delete the older one
                    if (Auth::user()->user_img != config('chatify.user_avatar.default')) {
                        $path = storage_path('app/public/' . config('chatify.user_avatar.folder') . '/' . Auth::user()->avatar);
                        if (file_exists($path)) {
                            @unlink($path);
                        }
                    }
                    // upload
                    $avatar = Str::uuid() . "." . $file->getClientOriginalExtension();
                    $update = User::where('id', Auth::user()->id)->update(['avatar' => $user_img]);
                    $file->storeAs("public/" . config('chatify.user_avatar.folder'), $avatar);
                    $success = $update ? 1 : 0;
                } else {
                    $msg = "File extension not allowed!";
                    $error = 1;
                }
            } else {
                $msg = "File extension not allowed!";
                $error = 1;
            }
        }

        // send the response
        return Response::json([
            'status' => $success ? 1 : 0,
            'error' => $error ? 1 : 0,
            'message' => $error ? $msg : 0,
        ], 200);
    }

    /**
     * Set user's active status
     *
     * @param Request $request
     * @return void
     */
    public function setActiveStatus(Request $request)
    {
        $update = $request['status'] > 0
            ? User::where('id', $request['user_id'])->update(['active_status' => 1])
            : User::where('id', $request['user_id'])->update(['active_status' => 0]);
        // send the response
        return Response::json([
            'status' => $update,
        ], 200);
    }
}
