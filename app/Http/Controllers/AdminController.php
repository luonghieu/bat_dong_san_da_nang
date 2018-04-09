<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Models\AssignTask;
use App\Models\Post;
use App\Models\Poster;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\NewsCreateRequest;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\User;
use App\Models\News;
use App\Models\CatNew;
use App\Models\Product;
use App\Models\Category;
use App\Models\District;
use App\Models\Village;
use App\Models\Street;
use Carbon;
use PurchaseTransaction;

class AdminController extends Controller
{
    // =======leader management========
    // list
    public function listLeaders()
    {
        $list  = Employee::select('employees.*')->join('users','user_id','users.id')->where('role',User::ROLE['leader'])->get();
        return view('admin.employee.index', ['list' => $list]);
    }

    // create
    public function createLeader()
    {
        return view('admin.employee.leader.add');
    }

    // edit
    public function editLeader($id)
    {
        $obj = Employee::find($id);
        return view('admin.employee.leader.edit', ['obj' => $obj]);
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

    // apply action
    public function actionLeader(Request $request)
    {
        $listObj = Employee::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
                case 1:
                    foreach ($listObj as $item) {
                        User::find($item->user_id)->delete();
                        $item->delete();
                    }
                    break;
                case 2:
                    foreach ($listObj as $item) {
                        User::find($item->user_id)->update(['active' => 1]);
                    }
                    break;
                case 3:
                    foreach ($listObj as $item) {
                        User::find($item->user_id)->update(['active' => 0]);
                    }
                    break;
            }
            return redirect()->route('admins.employee.leader.list')->with('success', 'Success');
        } else {

        }

    }

    // active
    public function activeLeader(Request $request)
    {
        $obj = Employee::find($request->id);

        $objUpdate = User::find($obj->user_id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    // ==========sale management=============
    // list
    public function listSales()
    {
        $list  = Employee::select('employees.*')->join('users','user_id','users.id')->where('role',User::ROLE['sale'])->get();
        return view('admin.employee.index', ['list' => $list]);
    }

    // create
    public function createSale()
    {
        return view('admin.employee.sale.add');
    }

    // edit
    public function editSale($id)
    {
        $obj = Employee::find($id);
        return view('admin.employee.sale.edit', ['obj' => $obj]);
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
            AssignTask::where('employee_id', $obj->id)->delete();
            if (User::find($obj->user_id)->delete()) {
                echo json_encode('ok');
            }
        }
    }

    // apply action
    public function actionSale(Request $request)
    {
        $listObj = Employee::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
                case 1:
                    foreach ($listObj as $item) {
                        AssignTask::where('employee_id', $item->id)->delete();
                        User::find($item->user_id)->delete();
                        $item->delete();
                    }
                    break;
                case 2:
                    foreach ($listObj as $item) {
                        User::find($item->user_id)->update(['active' => 1]);
                    }
                    break;
                case 3:
                    foreach ($listObj as $item) {
                        User::find($item->user_id)->update(['active' => 0]);
                    }
                    break;
            }
            return redirect()->route('admins.employee.sale.index')->with('success', 'Success');
        } else {

        }

    }

    // active
    public function activeSale(Request $request)
    {
        $obj = Employee::find($request->id);

        $objUpdate = User::find($obj->user_id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    // detail
    public function detailEmployee($employeeId)
    {
        $obj = Employee::find($employeeId);
        return view('admin.employee.detail', ['obj' => $obj]);
    }

    // ==========poster management=============
    // list
    public function listPoster()
    {
        $list  = Poster::all();
        return view('admin.post.poster.index', ['list' => $list]);
    }

    // apply action
    public function actionPoster(Request $request)
    {
        $listObj = Poster::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
            case 1:
                foreach ($listObj as $item) {
                    if ($item->delete()) {
                        User::find($item->user_id)->delete();
                        Poster::where('poster_id', $item->id)->delete();
                    }
                }
                break;
            case 2:
                foreach ($listObj as $item) {
                    $item->user->update(['active' => 1]);
                }
                break;
            case 3:
                foreach ($listObj as $item) {
                    $item->user->update(['active' => 0]);
                }
                break;
        }
            return redirect()->route('admins.post.poster.list')->with('success', 'Success');
        } else {

        }

    }

    // active
    public function activePoster(Request $request)
    {
        $objUpdate = Poster::find($request->id)->user;
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    //delete
    public function deletePoster(Request $request)
    {
    	$obj = Poster::find($request->id);
    	if ($obj->delete()) {
            Poster::where('poster_id', $obj->id)->delete();
    		if (User::find($obj->user_id)->delete()) {
    			echo json_encode('ok');
    		}
    	}
    }

    // detail product transaction
    public function detailPosts($poster_id)
    {
        $list = Post::where('poster_id', $poster_id)->get();
        return view('admin.post.posts.index', ['list' => $list]);
    }

    // =========Products=============
    // =========Sale Products=============

    // sale products
    public function listSaleProducts()
    {
        $list  = Product::select('products.*')->join('categories','products.cat_id','categories.id')->where('categories.type_transaction',1)->get();
        return view('admin.product.sale.index', ['list' => $list]);
    }


    // status
    public function statusSaleProduct(Request $request)
    {
        $objUpdate = Product::find($request->id);
        $objUpdate->update(['status' => $request->status]);
        echo json_encode('ok');
    }

    // sale edit
    public function createSaleProduct()
    {
        $listCat = Category::all()->where('type_transaction',1);
        $villages = Village::all();
        $streets = Street::all();
        $districts = District::all();
        $direction = Product::DIRECTION;
        return view('admin.product.sale.add', [
            'listCat' => $listCat,
            'villages' => $villages,
            'streets' => $streets,
            'districts' => $districts,
            'direction' => $direction
        ]);
    }

    // store
    public function storeSaleProduct(ProductCreateRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = "images/products/";
            $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($path, $fileName);
            $data['image'] = $path . $fileName;
        } else {
            $data['image'] = "";
        }

        if (Product::create($data)) {
            return redirect()->route('admins.product.sale.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    // edit
    public function editSaleProduct($id)
    {
        $listCat = Category::all()->where('type_transaction',1);
        $villages = Village::all();
        $streets = Street::all();
        $districts = District::all();
        $direction = Product::DIRECTION;
        $obj = Product::find($id);
        return view('admin.product.sale.edit', [
            'listCat' => $listCat,
            'villages' => $villages,
            'streets' => $streets,
            'districts' => $districts,
            'direction' => $direction,
            'obj' => $obj
        ]);
    }

    // update
    public function updateSaleProduct(ProductCreateRequest $request, $id)
    {
        $oldObj = Product::find($id);
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
            return redirect()->route('admins.product.sale.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    //delete
    public function deleteSaleProduct($id)
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

    // apply action
    public function actionSaleProduct(Request $request)
    {
        $listObj = Product::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
                case 1:
                    foreach ($listObj as $item) {
                        if (!empty($item->image)) {
                            unlink($item->image);
                        }
                        ProductTransaction::where('product_id', $item->id)->delete();
                        PurchaseTransaction::where('product_id', $item->id)->delete();
                        $item->delete();
                    }
                    break;
            }
            return redirect()->route('admins.product.sale.list')->with('success', 'Success');
        } else {

        }

    }

    // =========Post=============

    // lease products
    public function listPost()
    {
        $direction = Post::DIRECTION;
        $list  = Post::all();
        return view('admin.post.posts.index', ['list' => $list, 'direction' => $direction]);
    }


    // status
    public function statusPost(Request $request)
    {
        $objUpdate = Product::find($request->id);
        $objUpdate->update(['status' => $request->status]);
        echo json_encode('ok');
    }

    // sale edit
    public function createLeaseProduct()
    {
        $listCat = Category::all()->where('type_transaction',2);
        $villages = Village::all();
        $streets = Street::all();
        $districts = District::all();
        $direction = Product::DIRECTION;
        return view('admin.product.sale.add', [
            'listCat' => $listCat,
            'villages' => $villages,
            'streets' => $streets,
            'districts' => $districts,
            'direction' => $direction
        ]);
    }

    // store
    public function storeLeaseProduct(ProductCreateRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = "images/products/";
            $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($path, $fileName);
            $data['image'] = $path . $fileName;
        } else {
            $data['image'] = "";
        }

        if (Product::create($data)) {
            return redirect()->route('admins.product.sale.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    // edit
    public function editLeaseProduct($id)
    {
        $listCat = Category::all()->where('type_transaction',1);
        $villages = Village::all();
        $streets = Street::all();
        $districts = District::all();
        $direction = Product::DIRECTION;
        $obj = Product::find($id);
        return view('admin.product.sale.edit', [
            'listCat' => $listCat,
            'villages' => $villages,
            'streets' => $streets,
            'districts' => $districts,
            'direction' => $direction,
            'obj' => $obj
        ]);
    }

    // update
    public function updateLeaseProduct(ProductCreateRequest $request, $id)
    {
        $oldObj = Product::find($id);
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
            return redirect()->route('admins.product.sale.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    //delete
    public function deletePost($id)
    {
        $obj = Post::find($id);
        if ($obj->delete()) {
            if (!empty($obj->image)) {
                unlink($obj->image);
            }
            echo json_encode('ok');
        }
    }

    // apply action
    public function actionPost(Request $request)
    {
        $listObj = Post::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
                case 1:
                    foreach ($listObj as $item) {
                        if (!empty($item->image)) {
                            unlink($item->image);
                        }
                        $item->update(['deleted_at', Carbon::now()]);
                    }
                    break;
                case 2:
                    foreach ($listObj as $item) {
                        $item->update(['status', Post::STATUS['processed']]);
                    }
                    break;
                case 3:
                    foreach ($listObj as $item) {
                        $item->update(['status', Post::STATUS['cancel']]);
                    }
                    break;
            }
            return redirect()->route('admins.post.posts.list')->with('success', 'Success');
        } else {

        }

    }

    // ========== customer management=============
    // list
    public function listCustomer()
    {
        $list  = Customer::all;
        return view('admin.customer.purchaseCustomer.index', ['list' => $list]);
    }

    // apply action
    public function actionCustomer(Request $request)
    {
        $listObj = Customer::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
            case 1:
                foreach ($listObj as $item) {
                    $item->delete();
                }
                break;
        }
            return redirect()->route('admins.customer.list')->with('success', 'Success');
        } else {

        }
        
    }

    //delete
    public function deleteCustomer(Request $request)
    {
        $obj = Customer::find($request->id);
        if ($obj->delete()) {
            Transaction::where('customer_id', $request->id)->delete();
            echo json_encode('ok');
        }
    }

    // detail purchase transaction
    public function detailTransaction($customer_id)
    {
        $status = Transaction::STATUS;
        $list = Customer::find($customer_id)->transaction()->get();
        return view('admin.customer.detail', ['list' => $list, 'status' => $status, 'customer_id' => $customer_id]);
    }

     //delete
    public function deleteTransaction(Request $request)
    {
        $obj = Transaction::find($request->id);
        if ($obj->delete()) {
            echo json_encode('ok');
        }
    }

    // apply action
    public function actionTransaction(Request $request)
    {
        $listObj = Transaction::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
            case 1:
                foreach ($listObj as $item) {
                    $item->delete();
                }
                break;
            case 2:
                foreach ($listObj as $item) {
                    $item->update(['status' => Transaction::STATUS['registered']]);
                }
                break;
            case 3:
                foreach ($listObj as $item) {
                    $item->update(['status' => Transaction::STATUS['deposit']]);
                }
                break;
            case 4:
                foreach ($listObj as $item) {
                    $item->update(['status' => Transaction::STATUS['payment']]);
                }
                break;
        }
            return redirect()->route('admins.customer.detail',['customer_id' => $request->customer_id])->with('success', 'Success');
        } else {

        }
        
    }

    // apply action
    public function statusTransaction(Request $request)
    {
        $obj = Transaction::find($request->id)->update(['status' => $request->status]);
        echo json_encode('ok');
    }

    // detail Customer
    // detail
    public function detailCustomer($customerId)
    {
        $obj = Customer::find($customerId);
        return view('admin.customer.detail', ['obj' => $obj]);
    }

    // ==========News management=============
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
    public function activeNews(Request $request)
    {
        $objUpdate = News::find($request->id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    // ==========assign task management=============
    // assign
    public function listAssignTask()
    {
        $list  = AssignTask::all();
        return view('admin.assign.index', ['list' => $list]);
    }

//    // edit
//    public function createNews()
//    {
//        $listCat = CatNew::where('active',1)->get();
//        return view('admin.news.add', ['listCat' => $listCat]);
//    }
//
//    // store
//    public function storeNews(NewsCreateRequest $request)
//    {
//        $data = $request->all();
//        $data['created_at'] = Carbon\Carbon::now();;
//
//        if ($request->hasFile('image')) {
//            $path = "images/news/";
//            $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
//            $request->image->move($path, $fileName);
//            $data['image'] = $path . $fileName;
//        } else {
//            $data['image'] = "";
//        }
//
//        if (News::create($data)) {
//            return redirect()->route('admins.news.list')->with('success', 'Success');
//        } else {
//            return redirect()->back()->withInput()->with('error', 'Fail');
//        }
//    }
//
//    // create or edit
//    public function editNews($id)
//    {
//        $listCat = CatNew::where('active',1)->get();
//        $obj = News::find($id);
//        return view('admin.news.edit', ['obj' => $obj, 'listCat' => $listCat]);
//    }
//
//    // update
//    public function updateNews(NewsCreateRequest $request, $id)
//    {
//        $oldObj = News::find($id);
//        $data = $request->all();
//
//        if ($request->hasFile('image')) {
//            if (!empty($oldObj->image)) {
//                unlink($oldObj->image);
//            }
//            $path = "images/news/";
//            $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
//            $request->image->move($path, $fileName);
//            $data['image'] = $path . $fileName;
//        } else {
//            $data['image'] = $oldObj->image;
//        }
//
//        if ($oldObj->update($data)) {
//            return redirect()->route('admins.news.list')->with('success', 'Success');
//        } else {
//            return redirect()->back()->withInput()->with('error', 'Fail');
//        }
//    }
//
//    //delete
//    public function deleteNews($id)
//    {
//        $obj = News::find($id);
//        if ($obj->delete()) {
//            if (!empty($obj->image)) {
//                unlink($obj->image);
//            }
//            echo json_encode('ok');
//        }
//    }
//
//    // apply action
//    public function action(Request $request)
//    {
//        $listObj = News::whereIn('id', $request->selected)->get();
//        if (!empty($listObj)) {
//            switch ($request->option) {
//                case 1:
//                    foreach ($listObj as $item) {
//                        if (!empty($item->image)) {
//                            unlink($item->image);
//                        }
//                        $item->delete();
//                    }
//                    break;
//                case 2:
//                    foreach ($listObj as $item) {
//                        $item->update(['active' => 1]);
//                    }
//                    break;
//                case 3:
//                    foreach ($listObj as $item) {
//                        $item->update(['active' => 0]);
//                    }
//                    break;
//            }
//            return redirect()->route('admins.news.list')->with('success', 'Success');
//        } else {
//
//        }
//
//    }
//
//    // active
//    public function active(Request $request)
//    {
//        $objUpdate = News::find($request->id);
//        $objUpdate->update(['active' => !($objUpdate->active)]);
//        echo json_encode('ok');
//    }


}