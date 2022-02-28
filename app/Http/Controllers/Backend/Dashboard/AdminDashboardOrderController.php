<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class AdminDashboardOrderController extends Controller
{
    /**
     * get all orders using datatable
     */
    public function getAllOrders(Request $request){
        if($request->ajax()){
            $order = new Order();

            if(!empty($request->order_id)){
                $order->setOrderId($request->order_id);
            }

            if(!empty($request->mobile)){
                $order->setMobile($request->mobile);
            }

            if(!empty($request->email)){
                $order->setEmail($request->email);
            }

            if(!empty($request->status)){
                $order->setStatus($request->status);
            }

             /**
             * find this value from model
             */
            $order->setOrderValue($request->input('order.0.column'));
            $order->setDirValue($request->input('order.0.dir'));
            $order->setLengthValue($request->input('length'));
            $order->setStartValue($request->input('start'));

            $list = $order->getList();

            $data = [];
            $no = $request->input('start');
            foreach($list as $value){
                $no++;
                $action = '';
                $action .= '<li><a class="dropdown-item " href="'.route('admin.order.edit', ['id' => $value->id]).'"><i class="fa-solid fa-edit text-primary me-2"></i>Edit</a></li>';
                $action .= '<li><a class="dropdown-item view_data" href="'.route('admin.order.view', ['id' => $value->id]).'"><i class="fa-solid fa-eye text-warning me-2"></i>View</a></li>';
                $action .= '<li><a class="dropdown-item delete_data" data-id="'.$value->id.'" href="#"><i class="fa-solid fa-trash text-danger me-2"></i>Delete</a></li>';

                $btngroup = '<div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-th-list"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                '.$action.'
                                </ul>
                            </div>';

                $order_status = '';
                if($value->status == 'ordered'){
                    $order_status = '<span class="badge bg-info rounded-pill">Ordered</span>';
                }else if($value->status == 'delivered'){
                    $order_status = '<span class="badge bg-success rounded-pill">Delivered</span>';
                }else if($value->status == 'cancel'){
                    $order_status = '<span class="badge bg-danger rounded-pill">Cancelled</span>';
                }

                $orderItems = '';
                foreach($value->orderItems as $item){
                    $orderItems .= '<ul>
                        <li>'.Str::limit($item->product->name, 30, '...').'<b> x '.$item->quantity.'</b></li>
                    </ul>';
                }

                $row = [];
                $row[] = '<div class="form-check">
                            <input class="form-check-input select_data single_item_'.$value->id.'" onchange="select_single_item('.$value->id.')" value="'.$value->id.'" name="did[]" type="checkbox" value="" id="checkbox'.$value->id.'">
                            <label class="form-check-label" for="checkbox'.$value->id.'"></label>
                        </div>';
                $row[] = $no;
                $row[] = $orderItems;
                $row[] = $value->user->name;
                $row[] = $value->subtotal;
                $row[] = $value->tax;
                $row[] = $value->total;
                $row[] = $value->mobile;
                $row[] = $value->email;
                $row[] = Carbon::parse($value->created_at)->diffForHumans();
                $row[] = $order_status;
                $row[] = $btngroup;

                $data[] = $row;
            }

            $output = array(
                'draw' => $request->input('draw'),
                'recordsTotal' => $order->count_filtered(),
                'recordsFiltered' => $order->count_all(),
                'data' => $data
            );

            echo json_encode($output);

        }
    }

    /**
     * delete order
     */
    public function destroy(Request $request){
        $order = Order::find($request->id);

        /**
         * delete transection
         */
        $transection = Transection::where('order_id', $order->id)->first();
        if($transection){
            $transection->delete();
        }

        /**
         * delete shipping data
         */
        $shipping = Shipping::where('order_id', $order->id)->first();
        if($shipping){
            $shipping->delete();
        }

        /**
         * delete order items
         */
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        if($orderItems){
            foreach($orderItems as $item){
                $item->delete();
            }
        }
        $order->delete();


        return response()->json(['status' => 'success', 'message' => 'Order data Deleted']);
    }

    /**
     * bulk delete
     */
    public function bulkDelete(Request $request){
        if($request->ajax()){
            $orders = Order::toBase()->whereIn('id', $request->ids)->get();

            $result = Order::destroy($request->ids);

            if($result){
                if(!empty($orders)){
                    foreach($orders as $order){
                        /**
                         * delete transection
                         */
                        $transection = Transection::where('order_id', $order->id)->first();
                        if($transection){
                            $transection->delete();
                        }

                        /**
                         * delete shipping data
                         */
                        $shipping = Shipping::where('order_id', $order->id)->first();
                        if($shipping){
                            $shipping->delete();
                        }

                        /**
                         * delete order items
                         */
                        $orderItems = OrderItem::where('order_id', $order->id)->get();
                        if($orderItems){
                            foreach($orderItems as $item){
                                $item->delete();
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
