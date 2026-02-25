<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('users/index', [
            'users' => User::orderBy('id', 'desc')->paginate(10),
            'stats' => [
                ['label' => 'Total Users', 'value' => User::count()],
                ['label' => 'Administrators', 'value' => User::where('role_name', 'admin')->count()],
                ['label' => 'Customers', 'value' => User::where('role_name', 'user')->count()],
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
}