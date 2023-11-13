<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    /**
     * activate user.
     */

    public function activateUser(int $id)
    {
        $user = User::where('id', $id)->first();
        $user->active = true;
        $user->save();
        return response(['msg' => 'user activate with'], 200);
    }
    /**
     * deactivate user.
     */

    public function desactivateUser(int $id)
    {
        $user = User::where('id', $id)->first();
        $user->active = false;
        $user->save();
        return response(['msg' => 'user disactivated with'], 200);
    }
    /**
     * change password user.
     */

    public function changePassword(Request $request, int $id)
    {
        try {
            //code...
            $validation = Validator::make($request->all(), [
                'password' => 'min:8|max:16|required|confirmed',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            $user = User::where('id', $id)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            return response(['msg' => 'user password change with success'], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 404);
        }
    }
}
