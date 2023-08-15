<?php

namespace App\Http\Controllers;

use App\Models\todoModel;
use App\Models\userModel;
use Illuminate\Http\Request;

class todoContoller extends Controller
{
    public function addTodo(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            "user_id" => "required",
            "todo" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => "404",
                "message" => "please provide all fields"
            ], 404);
        } else {
            $user = userModel::find($request->user_id);
            if ($user) {
                todoModel::create([
                    "todo" => $request->todo,
                    "user_id" => $request->user_id,
                    "status" => "false",
                    "is_deleted" => "false"
                ]);
                return response()->json([
                    "status" => "200",
                    "message" => "Todo added successfully"
                ], 200);
            } else {
                return response()->json([
                    "status" => "404",
                    "message" => "user not found"
                ], 404);
            }
        }

    }

    public function updateTodo(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            "user_id" => "required",
            "todo" => "required",
            "status" => "required",
            "is_deleted" => "required",
            "todo_id" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => "404",
                "message" => "please provide all fields"
            ], 404);
        } else {
            $user = userModel::find($request->user_id);
            if ($user) {
                $todo = todoModel::find($request->todo_id);
                if ($todo) {
                    $todo->update([
                        "todo" => $request->todo,
                        "user_id" => $request->user_id,
                        "status" => $request->status,
                        "is_deleted" => $request->is_deleted,
                    ]);
                    return response()->json([
                        "status" => "200",
                        "message" => "Todo updated successfully"
                    ], 200);
                } else {
                    return response()->json([
                        "status" => "404",
                        "message" => "Todo not found"
                    ], 404);
                }

            } else {
                return response()->json([
                    "status" => "404",
                    "message" => "user not found"
                ], 404);
            }
        }

    }

    public function deleteTodo(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            "user_id" => "required",
            "todo_id" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => "404",
                "message" => "please provide all fields"
            ], 404);
        } else {
            $user = userModel::find($request->user_id);
            if ($user) {
                $todo = todoModel::find($request->todo_id);
                if ($todo) {
                    $todo->delete();
                    return response()->json([
                        "status" => "200",
                        "message" => "Todo deleted successfully"
                    ], 200);
                } else {
                    return response()->json([
                        "status" => "404",
                        "message" => "Todo not found"
                    ], 404);
                }

            } else {
                return response()->json([
                    "status" => "404",
                    "message" => "user not found"
                ], 404);
            }
        }

    }
    public function getTodo(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            "user_id" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => "404",
                "message" => "please provide all fields"
            ], 404);
        } else {
            $user = userModel::find($request->user_id);
            if ($user) {
                $todo = todoModel::where("user_id", $request->user_id)->get();
                if ($todo->count() > 0) {

                    return response()->json([
                        "status" => "200",
                        "message" => "Todo fetched successfully",
                        "todo" => $todo
                    ], 200);
                } else {
                    return response()->json([
                        "status" => "404",
                        "message" => "Todo not found"
                    ], 404);
                }

            } else {
                return response()->json([
                    "status" => "404",
                    "message" => "user not found"
                ], 404);
            }
        }

    }
}