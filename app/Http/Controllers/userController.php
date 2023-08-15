<?php

namespace App\Http\Controllers;

use App\Models\userModel;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function signUp(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            "name" => "required|string",
            "mail" => "required|string",
            "password" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => "404",
                "message" => "please provide all fields",

            ], 404);
        } else {
            $user = userModel::where("mail", $request->mail);
            if ($user->count() > 0) {
                return response()->json([
                    "status" => "404",
                    "message" => "User already exists",

                ], 404);
            } else {
                userModel::create([
                    "name" => $request->name,
                    "mail" => $request->mail,
                    "password" => $request->password
                ]);
                return response()->json([
                    "status" => "200",
                    "message" => "User created successfully",

                ], 200);
            }
        }
    }

    public function signIn(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            "mail" => "required|string",
            "password" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => "404",
                "message" => "please provide all fields",

            ], 404);
        } else {
            $user = userModel::where("mail", $request->mail)->where("password", $request->password)->get();

            if ($user->count() > 0) {
                return response()->json([
                    "status" => "200",
                    "message" => "Login in success",
                    "user" => $user[0]

                ], 200);
            } else {

                return response()->json([
                    "status" => "404",
                    "message" => "User not found",

                ], 404);
            }
        }
    }

    public function updateUser(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            "name" => "required|string",
            "mail" => "required|string",
            "password" => "required|string",
            "id" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => "404",
                "message" => "please provide all fields",

            ], 404);
        } else {
            $user = userModel::find($request->id);
            if ($user) {
                $user->update([
                    "name" => $request->name,
                    "mail" => $request->mail,
                    "password" => $request->password
                ]);
                return response()->json([
                    "status" => "200",
                    "message" => "User updated",

                ], 200);
            } else {

                return response()->json([
                    "status" => "404",
                    "message" => "User not found",

                ], 404);
            }
        }
    }
    public function deleteUser(Request $request)
    {
        $validator = Validator()->make($request->all(), [

            "id" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => "404",
                "message" => "please provide all fields",

            ], 404);
        } else {
            $user = userModel::find($request->id);
            if ($user) {
                $user->delete();
                return response()->json([
                    "status" => "200",
                    "message" => "User Deleted",

                ], 200);
            } else {

                return response()->json([
                    "status" => "404",
                    "message" => "User not found",

                ], 404);
            }
        }
    }

}