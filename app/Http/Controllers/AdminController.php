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
use App\Http\Requests\ApartmentCreateRequest;
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
use App\Models\Apartment;
use App\Models\Slider;
use App\Models\Consult;
use App\Models\Register;
use App\Models\PersonalInformation;
use App\Models\NotificationSchedule;
use App\Models\UnitPrice;
use Carbon\Carbon;
use PurchaseTransaction;
use App\Models\Announcement;
use App\Models\AnnouncementRecieves;

class AdminController extends Controller
{
    //=====================profile======================
    //profile
    public function profile()
    {
        return view('admin.auth.profile');
    }

    //update profile
    public function updateProfile(Request $request)
    {
        $objUser = session()->get('objUser');

        $data = [];
        if($objUser->role == 1) {
            $rules = $this->validate($request,
                [
                    'email' => 'required|email|unique:users,email,' . $objUser->id . ',id',
                    'password' => 'nullable|min:6|max:15'
                ],
                [
                    'email.required' => 'Email is required',
                    'email.email' => 'Email is not valid',
                    'email.unique' => 'Email is exist',
                    'password.min' => 'Password is not less than 6 character',
                    'password.max' => 'Password is not greater than 15 character',
                ]
            );

            $data = [
                'email' => $request->email,
                'password' => empty($request->password) ? $objUser->password : md5($request->password)
            ];
            if ($request->hasFile('image')) {
                if (!empty($objUser->image)) {
                    unlink($objUser->image);
                }
                $path = "images/users/";
                $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($path, $fileName);
                $data['image'] = $path . $fileName;
            } else {
                $data['image'] = $objUser->image;
            }

            $objUser->update($data);
            session()->put('objUser', $objUser);
        } else {
            $rules = $this->validate($request,
                [
                    'name.required' => 'Name is required',
                    'email' => 'required|email|unique:users,email,' . $objUser->id . ',id',
                    'phone' => 'required|numeric',
                    'address' => 'required',
                    'password' => 'nullable|min:6|max:15'
                ],
                [
                    'name.required' => 'Name is required',
                    'email.required' => 'Email is required',
                    'email.email' => 'Email is not valid',
                    'email.unique' => 'Email is exist',
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
                if (!empty($objUser->image)) {
                    unlink($objUser->image);
                }
                $path = "images/users/";
                $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move($path, $fileName);
                $data['image'] = $path . $fileName;
            } else {
                $data['image'] = $objUser->image;
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
        return redirect()->route('admins.profile')->with('success', 'Update success!');
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

    // create
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
            return redirect()->route('admins.leader.list')->with('success', 'Add success');
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

    // create
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
                if (!empty($oldUser->image)) {
                    unlink($oldUser->image);
                }
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

            return redirect()->route('admins.leader.list')->with('success', 'Update success');
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
            NotificationSchedule::where('type', NotificationSchedule::TYPE['employee'])
            ->where('reciever_id', $objUser->id)->delete();
            AnnouncementRecieves::where('reciever_id', $objUser->id)->delete();

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
                    NotificationSchedule::where('type', NotificationSchedule::TYPE['employee'])
                    ->where('reciever_id', $objUser->id)->delete();
                    AnnouncementRecieves::where('reciever_id', $objUser->id)->delete();

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
            return redirect()->route('admins.leader.list')->with('success', 'Action success');
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

    // create
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
            return redirect()->route('admins.sale.list')->with('success', 'Add success');
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

            return redirect()->route('admins.sale.list')->with('success', 'Update success');
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
            NotificationSchedule::where('type', NotificationSchedule::TYPE['employee'])
            ->where('reciever_id', $obj->user_id)->delete();
            AnnouncementRecieves::where('reciever_id', $obj->user_id)->delete();
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
                    NotificationSchedule::where('type', NotificationSchedule::TYPE['employee'])
                    ->where('reciever_id', $objUser->id)->delete();
                    AnnouncementRecieves::where('reciever_id', $objUser->id)->delete();
                    $item->delete();
                    $objUser->delete();
                    if (!empty($objUser->image)) {
                        unlink($objUser->image);
                    }

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
            return redirect()->route('admins.sale.list')->with('success', 'Action success');
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
                        Post::where('poster_id', $item->id)->delete();
                        User::find($item->user_id)->delete();
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
            return redirect()->route('admins.poster.list')->with('success', 'Action success');
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
            Post::where('poster_id', $obj->id)->delete();
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

    // =========Post=============

    // list
    public function listPost()
    {
        $direction = Post::DIRECTION;
        $list  = Post::whereNull('deleted_at')->orderBy('id','desc')->get();
        return view('admin.post.posts.index', ['list' => $list, 'direction' => $direction]);
    }

    public function listPostByPoster($posterId)
    {
        $list  = Post::where('poster_id', $posterId)->get();
        return view('admin.post.posts.index', ['list' => $list]);
    }

    // status
    public function statusPost(Request $request)
    {
        $objUpdate = Post::find($request->id);
        $objUpdate->update(['status' => $request->status]);
        echo json_encode('ok');
    }

    //delete
    public function deletePost(Request $request)
    {
        $obj = Post::find($request->id);
        Consult::where('type', Consult::TYPE['post'])
        ->where('product_id', $request->id)->delete();
        if ($obj->update(['deleted_at'=> Carbon::now()])) {
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
                    Consult::where('type', Consult::TYPE['post'])
                    ->where('product_id', $item->id)->delete();
                    $item->update(['deleted_at' => Carbon::now()]);
                }
                break;
                case 2:
                foreach ($listObj as $item) {
                    $item->update(['status'=> Post::STATUS['processed']]);
                }
                break;
                case 3:
                foreach ($listObj as $item) {
                    $item->update(['status'=> Post::STATUS['cancel']]);
                }
                break;
            }
            return redirect()->route('admins.post.list')->with('success', 'Action success');
        } else {

        }

    }

    // ========== customer management=============
    // list
    public function listCustomer()
    {
        $objUser = getUserLogin();
        if (isEmployee()) {
            $list  = Customer::select('customers.*')
            ->join('assign_task', 'assign_task.customer_id', 'customers.id')
            ->where('assign_task.employee_id', $objUser->employee->id)
            ->get();
        } else {
            $list  = Customer::all();
        }
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
            return redirect()->route('admins.customer.detail', ['id' => $request->customerId])->with('success', 'Action success');
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
        Transaction::where('register_id', $request->id)->delete();
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
                    PersonalInformation::where('customer_id', $item->id)->delete();
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
            PersonalInformation::where('customer_id', $obj->id)->delete();
            NotificationSchedule::where('type', 2)->where('reciever_id', $obj->id)->delele();
            AssignTask::where('customer_id', $obj->id)->delete();
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
        if ($request->block == -1 || $request->land == -1 || $request->floor == -1 || $request->position == -1) {
            return redirect()->back()->withInput()->with('error', 'Please Choose');
        }
        $productId = Product::where('block', $request->block)
        ->where('land', $request->land)
        ->where('project_id', $request->projectId)->first()->id;

        if ($request->floor != -1 && $request->position != -1 && $request->floor != 0 && $request->position != '0') {
            $apartmentId = Apartment::where('product_id', $productId)
            ->where('floor', $request->floor)
            ->where('position', 'like', "$request->position")
            ->first()->id;
        }

        //processing nhuwng neu cung la customer ddo thi k lay nuwa
        $transaction1 = Transaction::where('product_id', $productId)
        ->where('status', '!=', Transaction::STATUS['processing']);
        if (!empty($apartmentId)) {
            $transaction1 = $transaction1->where('apartment_id', $apartmentId);
        }
        $transaction1 = $transaction1->first();

        $transaction2 = Transaction::where('product_id', $productId)
        ->where('status', Transaction::STATUS['processing'])
        ->where('register_id', $request->registerId);
        if (!empty($apartmentId)) {
            $transaction2 = $transaction2->where('apartment_id', $apartmentId);
        }
        $transaction2 = $transaction2->first();
        if($transaction1 || $transaction2) {
            return redirect()->back()->withInput()->with('error', 'Transaction is exist');
        } else {
            $data = [
                'floor' => $request->floor,
                'apartment_id' => $apartmentId ?? 0,
                'status' => Transaction::STATUS['processing'],
                'created_at' => Carbon::now(),
                'register_id' => $request->registerId,
                'product_id' => $productId,
                'description' => $request->description ?? '',
                'rating' => 0
            ];
            if (Transaction::create($data)) {
                return redirect()->route('admins.customer.detailTransaction', ['registerId' => $request->registerId])->with('success', 'Add Success');
            } else {
                return redirect()->back()->withInput()->with('error', 'Fail');
            }
        }
    }

    // edit purchase transaction
    public function editTransaction($transactionId)
    {
        $transaction = Transaction::find($transactionId);
        if ($transaction->status != Transaction::STATUS['processing']) {
            return back()->with('success', 'Transaction is not edit');
        }
        $projectId = $transaction->product->project->id;
        $products = Product::where('project_id', $projectId);
        $blocks = array_unique($products->pluck('block')->toArray());
        $lands = $products->where('block', $transaction->product->block)->pluck('land')->toArray();
        $floors = $transaction->product->floor ?? 0;
        $apartment = 0;
        if (isset($transaction->apartment)) {
            $apartment = Apartment::where('product_id', $transaction->apartment->product_id)
            ->where('floor', $transaction->apartment->floor)->pluck('position')->toArray();
        }
        return view('admin.customer.editTransaction', ['products' => $products, 'transaction' => $transaction, 'blocks' => $blocks, 'floors' => $floors, 'lands' => $lands, 'apartment' => $apartment]);
    }

    // detail purchase transaction
    public function updateTransaction(Request $request)
    {
        if ($request->block == -1 || $request->land == -1 || $request->floor == -1 || $request->position == -1) {
            return redirect()->back()->withInput()->with('error', 'Please Choose');
        }
        $productId = Product::where('block', $request->block)
        ->where('land', $request->land)
        ->where('project_id', $request->projectId)->first()->id;

        if ($request->floor != -1 && $request->position != -1 && $request->floor != 0 && $request->position != '0') {
            $apartmentId = Apartment::where('product_id', $productId)
            ->where('floor', $request->floor)
            ->where('position', 'like', "$request->position")
            ->first()->id;
        }

        //processing nhuwng neu cung la customer ddo thi k lay nuwa
        $transaction1 = Transaction::where('id', '!=', $request->transactionId)
        ->where('product_id', $productId)
        ->where('status', '!=', Transaction::STATUS['processing']);
        if (!empty($apartmentId)) {
            $transaction1 = $transaction1->where('apartment_id', $apartmentId);
        }
        $transaction1 = $transaction1->first();

        $transaction2 = Transaction::where('id', '!=', $request->transactionId)
        ->where('product_id', $productId)
        ->where('status', Transaction::STATUS['processing'])
        ->where('register_id', $request->registerId);
        if (!empty($apartmentId)) {
            $transaction2 = $transaction2->where('apartment_id', $apartmentId);
        }
        $transaction2 = $transaction2->first();
        if($transaction1 || $transaction2) {
            return redirect()->back()->withInput()->with('error', 'Transaction is exist');
        } else {
            $transaction = Transaction::find($request->transactionId);

            $data = [
                'product_id' => $productId,
                'floor' => $request->floor,
                'apartment_id' => $apartmentId ?? 0,
                'description' => $request->description ?? '',
                'created_at' => Carbon::now(),
                'rating' => 0
            ];

            if ($transaction->update($data)) {
                return redirect()->route('admins.customer.detailTransaction', ['registerId' => $transaction->register_id])->with('success', 'Update Success');
            } else {
                return redirect()->back()->withInput()->with('error', 'Fail');
            }
        }
    }

    // detail purchase transaction
    public function ratingTransaction(Request $request)
    {
        $obj = Transaction::find($request->id);
        if ($obj->status != Transaction::STATUS['processing']) {
            echo json_encode('not ok');
        }
        $obj->update(['rating' => $request->rating]);
        echo json_encode('ok');
    }

    //delete
    public function deleteTransaction(Request $request)
    {
        $obj = Transaction::find($request->id);
        if($obj->status != Transaction::STATUS['processing']) {
            echo json_encode('yes');
        } else {
            if ($obj->delete()) {
                echo json_encode('ok');
            }
        }
    }

    //delete
    public function deleteConfirmTransaction(Request $request)
    {
        $obj = Transaction::find($request->id);
        if ($obj->status != Transaction::STATUS['processing']) {
            if ($obj->apartment_id != 0 && $obj->apartment_id != -1) {
                Apartment::find($obj->apartment_id)->update(['status' => 1]);
            }
            Product::find($obj->product_id)->update(['status' => 1]);
        }
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
                    if ($item->status == Transaction::STATUS['processing']) {
                    // if ($item->apartment_id != 0 && $item->apartment_id != -1) {
                    //     Apartment::find($item->apartment_id)->update(['status' => 1]);
                    // }
                    // Product::find($item->product_id)->update(['status' => 1]);
                        $item->delete();
                }
                
            }
            break;
            case 2:
            foreach ($listObj as $item) {
                $item->update(['status' => Transaction::STATUS['registered']]);
                if ($item->apartment_id != 0 && $item->apartment_id != -1) {
                    Apartment::find($item->apartment_id)->update(['status' => 0]);
                    $product = Product::find($item->product_id);
                    $apartmentIds =  Apartment::where('product_id', $product->id)
                    ->pluck('id')->toArray();
                    $isRemaing = false;
                    foreach ($apartmentIds as $apartmentId) {
                        $status = Apartment::find($apartmentId)->status;
                        if ($status == 1) {
                            $isRemaing = true;
                            break;
                        }
                    }
                    if($isRemaing) {
                        $product->update(['status' => 1]);
                    } else {
                        $product->update(['status' => 0]);
                    }
                } else {
                    $product->update(['status' => 0]);
                }
                
            }
            break;
            case 3:
            foreach ($listObj as $item) {
                $item->update(['status' => Transaction::STATUS['deposit']]);
                if ($item->apartment_id != 0 && $item->apartment_id != -1) {
                    Apartment::find($item->apartment_id)->update(['status' => 0]);
                    $product = Product::find($item->product_id);
                    $apartmentIds =  Apartment::where('product_id', $product->id)
                    ->pluck('id')->toArray();
                    $isRemaing = false;
                    foreach ($apartmentIds as $apartmentId) {
                        $status = Apartment::find($apartmentId)->status;
                        if ($status == 1) {
                            $isRemaing = true;
                            break;
                        }
                    }
                    if($isRemaing) {
                        $product->update(['status' => 1]);
                    } else {
                        $product->update(['status' => 0]);
                    }
                } else {
                    $product->update(['status' => 0]);
                }
                
            }
            break;
            case 4:
            foreach ($listObj as $item) {
                $item->update(['status' => Transaction::STATUS['payment']]);
                if ($item->apartment_id != 0 && $item->apartment_id != -1) {
                    Apartment::find($item->apartment_id)->update(['status' => 0]);
                    $product = Product::find($item->product_id);
                    $apartmentIds =  Apartment::where('product_id', $product->id)
                    ->pluck('id')->toArray();
                    $isRemaing = false;
                    foreach ($apartmentIds as $apartmentId) {
                        $status = Apartment::find($apartmentId)->status;
                        if ($status == 1) {
                            $isRemaing = true;
                            break;
                        }
                    }
                    if($isRemaing) {
                        $product->update(['status' => 1]);
                    } else {
                        $product->update(['status' => 0]);
                    }
                } else {
                    $product->update(['status' => 0]);
                }
                
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
    $obj = Transaction::find($request->id);
    $obj->update(['status' => $request->status]);
    switch ($request->status) {
        case Transaction::STATUS['processing']:
        if ($obj->apartment_id != 0 && $obj->apartment_id != -1) {
            Apartment::find($obj->apartment_id)->update(['status' => 1]);
        }
        Product::find($obj->product_id)->update(['status' => 1]);
        break;

        default:
        $product = Product::find($obj->product_id);
        if ($obj->apartment_id != 0 && $obj->apartment_id != -1) {
            Apartment::find($obj->apartment_id)->update(['status' => 0]);
            $apartmentIds =  Apartment::where('product_id', $product->id)
            ->pluck('id')->toArray();
            $isRemaing = false;
            foreach ($apartmentIds as $apartmentId) {
                // $transaction = Transaction::where('product_id', $product->id)
                // ->where('apartment_id', $apartmentId)
                // ->where('status', '!=', Transaction::STATUS['processing'])->first();
                $status = Apartment::find($apartmentId)->status;
                if ($status == 1) {
                    $isRemaing = true;
                    break;
                }
                // if ($transaction == null) {
                //     $isRemaing = true;
                //     break;
                // }
            }

            if($isRemaing) {
                $product->update(['status' => 1]);
            } else {
                $product->update(['status' => 0]);
            }
        } else {
            $product->update(['status' => 0]);
        }
        break;
    }
    
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
        return redirect()->route('admins.news.list')->with('success', 'Add success');
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
        return redirect()->route('admins.news.list')->with('success', 'Update success');
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
        return redirect()->route('admins.news.list')->with('success', 'Action success');
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
    $objUser = session()->get('objUser');
        // if ($objUser == User::ROLE['admin']) {
    if (!isEmployee()) {
        $list = AssignTask::all();
    } else {
        $list  = AssignTask::where('employee_id', $objUser->employee->id)->get();
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
            'reciever_id' => $assign->employee->user->id,
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
    $oldEmployeeId = $oldObj->employee_id;
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
            'reciever_id' => Employee::find($request->employee_id)->user->id,
            'is_read' => 0
        ]);
        AnnouncementRecieves::create([
            'announcement_id' => $announcement->id,
            'reciever_id' => Employee::find($oldEmployeeId)->user->id,
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
    $employeeId = $obj->employee_id;
    if ($obj->delete()) {
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
            'reciever_id' => Employee::find($employeeId)->user->id,
            'is_read' => 0
        ]);
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
                'reciever_id' => Employee::find($item->employee_id)->user->id,
                'is_read' => 0
            ]);
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
    $listObj = Contact::whereIn('id', $request->selected)->get();
    if (!empty($listObj)) {
        switch ($request->option) {
            case 1:
            foreach ($listObj as $item) {
                $item->delete();
            }
            break;
            case 2:
            foreach ($listObj as $item) {
                $item->update(['is_reply'=> 1]);
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
    $objUpdate->update(['is_reply' => !($objUpdate->active)]);
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
        return redirect()->route('admins.introduce.list')->with('success', 'Add success');
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
        return redirect()->route('admins.introduce.list')->with('success', 'Update success');
    } else {
        return redirect()->back()->withInput()->with('error', 'Fail');
    }
}

    //delete
public function deleteIntroduce(Request $request)
{
    $obj = Introduce::find($request->id)->delete();
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

    // ==========project management=============
    // schedule
public function listProject()
{
    $status = Project::STATUS;
    $list  = Project::all();
    $districts = District::pluck('name', 'id')->toArray();
    return view('admin.project.index', ['list' => $list, 'status' => $status, 'districts' => $districts]);
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
    $districts = District::pluck('name', 'id')->toArray();
    return view('admin.project.add', ['districts' => $districts]);
}

// store
public function storeProject(ProjectCreateRequest $request)
{
        // get user login
    $data = $request->all();
    $dataDetail = [
        'introduce' => $request->introduce,
        'overview' => $request->overview,
        'position' => $request->position,
        'utilities' => $request->utilities,
        'progress' => $request->progress,
        'price_payment' => $request->price_payment,

    ];
    if ($detailProject = DetailProject::create($dataDetail)) {
        if ($request->hasFile('image')) {
            $path = "images/projects/";
            $fileName = str_random('10') . time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($path, $fileName);
            $imagePath = $path . $fileName;
        } else {
            $imagePath = '';
        }
        $data['image'] = $imagePath;
        $images = [];
        if ($files = $request->file('images')) {
            if (count($files) > 3) {
                return redirect()->back()->withInput()->with('error', 'Fail');
            }
            if (!empty($files)) {
                foreach ($files as $file) {
                    $path = "images/projects/";
                    $fileName = str_random('10') . time() . '.' . $file->getClientOriginalExtension();
                    $file->move($path, $fileName);
                    $imagePath = $path . $fileName;
                    $images[] = $imagePath;
                }
                $data['library_images'] = implode("|", $images);
            }
        } else {
            $data['library_images'] = '';
        }

        $data['name'] = $request->name;
        $data['detail_project_id'] = $detailProject->id;
        $data['status'] = Project::STATUS['comingsoon'];
        $data['created_at'] = Carbon::now();
        $data['district_id'] = $request->district_id;
        $data['village_id'] = $request->village_id;
        $data['street_id'] = $request->street_id;

        $district = District::find($request->district_id)->name;
        $village = Village::find($request->village_id)->name;
        $street = Street::find($request->street_id)->name;
        $address = $street . ' ' . $village . ' ' . $district;
        $map = getMap($address);
        $data['map'] = $map['latitude'] . '|' . $map['longitude'];

        if (Project::create($data)) {
            return redirect()->route('admins.project.list')->with('success', 'Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }
}

// create or edit
public function editProject($id)
{
    $obj = Project::find($id);
    $detail = DetailProject::find($obj->detail_project_id);
    $district = District::pluck('name', 'id')->toArray();
    $village = Village::where('district_id', $obj->district_id)->pluck('name', 'id')->toArray();
    $street = Street::where('village_id', $obj->village_id)->pluck('name', 'id')->toArray();
    return view('admin.project.edit', ['obj' => $obj, 'detail' => $detail, 'districts' => $district, 'villages' => $village, 'streets' => $street]);
}

    // update
public function updateProject(ProjectCreateRequest $request, $id)
{
    $data = $request->all();

    $dataDetail = [
        'introduce' => $request->introduce,
        'overview' => $request->overview,
        'position' => $request->position,
        'utilities' => $request->utilities,
        'progress' => $request->progress,
        'price_payment' => $request->price_payment,

    ];
    if (DetailProject::find($id)->update($dataDetail)) {
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
        $data['image'] = $imagePath;
        $images = [];
        if ($files = $request->file('images')) {
            if (count($files) > 3) {
                return redirect()->back()->withInput()->with('error', 'Fail');
            }
            if (!empty($files)) {
                foreach(explode("|", $oldObj->library_images) as $item) {
                    if (!empty($item)) {
                        unlink($item);
                    }
                }

                foreach ($files as $file) {
                    $path = "images/projects/";
                    $fileName = str_random('10') . time() . '.' . $file->getClientOriginalExtension();
                    $file->move($path, $fileName);
                    $imagePath = $path . $fileName;
                    $images[] = $imagePath;
                }
                $data['library_images'] = implode("|", $images);
            }
        }

        $data['name'] = $request->name;
        $data['district_id'] = $request->district_id;
        $data['village_id'] = $request->village_id;
        $data['street_id'] = $request->street_id;

        $district = District::find($request->district_id)->name;
        $village = Village::find($request->village_id)->name;
        $street = Street::find($request->street_id)->name;
        $address = $street . ' ' . $village . ' ' . $district;
        $map = getMap($address);
        $data['map'] = $map['latitude'] . '|' . $map['longitude'];

        if ($oldObj->update($data)) {
            return redirect()->route('admins.project.list')->with('success', 'Update Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }
}

    // apply action
public function changeStatusProject(Request $request)
{
    $transactions = Transaction::join('registers', 'registers.id', 'transactions.register_id')
    ->join('projects', 'projects.id', 'registers.project_id')
    ->where('project_id', $request->id)->first();
    if(isset($transactions)) {
        echo json_encode('not ok');
    } else {
        $obj = Project::find($request->id)->update(['status' => $request->status]);
        echo json_encode('ok');
    }
}


    //delete
public function deleteProject(Request $request)
{
    $transactions = Transaction::join('registers', 'registers.id', 'transactions.register_id')
    ->join('projects', 'projects.id', 'registers.project_id')
    ->where('project_id', $request->id)->first();
    if(isset($transactions)) {
        echo json_encode('not ok');
    } else {
        $obj = Project::find($request->id);
        DetailProject::find($obj->detail_project_id)->delete();
        $productIds = Product::where('project_id', $request->id)->pluck('id')->toArray();
        Apartment::whereIn('product_id', $productIds)->delete();
        Product::where('project_id', $request->id)->delete();
        $registerIds = Register::where('project_id', $request->id)->pluck('id')->toArray();
        Register::where('project_id', $request->id)->delete();
        Transaction::whereIn('register_id', $registerIds)->delete();
        $obj->delete();
        echo json_encode('ok');
    }
}

    // apply action
public function actionProject(Request $request)
{
    $listObj = Project::whereIn('id', $request->selected)->get();
    if (!empty($listObj)) {
        switch ($request->option) {
            case 1:
            foreach ($listObj as $item) {
                $transactions = Transaction::join('registers', 'registers.id', 'transactions.register_id')
                ->join('projects', 'projects.id', 'registers.project_id')
                ->where('project_id', $item->id)->first();
                if(!isset($transactions)) {
                    $productIds = Product::where('project_id', $item->id)->pluck('id')->toArray();
                    Apartment::whereIn('product_id', $productIds)->delete();
                    Product::where('project_id', $item->id)->delete();
                    $registerIds = Register::where('project_id', $item->id)->pluck('id')->toArray();
                    Register::where('project_id', $item->id)->delete();
                    Transaction::whereIn('register_id', $registerIds)->delete();
                    $item->delete();
                }
            }
            break;
            case 2:
            foreach ($listObj as $item) {
                $item->update(['status' => Project::STATUS['ready']]);
            }
            break;
            case 3:
            foreach ($listObj as $item) {
                $item->update(['status' => Project::STATUS['saling']]);
            }
            break;
            case 4:
            foreach ($listObj as $item) {
                $item->update(['status' => Project::STATUS['comingsoon']]);
            }
            break;
            case 5:
            foreach ($listObj as $item) {
                $transactions = Transaction::join('registers', 'registers.id', 'transactions.register_id')
                ->join('projects', 'projects.id', 'registers.project_id')
                ->where('project_id', $item->id)->first();
                if(!isset($transactions)) {
                    $item->update(['status' => Project::STATUS['stop']]);
                } 
            }
            break;
        }
        return redirect()->route('admins.project.list')->with('success', 'Action Success');
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
    $cats = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
    ->pluck('name', 'id')->toArray();
    $products = Product::where('project_id', $id);
    $blocks = array_unique($products->pluck('block')->toArray());
    $transactions = Transaction::select('transactions.*')->join('products', 'products.id', 'transactions.product_id')
    ->join('projects', 'products.project_id', 'projects.id')
    ->where('projects.id', $id)->get();

    return view('admin.project.status', ['obj' => $obj, 'products' => $products->get(), 'transactions' => $transactions, 'status' => $status, 'cats' => $cats, 'blocks' => $blocks]);
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
    $floors = ($floor) ? range(1, $floor) : 0;
    echo json_encode($floors);

}

    // detail purchase transaction
public function getApartmentByFloor(Request $request)
{
    $productId = Product::where('project_id', $request->projectId)
    ->where('block', $request->block)
    ->where('land', $request->land)->first()->id;
    $apartment = Apartment::where('product_id', $productId)->where('floor', $request->floor)->pluck('position')->toArray();
    $apartment = !empty($apartment) ? $apartment : 0;
    echo json_encode($apartment);

}

public function getVillageByDistrict(Request $request)
{
    $villages = Village::where('district_id', $request->district_id)
    ->pluck('name', 'id')->toArray();
    echo json_encode($villages);

}

public function getStreetByVillage(Request $request)
{
    $streets = Street::where('village_id', $request->village_id)
    ->pluck('name', 'id')->toArray();
    echo json_encode($streets);

}

    // searchTransaction
public function searchTransaction(Request $request)
{
    $transaction = Transaction::select('transactions.*')
    ->join('products', 'products.id', 'transactions.product_id')
    ->where('project_id', $request->projectId);
    $cats = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
    ->pluck('name', 'id')->toArray();
    $blocks = $lands = $floors = [];
    $blocks = Product::where('project_id', $request->projectId)
    ->pluck('block')->toArray();

    if ($request->cat_id != -1) {
        $transaction = $transaction->where('cat_id', $request->cat_id);
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
        $transaction = $transaction->join('apartments', 'apartments.id', 'transactions.apartment_id')
        ->where('apartments.floor', $request->floor);
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
        'cat_id' => $request->cat_id,
    ];

    return view('admin.project.status', ['obj' => $obj, 'products' => $products, 'transactions' => $transactions, 'status' => $status, 'search' => $search, 'floors' => $floors, 'lands' => $lands, 'blocks' => $blocks, 'cats' => $cats]);

}

// searchTransaction
public function searchProject(Request $request)
{
    $project = new Project;
    $districts = $villages = $streets = [];
    $districts = District::pluck('name', 'id')->toArray();

    if ($request->district_id != -1) {
        $project = $project->where('district_id', $request->district_id);

        $villages = Village::where('district_id', $request->district_id)
        ->pluck('name', 'id')->toArray();
    }

    if ($request->village_id != -1) {
        $project = $project->where('village_id', $request->village_id);

        $streets = Street::where('village_id', $request->village_id)
        ->pluck('name', 'id')->toArray();
    }

    if ($request->street_id != -1) {
        $project = $project->where('street_id', $request->street_id);
    }

    if ($request->status != -1) {
        $project = $project->where('status', $request->status);
    }

    $status = Project::STATUS;

    $list = $project->get();
    $search = [
        'district_id' => $request->district_id,
        'village_id' => $request->village_id,
        'street_id' => $request->street_id,
        'status' => $request->status,
    ];

    return view('admin.project.index', ['list' => $list, 'status' => $status, 'search' => $search, 'districts' => $districts, 'villages' => $villages, 'streets' => $streets]);

}
    //=====product====
    // edit
public function listProduct($projectId)
{
    $project = Project::find($projectId);
    $list = Product::where('project_id', $projectId)->orderBy('id')->get();
    $cats = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
    ->pluck('name', 'id')->toArray();

    $directions = Product::DIRECTION;
    $prices = [
        'Thỏa thuận',
        '< 500 triệu',
        '500 - 800 triệu',
        '800 - 1 tỷ',
        '1 - 5 tỷ',
        '> 5 tỷ'
    ];
    $areas = [
        'Không xác định',
        '<= 30 m2',
        '30-80 m2',
        '80-150 m2',
        '150-300 m2',
        '300-500 m2',
        '> 500 m2',
    ];
    $statuses = Product::STATUS;
    return view('admin.product.index', [
        'list' => $list,
        'project' => $project,
        'cats' => $cats,
        'prices' => $prices,
        'areas' => $areas,
        'statuses' => $statuses,
        'directions' => $directions,
    ]);
}

// searchTransaction
public function searchProduct(Request $request)
{
    $product = Product::where('project_id', $request->projectId);
    $project = Project::find($request->projectId);
    $cats = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
    ->pluck('name', 'id')->toArray();

    $directions = Product::DIRECTION;
    $prices = [
        'Thỏa thuận',
        '< 500 triệu',
        '500 - 800 triệu',
        '800 - 1 tỷ',
        '1 - 5 tỷ',
        '> 5 tỷ'
    ];
    $areas = [
        'Không xác định',
        '<= 30 m2',
        '30-80 m2',
        '80-150 m2',
        '150-300 m2',
        '300-500 m2',
        '> 500 m2',
    ];
    $statuses = Product::STATUS;

    if ($request->cat_id != -1) {
        $product = $product->where('cat_id', $request->cat_id);
    }

    if ($request->area != -1) {
        switch ($request->area) {
            case 0: $product = $product->where('area', 0);
            break;
            case 1: $product = $product->where('area', '<=', 30);
            break;
            case 2: $product = $product->whereBetween('area', [30, 80]);
            break;
            case 3: $product = $product->whereBetween('area', [80, 150]);
            break;
            case 4: $product = $product->whereBetween('area', [150, 300]);
            break;
            case 5: $product = $product->whereBetween('area', [300, 500]);
            break;
            case 6: $product = $product->where('area', '>', 500);
            break;
        }
    }

    if ($request->price != -1) {
        switch ($request->price) {
            case 0: $product = $product->where('unit_price_id', 1);
            break;
            case 1: $product = $product->where('unit_price_id', 2)->where('price', '<', 500);
            break;
            case 2: $product = $product->where('unit_price_id', 2)->whereBetween('price', [500, 800]);
            break;
            case 3: $product = $product->where(function ($query) {
                $query->where('unit_price_id', 2)
                ->whereBetween('price', [800, 999]);
            })->orWhere(function ($query) {
                $query->where('unit_price_id', 3)
                ->where('price', 1);
            });
            break;
            case 4: $product = $product->where('unit_price_id', 3)
            ->whereBetween('price', [1, 5]);
            break;
            case 5: $product = $product->where('unit_price_id', 3)
            ->where('price', '>', 5);
            break;
        }
    }

    if ($request->status != -1) {
        $product = $product->where('status', $request->status);
    }

    if ($request->direction != -1) {
        $product = $product->where('direction', $request->direction);
    }

    $list = $product->get();
    $search = [
        'price' => $request->price,
        'direction' => $request->direction,
        'status' => $request->status,
        'area' => $request->area,
        'cat_id' => $request->cat_id,
    ];

    return view('admin.product.index', [
        'list' => $list,
        'project' => $project,
        'cats' => $cats,
        'prices' => $prices,
        'areas' => $areas,
        'statuses' => $statuses,
        'directions' => $directions,
        'search' => $search
    ]);
}

    // edit
public function createProduct($projectId)
{
    $direction = Product::DIRECTION;
    $unitPrice = UnitPrice::where('type_transaction', 1)
    ->pluck('name', 'id')->toArray();
    $project = Project::find($projectId);
    $categories = Category::where('type_transaction', 1)
    ->pluck('name', 'id')->toArray();
    return view('admin.product.add', ['direction' => $direction, 'project' => $project, 'unitPrice' => $unitPrice, 'categories' => $categories]);
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
            'apartment' => $request->apartment,
            'price' => ($request->unit_price_id == 1) ? 0 : $request->price,
            'unit_price_id' => $request->unit_price_id,
            'area' => $request->area,
            'cat_id' => $request->cat_id,
            'description' => $request->description ?? '',
            'direction' => $request->direction,
            'status' => 1,
        ];
        $images = [];
        if ($files = $request->file('images')) {
            if (count($files) > 3) {
                return redirect()->back()->withInput()->with('error', 'Fail');
            }
            if (!empty($files)) {
                foreach ($files as $file) {
                    $path = "images/products/";
                    $fileName = str_random('10') . time() . '.' . $file->getClientOriginalExtension();
                    $file->move($path, $fileName);
                    $imagePath = $path . $fileName;
                    $images[] = $imagePath;
                }
                $data['images'] = implode("|", $images);
            } else {
                $data['images'] = '';
            }
        } else {
            $data['images'] = '';
        }
        if (Product::create($data)) {
            return redirect()->route('admins.product.list', ['projectId' => $projectId])->with('success', 'Add Success');
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
    $objTransaction = Transaction::join('products', 'products.id', 'transactions.product_id')
    ->where('product_id', $id)
    ->where('transactions.status', '!=', Transaction::STATUS['processing'])
    ->where('floor', 0)->where('apartment_id', 0)->first();
    if (isset($objTransaction)) {
        return back()->with('success', 'This product is in transaction');
    }
    $direction = Product::DIRECTION;
    $unitPrice = UnitPrice::where('type_transaction', 1)
    ->pluck('name', 'id')->toArray();
    $categories = Category::where('type_transaction', 1)
    ->pluck('name', 'id')->toArray();
    $obj = Product::find($id);
    return view('admin.product.edit', ['direction' => $direction, 'obj' => $obj, 'unitPrice' => $unitPrice, 'categories' => $categories]);
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
        if ($oldProduct->floor != 0 && $oldProduct->floor != -1 && $oldProduct->apartment != 0 && $oldProduct->apartment  != -1) {
            $transaction = Transaction::select('apartments.floor')
            ->join('apartments', 'apartments.id', 'transactions.apartment_id')
            ->where('transactions.product_id', $oldProduct->id)
            ->orderBy('floor', 'DESC')->first();
            if (isset($transaction)) {
             if($request->floor < $transaction->floor) {
                return back()->with('error', 'Error');
            } 
        }

        $countApartment = Transaction::select('floor')
        ->join('apartments', 'apartments.id', 'transactions.apartment_id')
        ->where('transactions.product_id', $oldProduct->id)->count();
        if($request->apartment < $countApartment ) {
            return back()->with('error', 'Error');
        }

    }
    $data = [
        'block' => $request->block,
        'land' => $request->land,
        'floor' => $request->floor,
        'apartment' => $request->apartment,
        'price' => ($request->unit_price_id == 1) ? 0 : $request->price,
        'area' => $request->area,
        'description' => $request->description ?? '',
        'direction' => $request->direction,
        'cat_id' => $request->cat_id,
        'unit_price_id' => $request->unit_price_id,
    ];

    $images = [];
    if ($files = $request->file('images')) {
        if (count($files) > 3) {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
        if (!empty($files)) {
            foreach(explode("|", $oldProduct->images) as $item) {
                if (!empty($item)) {
                    unlink($item);
                }
            }

            foreach ($files as $file) {
                $path = "images/products/";
                $fileName = str_random('10') . time() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $fileName);
                $imagePath = $path . $fileName;
                $images[] = $imagePath;
            }
            $data['images'] = implode("|", $images);
        }
    }
    if ($oldProduct->update($data)) {
        return redirect()->route('admins.product.list', ['projectId' => $oldProduct->project_id])->with('success', 'Update Success');
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
    $transaction = Transaction::where('product_id', $request->id)
    ->first();
    if(isset($transaction)) {
        echo json_encode('not ok');
    } else {
     $obj = Product::find($request->id)->delete();
     Apartment::where('product_id', $request->id)->delete();
     Transaction::where('product_id', $request->id)->delete();
     echo json_encode('ok');
 }
}

    // apply action
public function actionProduct(Request $request)
{
    $listObj = Product::whereIn('id', $request->selected)->get();
    if (!empty($listObj)) {
        switch ($request->option) {
            case 1:
            foreach ($listObj as $item) {
                $transaction = Transaction::where('product_id', $item->id)
                ->first();
                if($transaction == null) {
                    Transaction::where('product_id', $item->id)->delete();
                    $item->delete();
                }
            }
            break;
        }
        return redirect()->route('admins.product.list', ['projectId' => $request->projectId])->with('success', 'Action Success');
    } else {

    }
}

// status
public function statusProduct($id)
{
    $statuses = Transaction::STATUS;
    $obj = Product::find($id);

    $transactions = Transaction::select('transactions.*')->where('product_id', $id)->get();

    return view('admin.product.status', ['obj' => $obj, 'transactions' => $transactions, 'statuses' => $statuses]);
}

    // searchTransaction
public function searchTransactionProduct(Request $request)
{
    $statuses = Transaction::STATUS;
    $obj = Product::find($request->productId);
    $transaction = Transaction::where('transactions.product_id', $obj->id);
    if ($request->status != -1) {
        $transaction = $transaction->where('transactions.status', $request->status);
    }

    if (isset($request->floor) && $request->floor != -1) {
        $transaction = $transaction->join('apartments', 'apartments.id', 'transactions.apartment_id')->where('apartments.floor', $request->floor);
    }

    $transactions = $transaction->get();
    $search = [
        'status' => $request->status,
        'floor' => $request->floor ?? 0,
    ];

    return view('admin.product.status', ['obj' => $obj, 'transactions' => $transactions, 'statuses' => $statuses, 'search' => $search]);

}

//========================apartment=========================================
//=====apartment====
public function listApartment($productId)
{
    $product = Product::find($productId);
    $list = Apartment::where('product_id', $productId)->orderBy('id')->get();

    $floors = range(1, $product->floor);
    $positions = Apartment::where('product_id', $productId)->pluck('position')->toArray();
    $directions = Apartment::DIRECTION;
    $prices = [
        'Thỏa thuận',
        '< 500 triệu',
        '500 - 800 triệu',
        '800 - 1 tỷ',
        '1 - 5 tỷ',
        '> 5 tỷ'
    ];
    $areas = [
        'Không xác định',
        '<= 30 m2',
        '30-80 m2',
        '80-150 m2',
        '150-300 m2',
        '300-500 m2',
        '> 500 m2',
    ];

    return view('admin.apartment.index', [
        'list' => $list,
        'floors' => $floors,
        'positions' => $positions,
        'product' => $product,
        'prices' => $prices,
        'areas' => $areas,
        'directions' => $directions,
    ]);
}

// searchTransaction
public function searchApartment(Request $request)
{
    $product = Product::find($request->productId);
    $floors = range(1, $product->floor);
    $positions = Apartment::where('product_id', $product->id)->pluck('position')->toArray();
    $apartment = Apartment::where('product_id', $product->id);

    $directions = Apartment::DIRECTION;
    $prices = [
        'Thỏa thuận',
        '< 500 triệu',
        '500 - 800 triệu',
        '800 - 1 tỷ',
        '1 - 5 tỷ',
        '> 5 tỷ'
    ];
    $areas = [
        'Không xác định',
        '<= 30 m2',
        '30-80 m2',
        '80-150 m2',
        '150-300 m2',
        '300-500 m2',
        '> 500 m2',
    ];

    if ($request->area != -1) {
        switch ($request->area) {
            case 0: $apartment = $apartment->where('area', 0);
            break;
            case 1: $apartment = $apartment->where('area', '<=', 30);
            break;
            case 2: $apartment = $apartment->whereBetween('area', [30, 80]);
            break;
            case 3: $apartment = $apartment->whereBetween('area', [80, 150]);
            break;
            case 4: $apartment = $apartment->whereBetween('area', [150, 300]);
            break;
            case 5: $apartment = $apartment->whereBetween('area', [300, 500]);
            break;
            case 6: $apartment = $apartment->where('area', '>', 500);
            break;
        }
    }

    if ($request->price != -1) {
        switch ($request->price) {
            case 0: $apartment = $apartment->where('unit_price_id', 1);
            break;
            case 1: $apartment = $apartment->where('unit_price_id', 2)->where('price', '<', 500);
            break;
            case 2: $apartment = $apartment->where('unit_price_id', 2)->whereBetween('price', [500, 800]);
            break;
            case 3: $apartment = $apartment->where(function ($query) {
                $query->where('unit_price_id', 2)
                ->whereBetween('price', [800, 999]);
            })->orWhere(function ($query) {
                $query->where('unit_price_id', 3)
                ->where('price', 1);
            });
            break;
            case 4: $apartment = $apartment->where('unit_price_id', 3)
            ->whereBetween('price', [1, 5]);
            break;
            case 5: $apartment = $apartment->where('unit_price_id', 3)
            ->where('price', '>', 5);
            break;
        }
    }

    if ($request->direction != -1) {
        $apartment = $apartment->where('direction', $request->direction);
    }

    if ($request->floor != -1) {
        $apartment = $apartment->where('floor', $request->floor);
    }

    if ($request->position != -1) {
        $apartment = $apartment->where('position', 'like', "$request->position");
    }

    $list = $apartment->get();
    $search = [
        'price' => $request->price,
        'direction' => $request->direction,
        'floor' => $request->floor,
        'position' => $request->position,
        'area' => $request->area,
    ];

    return view('admin.apartment.index', [
        'list' => $list,
        'product' => $product,
        'prices' => $prices,
        'areas' => $areas,
        'directions' => $directions,
        'positions' => $positions,
        'floors' => $floors,
        'search' => $search
    ]);
}

    // edit
public function createApartment($productId)
{
    $direction = Apartment::DIRECTION;
    $unitPrice = UnitPrice::where('type_transaction', 1)
    ->pluck('name', 'id')->toArray();
    $product = Product::find($productId);
    $floors = range(1, $product->floor);

    return view('admin.apartment.add', ['direction' => $direction, 'product' => $product, 'unitPrice' => $unitPrice, 'floors' => $floors]);
}
    // store
public function storeApartment(ApartmentCreateRequest $request, $productId)
{
    $data =  $request->all();
    $apartment = Apartment::where('product_id', $productId)
    ->where('floor', $request->floor)
    ->where('position','like', "$request->position")->first();
    if (!$apartment) {
        $data = [
            'product_id' => $productId,
            'floor' => $request->floor,
            'position' => $request->position,
            'price' => ($request->unit_price_id == 1) ? 0 : $request->price,
            'unit_price_id' => $request->unit_price_id,
            'area' => $request->area,
            'description' => $request->description ?? '',
            'direction' => $request->direction,
            'status' => 1,
        ];
        if (Apartment::create($data)) {
            return redirect()->route('admins.apartment.list', ['productId' => $productId])->with('success', 'Add Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    } else {
        return redirect()->back()->withInput()->with('error', 'Apartment is exist');
    }

}

    // edit
public function editApartment($id)
{
    $objTransaction = Transaction::where('apartment_id', $id)
    ->where('transactions.status', '!=', Transaction::STATUS['processing'])->first();
    if ($objTransaction != null) {
        return back()->with('success', 'This apartment is in transaction');
    }
    $direction = Apartment::DIRECTION;
    $unitPrice = UnitPrice::where('type_transaction', 1)
    ->pluck('name', 'id')->toArray();
    $obj = Apartment::find($id);
    $floors = range(1, $obj->product->floor);

    return view('admin.apartment.edit', ['direction' => $direction, 'obj' => $obj, 'unitPrice' => $unitPrice, 'floors' => $floors]);
}

    // update
public function updateApartment(ApartmentCreateRequest $request)
{
    $data =  $request->all();
    $oldApartment = Apartment::find($request->apartmentId);
    $apartment = Apartment::where('product_id', $oldApartment->product_id)
    ->where('floor', $request->floor)
    ->where('position', $request->position)
    ->where('id', '!=', $request->apartmentId)
    ->first();
    if (!$apartment) {
        $data = [
            'floor' => $request->floor,
            'position' => $request->position,
            'price' => ($request->unit_price_id == 1) ? 0 : $request->price,
            'area' => $request->area,
            'description' => $request->description ?? '',
            'direction' => $request->direction,
            'unit_price_id' => $request->unit_price_id,
        ];
        if ($oldProduct->update($data)) {
            return redirect()->route('admins.apartment.list', ['productId' => $oldApartment->product_id])->with('success', 'Update Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    } else {
        return redirect()->back()->withInput()->with('error', 'Apartment is exist');
    }

}

    //delete
public function deleteApartment(Request $request)
{
    $transactions = Transaction::where('apartment_id', $request->id)->first();
    if(isset($transactions)) {
        echo json_encode('not ok');
    } else {
        $obj = Apartment::find($request->id)->delete();
        Transaction::where('apartment_id', $request->id)->delete();
        echo json_encode('ok');
    }
}

    // apply action
public function actionApartment(Request $request)
{
    $listObj = Apartment::whereIn('id', $request->selected)->get();
    if (!empty($listObj)) {
        switch ($request->option) {
            case 1:
            foreach ($listObj as $item) {
                $transactions = Transaction::where('apartment_id', $item->id)->first();
                if(!isset($transactions)) {
                 Transaction::where('apartment_id', $item->id)->delete();
                 $item->delete();
             }

         }
         break;
     }
     return redirect()->route('admins.apartment.list', ['productId' => $request->productId])->with('success', 'Action Success');
 } else {

 }
}

// status
public function statusApartment($id)
{
    $statuses = Transaction::STATUS;
    $obj = Apartment::find($id);

    $transactions = Transaction::select('transactions.*')->where('apartment_id', $id)->get();

    return view('admin.apartment.status', ['obj' => $obj, 'transactions' => $transactions, 'statuses' => $statuses]);
}

    // searchTransaction
public function searchTransactionApartment(Request $request)
{
    $statuses = Transaction::STATUS;
    $obj = Apartment::find($request->apartmentId);
    $transaction = Transaction::where('apartment_id', $obj->id);
    if ($request->status != -1) {
        $transaction = $transaction->where('status', $request->status);
    }

    $transactions = $transaction->get();
    $search = [
        'status' => $request->status,
    ];

    return view('admin.apartment.status', ['obj' => $obj, 'transactions' => $transactions, 'statuses' => $statuses, 'search' => $search]);

}
//======================================================================
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
        return redirect()->route('admins.slider.list')->with('success', 'Add Success');
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
        return redirect()->route('admins.slider.list')->with('success', 'Update Success');
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
        return redirect()->route('admins.slider.list')->with('success', 'Action Success');
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
    $objLogin = getUserLogin();
    if (isAdmin()) {
            //adim get all
        $list = Announcement::select(['announcements.*',\DB::raw('1  as is_read'),\DB::raw('1  as active_edit')])->orderBy('created_at', 'DESC')->get();
    } else {
        $list1 = Announcement::select(['announcements.*',\DB::raw('1  as is_read'),\DB::raw('1  as active_edit')])->Where('causer_id', $objLogin->id)->where('active', 1)->orderBy('created_at', 'DESC')->get();
        $list2  = Announcement::select(['announcements.*', 'is_read',\DB::raw('0  as active_edit')])
        ->join('announcement_recieves', 'announcements.id', 'announcement_recieves.announcement_id')
        ->where('reciever_id', $objLogin->id)->where('active', 1)
        ->orderBy('is_read', 'ASC')->orderBy('created_at', 'DESC')->get();
        $list = $list2->merge($list1);
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
    $loginUser = getUserLogin();
    $data = $request->all();
    $data['created_at'] = Carbon::now();
    $data['causer_id'] = $loginUser->id;

    if ($announcement = Announcement::create($data)) {
        $userId = User::where('role', '!=', User::ROLE['admin'])
        ->where('role', '!=', User::ROLE['customer'])
        ->where('id', '!=', $loginUser->id)
        ->pluck('id')->toArray();
        foreach ($userId as $id) {
            AnnouncementRecieves::create([
                'announcement_id' => $announcement->id,
                'reciever_id' => $id,
                'is_read' => 0
            ]);
        }

        return redirect()->route('admins.announcement.list')->with('success', 'Add success');
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
    $data['created_at'] = Carbon::now();

    if ($oldObj->update($data)) {
        AnnouncementRecieves::where('announcement_id', $oldObj->id)->update(['is_read' => 0]);
        return redirect()->route('admins.announcement.list')->with('success', 'Update success');
    } else {
        return redirect()->back()->withInput()->with('error', 'Fail');
    }
}

    //delete
public function deleteAnnouncement(Request $request)
{
    $objLogin = getUserLogin();
    $obj = Announcement::find($request->id);
    if (isAdmin() || $objLogin->id == $obj->causer_id) {
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
                if (isAdmin() || $objLogin->id == $obj->causer_id) {
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
                if (isAdmin() || $objLogin->id == $item->causer_id) {
                    $item->update(['active' => 1]);
                }
            }
            break;
            case 3:
            foreach ($listObj as $item) {
                if (isAdmin() || $objLogin->id == $item->causer_id) {
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
    $list  = Consult::orderBy('type', 'desc')->orderBy('created_at', 'desc')->get();
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
    $register = Register::create($data);

    if (!empty($consult->sub_product_id)) {
        $transaction = [
            'product_id' => $consult->sub_product_id,
            'transaction_id' => 0,
            'register_id' => $register->id,
            'status' => Transaction::STATUS['processing'],
            'created_at' => Carbon::now(),
            'description' => $consult->message,
        ];
        Transaction::create($transaction);
    }
    $consult->delete();

    return redirect()->route('admins.consult.list')->with('success', 'Save success');
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
    $objUser = session()->get('objUser');

    if (isEmployee()) {
        $employeeId = $objUser->employee->id;
        $list  = Transaction::select(
            [
                'transactions.*',
                \DB::raw("case when assign_task.employee_id = $employeeId then true else false end as isPermit")
            ]
        )
        ->join('registers', 'registers.id', 'transactions.register_id')
        ->join('assign_task', 'assign_task.customer_id', 'registers.customer_id')
        // ->where('assign_task.employee_id', $objUser->employee->id)
        ->get();
    } else {
        $list  = Transaction::select(['transactions.*',\DB::raw("true as isPermit")])->get();
    }
    $status  = Transaction::STATUS;
    $projects = Project::pluck('name', 'id')->toArray();
    $cats = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
    ->pluck('name', 'id')->toArray();
    return view('admin.transaction.index', ['list' => $list, 'status' => $status, 'cats' => $cats, 'projects' => $projects]);
}

    // transaction
public function searchAllTransaction(Request $request)
{
    $transaction = Transaction::select('transactions.*')
    ->join('products', 'products.id', 'transactions.product_id');
    $cats = Category::where('type_transaction', Category::TYPETRANSACTION['sale'])
    ->pluck('name', 'id')->toArray();
    $projects = $blocks = $lands = $floors = [];
    $projects = Project::pluck('name', 'id')->toArray();

    if ($request->project != -1) {
        $transaction = $transaction->where('project_id', $request->project);

        $blocks = array_unique(Product::where('project_id', $request->project)
            ->pluck('block')->toArray());
    }

    if ($request->cat_id != -1) {
        $transaction = $transaction->where('cat_id', $request->cat_id);
    }

    if ($request->block != -1) {
        $transaction = $transaction->where('block', $request->block);


        $lands = Product::where('project_id', $request->project)
        ->where('block', $request->block)
        ->pluck('land')->toArray();
    }

    if ($request->land != -1) {
        $transaction = $transaction->where('land', $request->land);


        $floor = Product::where('project_id', $request->project)
        ->where('block', $request->block)
        ->where('land', $request->land)->first()->floor;
        $floors = ($floor) ? range(1, $floor) : [];

    }

    if ($request->floor != -1) {
        $transaction = $transaction->join('apartments', 'apartments.id', 'transactions.apartment_id')->where('apartments.floor', $request->floor);
    }

    if ($request->status != -1) {
        $transaction = $transaction->where('transactions.status', $request->status);
    }

    $status = Transaction::STATUS;

    if (isEmployee()) {
        $list  = $transaction->join('registers', 'registers.id', 'transactions.register_id')
        ->join('assign_task', 'assign_task.customer_id', 'registers.customer_id')
        ->where('assign_task.employee_id', $objUser->id)
        ->get();
    } else {
        $list = $transaction->get();
    }

    $search = [
        'project' => $request->project,
        'block' => $request->block,
        'floor' => $request->floor,
        'land' => $request->land,
        'status' => $request->status,
        'cat_id' => $request->cat_id,
    ];

    return view('admin.transaction.index', ['list' => $list, 'status' => $status, 'search' => $search, 'floors' => $floors, 'lands' => $lands, 'blocks' => $blocks, 'cats' => $cats, 'projects' => $projects]);

}

// apply action
public function actionAllTransaction(Request $request)
{
    $objUser = getUserLogin();
    $listObj = Transaction::whereIn('id', $request->selected)->get();
    if (!empty($listObj)) {
        switch ($request->option) {
            case 1:
            if (isEmployee()) {
                $transaction->join('registers', 'registers.id', 'transactions.register_id')
                ->join('assign_task', 'assign_task.customer_id', 'registers.customer_id')
                ->where('assign_task.employee_id', $objUser->employee->id)
                ->where('transactions.status', Transaction::STATUS['processing'])
                ->whereIn('id', $request->selected)->delete();
            } else {
                Transaction::whereIn('id', $request->selected)->where('transactions.status', Transaction::STATUS['processing'])->delete();
            }
            
            break;
            case 2:
            foreach ($listObj as $item) {
                if ($item->apartment_id != 0 && $item->apartment_id != -1) {
                    Apartment::find($item->apartment_id)->update(['status' => 0]);
                    $product = Product::find($item->product_id);
                    $apartmentIds =  Apartment::where('product_id', $product->id)
                    ->pluck('id')->toArray();
                    $isRemaing = false;
                    foreach ($apartmentIds as $apartmentId) {
                        $transaction = Transaction::where('product_id', $product->id)
                        ->where('apartment_id', $apartmentId)
                        ->where('status', '!=', Transaction::STATUS['processing'])->first();
                        if ($transaction == null) {
                            $isRemaing = true;
                            break;
                        }
                    }
                    if($isRemaing) {
                        $product->update(['status' => 1]);
                    } else {
                        $product->update(['status' => 0]);
                    }
                } else {
                    $product->update(['status' => 0]);
                }
                $item->update(['status' => Transaction::STATUS['registered']]);
            }
            break;
            case 3:
            foreach ($listObj as $item) {
                if ($item->apartment_id != 0 && $item->apartment_id != -1) {
                    Apartment::find($item->apartment_id)->update(['status' => 0]);
                    $product = Product::find($item->product_id);
                    $apartmentIds =  Apartment::where('product_id', $product->id)
                    ->pluck('id')->toArray();
                    $isRemaing = false;
                    foreach ($apartmentIds as $apartmentId) {
                        $transaction = Transaction::where('product_id', $product->id)
                        ->where('apartment_id', $apartmentId)
                        ->where('status', '!=', Transaction::STATUS['processing'])->first();
                        if ($transaction == null) {
                            $isRemaing = true;
                            break;
                        }
                    }
                    if($isRemaing) {
                        $product->update(['status' => 1]);
                    } else {
                        $product->update(['status' => 0]);
                    }
                } else {
                    $product->update(['status' => 0]);
                }
                $item->update(['status' => Transaction::STATUS['deposit']]);
            }
            break;
            case 4:
            foreach ($listObj as $item) {
                if ($item->apartment_id != 0 && $item->apartment_id != -1) {
                    Apartment::find($item->apartment_id)->update(['status' => 0]);
                    $product = Product::find($item->product_id);
                    $apartmentIds =  Apartment::where('product_id', $product->id)
                    ->pluck('id')->toArray();
                    $isRemaing = false;
                    foreach ($apartmentIds as $apartmentId) {
                        $transaction = Transaction::where('product_id', $product->id)
                        ->where('apartment_id', $apartmentId)
                        ->where('status', '!=', Transaction::STATUS['processing'])->first();
                        if ($transaction == null) {
                            $isRemaing = true;
                            break;
                        }
                    }
                    if($isRemaing) {
                        $product->update(['status' => 1]);
                    } else {
                        $product->update(['status' => 0]);
                    }
                } else {
                    $product->update(['status' => 0]);
                }
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

    if ($request->project == -1 || $request->block == -1 || $request->land == -1 || $request->floor == -1 || $request->position = -1) {
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

    if ($request->floor != -1 && $request->position != -1 && $request->floor != 0 && $request->position != '0') {
        $apartmentId = Apartment::where('product_id', $productId)
        ->where('floor', $request->floor)
        ->where('position', 'like', "$request->position")
        ->first()->id;
    }

        //processing nhuwng neu cung la customer ddo thi k lay nuwa
    $transaction = Transaction::where('product_id', $productId)
    ->where('status', '!=', Transaction::STATUS['processing']);
    if (!empty($apartmentId)) {
        $transaction = $transaction->where('apartment_id', $apartmentId);
    }
    $transaction = $transaction->first();

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
            'apartment_id' => $apartmentId ?? 0,
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

// edit purchase transaction
public function editAllTransaction($transactionId)
{
    $transaction = Transaction::find($transactionId);
    if ($transaction->status != Transaction::STATUS['processing']) {
        return back()->with('success', 'Transaction is not edit');
    }
    $transaction = Transaction::find($transactionId);
    $projectId = $transaction->product->project->id;
    $products = Product::where('project_id', $projectId);
    $blocks = array_unique($products->pluck('block')->toArray());
    $lands = $products->where('block', $transaction->product->block)->pluck('land')->toArray();
    $floors = $transaction->product->floor ?? 0;
    $apartment = 0;
    if (isset($transaction->apartment)) {
        $apartment = Apartment::where('product_id', $transaction->apartment->product_id)
        ->where('floor', $transaction->apartment->floor)->pluck('position')->toArray();
    }
    return view('admin.transaction.edit', ['products' => $products, 'transaction' => $transaction, 'blocks' => $blocks, 'floors' => $floors, 'lands' => $lands, 'apartment' => $apartment]);
}

// detail purchase transaction
public function updateAllTransaction(Request $request)
{
    if ($request->block == -1 || $request->land == -1 || $request->floor == -1) {
        return redirect()->back()->withInput()->with('error', 'Please Choose');
    }
    $productId = Product::where('block', $request->block)
    ->where('land', $request->land)
    ->where('project_id', $request->projectId)->first()->id;

    if ($request->floor != -1 && $request->position != -1 && $request->floor != 0 && $request->position != '0') {
        $apartmentId = Apartment::where('product_id', $productId)
        ->where('floor', $request->floor)
        ->where('position', 'like', "$request->position")
        ->first()->id;
    }

        //processing nhuwng neu cung la customer ddo thi k lay nuwa
    $transaction1 = Transaction::where('id', '!=', $request->transactionId)
    ->where('product_id', $productId)
    ->where('status', '!=', Transaction::STATUS['processing']);
    if (!empty($apartmentId)) {
        $transaction1 = $transaction1->where('apartment_id', $apartmentId);
    }
    $transaction1 = $transaction1->first();

    $transaction2 = Transaction::where('id', '!=', $request->transactionId)
    ->where('product_id', $productId)
    ->where('status', Transaction::STATUS['processing'])
    ->where('register_id', $request->registerId);
    if (!empty($apartmentId)) {
        $transaction2 = $transaction2->where('apartment_id', $apartmentId);
    }
    $transaction2 = $transaction2->first();

    if($transaction1 || $transaction2) {
        return redirect()->back()->withInput()->with('error', 'Transaction is exist');
    } else {
        $transaction = Transaction::find($request->transactionId);

        $data = [
            'product_id' => $productId,
            'floor' => $request->floor,
            'apartment_id' => $apartmentId ?? 0,
            'description' => $request->description ?? '',
            'created_at' => Carbon::now(),
            'rating' => 0
        ];

        if ($transaction->update($data)) {
            return redirect()->route('admins.transaction.listAll')->with('success', 'Update Success');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fail');
        }
    }
}
    // ==========consult management=============
    // consult
public function listReport()
{
    $projects = Project::pluck('name', 'id')->toArray();
    $report = [];
    foreach ($projects as $id => $name) {
        $report[$id] = Transaction::select([
            \DB::raw('count(transactions.id) as total'),
            \DB::raw('count(case when transactions.status = 0 then 1 else NULL end) as sum_processing'),
            \DB::raw('count(case when transactions.status = 1 then 1 else NULL end) as sum_registered'),
            \DB::raw('count(case when transactions.status = 2 then 1 else NULL end) as sum_deposit'),
            \DB::raw('count(case when transactions.status = 3 then 1 else NULL end) as sum_payment'),
        ])->join('registers', 'registers.id', 'transactions.register_id')
        ->where('registers.project_id', $id)->first();
    }

    return view('admin.report.index', ['projects' => $projects, 'report' => $report]);
}

    // consult
public function searchReport(Request $request)
{
    $data = $request->all();
    $projects = Project::pluck('name', 'id')->toArray();
    $report = [];
    foreach ($projects as $id => $name) {
        $query = Transaction::select([
            \DB::raw('count(transactions.id) as total'),
            \DB::raw('count(case when transactions.status = 0 then 1 else NULL end) as sum_processing'),
            \DB::raw('count(case when transactions.status = 1 then 1 else NULL end) as sum_registered'),
            \DB::raw('count(case when transactions.status = 2 then 1 else NULL end) as sum_deposit'),
            \DB::raw('count(case when transactions.status = 3 then 1 else NULL end) as sum_payment'),
        ])->join('registers', 'registers.id', 'transactions.register_id')
        ->where('registers.project_id', $id);
        if ($data['date_from'] != '') {
            $query = $query->where('transactions.created_at', '>=', $data['date_from']);
        }
        if ($data['date_to'] != '') {
            $query = $query->where('transactions.created_at', '<=', $data['date_to']);
        }
        $report[$id] = $query->first();
    }

    return view('admin.report.index', ['projects' => $projects, 'report' => $report]);
}
}