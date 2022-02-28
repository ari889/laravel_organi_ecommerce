<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function getallproducts(Request $request){
        if($request->ajax()){
            $product = new Product();

            if(!empty($request->name)){
                $product->setName($request->name);
            }

            if(!empty($request->sku)){
                $product->setSku($request->sku);
            }

            if(!empty($request->category)){
                $product->setCategory($request->category);
            }

            /**
             * find this value from model
             */
            $product->setOrderValue($request->input('order.0.column'));
            $product->setDirValue($request->input('order.0.dir'));
            $product->setLengthValue($request->input('length'));
            $product->setStartValue($request->input('start'));

            $list = $product->getList();

            $data = [];
            $no = $request->input('start');
            foreach($list as $value){
                $product_image = json_decode($value->image);
                $no++;
                $action = '';
                $action .= '<li><a class="dropdown-item " href="'.route('admin.product.edit', ['id' => $value->id]).'"><i class="fa-solid fa-edit text-primary me-2"></i>Edit</a></li>';
                $action .= '<li><a class="dropdown-item view_data" data-id="'.$value->id.'" href="#"><i class="fa-solid fa-eye text-warning me-2"></i>View</a></li>';
                $action .= '<li><a class="dropdown-item delete_data" data-id="'.$value->id.'" data-name="'.$value->name.'" href="#"><i class="fa-solid fa-trash text-danger me-2"></i>Delete</a></li>';

                $btngroup = '<div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-th-list"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                '.$action.'
                                </ul>
                            </div>';

                $row = [];
                $row[] = '<div class="form-check">
                            <input class="form-check-input select_data single_item_'.$value->id.'" onchange="select_single_item('.$value->id.')" value="'.$value->id.'" name="did[]" type="checkbox" value="" id="checkbox'.$value->id.'">
                            <label class="form-check-label" for="checkbox'.$value->id.'"></label>
                        </div>';
                $row[] = $no;
                $row[] = $value->name;
                $row[] = '<img width="100" src="storage/'.$product_image[1].'" alt="">';
                $row[] = $value->sku;
                $row[] = '$'.$value->regular_price;
                $row[] = '$'.$value->sale_price;
                $row[] = $value->category->name;
                $row[] = $btngroup;

                $data[] = $row;
            }

            $output = array(
                'draw' => $request->input('draw'),
                'recordsTotal' => $product->count_filtered(),
                'recordsFiltered' => $product->count_all(),
                'data' => $data
            );

            echo json_encode($output);
        }
    }

    public function delete(Request $request){
        if($request->ajax()){
            $product = Product::find($request->id);

            if(Storage::disk('public')->exists(json_decode($product->image)[0])){
                Storage::disk('public')->delete(json_decode($product->image)[0]);
            }

            if(Storage::disk('public')->exists(json_decode($product->image)[1])){
                Storage::disk('public')->delete(json_decode($product->image)[1]);
            }

            if($product->images != null){
                $images = json_decode($product->images);
                foreach($images as $image){
                    if(Storage::disk('public')->exists($image)){
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $product->delete();

            return response()->json(['status' => 'success', 'message' => 'Product Deleted']);
        }
    }

    /**
     * bulk delete
     */
    public function bulkDelete(Request $request){
        if($request->ajax()){
            $products = Product::toBase()->whereIn('id', $request->ids)->get();

            $result = Product::destroy($request->ids);

            if($result){
                if(!empty($products)){
                    foreach($products as $product){
                        if(!empty($product->image)){
                            if(Storage::disk('public')->exists(json_decode($product->image)[0])){
                                Storage::disk('public')->delete(json_decode($product->image)[0]);
                            }

                            if(Storage::disk('public')->exists(json_decode($product->image)[1])){
                                Storage::disk('public')->delete(json_decode($product->image)[1]);
                            }
                        }

                        if($product->images != null){
                            $images = json_decode($product->images);
                            foreach($images as $image){
                                if(Storage::disk('public')->exists($image)){
                                    Storage::disk('public')->delete($image);
                                }
                            }
                        }
                    }

                    $output = ['status' => 'success', 'message' => 'Data Deleted'];
                }else{
                    $output = ['status' => 'error', 'message' => 'Something went wrong'];
                }
            }else{
                $output = ['status' => 'error', 'message' => 'Something went wrong'];
            }

            return response()->json($output);
        }
    }
}
