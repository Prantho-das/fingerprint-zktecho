<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FingerPrintMachineService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select(['id', 'name', 'email', 'role', 'is_active', 'phone', 'created_at'])
            ->paginate(10);

        return view('users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'uid' => 'nullable|integer|unique:users,uid|between:11111,65535', // Correct range rule
            'name' => 'required|string|max:24',
            'password' => 'required|string|min:8',
            'cardno' => 'nullable|unique:users,cardno|string|max:10',
            'phone' => 'nullable|unique:users,phone|string|max:15',
            'email' => 'required|email|unique:users,email',
            'address' => 'nullable|string|max:100',
            'thana' => 'nullable|string|max:50',
            'district' => 'nullable|string|max:50',
            'is_finger_print_added' => 'nullable',
            'is_face_added' => 'nullable',

        ]);

// Create the user in the database
        $user = User::create([
            'uid' => $validated['uid'] ?? rand(11111, 65535),
            'name' => $validated['name'],
            'password' => bcrypt($validated['password']),
            'cardno' => $validated['cardno'] ?? 0,
            'phone' => $validated['phone'] ?? 0,
            'email' => $validated['email'],
            'address' => $validated['address'] ?? '',
            'thana' => $validated['thana'] ?? '',
            'district' => $validated['district'] ?? '',
            'is_active' => '1',
            'is_finger_print_added' => isset($validated['is_finger_print_added']) && $validated['is_finger_print_added'] == 'on' ? 1 : 0,
            'is_face_added' => isset($validated['is_face_added']) && $validated['is_face_added'] == 'on' ? 1 : 0,
            'is_card_added' => $validated['cardno'] ? 1 : 0,
        ]);
// add user to fingerprint machine
        FingerPrintMachineService::createUser($user);
        if ($user) {
            return redirect()->route('employee.index')->with('success', 'User created successfully');
        }
        return redirect()->route('employee.index')->with('error', 'User creation failed');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if ($user) {
            return view('users.edit', compact('user'));
        }

        return redirect()->route('employee.index')->with('error', 'User not found');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'uid' => 'nullable|integer|unique:users,uid,' . $id . '|between:11111,65535', // Exclude current user ID
            'name' => 'required|string|max:24',
            'password' => 'nullable|string|min:8',
            'cardno' => 'nullable|unique:users,cardno,' . $id . '|string|max:10',
            'phone' => 'nullable|unique:users,phone,' . $id . '|string|max:15',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'nullable|string|max:100',
            'thana' => 'nullable|string|max:50',
            'district' => 'nullable|string|max:50',
            'is_finger_print_added' => 'nullable',
            'is_face_added' => 'nullable',
        ]);

        $user = User::find($id);

        if ($user) {
            $user->update([
                'uid' => $validated['uid'] ?? $user->uid,
                'name' => $validated['name'],
                'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
                'cardno' => $validated['cardno'] ?? $user->cardno,
                'phone' => $validated['phone'] ?? $user->phone,
                'email' => $validated['email'],
                'address' => $validated['address'] ?? $user->address,
                'thana' => $validated['thana'] ?? $user->thana,
                'district' => $validated['district'] ?? $user->district,
                'is_finger_print_added' => isset($validated['is_finger_print_added']) && $validated['is_finger_print_added'] == 'on' ? 1 : 0,
                'is_face_added' => isset($validated['is_face_added']) && $validated['is_face_added'] == 'on' ? 1 : 0,
                'is_card_added' => $validated['cardno'] ? 1 : 0,
            ]);

            return redirect()->route('employee.index')->with('success', 'User updated successfully');
        }

        return redirect()->route('employee.index')->with('error', 'User update failed');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('employee.index')->with('success', 'User deleted successfully');
        }

        return redirect()->route('employee.index')->with('error', 'User deletion failed');

    }
}
