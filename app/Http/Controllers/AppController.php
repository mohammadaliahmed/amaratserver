<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SelledItems;
use App\Models\Sites;
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
                    'code' => Response::HTTP_FORBIDDEN, 'message' => "Email already exists"
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
    public function UpdateProfile(Request $request){
        $customer=Customer::find($request->userId);
        $customer->phone_number=$request->phone;
        $customer->name=$request->name;
        $customer->cnic=$request->cnic;
        $customer->famous=$request->famous;
        $customer->update();
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
                        'code' => Response::HTTP_FORBIDDEN, 'message' => "Wrong password"
                    ], Response::HTTP_FORBIDDEN);
                } else {
                    return response()->json([
                        'code' => Response::HTTP_OK, 'message' => "", 'customer' => $customer
                    ], Response::HTTP_OK);
                }

            }
        }

    }

    public function GetCustomer($id){
        $customer = Customer::where('id',$id)->with('sites')->get();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "", 'customer' => $customer
        ], Response::HTTP_OK);
    }

    public function ListProducts()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $unit = Unit::where('id', $product->unit_id)->pluck('shortname');
            if (sizeof($unit) > 0) {
                $product->unit = $unit[0];
            } else {
                $product->unit = "";
            }

        }
        $categories=Category::all();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "", 'products' => $products, 'categories' => $categories
        ], Response::HTTP_OK);
    }

    public function PlaceOrder(Request $request)
    {

        $latest = Sale::orderBy('created_at', 'desc')->first();
        $invoice_id = $latest ? $latest->invoice_id + 1 : 1;

        $sale = new Sale();
        $sale->customer_id = $request->userId;
        $sale->invoice_id = $invoice_id;
        $sale->branch_id = 0;
        $sale->cash_register_id = 0;
        $sale->status = 0;
        $sale->created_by = 1;
        $sale->site_id = $request->site_id;
        $sale->save();
//
        foreach ($request->items as $key => $value) {
            $product = Product::find($key);
            $product_id = $key;
            $selleditems = new SelledItems();
            $selleditems->sell_id = $sale->id;
            $selleditems->product_id = $key;
            $selleditems->price = $product->sale_price;
            $selleditems->quantity = $value;
            $selleditems->tax_id = 0;
            $selleditems->tax = 0;

            $selleditems->save();
        }
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success"
        ], Response::HTTP_OK);

    }

    public function MyOrders($id)
    {
        $sales = Sale::where('customer_id',$id)->orderBy('id','desc')->with('site')->with('items')->get();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success", 'sales' => $sales
        ], Response::HTTP_OK);
    }

    public function OrderItems($id)
    {
        $sellItems = SelledItems::where('sell_id',$id)->with('product')->get();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success", 'sellItems' => $sellItems
        ], Response::HTTP_OK);
    }


    public function AddSite(Request  $request){

        Sites::create([
            'house' => $request->house,
            'address' => $request->address,
            'street' =>$request->street,
            'sector' => $request->sector,
            'near' => $request->near,
            'customer_id' => $request->userId,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success",
        ], Response::HTTP_OK);



    }
    public function GetSites($id){
        $sites= Sites::where('customer_id',$id)->get();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success",'sites'=>$sites
        ], Response::HTTP_OK);
    }

    public function EditSite(Request $request){
        $site=Sites::find($request->siteId);
        $site->address=$request->address;
        $site->details=$request->details;
        $site->name=$request->name;
        $site->latitude=$request->latitude;
        $site->longitude=$request->longitude;

        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success",
        ], Response::HTTP_OK);
    }

    public function DeleteSite($id){
        $site=Sites::find($id);
        $site->delete();

        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success",
        ], Response::HTTP_OK);
    }

    public function CategoryProducts($id){
        $products=Product::where('category_id',$id)->get();
        foreach ($products as $product) {
            $unit = Unit::where('id', $product->unit_id)->pluck('shortname');
            if (sizeof($unit) > 0) {
                $product->unit = $unit[0];
            } else {
                $product->unit = "";
            }

        }
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success",'products'=>$products
        ], Response::HTTP_OK);
    }


    public function Categories(){
        $categories=Category::all();
        return response()->json([
            'code' => Response::HTTP_OK, 'message' => "success",'categories'=>$categories
        ], Response::HTTP_OK);
    }
}
