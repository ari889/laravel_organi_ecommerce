<?php

namespace App\Http\Controllers\Backend\Coupon;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class AdminCouponController extends Controller
{
    /**
     * get all coupon
     */
    public function getAllCoupon(Request $request){
        if($request->ajax()){
            $coupon = new Coupon();

            /**
             * set search value
             */
            if(!empty($request->code)){
                $coupon->setCode($request->code);
            }
            if(!empty($request->type)){
                $coupon->setType($request->type);
            }
            if(!empty($request->value)){
                $coupon->setValue($request->value);
            }
            if(!empty($request->cart_value)){
                $coupon->setCartValue($request->cart_value);
            }
            if(!empty($request->expiry_date)){
                $coupon->setExpiryDate($request->expiry_date);
            }

            /**
             * set value
             */
            $coupon->setOrderValue($request->input('order.0.column'));
            $coupon->setDirValue($request->input('order.0.dir'));
            $coupon->setLengthValue($request->input('length'));
            $coupon->setStartValue($request->input('start'));

            $list = $coupon->getList();

            $data = [];
            $no = $request->input('start');
            foreach($list as $value){
                $no++;
                $action = '';
                $action .= '<li><a class="dropdown-item " href="'.route('admin.editcoupon', ['id' => $value->id]).'"><i class="fa-solid fa-edit text-primary me-2"></i>Edit</a></li>';
                $action .= '<li><a class="dropdown-item view_data" data-id="'.$value->id.'" href="#"><i class="fa-solid fa-eye text-warning me-2"></i>View</a></li>';
                $action .= '<li><a class="dropdown-item delete_data" data-id="'.$value->id.'" data-name="'.$value->code.'" href="#"><i class="fa-solid fa-trash text-danger me-2"></i>Delete</a></li>';

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
                $row[] = $value->code;
                $row[] = $value->type;
                $row[] = $value->value;
                $row[] = $value->cart_value;
                $row[] = $value->expiry_date;
                $row[] = $btngroup;

                $data[] = $row;
            }

            $output = array(
                'draw' => $request->input('draw'),
                'recordsTotal' => $coupon->count_all(),
                'recordsFiltered' => $coupon->count_all(),
                'data' => $data
            );

            echo json_encode($output);
        }
    }

    /**
     * delete coupon
     */
    public function destroy(Request $request){
        $coupon = Coupon::find($request->id);
        $coupon->delete();
        return response()->json(['status' => 'success', 'message' => 'Coupon Deleted']);
    }

    /**
     * bulk delete
     */
    public function bulkDelete(Request $request){
        if($request->ajax()){
            $coupons = Coupon::toBase()->whereIn('id', $request->ids)->get();
            $result = Coupon::destroy($request->ids);
            if($result){
                if(!empty($coupons)){
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
