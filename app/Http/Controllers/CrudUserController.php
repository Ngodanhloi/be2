<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CrudUserController extends Controller
{
    public function index()
    {
        $users = User ::paginate(3);
        return view('admin.crudUser.listUser', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:user,admin' // validate giá trị hợp lệ
        ]);
    
        $user = new User;
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role; // Lấy role từ form
        $user->save();
    
    


        return redirect()->route('admin.listUser.index')->with('success', 'Người dùng mới đã được thêm thành công.');

    }
    public function delete($id)
    {
        User::destroy($id);

        return redirect()->route('admin.listUser.index')->with('success', 'Tài khoản đã được xóa thành công.');
    }
    public function update(Request $request, $user_id)
    {
        $users = User::find($user_id);

        // Validate the input data
        $validatedData = $request->validate([
            'ten' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $user_id . ',user_id',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,user', // Chỉ chấp nhận giá trị admin hoặc user
        ]);

        // Update the user data
        $users->name = $validatedData['ten'];
        $users->email = $validatedData['email'];
        $users->password = Hash::make($validatedData['password']);
        $users->role = $validatedData['role']; // Cập nhật quyền
        $users->save();

        return redirect()->route('admin.listUser.index')->with('success', 'Tài khoản đã được cập nhật thành công!');
    } 
}