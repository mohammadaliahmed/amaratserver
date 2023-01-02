<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class AppController extends Controller
{
    //
    public function Register(Request $request)
    {
        if (!empty($request->email)) {
            $customer_has_mail = Customer::Where('email', $request->email)->count();
            if ($customer_has_mail != 0) {
                return response()->json([
                    'code' => Response::HTTP_FORBIDDEN, 'message' =>"Email already exists"
                ], Response::HTTP_FORBIDDEN);
            }
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'is_active' => 1,
        ]);
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "Saved", 'error' => "", "customer" => $customer
        ], Response::HTTP_OK);

    }

    public function Login(Request $request)
    {
        if (!empty($request->email)) {
            $customer_has_mail = Customer::Where('email', $request->email)->count();
            if ($customer_has_mail == 0) {
                return response()->json([
                    'code' => Response::HTTP_FORBIDDEN, 'message' => "Account does not exists. Please signup"
                ], Response::HTTP_FORBIDDEN);
            } else {
                $customer = Customer::where('email', $request->email)
                    ->where('password', md5($request->password))->first();
                if (!isset($customer)) {
                    return response()->json([
                        'code' => Response::HTTP_FORBIDDEN,  'message' => "Wrong password"
                    ], Response::HTTP_FORBIDDEN);
                } else {
                    return response()->json([
                        'code' => Response::HTTP_OK,  'message' => "",'customer'=>$customer
                    ], Response::HTTP_OK);
                }

            }
        }

    }

    public function ListProducts(){
        $products=Product::all();
        foreach ($products as $product){
            $unit=Unit::where('id',$product->unit_id)->pluck('shortname');
            if(sizeof($unit)>0){
                $product->unit=$unit[0];
            }else{
                $product->unit="";
            }

        }
        return response()->json([
            'code' => Response::HTTP_OK,  'message' => "",'products'=>$products
        ], Response::HTTP_OK);
    }

    public function PlaceOrder(Request $request){

    }
}
