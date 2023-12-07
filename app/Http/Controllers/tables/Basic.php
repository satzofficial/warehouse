<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\ItemsImage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Basic extends Controller
{
  public function index()
  {
    return view('content.tables.tables-basic');
  }

  public function items()
  {
    $ItemsArr = Items::where('status', '1')
      ->orderBy('id', 'desc')
      ->get();
    return view('content.tables.items', compact('ItemsArr'));
  }

  public function composite_items()
  {
    return view('content.tables.composite_items');
  }

  public function add_items()
  {
    return view('content.tables.add_items');
  }

  public function create(Request $request)
  {
    try {
      // Validation rules
      $rules = [
        'name' => 'required',
        'sku' => 'required',
        'unit' => 'required',
        'dimensions' => 'required',
        'manufacturer' => 'required',
        'upc' => 'required',
        'ean' => 'required',
        'weight' => 'required',
        'brand' => 'required',
        'mpn' => 'required',
        'isbn' => 'required',
        'selling_price' => 'required',
        'account' => 'required',
        'description' => 'required',
        'cost_price' => 'required',
        'purchase_account' => 'required',
        'purchase_description' => 'required',
        'preferred_vendor' => 'required',
        'opening_stock' => 'required',
        'opening_stock_rate_per_unit' => 'required',
        'reorder_point' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image in the array
      ];
      $request->validate($rules);
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
        'reorder_point' => $request->reorder_point,
      ];
      $createdItem = Items::create($data);
      $insertedId = $createdItem->id;
      if ($request->hasFile('images')) {
        $imageName = '';
        foreach ($request->file('images') as $image) {
          // local storage
          // $imageName = $image->getClientOriginalName();
          // $uploadedFile = $image->move(public_path('images'), $imageName);
          //   if($uploadedFile){
          //     $slupload = Cloudinary::upload($image->getRealPath());
          //     if($slupload){
          //       $imageName = $slupload->getSecurePath();
          //     }
          // }

          $slupload = Cloudinary::upload($image->getRealPath());
          if ($slupload) {
            $imageName = $slupload->getSecurePath();
          }
          $data = [
            'image_id' => $insertedId,
            'image' => $imageName,
            'type' => 'item_image',
          ];
          ItemsImage::create($data);
        }
      }

      if ($request->header('X-Requested-With') === 'XMLHttpRequests') {
        return response()->json(['status' => true, 'msg' => 'Item added successfully!.', 'redirect' => route('items')]);
      } else {
        return redirect()
          ->route('items')
          ->with(['success' => 'Item added successfully!.']);
      }
    } catch (\Exception $e) {
      // Handle the exception
      Log::error('Exception caught: ' . $e->getMessage());

      return response()->json(['status' => false, 'msg' => 'An error occurred.']);
    }
  }

  public function delete(Request $request, $id = null)
  {
    try {
      if ($request->header('X-Requested-With') === 'XMLHttpRequests') {
        if ($id) {
          $OrginalId = decryptIt($id);
          $item = Items::findOrFail($OrginalId);
          $item->delete();
          ItemsImage::where('image_id', $OrginalId)->delete();

          if ($request->header('X-Requested-With') === 'XMLHttpRequests') {
            return response()->json([
              'status' => true,
              'msg' => 'Item deleted successfully',
              'redirect' => '',
            ]);
          }
        }
      } else {
        abort(304);
      }
    } catch (\Exception $e) {
      // Handle the exception
      Log::error('Exception caught: ' . $e->getMessage());

      return response()->json(['status' => false, 'msg' => 'An error occurred.']);
    }
  }

  public function update(Request $request, $id = null)
  {
    try {
      if ($request->isMethod('get')) {
        $ItemsArr = Items::where('status', '1')
          ->where('id', $id)
          ->first();
        return view('content.tables.edit_items', compact('ItemsArr'));
      }

      if ($request->isMethod('post')) {
        if ($request->header('X-Requested-With') === 'XMLHttpRequests') {
          if ($id) {
            $OrginalId = decryptIt($id);
            $item = Items::findOrFail($OrginalId);
            $item->delete();
            ItemsImage::where('image_id', $OrginalId)->delete();

            if ($request->header('X-Requested-With') === 'XMLHttpRequests') {
              return response()->json([
                'status' => true,
                'msg' => 'Item deleted successfully',
                'redirect' => '',
              ]);
            }
          }
        } else {
          abort(304);
        }
      }
    } catch (\Exception $e) {
      // Handle the exception
      Log::error('Exception caught: ' . $e->getMessage());

      return response()->json(['status' => false, 'msg' => 'An error occurred.']);
    }
  }
}