<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SiteCommonContent;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Support\Renderable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = User::where('user_type','=','user')->latest()->get();
        return view('admin::user.index',compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user)
        {
            $user->phoneOtps()->delete();
            $user->loginOtps()->delete();
            $user->emailVerify()->delete();
            $user->delete();
            return redirect()->back()->with('success','User Deleted Successfully!');
        }
        return redirect()->back()->with('error',' Failed To Delete User ');
    }

    /**
     * Change Status
     *
     */
    public function changeStatus(Request $request)
    {
        $status = $request->user_status == 1 ? 0 : 1;
        $user = User::find($request->user_id);
        $user->status = $request->user_status;
        if($user->save())
        {
            return response()->json([
                'updated_status' => $status,
            ]);
        }
    }
    /**
     * Verify User
     *
     */
    public function verifyUser(Request $request)
    {
        $user = User::find($request->user_id);
        if(!$user)
            return response()->json([
                'status' => false,
            ]);

        $user->admin_verified = 1;
        if($user->save())
        {
            $siteSettings = SiteCommonContent::first();
            Mail::send('admin::emails.user-verify-email', ['user' => $user,'siteSettings'=>$siteSettings], function ($message) use($user) {
                $message->to($user->email);
                $message->subject('Al Masar Al Saree - Admin Verification Done');
            });

            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }
}
