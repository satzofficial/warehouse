<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\ItemsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Basic extends Controller
{
  public function index()
  {
    return view('content.tables.tables-basic');
  }

  public function items()
  {
    return view('content.tables.items');
  }

  public function composite_items()
  {
    return view('content.tables.composite_items');
  }

  public function add_items(){
    return view('content.tables.add_items');
  }

  public function create(Request $request){

      
        // Validation rules
        $rules = [
          'name' => 'trim|required',
          'sku' => 'trim|required',
          'unit' => 'trim|required',
          'dimensions' => 'trim|required',
          'manufacturer' => 'trim|required',
          'upc' => 'trim|required',
          'ean' => 'trim|required',
          'weight' => 'trim|required',
          'brand' => 'trim|required',
          'mpn' => 'trim|required',
          'isbn' => 'trim|required',
          'selling_price' => 'trim|required',
          'account' => 'trim|required',
          'description' => 'trim|required',
          'cost_price' => 'trim|required',
          'purchase_account' => 'trim|required',
          'purchase_description' => 'trim|required',
          'preferred_vendor' => 'trim|required',
          'opening_stock' => 'trim|required',
          'opening_stock_rate_per_unit' => 'trim|required',
          'reorder_point' => 'trim|required',
          // 'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image in the array
      ];

      $request->validate($rules);
      
      // // Custom error messages
      // $messages = [
      //     // 'images.*.image' => 'Each file must be an image.',
      //     // 'images.*.mimes' => 'Allowed image file types: jpeg, png, jpg, gif.',
      //     // 'images.*.max' => 'Each image must not exceed 2MB.',
      // ];

      // // Validate the request
      // $validator = Validator::make($request->all(), $rules, $messages);

      // // Check for validation errors
      // if ($validator->fails()) {        
      //     return redirect()->back()->withErrors($validator)->withInput();
      // }
      $data = [
        'name' => $request->name,
        'sku' => $request->sku,
        'unit' => $request->unit,
        'dimensions' => $request->dimensions,
        'manufacturer' => $request->manufacturer,
        'upc' => $request->upc,
        'ean' => $request->ean,
        'weight' => $request->weight,
        'brand' => $request->brand,
        'mpn' => $request->mpn,
        'isbn' => $request->isbn,
        'selling_price' => $request->selling_price,
        'account' => $request->account,
        'description' => $request->description,
        'cost_price' => $request->cost_price,
        'purchase_account' => $request->purchase_account,
        'purchase_description' => $request->purchase_description,
        'preferred_vendor' => $request->preferred_vendor,
        'opening_stock' => $request->opening_stock,
        'opening_stock_rate_per_unit' => $request->opening_stock_rate_per_unit,
        'reorder_point' => $request->reorder_point        
      ];
      // dd($data);
      $createdItem = Items::create($data);
      $insertedId = $createdItem->id;
      if ($request->hasFile('images')){
        foreach ($request->file('images') as $image) {
          $imageName = $image->getClientOriginalName();
          $image->move(public_path('images'), $imageName);
          $data = [
            'image_id' => $insertedId,
            'image' => $imageName
          ];
          ItemsImage::create($data);
        }
      }

      return response()->json(['status' => true, 'msg' => 'Item added successfully', 'redirect' => '2']);
  }
}
