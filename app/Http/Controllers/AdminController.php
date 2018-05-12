<?php

namespace App\Http\Controllers;

use App\Models\AssignTask;
use App\Models\Post;
use App\Models\Poster;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\IntroduceCreateRequest;
use App\Http\Requests\ScheduleCreateRequest;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\SliderCreateRequest;
use App\Http\Requests\AnnouncementCreateRequest;
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
use App\Models\Contact;
use App\Models\Introduce;
use App\Models\DetailProject;
use App\Models\Project;
use App\Models\Slider;
use App\Models\Consult;
use App\Models\Register;
use App\Models\PersonalInformation;
use Carbon\Carbon;
use PurchaseTransaction;
use App\Models\Announcement;
use App\Models\AnnouncementRecieves;

class AdminController extends Controller
{
    //profile
    public function profile()
    {
        return view('admin.auth.profile');
    }

    //profile
    public function updateProfile(Request $request)
    {
        $objUser = session()->get('objUser');

        $data = [];
        if($objUser->role == 1) {
            $rules = $this->validate($request,
                [
                    'email' => 'required|email',
                    'password' => 'nullable|min:6|max:15'
                ],
                [
                    'email.required' => 'Email is required',
                    'email.email' => 'Email is not valid',
                    'password.min' => 'Password is not less than 6 character',
                    'password.max' => 'Password is not greater than 15 character',
                ]
            );

            $data = [
                'email' => $request->email,
                'password' => empty($request->password) ? $objUser->password : md5($request->password)
            ];
            if ($request->hasFile('image')) {
                $path = "images/users/";
                $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($path, $fileName);
                $data['image'] = $path . $fileName;
            } else {
                $data['image'] = "";
            }

            $objUser->update($data);
            session()->put('objUser', $objUser);
        } else {
            $rules = $this->validate($request,
                [
                    'name.required' => 'Name is required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'address' => 'required',
                    'password' => 'nullable|min:6|max:15'
                ],
                [
                    'name.required' => 'Name is required',
                    'email.required' => 'Email is required',
                    'email.email' => 'Email is not valid',
                    'phone.required' => 'Phone is required',
                    'phone.numeric' => 'Phone must be number',
                    'address.required' => 'Address is required',
                    'password.min' => 'Password is not less than 6 character',
                    'password.max' => 'Password is not greater than 15 character',
                ]
            );

            $data = [
                'email' => $request->email,
                'password' => empty($request->password) ? $objUser->password : md5($request->password)
            ];
            if ($request->hasFile('image')) {
                $path = "images/users/";
                $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($path, $fileName);
                $data['image'] = $path . $fileName;
            } else {
                $data['image'] = "";
            }
            $objUser->update($data);

            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            Employee::where('user_id', $objUser->id)->update($data);

            session()->put('objUser', $objUser);

        }

        return redirect()->route('admins.profile')->with('success', 'Success');
    }
    // =======leader management========
    // list
    public function listLeaders()
    {
        $list  = Employee::select('employees.*')->join('users','user_id','users.id')->where('role',User::ROLE['leader'])->get();
        return view('admin.employee.leader.index', ['list' => $list]);
    }

    // create
    public function createLeader()
    {
        return view('admin.employee.leader.add');
    }

    // create or edit
    public function storeLeader(EmployeeCreateRequest $request)
    {
        $data = $request->all();
        $infoData = [
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
        ];
        if ($obj = Employee::create($infoData)) {
            if ($request->hasFile('image')) {
                $path = "images/employees/";
                $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($path, $fileName);
                $image = $path . $fileName;
            } else {
                $image = "";
            }
            $objUser = User::create([
                'username' => $request->username,
                'password' => md5($request->password),
                'email' => $request->email,
                'role' => User::ROLE['leader'],
                'active' => 1,
                'image' => $image
            ]);

            $obj->update(['user_id' => $objUser->id]);
            return redirect()->route('admins.leader.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    // edit
    public function editLeader($id)
    {
        $obj = Employee::find($id);
        return view('admin.employee.leader.edit', ['obj' => $obj]);
    }

    // create or edit
    public function updateLeader(EmployeeUpdateRequest $request, $id)
    {
        $data = $request->all();
        $infoData = [
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
        ];
        $oldEmployee = Employee::find($id);
        if ($oldEmployee->update($data)) {
            $oldUser = User::find($oldEmployee->user_id);
            if ($request->hasFile('image')) {
                $path = "images/employees/";
                $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($path, $fileName);
                $image = $path . $fileName;
            } else {
                $image = $oldUser->image;
            }
            $rules = $this->validate($request,
                [
                    'email' => 'unique:users,email,' . $oldUser->id,
                ],
                [
                    'email.unique' => 'Email is exist',
                ]
            );
            $oldUser->update([
                'password' => !empty($request->password) ? md5($request->password) : $oldUser->password,
                'email' => $request->email,
                'image' => $image
            ]);

            return redirect()->route('admins.leader.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    // delete
    public function deleteLeader(Request $request)
    {
        $obj = Employee::find($request->id);
        if (Employee::find($request->id)->delete()) {
            $objUser = User::find($obj->user_id);
            if ($objUser->delete()) {
                if (!empty($objUser->image)) {
                    unlink($objUser->image);
                }
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
                    $objUser = User::find($item->user_id);
                    $objUser->delete();
                    if (!empty($objUser->image)) {
                        unlink($objUser->image);
                    }
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
            return redirect()->route('admins.leader.list')->with('success', 'Success');
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
        return view('admin.employee.sale.index', ['list' => $list]);
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
    public function storeSale(EmployeeCreateRequest $request)
    {
        $data = $request->all();
        $infoData = [
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
        ];
        if ($obj = Employee::create($infoData)) {
            if ($request->hasFile('image')) {
                $path = "images/employees/";
                $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($path, $fileName);
                $image = $path . $fileName;
            } else {
                $image = "";
            }
            $objUser = User::create([
                'username' => $request->username,
                'password' => md5($request->password),
                'email' => $request->email,
                'role' => User::ROLE['sale'],
                'active' => 1,
                'image' => $image
            ]);

            $obj->update(['user_id' => $objUser->id]);
            return redirect()->route('admins.sale.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

// create or edit
    public function updateSale(EmployeeUpdateRequest $request, $id)
    {
        $data = $request->all();
        $infoData = [
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
        ];
        $oldEmployee = Employee::find($id);
        if ($oldEmployee->update($data)) {
            $oldUser = User::find($oldEmployee->user_id);
            if ($request->hasFile('image')) {
                $path = "images/employees/";
                $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($path, $fileName);
                $image = $path . $fileName;
            } else {
                $image = $oldUser->image;
            }
            $rules = $this->validate($request,
                [
                    'email' => 'unique:users,email,' . $oldUser->id,
                ],
                [
                    'email.unique' => 'Email is exist',
                ]
            );
            $oldUser->update([
                'password' => !empty($request->password) ? md5($request->password) : $oldUser->password,
                'email' => $request->email,
                'image' => $image
            ]);

            return redirect()->route('admins.sale.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    //delete
    public function deleteSale(Request $request)
    {
        $obj = Employee::find($request->id);
        if (Employee::find($request->id)->delete()) {
            AssignTask::where('employee_id', $obj->id)->delete();
            $objUser = User::find($obj->user_id);
            if ($objUser->delete()) {
                if (!empty($objUser->image)) {
                    unlink($objUser->image);
                }
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
                    $objUser = User::find($item->user_id);
                    $objUser->delete();
                    if (!empty($objUser->image)) {
                        unlink($objUser->image);
                    }
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
            return redirect()->route('admins.sale.list')->with('success', 'Success');
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

    // ==========poster management=============
    // list
    public function listPoster()
    {
        $list  = Poster::all();
        return view('admin.post.posters.index', ['list' => $list]);
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

    public function listPostByPoster($posterId)
    {
        $direction = Post::DIRECTION;
        $list  = Post::where('poster_id', $posterId)->get();
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
            $path = "images/products/";
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
        $list  = Customer::all();
        return view('admin.customer.index', ['list' => $list]);
    }

// storeDetailCustomer
    public function storeDetailCustomer(Request $request)
    {
        $data  = [
            'attribute' => $request->attribute,
            'value' => $request->value,
            'customer_id' => $request->id,
            'created_at' => Carbon::now()
        ];

        $obj = PersonalInformation::create($data);
        $result = '<tr class="odd gradeX">' .
        '<td>' .
        '<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"> <input type="checkbox" class="selectMe" name="selected[]" value="' . $obj->id . '" ><i></i></label>' .
        '</td>' .
        '<td>' . $obj->id . '</td>' .
        '<td>' . $obj->attribute . '</td>' .
        '<td>' . $obj->value . '</td>' .
        '<td>' . date( "d/m/Y", strtotime($obj->created_at)) . '</td>' .
        '<td class="actions"><a href="javascript:void(0)" onclick="edit(' . $obj->id . ')" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>' .
        '</tr>';
        echo  $result;
    }

// storeDetailCustomer
    public function updateDetailCustomer(Request $request)
    {
        $data  = [
            'attribute' => $request->attribute,
            'value' => $request->value,
            'created_at' => Carbon::now()
        ];

        PersonalInformation::find($request->id)->update($data);

        $result = '<td>' .
        '<label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"> <input type="checkbox" class="selectMe" name="selected[]" value="' . $request->id . '" ><i></i></label>' .
        '</td>' .
        '<td>' . $request->id . '</td>' .
        '<td>' . $request->attribute . '</td>' .
        '<td>' . $request->value . '</td>' .
        '<td>' . date( "d/m/Y", strtotime(Carbon::now())) . '</td>' .
        '<td class="actions"><a href="javascript:void(0)" onclick="edit(' . $request->id . ')" role="button" tabindex="0" class="edit text-primary text-uppercase text-strong text-sm mr-10">Edit</a><a role="button" tabindex="0" class="delete text-danger text-uppercase text-strong text-sm mr-10">Remove</a></td>' .
        '</tr>';
        echo  $result;
    }

    public function getDetailCustomer(Request $request)
    {
        $obj = PersonalInformation::find($request->id);
        echo json_encode($obj);

    }

    public function deleteDetailCustomer(Request $request)
    {
        $obj = PersonalInformation::find($request->id);
        if ($obj->delete()) {
            echo json_encode('ok');
        }
    }

    public function actionDetailCustomer(Request $request)
    {
        $listObj = PersonalInformation::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
                case 1:
                foreach ($listObj as $item) {
                    $item->delete();
                }
                break;
            }
            return redirect()->route('admins.customer.detail', ['id' => $request->customerId])->with('success', 'Success');
        } else {

        }

    }

// register
//get register by customer
    public function getRegister(Request $request)
    {
        $projectId = Register::where('customer_id', $request->id)->pluck('project_id')->toArray();
        $project = Project::whereNotIn('id', $projectId)->pluck('name', 'id')->toArray();
        echo json_encode($project);
    }

// store register
    public function storeRegister(Request $request)
    {
        $data = [
            'customer_id' => $request->id,
            'project_id' => $request->project_id,
            'created_at' => Carbon::now()
        ];

        $obj = Register::create($data);
        echo json_encode('ok');
    }

// store register
    public function removeRegister(Request $request)
    {
        $obj = Register::find($request->id)->delete();
        echo json_encode('ok');
    }

// addRegister
    public function addRegister()
    {
        $project = Project::all();
        return view('admin.customer.formAddRegister', ['project' => $project]);
    }

// addRegister
    public function storeAllRegister(Request $request)
    {
        $rules = $this->validate($request,
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric'
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email is not valid',
                'phone.required' => 'Phone is required',
                'phone.numeric' => 'Phone must be number',
            ]
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now(),
        ];

        $customer = Customer::create($data);

        $register = [
            'customer_id' => $customer->id,
            'project_id' => $request->project_id,
            'created_at' => Carbon::now()
        ];

        Register::create($register);
        return redirect()->route('admins.customer.list')->with('success', 'Success');

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
                    $registerId = Register::where('customer_id', $item->id)->pluck('id')->toArray();
                    Register::where('customer_id', $item->id)->delete();
                    Transaction::whereIn('register_id', $registerId)->delete();
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
            $registerId = Register::where('customer_id', $obj->id)->pluck('id')->toArray();
            Register::where('customer_id', $obj->id)->delete();
            Transaction::whereIn('register_id', $registerId)->delete();
            echo json_encode('ok');
        }
    }

    // detail purchase transaction
    public function detailTransaction($registerId)
    {
        $register = Register::find($registerId);
        $status = Transaction::STATUS;
        $direction = Product::DIRECTION;
        $list = Transaction::select('transactions.*')->join('products', 'products.id', 'transactions.product_id')->where('register_id', $registerId)->get();
        return view('admin.customer.transaction', ['list' => $list, 'status' => $status, 'register' => $register, 'direction' => $direction]);
    }

// detail purchase transaction
    public function createTransaction($registerId)
    {
        $register = Register::find($registerId);
        $products = Product::where('project_id', $register->project_id);

        $blocks = array_unique($products->pluck('block')->toArray());

        return view('admin.customer.addTransaction', ['products' => $products->get(),'register' => $register, 'blocks' => $blocks]);
    }

    // detail purchase transaction
    public function storeTransaction(Request $request)
    {
        if ($request->block == -1 || $request->land == -1 || $request->floor == -1) {
            return redirect()->back()->withInput()->with('error', 'Please Choose');
        }
        $productId = Product::where('block', $request->block)
        ->where('land', $request->land)
        ->where('project_id', $request->projectId)->first()->id;

        //processing nhuwng neu cung la customer ddo thi k lay nuwa
        $transaction = Transaction::where('product_id', $productId)
        ->where('status', '!=', Transaction::STATUS['processing'])
        ->where('register_id', '!=', $request->registerId)->first();
        if(!$transaction) {
            $data = [
                'floor' => $request->floor,
                'status' => Transaction::STATUS['processing'],
                'created_at' => Carbon::now(),
                'register_id' => $request->registerId,
                'product_id' => $productId,
                'description' => $request->description ?? '',
                'rating' => 0
            ];
            if (Transaction::create($data)) {
                return redirect()->route('admins.customer.detailTransaction', ['registerId' => $request->registerId])->with('success', 'Success');
            } else {
                return redirect()->back()->withInput()->with('error', 'Fail');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Transaction is exist');
        }
    }

    // edit purchase transaction
    public function editTransaction($transactionId)
    {
        $transaction = Transaction::find($transactionId);
        $projectId = $transaction->product->project->id;
        $products = Product::where('project_id', $projectId)->get();
        $floorFirst = $transaction->product->floor;
        return view('admin.customer.editTransaction', ['products' => $products, 'transaction' => $transaction, 'floor' => $floorFirst]);
    }

    // detail purchase transaction
    public function updateTransaction(Request $request)
    {
        $transaction = Transaction::find($request->transactionId);
        
        $data = [
            'product_id' => $request->block,
            'floor' => $request->floor,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ];

        if ($transaction->update($data)) {
            return redirect()->route('admins.customer.detailTransaction', ['registerId' => $transaction->register_id])->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }

    }

    // detail purchase transaction
    public function ratingTransaction(Request $request)
    {
        $transaction = Transaction::find($request->id)->update(['rating' => $request->rating]);
        echo json_encode('ok');

    }

    // detail purchase transaction
    public function getDataByBlock(Request $request)
    {
        // $floorTrans = Transaction::where('product_id', $request->productId)->where('status', '!=', Transaction::STATUS['processing'])->pluck('floor')->toArray();
        // $floorAll = range(1, Product::find($request->productId)->floor);

        // $floorValid = array_diff($floorAll, $floorTrans);

        $lands = Product::where('block', $request->block)
        ->pluck('land')->toArray();
        $floorFirst = Product::where('land', $lands[0])
        ->first()->floor;

        $floors = ($floorFirst!=0) ? range(1, $floorFirst) : [0 => 0];

        echo json_encode([
            'lands' => $lands,
            'floors' => $floors
        ]);

    }

    // // detail purchase transaction
    // public function getFloorByLand(Request $request)
    // {
    //     $floorFirst = Product::where('land', $request->land)
    //         ->first()->floor;

    //     $floors = ($floorFirst!=0) ? range(1, $floorFirst) : [0 => 0];

    //     echo json_encode($floors);    
    // }

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
            return redirect()->route('admins.customer.detailTransaction',['registerId' => $request->registerId])->with('success', 'Success');
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
        $list = PersonalInformation::where('customer_id', $customerId)->get();
        return view('admin.customer.detail', ['obj' => $obj, 'list' => $list]);
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
        $data['created_at'] = Carbon::now();;

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
    public function deleteNews(Request $request)
    {
        $obj = News::find($request->id);
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
        $objUSer = session()->get('objUser');
        if ($objUser == User::ROLE['admin']) {
            $list = AssignTask::all();
        } else {
            $list  = AssignTask::where('employee_id', $objUser->id)->get();
        }
        
        return view('admin.assign.index', ['list' => $list]);
    }

    // create
    public function createAssignTask()
    {
        $employees = Employee::join('users', 'employees.user_id', 'users.id')->where('users.role', User::ROLE['sale'])->pluck('employees.name', 'employees.id')->toArray();
        $customerIds = AssignTask::select('customer_id')->get()->toArray();
        $customers = Customer::whereNotIn('id', $customerIds)->pluck('customers.name', 'customers.id')->toArray();
        return view('admin.assign.add', ['employees' => $employees, 'customers' => $customers]);
    }

    // store
    public function storeAssignTask(Request $request)
    {
        if ($request->employee_id == -1 || $request->customer_id == -1) {
            return redirect()->back()->withInput()->with('error', 'Please choose');
        }
        $objUser = session()->get('objUser');
        $data = [
            'employee_id' => $request->employee_id,
            'customer_id' => $request->customer_id,
            'created_at' => Carbon::now(),
            'assigner_id' => $objUser->id,
            'description' => ($request->description) ?? ''
        ];
        if ($assign = AssignTask::create($data)) {
            $createAnnouncement = [
                'title' => Announcement::TITLE['employee'],
                'content' => Announcement::CONTENT['employee'],
                'active' => 1,
                'created_at' => Carbon::now(),
                'causer_id' => $objUser->id,
            ];

            $announcement = Announcement::create($createAnnouncement);
            AnnouncementRecieves::create([
                'announcement_id' => $announcement->id,
                'reciever_id' => $assign->employee_id,
                'is_read' => 0
            ]);

            return redirect()->route('admins.assign.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    // edit
    public function editAssignTask($id)
    {
        $obj = AssignTask::find($id);
        $employees = Employee::join('users', 'employees.user_id', 'users.id')->where('users.role', User::ROLE['sale'])->select(['employees.id', 'employees.name'])->get();
        $customer = Customer::find($obj->customer_id);
        $employee = Employee::find($obj->employee_id);
        return view('admin.assign.edit', ['obj' => $obj, 'employees' => $employees, 'customer' => $customer, 'employee' => $employee]);
    }

    // update
    public function updateAssignTask(Request $request)
    {
        $objUser = session()->get('objUser');
        $oldObj = AssignTask::find($request->assignId);
        $data = [
            'employee_id' => $request->employee_id,
            'customer_id' => $request->customer_id,
            'created_at' => Carbon::now(),
            'assigner_id' => $objUser->id,
            'description' => ($request->description) ?? ''
        ];

        if ($oldObj->update($data)) {
            $createAnnouncement = [
                'title' => Announcement::TITLE['employee'],
                'content' => 'update task ' . $oldObj->id,
                'active' => 1,
                'created_at' => Carbon::now(),
                'causer_id' => $objUser->id,
            ];

            $announcement = Announcement::create($createAnnouncement);
            AnnouncementRecieves::create([
                'announcement_id' => $announcement->id,
                'reciever_id' => $oldObj->employee_id,
                'is_read' => 0
            ]);
            return redirect()->route('admins.assign.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    //delete
    public function deleteAssignTask(Request $request)
    {
        $obj = AssignTask::find($request->id);
        if ($obj->delete()) {
            echo json_encode('ok');
        }
    }

    // apply action
    public function actionAssignTask(Request $request)
    {
        $listObj = AssignTask::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
                case 1:
                foreach ($listObj as $item) {
                    $item->delete();
                }
                break;
            }
            return redirect()->route('admins.assign.list')->with('success', 'Success');
        } else {

        }

    }

    // ==========contact management=============
    // contact
    public function listContact()
    {
        $list  = Contact::all();
        return view('admin.contact.index', ['list' => $list]);
    }

    //delete
    public function deleteContact($id)
    {
        $obj = Contact::find($id);
        if ($obj->delete()) {
            echo json_encode('ok');
        }
    }

    // apply action
    public function actionContact(Request $request)
    {
        $listObj = Assign::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
                case 1:
                foreach ($listObj as $item) {
                    $item->delete();
                }
                break;
                case 2:
                foreach ($listObj as $item) {
                    $item->update(['is_reply', 1]);
                }
                break;
            }
            return redirect()->route('admins.contact.list')->with('success', 'Success');
        } else {

        }

    }

    //active
    public function activeContact(Request $request)
    {
        $objUpdate = Contact::find($request->id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    // ==========News management=============
    // news
    public function listIntroduce()
    {
        $list  = Introduce::all();
        return view('admin.introduce.index', ['list' => $list]);
    }

    // edit
    public function createIntroduce()
    {
        return view('admin.introduce.add');
    }

    // store
    public function storeIntroduce(IntroduceCreateRequest $request)
    {
        $data = $request->all();
        $data['created_at'] = Carbon::now();;

        if (Introduce::create($data)) {
            return redirect()->route('admins.introduce.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    // create or edit
    public function editIntroduce($id)
    {
        $obj = Introduce::find($id);
        return view('admin.introduce.edit', ['obj' => $obj]);
    }

    // update
    public function updateIntroduce(IntroduceCreateRequest $request, $id)
    {
        $oldObj = Introduce::find($id);
        $data = $request->all();

        if ($oldObj->update($data)) {
            return redirect()->route('admins.introduce.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    //delete
    public function deleteIntroduce($id)
    {
        $obj = Introduce::find($id)->delete();
        echo json_encode('ok');
    }

    // apply action
    public function actionIntroduce(Request $request)
    {
        $listObj = Introduce::whereIn('id', $request->selected)->get();
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
            return redirect()->route('admins.introduce.list')->with('success', 'Success');
        } else {

        }

    }

    // active
    public function activeIntroduce(Request $request)
    {
        $objUpdate = Introduce::find($request->id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }


    // ==========Schedule management=============
    // schedule
    public function listSchedule()
    {
        $list  = Schedule::orderBy('time', 'DESC')->get();
        return view('admin.schedule.index', ['list' => $list]);
    }

    // edit
    public function createSchedule()
    {
        return view('admin.schedule.add');
    }

    // store
    public function storeSchedule(ScheduleCreateRequest $request)
    {
        // get user login
        $data = $request->all();

        if (Schedule::create($data)) {
            return redirect()->route('admins.schedule.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    // create or edit
    public function editSchedule($id)
    {
        $obj = Schedule::find($id);
        return view('admin.schedule.edit', ['obj' => $obj]);
    }

    // update
    public function updateSchedule(ScheduleCreateRequest $request, $id)
    {
        $oldObj = Schedule::find($id);
        $data = $request->all();

        if ($oldObj->update($data)) {
            return redirect()->route('admins.schedule.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    //delete
    public function deleteSchedule($id)
    {
        $obj = Schedule::find($id)->delete();
        echo json_encode('ok');
    }

    // apply action
    public function actionSchedule(Request $request)
    {
        $listObj = Schedule::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
                case 1:
                foreach ($listObj as $item) {
                    $item->delete();
                }
                break;
                case 2:
                foreach ($listObj as $item) {
                    $item->update(['is_done' => 1]);
                }
                break;
                case 3:
                foreach ($listObj as $item) {
                    $item->update(['is_done' => 0]);
                }
                break;
            }
            return redirect()->route('admins.schedule.list')->with('success', 'Success');
        } else {

        }

    }

    // active
    public function activeSchedule(Request $request)
    {
        $objUpdate = Schedule::find($request->id);
        $objUpdate->update(['active' => !($objUpdate->active)]);
        echo json_encode('ok');
    }

    // ==========project management=============
    // schedule
    public function listProject()
    {
        $status = Project::STATUS;
        $list  = Project::all();
        return view('admin.project.index', ['list' => $list, 'status' => $status]);
    }

    // detail
    public function detailProject($id)
    {
        $obj = Project::find($id);
        $detail = DetailProject::find($obj->detail_project_id);

        return view('admin.project.edit', ['obj' => $obj, 'detail' => $detail]);
    }

    // edit
    public function createProject()
    {
        return view('admin.project.add');
    }

    // store
    public function storeProject(ProjectCreateRequest $request)
    {
        // get user login
        $data = $request->all();

        if (Project::create($data)) {
            return redirect()->route('admins.Project.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

    // create or edit
    public function editProject($id)
    {
        $project = Project::find($id);
        $detail = DetailProject::find($project->detail_project_id);
        $products = Product::where('project_id', $project->id)->get();

        return view('admin.project.edit', ['project' => $project, 'detail' => $detail, 'products' => $products]);
    }

    // update
    public function updateProject(ProjectCreateRequest $request, $id)
    {
        $data = $request->all();

        if (DetailProject::find($id)->update($request->except(['name', 'image', 'projectId']))) {
            $oldObj = Project::find($request->projectId);
            if ($request->hasFile('image')) {
                if (!empty($oldObj->image)) {
                    unlink($oldObj->image);
                }
                $path = "images/projects/";
                $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($path, $fileName);
                $imagePath = $path . $fileName;
            } else {
                $imagePath = $oldObj->image;
            }

            $oldObj->update(['name' => $request->name, 'image' => $imagePath]);
            return redirect()->route('admins.project.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }

     // apply action
    public function changeStatusProject(Request $request)
    {
        $obj = Project::find($request->id)->update(['status' => $request->status]);
        echo json_encode('ok');
    }


    //delete
    public function deleteProject(Request $request)
    {
        $obj = Project::find($request->id)->delete();
        echo json_encode('ok');
    }

    // apply action
    public function actionProject(Request $request)
    {
        $listObj = Project::whereIn('id', $request->selected)->get();
        if (!empty($listObj)) {
            switch ($request->option) {
                case 1:
                foreach ($listObj as $item) {
                    $item->delete();
                }
                break;
                case 2:
                foreach ($listObj as $item) {
                    $item->update(['status' => Project::STATUS['ready']]);
                }
                break;
                case 3:
                foreach ($listObj as $item) {
                 $item->update(['status' => Project::STATUS['salling']]);
             }
             break;
             case 4:
             foreach ($listObj as $item) {
                 $item->update(['status' => Project::STATUS['comingsoon']]);
             }
             break;
         }
         return redirect()->route('admins.project.list')->with('success', 'Success');
     } else {

     }

 }

    // active
 public function activeProject(Request $request)
 {
    $objUpdate = Project::find($request->id);
    $objUpdate->update(['active' => !($objUpdate->active)]);
    echo json_encode('ok');
}

    // status
public function statusProject($id)
{
    $status = Transaction::STATUS;
    $obj = Project::find($id);
    $products = Product::where('project_id', $id);
    $blocks = array_unique($products->pluck('block')->toArray());
    // $lands = $products->where('block', $blocks[0])->pluck('land')->toArray();
    // $floor = $products->where('land', $lands[0])->first()->floor;
    // $floors = ($floor) ? range(1,$floor) : [0 => 0]; 
    $transactions = Transaction::select('transactions.*')->join('products', 'products.id', 'transactions.product_id')
    ->join('projects', 'products.project_id', 'projects.id')
    ->where('projects.id', $id)->get();

    // return view('admin.project.status', ['obj' => $obj, 'products' => $products->get(), 'transactions' => $transactions, 'status' => $status, 'blocks' => $blocks, 'lands' => $lands, 'floors' => $floors]);
    return view('admin.project.status', ['obj' => $obj, 'products' => $products->get(), 'transactions' => $transactions, 'status' => $status, 'blocks' => $blocks]);
}

    // detail purchase transaction
public function getBlockByProject(Request $request)
{
    $blocks = Product::where('project_id', $request->projectId)
    ->pluck('block')->toArray();

    echo json_encode(array_unique($blocks));

}

    // detail purchase transaction
public function getLandByBlock(Request $request)
{
    $lands = Product::where('project_id', $request->projectId)
    ->where('block', $request->block)
    ->pluck('land')->toArray();

    echo json_encode($lands);

}

    // detail purchase transaction
public function getFloorByLand(Request $request)
{
    $floor = Product::where('project_id', $request->projectId)
    ->where('block', $request->block)
    ->where('land', $request->land)->first()->floor;
    $floors = ($floor) ? range(1, $floor) : [0 => 0];
    echo json_encode($floors);

}

//     // status
// public function getFloorByBlock(Request $request)
// {
//     $floors = Product::find($request->id)->floor;

//     echo json_encode(range(1, $floors));
// }

    // searchTransaction
public function searchTransaction(Request $request)
{
    $transaction = new Transaction;
    $blocks = $lands = $floors = [];
    $blocks = Product::where('project_id', $request->projectId)
    ->pluck('block')->toArray();
    if ($request->block != -1) {
        $transaction = $transaction->select('transactions.*')->join('products', 'products.id', 'transactions.product_id')
        ->where('project_id', $request->projectId)
        ->where('block', $request->block);


        $lands = Product::where('project_id', $request->projectId)
        ->where('block', $request->block)
        ->pluck('land')->toArray();
    }

    if ($request->land != -1) {
        $transaction = $transaction->where('land', $request->land);


        $floor = Product::where('project_id', $request->projectId)
        ->where('block', $request->block)
        ->where('land', $request->land)->first()->floor;
        $floors = ($floor) ? range(1, $floor) : [];

    }

    if ($request->floor != -1) {
        $transaction = $transaction->where('transactions.floor', $request->floor);
    }

    if ($request->status != -1) {
        $transaction = $transaction->where('transactions.status', $request->status);
    }

    $status = Transaction::STATUS;
    $obj = Project::find($request->projectId);
    $products = Product::where('project_id', $obj->id)->get();

    $transactions = $transaction->get();
    $search = [
     'block' => $request->block,
     'floor' => $request->floor,
     'land' => $request->land,
     'status' => $request->status,
 ];

 return view('admin.project.status', ['obj' => $obj, 'products' => $products, 'transactions' => $transactions, 'status' => $status, 'search' => $search, 'floors' => $floors, 'lands' => $lands, 'blocks' => $blocks]);

}

    //=====product====
    // edit
public function listProduct($projectId)
{
    $direction = Product::DIRECTION;
    $list = Product::where('project_id', $projectId)->orderBy('block')->get();
    return view('admin.product.index', ['list' => $list, 'direction' => $direction, 'projectId' => $projectId]);
}

    // edit
public function createProduct($projectId)
{
    $direction = Product::DIRECTION;
    return view('admin.product.add', ['direction' => $direction, 'projectId' => $projectId]);
}
    // store
public function storeProduct(ProductCreateRequest $request, $projectId)
{
    $data =  $request->all();

    $product = Product::where('project_id', $projectId)
    ->where('block', $request->block)
    ->where('land', $request->land)->first();
    if (!$product) {
        $data = [
            'project_id' => $projectId,
            'block' => $request->block,
            'land' => $request->land,
            'floor' => $request->floor,
            'price' => $request->price,
            'area' => $request->area,
            'description' => $request->description,
            'direction' => $request->direction,
        ];
        if (Product::create($data)) {
            return redirect()->route('admins.product.list', ['projectId' => $projectId])->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    } else {
        return redirect()->back()->withInput()->with('error', 'Product is exist');
    }
    
}

    // edit
public function editProduct($id)
{
    $direction = Product::DIRECTION;
    $obj = Product::find($id);
    return view('admin.product.edit', ['direction' => $direction, 'obj' => $obj]);
}

    // update
public function updateProduct(ProductCreateRequest $request)
{
    $data =  $request->all();
    $oldProduct = Product::find($request->productId);
    $product = Product::where('project_id', $oldProduct->project_id)
    ->where('block', $request->block)
    ->where('land', $request->land)
    ->where('id', '!=', $request->productId)
    ->first();
    if (!$product) {
        $data = [
            'block' => $request->block,
            'land' => $request->land,
            'floor' => $request->floor,
            'price' => $request->price,
            'area' => $request->area,
            'description' => $request->description,
            'direction' => $request->direction,
        ];
        if ($oldProduct->update($data)) {
            return redirect()->route('admins.product.list', ['projectId' => $oldProduct->project_id])->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    } else {
        return redirect()->back()->withInput()->with('error', 'Product is exist');
    }

}

    //delete
public function deleteProduct(Request $request)
{
    $obj = Product::find($request->id)->delete();
    Transaction::where('product_id', $request->id)->delete();
    echo json_encode('ok');
}

    // apply action
public function actionProduct(Request $request)
{
    $listObj = Product::whereIn('id', $request->selected)->get();
    if (!empty($listObj)) {
        switch ($request->option) {
            case 1:
            foreach ($listObj as $item) {
                Transaction::where('product_id', $item->id)->delete();
                $item->delete();
            }
            break;
        }
        return redirect()->route('admins.slider.list')->with('success', 'Success');
    } else {

    }
}

    // ==========Slider management=============
    // sliders
public function listSlider()
{
    $list  = Slider::all();
    return view('admin.slider.index', ['list' => $list]);
}

    // edit
public function createSlider()
{
    return view('admin.slider.add');
}

    // store
public function storeSlider(SliderCreateRequest $request)
{
    $data = $request->all();
    $data['created_at'] = Carbon::now();;

    if ($request->hasFile('image')) {
        $path = "images/sliders/";
        $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move($path, $fileName);
        $data['image'] = $path . $fileName;
    } else {
        $data['image'] = "";
    }

    if (Slider::create($data)) {
        return redirect()->route('admins.slider.list')->with('success', 'Success');
    } else {
        return redirect()->back()->withInput()->with('error', 'Fail');
    }
}

    // create or edit
public function editSlider($id)
{
    $obj = Slider::find($id);
    return view('admin.slider.edit', ['obj' => $obj]);
}

    // update
public function updateSlider(SliderCreateRequest $request, $id)
{
    $oldObj = Slider::find($id);
    $data = $request->all();

    if ($request->hasFile('image')) {
        if (!empty($oldObj->image)) {
            unlink($oldObj->image);
        }
        $path = "images/sliders/";
        $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move($path, $fileName);
        $data['image'] = $path . $fileName;
    } else {
        $data['image'] = $oldObj->image;
    }

    if ($oldObj->update($data)) {
        return redirect()->route('admins.slider.list')->with('success', 'Success');
    } else {
        return redirect()->back()->withInput()->with('error', 'Fail');
    }
}

    //delete
public function deleteSlider(Request $request)
{
    $obj = Slider::find($request->id);
    if ($obj->delete()) {
        if (!empty($obj->image)) {
            unlink($obj->image);
        }
        echo json_encode('ok');
    }
}

    // apply action
public function actionSlider(Request $request)
{
    $listObj = Slider::whereIn('id', $request->selected)->get();
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
        return redirect()->route('admins.slider.list')->with('success', 'Success');
    } else {

    }

}

    // active
public function activeSlider(Request $request)
{
    $objUpdate = Slider::find($request->id);
    $objUpdate->update(['active' => !($objUpdate->active)]);
    echo json_encode('ok');
}

    // ==========Announcement management=============
    // announcements
public function listAnnouncement()
{
    $objLogin = session()->get('objUser');
    if ($objLogin->role == User::ROLE['admin']) {
        $list = Announcement::all();
    } else {
        $list1 = Announcement::select(['announcements.*',\DB::raw('1  as is_read')])->Where('causer_id', $objLogin->id)->where('active', 1)->orderBy('created_at', 'DESC')->get();
        $list2  = Announcement::select(['announcements.*', 'is_read'])
        ->join('announcement_recieves', 'announcements.id', 'announcement_recieves.announcement_id')
        ->where('reciever_id', $objLogin->id)->where('active', 1)
        ->orderBy('is_read', 'ASC')->orderBy('created_at', 'DESC')->get();

        $list = $list1->merge($list2);
        AnnouncementRecieves::where('reciever_id', $objLogin->id)->update(['is_read' => 1]);
    }

    return view('admin.announcement.index', ['list' => $list]);
}

    // edit
public function createAnnouncement()
{
    return view('admin.announcement.add');
}

    // store
public function storeAnnouncement(AnnouncementCreateRequest $request)
{
    $loginUser = session()->get('objUser');
    $data = $request->all();
    $data['created_at'] = Carbon::now();
    $data['causer_id'] = $loginUser->id;

    if ($announcement = Announcement::create($data)) {
        $userId = User::where('role', '!=', User::ROLE['admin'])->where('role', '!=', User::ROLE['customer'])->pluck('id')->toArray();
        foreach ($userId as $id) {
            AnnouncementRecieves::create([
                'announcement_id' => $announcement->id,
                'reciever_id' => $id,
                'is_read' => 0
            ]);
        }

        return redirect()->route('admins.announcement.list')->with('success', 'Success');
    } else {
        return redirect()->back()->withInput()->with('error', 'Fail');
    }
}

    // create or edit
public function editAnnouncement($id)
{
    $obj = Announcement::find($id);
    return view('admin.announcement.edit', ['obj' => $obj]);
}

    // update
public function updateAnnouncement(AnnouncementCreateRequest $request, $id)
{
    $oldObj = Announcement::find($id);
    $data = $request->all();

    if ($oldObj->update($data)) {
        return redirect()->route('admins.announcement.list')->with('success', 'Success');
    } else {
        return redirect()->back()->withInput()->with('error', 'Fail');
    }
}

    //delete
public function deleteAnnouncement(Request $request)
{
    $objLogin = session()->get('objUser');
    $obj = Announcement::find($request->id);
    if ($objLogin->role == User::ROLE['admin'] || $objLogin->id == $obj->causer_id) {
        if ($obj->delete()) {
            AnnouncementRecieves::where('announcement_id', $request->id)->delete();
            echo json_encode('ok');
        }
    } else {
        AnnouncementRecieves::where('announcement_id', $request->id)
        ->where('reciever_id', $objLogin->id)->delete();
        echo json_encode('ok');
    }
}

    // apply action
public function actionAnnouncement(Request $request)
{
    $objLogin = session()->get('objUser');
    $listObj = Announcement::whereIn('id', $request->selected)->get();
    if (!empty($listObj)) {
        switch ($request->option) {
            case 1:
            foreach ($listObj as $item) {
                if ($objLogin->role == User::ROLE['admin'] || $objLogin->id == $obj->causer_id) {
                    if ($item->delete()) {
                        AnnouncementRecieves::where('announcement_id', $item->id)->delete();
                    }
                } else {
                    AnnouncementRecieves::where('announcement_id', $item->id)
                    ->where('reciever_id', $objLogin->id)->delete();
                }
            }
            break;
            case 2:
            foreach ($listObj as $item) {
                if ($objLogin->role == User::ROLE['admin'] || $objLogin->id == $item->causer_id) {
                    $item->update(['active' => 1]);
                }
            }
            break;
            case 3:
            foreach ($listObj as $item) {
                if ($objLogin->role == User::ROLE['admin'] || $objLogin->id == $item->causer_id) {
                    $item->update(['active' => 0]);
                }
            }
            break;
        }
        return redirect()->route('admins.announcement.list')->with('success', 'Success');
    } else {

    }

}

    // active
public function activeAnnouncement(Request $request)
{
    $objUpdate = Announcement::find($request->id);
    $objUpdate->update(['active' => !($objUpdate->active)]);
    echo json_encode('ok');
}

// ==========consult management=============
    // consult
public function listConsult()
{
    $list  = Consult::all();
    return view('admin.consult.index', ['list' => $list]);
}

    // consult
public function saveConsult($id)
{
    $consult = Consult::find($id);
    $data = [
        'name' => $consult->name,
        'email' => $consult->email,
        'phone' => $consult->phone,
        'created_at' => Carbon::now()
    ];

    $customer = Customer::create($data);

    $data = [
        'customer_id' => $customer->id,
        'project_id' => $consult->product_id,
        'created_at' => Carbon::now()
    ];
    Register::create($data);

    return redirect()->route('admins.consult.list')->with('success', 'Success');
}


    //delete
public function deleteConsult(Request $request)
{
    $obj = Consult::find($request->id);
    if ($obj->delete()) {
        echo json_encode('ok');
    }
}

    // apply action
public function actionConsult(Request $request)
{
    $listObj = Consult::whereIn('id', $request->selected)->get();
    if (!empty($listObj)) {
        switch ($request->option) {
            case 1:
            foreach ($listObj as $item) {
                $item->delete();
            }
            break;
        }
        return redirect()->route('admins.consult.list')->with('success', 'Success');
    } else {

    }

}
//=====================search All transaction ==========
// transaction
public function listAllTransaction()
{
    $list  = Transaction::all();
    $status  = Transaction::STATUS;
    $projects = Project::pluck('name', 'id')->toArray();
    return view('admin.transaction.index', ['list' => $list, 'status' => $status, 'projects' => $projects]);
}

    // transaction
public function searchAllTransaction(Request $request)
{
    $transaction = new Transaction;
    $projects = $blocks = $lands = $floors = [];
    $projects = Project::pluck('name', 'id')->toArray();
    
    if ($request->project != -1) {
        $transaction = $transaction->select('transactions.*')->join('products', 'products.id', 'transactions.product_id')
        ->where('project_id', $request->project);

        $blocks = Product::where('project_id', $request->project)
        ->pluck('block')->toArray();
    }

    if ($request->block != -1) {
        $transaction = $transaction->where('block', $request->block);


        $lands = Product::where('project_id', $request->projectId)
        ->where('block', $request->block)
        ->pluck('land')->toArray();
    }

    if ($request->land != -1) {
        $transaction = $transaction->where('land', $request->land);


        $floor = Product::where('project_id', $request->projectId)
        ->where('block', $request->block)
        ->where('land', $request->land)->first()->floor;
        $floors = ($floor) ? range(1, $floor) : [];

    }

    if ($request->floor != -1) {
        $transaction = $transaction->where('transactions.floor', $request->floor);
    }

    if ($request->status != -1) {
        $transaction = $transaction->where('transactions.status', $request->status);
    }

    $status = Transaction::STATUS;

    $transactions = $transaction->get();
    $search = [
     'project' => $request->project,
     'block' => $request->block,
     'floor' => $request->floor,
     'land' => $request->land,
     'status' => $request->status,
 ];

 return view('admin.transaction.index', ['list' => $transactions, 'status' => $status, 'search' => $search, 'floors' => $floors, 'lands' => $lands, 'blocks' => $blocks, 'projects' => $projects]);

}

// apply action
    public function actionAllTransaction(Request $request)
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
            return redirect()->route('admins.transaction.listAll')->with('success', 'Success');
        } else {

        }

    }

    // transaction
    public function createAllTransaction()
    {
        $projects = Project::pluck('name', 'id')->toArray();
        return view('admin.transaction.add', ['projects' => $projects]);
    }

     // transaction
    public function storeAllTransaction(Request $request)
    {
        if ($request->project == -1 || $request->block == -1 || $request->land == -1 || $request->floor == -1) {
            return redirect()->back()->withInput()->with('error', 'Please Choose');
        }

        $rules = $this->validate($request,
            [
                'name' => 'required|min:3|max:50',
                'email' => 'required|email',
                'phone' => 'required|numeric'
            ],
            [
                'name.required' => 'Name is required',
                'name.min' => 'Name is not less than 3 character',
                'name.max' => 'Name is not greater than 50 character',
                'email.required' => 'Email is required',
                'email.email' => 'Email is not valid',
                'phone.required' => 'Phone is required',
                'phone.numeric' => 'Phone must be number',
            ]
        );

        $productId = Product::where('block', $request->block)
        ->where('land', $request->land)
        ->where('project_id', $request->project)->first()->id;

        //processing nhuwng neu cung la customer ddo thi k lay nuwa
        $transaction = Transaction::where('product_id', $productId)
        ->where('status', '!=', Transaction::STATUS['processing'])->first();
        if(!$transaction) {
            $customerData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'created_at' => Carbon::now()
            ];

            $customer = Customer::create($customerData);
            $register = Register::create([
                'customer_id' => $customer->id,
                'project_id' => $request->project,
                'created_at' => Carbon::now()
            ]);
            $data = [
                'floor' => $request->floor,
                'status' => Transaction::STATUS['processing'],
                'created_at' => Carbon::now(),
                'register_id' => $register->id,
                'product_id' => $productId,
                'description' => $request->description ?? '',
                'rating' => 0
            ];
            if (Transaction::create($data)) {
                return redirect()->route('admins.transaction.listAll')->with('success', 'Success');
            } else {
                return redirect()->back()->withInput()->with('error', 'Fail');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Transaction is exist');
        }
    }

}