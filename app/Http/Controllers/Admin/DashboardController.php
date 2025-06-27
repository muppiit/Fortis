<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Role;
use App\Models\TeamDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    //user
    public function index()
    {
        $user = Auth::user();
        $level = $user->role->level;

        $users = [];

        if ($level === 'super_super_admin') {
            $users = User::with('role', 'teamDepartment.department')->get();
        } elseif ($level === 'super_admin') {
            $users = User::with('role', 'teamDepartment.department')
                ->whereHas('teamDepartment', function ($query) use ($user) {
                    $query->where('department_id', $user->teamDepartment->department_id);
                })
                ->get();
        } elseif ($level === 'admin') {
            $users = User::with('role', 'teamDepartment.department')
                ->where('team_department_id', $user->team_department_id)
                ->get();
        }

        return view('admin.dashboard', compact('users', 'user'));
    }

    public function createUser()
    {
        $roles = Role::all();
        $departments = Department::with('teamDepartments')->get();
        $teamDepartments = TeamDepartment::with('department')->get();
        return view('admin.user.create', compact('roles', 'departments', 'teamDepartments'));
    }


    public function storeUser(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|unique:users,nip',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'team_department_id' => 'required|exists:team_departments,id',
        ]);

        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'team_department_id' => $request->team_department_id,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil ditambahkan.');
    }

    public function editUser($nip)
    {
        $user = User::where('nip', $nip)->firstOrFail();
        $roles = Role::all();
        $departments = Department::with('teamDepartments')->get();
        $teamDepartments = TeamDepartment::with('department')->get();
        return view('admin.user.edit', compact('user', 'roles', 'departments', 'teamDepartments'));
    }

    public function updateUser(Request $request, $nip)
    {
        $user = User::where('nip', $nip)->firstOrFail();

        // Validasi dinamis hanya untuk field yang dikirim
        $rules = [
            'email' => ['email', Rule::unique('users')->ignore($user->nip, 'nip')],
            'password' => 'nullable|min:6|confirmed',
            'role_id' => 'exists:roles,id',
            'team_department_id' => 'exists:team_departments,id',
        ];

        if ($request->has('name')) {
            $rules['name'] = 'string';
        }

        if ($request->has('department_id')) {
            $rules['department_id'] = 'exists:departments,id';
        }

        $validated = $request->validate($rules);

        // Update hanya field yang dikirim
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('role_id')) {
            $user->role_id = $request->role_id;
        }

        if ($request->has('team_department_id')) {
            $user->team_department_id = $request->team_department_id;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Validasi kecocokan departemen dan team hanya jika super_super_admin
        if (
            auth()->user()->role->level === 'super_super_admin' &&
            $request->has('department_id') &&
            $request->has('team_department_id')
        ) {
            $team = TeamDepartment::find($request->team_department_id);
            if (!$team || $team->department_id != $request->department_id) {
                return back()->withErrors(['team_department_id' => 'Team tidak cocok dengan departemen terpilih.']);
            }
        }

        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser($nip)
    {
        $user = User::where('nip', $nip)->firstOrFail();
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil dihapus.');
    }

    // Roles 
    public function listRoles()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function createRole()
    {
        return view('admin.roles.create');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:super_super_admin,super_admin,admin,user',
        ]);

        Role::create($request->only('name', 'level'));

        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil dibuat.');
    }

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:super_super_admin,super_admin,admin,user',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->only('name', 'level'));

        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role berhasil dihapus.');
    }


    // Departments 
    public function departmentsIndex()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    public function departmentsCreate()
    {
        return view('admin.departments.create');
    }

    public function departmentsStore(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:255',
            'manager_department' => 'required|string|max:255',
        ]);

        Department::create($request->only(['department', 'manager_department']));

        return redirect()->route('admin.departments.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function departmentsEdit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }

    public function departmentsUpdate(Request $request, $id)
    {
        $request->validate([
            'department' => 'required|string|max:255',
            'manager_department' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->only(['department', 'manager_department']));

        return redirect()->route('admin.departments.index')->with('success', 'Departemen berhasil diperbarui.');
    }

    public function departmentsDestroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('admin.departments.index')->with('success', 'Departemen berhasil dihapus.');
    }


    //team department
    public function teamDepartmentsIndex()
    {
        $user = Auth::user();
        $roles = Role::all();

        if ($user->role->level === 'super_super_admin') {
            $teamDepartments = TeamDepartment::with('department')->get();
        } elseif ($user->role->level === 'super_admin') {
            $teamDepartments = TeamDepartment::with('department')
                ->where('department_id', $user->teamDepartment->department_id)
                ->get();
        } else {
            $teamDepartments = collect(); // kosong untuk admin/user
        }

        return view('admin.team_departement.index', compact('teamDepartments', 'roles', 'user'));
    }


    public function teamDepartmentsCreate()
    {
        $departments = Department::all();
        return view('admin.team_departement.create', compact('departments'));
    }

    public function teamDepartmentsStore(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
        ]);

        TeamDepartment::create([
            'department_id' => $request->department_id,
            'name' => $request->name,
        ]);

        return redirect()->route('admin.team_departments.index')->with('success', 'Team departemen berhasil ditambahkan.');
    }

    public function teamDepartmentsEdit($id)
    {
        $teamDepartment = TeamDepartment::findOrFail($id);
        $departments = Department::all();
        return view('admin.team_departement.edit', compact('teamDepartment', 'departments'));
    }

    public function teamDepartmentsUpdate(Request $request, $id)
    {
        $teamDepartment = TeamDepartment::findOrFail($id);

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
        ]);

        $teamDepartment->department_id = $request->department_id;
        $teamDepartment->name = $request->name;
        $teamDepartment->save();

        return redirect()->route('admin.team_departments.index')->with('success', 'Team departemen berhasil diperbarui.');
    }

    public function teamDepartmentsDestroy($id)
    {
        $teamDepartment = TeamDepartment::findOrFail($id);
        $teamDepartment->delete();

        return redirect()->route('admin.team_departments.index')->with('success', 'Team departemen berhasil dihapus.');
    }
}
