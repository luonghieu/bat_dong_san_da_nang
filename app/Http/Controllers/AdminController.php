<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\NewsCreateRequest;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\User;
use App\Models\News;
use App\Models\CatNew;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Category;
use App\Models\District;
use App\Models\Village;
use App\Models\Street;
use Carbon;
 
class AdminController extends Controller
{
    // =======leader management========
    // list
    public function listLeaders()
    {
        $list  = Employee::select('employees.*')->join('users','user_id','users.id')->where('role',User::ROLE['leader'])->get();
        return view('admin.employee.index', ['list' => $list]);
    }

    // create or edit
    public function createOrUpdateLeader(EmployeeCreateRequest $request)
    {
    	$data = $request->except(['id']);
        if ($obj = Employee::updateOrCreate(['id' => $request->id], $data)) {
        	if ($obj->user_id == 0) {
        		$objUser = User::create([
        		'username' => $obj->name,
        		'password' => bcrypt('1234567'),
        		'email' => 'abc@gmail.com',
        		'role' => User::ROLE['leader'],
        		'active' => 1
	        	]);

	        	$obj->update(['user_id' => $objUser->id]);
        	}
        	
        	$result = [
        		'id' => $obj->id,
        		'name' => $obj->name,
        		'phone' => $obj->phone,
        		'gender' => $obj->gender==0?'Male':'Female',
        		'address' => $obj->address,
        		'district' => $obj->district->name,

        	];
            echo json_encode($result);
        }
    }

    // delete
    public function deleteLeader(Request $request)
    {
    	$obj = Employee::find($request->id);
    	if ($obj->delete()) {
    		if (User::find($obj->user_id)->delete()) {
    			echo json_encode('ok');
    		}
    	}
    }

    // ==========sale management=============
    // list
    public function listSales()
    {
        $list  = Employee::select('employees.*')->join('users','user_id','users.id')->where('role',User::ROLE['sale'])->get();
        return view('admin.employee.index', ['list' => $list]);
    }

    // create or edit
    public function createOrUpdateSale(EmployeeCreateRequest $request)
    {
    	$data = $request->except(['id']);
        if ($obj = Employee::updateOrCreate(['id' => $request->id], $data)) {
            if ($obj->user_id == 0) {
                $objUser = User::create([
                'username' => $obj->name,
                'password' => bcrypt('1234567'),
                'email' => 'abc@gmail.com',
                'role' => User::ROLE['sale'],
                'active' => 1
                ]);

                $obj->update(['user_id' => $objUser->id]);
            }
            
            $result = [
                'id' => $obj->id,
                'name' => $obj->name,
                'phone' => $obj->phone,
                'gender' => $obj->gender==0?'Male':'Female',
                'address' => $obj->address,
                'district' => $obj->district->name,

            ];
            echo json_encode($result);
        }
    }

    //delete
    public function deleteSale(Request $request)
    {
    	$obj = Employee::find($request->id);
    	if ($obj->delete()) {
    		if (User::find($obj->user_id)->delete()) {
    			echo json_encode('ok');
    		}
    	}
    }

    // ==========post customer management=============
    // list
    public function listPostCustomer()
    {
        $list  = Customer::where('type_customer',Customer::TYPECUSTOMER['post'])->get();
        return view('admin.customer.postCustomer.index', ['list' => $list]);
    }

    // apply action
    public function actionPostCustomer(Request $request)
    {
        $listObj = Customer::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
            case 1:
                foreach ($listObj as $item) {
                    if ($item->delete()) {
                        User::find($item->user_id)->delete();
                    }
                }
                break;
            case 2:
                foreach ($listObj as $item) {
                    $item->update(['active' => 1]);
                }
                break;
            case 3:
                foreach ($listObj as $item) {
                    $item->update(['active' => 0]);
                }
                break;
        }
            return redirect()->route('admins.postCustomer.list')->with('success', 'Success');
        } else {

        }
        
    }

    // active
    public function activePostCustomer(Request $request)
    {
        $objUpdate = Customer::find($request->id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    //delete
    public function deletePostCustomer(Request $request)
    {
    	$obj = Customer::find($request->id);
    	if ($obj->delete()) {
    		if (User::find($obj->user_id)->delete()) {
    			echo json_encode('ok');
    		}
    	}
    }

    // detail product transaction
    public function detailProductTransaction($customer_id)
    {
        $list = Customer::find($customer_id)->productTransaction()->get();
        return view('admin.customer.postCustomer.detail', ['list' => $list, 'customer_id' => $customer_id]);
    }

    public function activeProductTransaction(Request $request)
    {
        $objUpdate = ProductTransaction::find($request->id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    public function activePaidProductTransaction(Request $request)
    {
        $objUpdate = ProductTransaction::find($request->id);
        $objUpdate->update(['payed' => !($objUpdate->payed)]);
        echo json_encode('ok');
    }

     //delete
    public function deleteProductTransaction(Request $request)
    {
        $obj = ProductTransaction::find($request->id);
        if ($obj->delete()) {
            $deleteProduct = Product::find($obj->product_id);
            if ($deleteProduct->delete()) {
                if (!empty($deleteProduct->image)) {
                    unlink($deleteProduct->image);
                }
                echo json_encode('ok');
            }
        }
    }

    // apply action
    public function actionProductTransaction(Request $request)
    {
        $listObj = ProductTransaction::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
            case 1:
                foreach ($listObj as $item) {
                    if ($item->delete()) {
                        $deleteProduct = Product::find($item->product_id);
                        if ($deleteProduct->delete()) {
                            if (!empty($deleteProduct->image)) {
                                unlink($deleteProduct->image);
                            }
                        }
                    }
                }
                break;
            case 2:
                foreach ($listObj as $item) {
                    $item->update(['active' => 1]);
                }
                break;
            case 3:
                foreach ($listObj as $item) {
                    $item->update(['active' => 0]);
                }
                break;
            case 4:
                foreach ($listObj as $item) {
                    $item->update(['payed' => 0]);
                }
                break;
            case 5:
                foreach ($listObj as $item) {
                    $item->update(['payed' => 0]);
                }
                break;
        }
            return redirect()->route('admins.postCustomer.detail',['customer_id' => $request->customer_id])->with('success', 'Success');
        } else {

        }
        
    }

    // ==========purchase customer management=============
    // list
    public function listPurchaseCustomer()
    {
        $list  = Customer::where('type_customer',Customer::TYPECUSTOMER['purchase'])->get();
        return view('admin.customer.purchaseCustomer.index', ['list' => $list]);
    }

    // apply action
    public function actionPurchaseCustomer(Request $request)
    {
        $listObj = Customer::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
            case 1:
                foreach ($listObj as $item) {
                    $item->delete();
                }
                break;
            case 2:
                foreach ($listObj as $item) {
                    $item->update(['active' => 1]);
                }
                break;
            case 3:
                foreach ($listObj as $item) {
                    $item->update(['active' => 0]);
                }
                break;
        }
            return redirect()->route('admins.purchaseCustomer.list')->with('success', 'Success');
        } else {

        }
        
    }

    // activeDeposit
    public function activePurchaseCustomer(Request $request)
    {
        $objUpdate = Customer::find($request->id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    //delete
    public function deletePurchaseCustomer(Request $request)
    {
        $obj = Customer::find($request->id);
        if ($obj->delete()) {
            echo json_encode('ok');
        }
    }

    // detail purchase transaction
    public function detailPurchaseTransaction($customer_id)
    {
        $list = Customer::find($customer_id)->purchaseTransaction()->get();
        return view('admin.customer.purchaseCustomer.detail', ['list' => $list, 'customer_id' => $customer_id]);
    }

    public function activeDepositPurchaseTransaction(Request $request)
    {
        $objUpdate = PurchaseTransaction::find($request->id);
        $objUpdate->update(['deposit' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    public function activePaymentProductTransaction(Request $request)
    {
        $objUpdate = PurchaseTransaction::find($request->id);
        $objUpdate->update(['payment' => !($objUpdate->payed)]);
        echo json_encode('ok');
    }

     //delete
    public function deletePurchaseTransaction(Request $request)
    {
        $obj = PurchaseTransaction::find($request->id);
        if ($obj->delete()) {
            echo json_encode('ok');
        }
    }

    // apply action
    public function actionPurchaseTransaction(Request $request)
    {
        $listObj = PurchaseTransaction::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
            case 1:
                foreach ($listObj as $item) {
                    $item->delete();
                }
                break;
            case 2:
                foreach ($listObj as $item) {
                    $item->update(['deposit' => 1]);
                }
                break;
            case 3:
                foreach ($listObj as $item) {
                    $item->update(['deposit' => 0]);
                }
                break;
            case 4:
                foreach ($listObj as $item) {
                    $item->update(['payment' => 0]);
                }
                break;
            case 5:
                foreach ($listObj as $item) {
                    $item->update(['payment' => 0]);
                }
                break;
        }
            return redirect()->route('admins.purchaseCustomer.detail',['customer_id' => $request->customer_id])->with('success', 'Success');
        } else {

        }
        
    }

    // ==========purchase customer management=============
    // news
    public function listNews()
    {
        $list  = News::all();
        return view('admin.news.index', ['list' => $list]);
    }

    // edit
    public function createNews()
    {
       $listCat = CatNew::where('active',1)->get();
       return view('admin.news.add', ['listCat' => $listCat]);
    }

    // store
    public function storeNews(NewsCreateRequest $request)
    {
        $data = $request->all();
        $data['created_at'] = Carbon\Carbon::now();;

        if ($request->hasFile('image')) {
            $path = "images/news/";
            $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($path, $fileName);
            $data['image'] = $path . $fileName;
        } else {
            $data['image'] = "";
        }
        
       if (News::create($data)) {
            return redirect()->route('admins.news.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    // create or edit
    public function editNews($id)
    {
        $listCat = CatNew::where('active',1)->get();
        $obj = News::find($id);
        return view('admin.news.edit', ['obj' => $obj, 'listCat' => $listCat]);
    }

    // update
    public function updateNews(NewsCreateRequest $request, $id)
    {
        $oldObj = News::find($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            if (!empty($oldObj->image)) {
                unlink($oldObj->image);
            }
            $path = "images/news/";
            $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($path, $fileName);
            $data['image'] = $path . $fileName;
        } else {
            $data['image'] = $oldObj->image;
        }
        
       if ($oldObj->update($data)) {
            return redirect()->route('admins.news.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    //delete
    public function deleteNews($id)
    {
        $obj = News::find($id);
        if ($obj->delete()) {
            if (!empty($obj->image)) {
                unlink($obj->image);
            }
            echo json_encode('ok');
        }
    }

    // apply action
    public function action(Request $request)
    {
        $listObj = News::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
            case 1:
                foreach ($listObj as $item) {
                    if (!empty($item->image)) {
                        unlink($item->image);
                    }
                    $item->delete();
                }
                break;
            case 2:
                foreach ($listObj as $item) {
                    $item->update(['active' => 1]);
                }
                break;
            case 3:
                foreach ($listObj as $item) {
                    $item->update(['active' => 0]);
                }
                break;
        }
            return redirect()->route('admins.news.list')->with('success', 'Success');
        } else {

        }
        
    }

    // active
    public function active(Request $request)
    {
        $objUpdate = News::find($request->id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    // =========Products=============

    // products
    public function listProducts()
    {
        $list  = Product::all();
        return view('admin.product.index', ['list' => $list]);
    }

    // edit
    public function createProduct()
    {
       $listCat = Category::all();
       $villages = Village::all();
       $streets = Street::all();
       $districts = District::all();
       $direction = Product::DIRECTION;
       return view('admin.product.add', [
            'listCat' => $listCat,
            'villages' => $villages,
            'streets' => $streets,
            'districts' => $districts,
            'direction' => $direction
        ]);
    }

    // // store
    // public function storeNews(NewsCreateRequest $request)
    // {
    //     $data = $request->all();
    //     $data['created_at'] = Carbon\Carbon::now();;

    //     if ($request->hasFile('image')) {
    //         $path = "images/news/";
    //         $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
    //         $request->image->move($path, $fileName);
    //         $data['image'] = $path . $fileName;
    //     } else {
    //         $data['image'] = "";
    //     }
        
    //    if (News::create($data)) {
    //         return redirect()->route('admins.news.list')->with('success', 'Success');
    //     } else {
    //         return redirect()->back()->withInput()->with('error', 'Fail');
    //     }
    // }

    // // create or edit
    // public function editNews($id)
    // {
    //     $listCat = CatNew::where('active',1)->get();
    //     $obj = News::find($id);
    //     return view('admin.news.edit', ['obj' => $obj, 'listCat' => $listCat]);
    // }

    // // update
    // public function updateNews(NewsCreateRequest $request, $id)
    // {
    //     $oldObj = News::find($id);
    //     $data = $request->all();

    //     if ($request->hasFile('image')) {
    //         if (!empty($oldObj->image)) {
    //             unlink($oldObj->image);
    //         }
    //         $path = "images/news/";
    //         $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
    //         $request->image->move($path, $fileName);
    //         $data['image'] = $path . $fileName;
    //     } else {
    //         $data['image'] = $oldObj->image;
    //     }
        
    //    if ($oldObj->update($data)) {
    //         return redirect()->route('admins.news.list')->with('success', 'Success');
    //     } else {
    //         return redirect()->back()->withInput()->with('error', 'Fail');
    //     }
    // }

    //delete
    public function deleteProduct($id)
    {
        $obj = Product::find($id);
        if ($obj->delete()) {
            if (!empty($obj->image)) {
                unlink($obj->image);
            }
            ProductTransaction::where('product_id', $obj->id)->delete();
            PurchaseTransaction::where('product_id', $obj->id)->delete();
            echo json_encode('ok');
        }
    }

    // // apply action
    // public function action(Request $request)
    // {
    //     $listObj = News::whereIn('id', $request->selected)->get();
    //     if (!empty($listObj)) {
    //         switch ($request->option) {
    //         case 1:
    //             foreach ($listObj as $item) {
    //                 if (!empty($item->image)) {
    //                     unlink($item->image);
    //                 }
    //                 $item->delete();
    //             }
    //             break;
    //         case 2:
    //             foreach ($listObj as $item) {
    //                 $item->update(['active' => 1]);
    //             }
    //             break;
    //         case 3:
    //             foreach ($listObj as $item) {
    //                 $item->update(['active' => 0]);
    //             }
    //             break;
    //     }
    //         return redirect()->route('admins.news.list')->with('success', 'Success');
    //     } else {

    //     }
        
    // }

    // // active
    // public function active(Request $request)
    // {
    //     $objUpdate = News::find($request->id);
    //     $objUpdate->update(['active' => !($objUpdate->active)]);
    //     echo json_encode('ok');
    // }
    
    // detail product transaction
    public function detailProduct($product_id)
    {
        $obj = Product::find($product_id);
        return view('admin.product.detail', ['obj' => $obj]);
    }


}