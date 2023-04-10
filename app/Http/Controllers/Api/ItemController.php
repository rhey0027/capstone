<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    //get all-------------------------------------------------
    public function index()
    {
        $items = Item::all();
        if ($items->count() > 0) {

            return response()->json([
                'status' => 200,
                'items' => $items
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No items found!'
            ], 404);
        }
    }
    //display-------------------------------------------------------------
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required| max: 191',
            'color' => 'required| max: 191',
            'brand' => 'required| max: 191',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $items = Item::create([
                'name' => $request->name,
                'color' => $request->color,
                'brand' => $request->brand,
            ]);
            if ($items) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Items created successfully!'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Please check your input!'
                ], 500);
            }
        }
    }
    //display by id-------------------------------------------------------
    public function display($id)
    {
        $Item = Item::find($id);
        if ($Item) {
            return response()->json([
                'status' => 200,
                'Item' => $Item
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No item found!'
            ], 404);
        }
    }
    public function edit($id)
    {
        $Item = Item::find($id);
        if ($Item) {
            return response()->json([
                'status' => 200,
                'Item' => $Item
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No item found!'
            ], 404);
        }
    }
    //update by id------------------------------------------------
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required| max: 191',
            'color' => 'required| max: 191',
            'brand' => 'required| max: 191',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $Item = Item::find($id);
            if ($Item) {
                $Item->update([
                    'name' => $request->name,
                    'color' => $request->color,
                    'brand' => $request->brand,
                ]);
            }

            if ($Item) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Items updated successfully!'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Please check your input!'
                ], 500);
            }
        }
    }
    //delete by id------------------------------------------------
    public function dispose($id) 
    {
        $Item=Item::find($id);
        if($Item) {
            $Item->delete();
            return response()->json([
                'status'=> 200,
                'message'=> 'Item Deleted Successfully!'
                ], 200);
        }else {
            return response()->json([
                'status'=> 404,
                'message'=> 'No items found!'
                ], 404);
        }
    }
}
