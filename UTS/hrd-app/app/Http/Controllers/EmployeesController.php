<?php

namespace App\Http\Controllers;
use App\Models\Employees;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::all();

        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'Data is empty'
            ], 200);
        }

        return response()->json([
            'message' => 'Get All Resource',
            'data' => $employees
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'status' => 'required|in:active,inactive,terminated',
            'hired_on' => 'required|date',
        ]);
    
        // Jika validasi gagal, kembalikan respon dengan error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        // Menyimpan data pegawai baru
        $employee = Employees::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'status' => $request->status,
            'hired_on' => $request->hired_on,
        ]);

        // Mengembalikan response jika berhasil ditambahkan
        return response()->json([
            'message' => 'Resource is added successfully',
            'data' => $employee
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mencari employee berdasarkan ID
        $employee = Employees::find($id);

        // Cek jika data pegawai ditemukan
        if (!$employee) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }

        // Mengembalikan data employee jika ditemukan
        return response()->json([
            'message' => 'Get Detail Resource',
            'data' => $employee
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Mencari employee berdasarkan ID
        $employee = Employees::find($id);

        // Cek jika data pegawai ditemukan
        if (!$employee) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }

        // Validasi data yang diterima, hanya validasi yang diberikan
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'gender' => 'sometimes|in:male,female',
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string',
            'email' => 'sometimes|email|unique:employees,email,' . $id,
            'status' => 'sometimes|in:active,inactive,terminated',
            'hired_on' => 'sometimes|date',
        ]);

        // Jika validasi gagal, kembalikan respon dengan error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        // Mengupdate data employee dengan data baru
        $employee->update($request->only([
            'name', 'gender', 'phone', 'address', 'email', 'status', 'hired_on'
        ]));

        // Mengembalikan response setelah update berhasil
        return response()->json([
            'message' => 'Resource is updated successfully',
            'data' => $employee
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari employee berdasarkan ID
        $employee = Employees::find($id);

        // Cek jika data pegawai ditemukan
        if (!$employee) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }

        // Menghapus data employee
        $employee->delete();

        // Mengembalikan response setelah resource berhasil dihapus
        return response()->json([
            'message' => 'Resource is deleted successfully'
        ], 200);
    }

    /**
     * Search the resource by name.
     */
    public function search($name)
    {
        // Mencari employee berdasarkan nama
        $employees = Employees::where('name', 'like', '%' . $name . '%')->get();

        // Cek jika ada resource yang ditemukan
        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'Resource not found'
            ], 404);
        }

        // Mengembalikan response dengan data yang ditemukan
        return response()->json([
            'message' => 'Get searched resource',
            'data' => $employees
        ], 200);
    }

    /**
     * Get all active employees.
     */
    public function getActive()
    {
        // Mencari employee yang aktif
        $employees = Employees::where('status', 'active')->get();

        // Cek jika ada resource yang ditemukan
        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'Get active resource',
                'total' => 0,
                'data' => []
            ], 200);
        }

        // Mengembalikan response dengan data yang ditemukan
        return response()->json([
            'message' => 'Get active resource',
            'total' => $employees->count(),
            'data' => $employees
        ], 200);
    }

    /**
     * Get all inactive employees.
     */
    public function getInactive()
    {
        // Mencari employee yang tidak aktif
        $employees = Employees::where('status', 'inactive')->get();

        // Cek jika ada resource yang ditemukan
        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'Get inactive resource',
                'total' => 0,
                'data' => []
            ], 200);
        }

        // Mengembalikan response dengan data yang ditemukan
        return response()->json([
            'message' => 'Get inactive resource',
            'total' => $employees->count(),
            'data' => $employees
        ], 200);
    }

    /**
     * Get all terminated employees.
     */
    public function getTerminated()
    {
        // Mencari employee yang dihentikan
        $employees = Employees::where('status', 'terminated')->get();

        // Cek jika ada resource yang ditemukan
        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'Get terminated resource',
                'total' => 0,
                'data' => []
            ], 200);
        }

        // Mengembalikan response dengan data yang ditemukan
        return response()->json([
            'message' => 'Get terminated resource',
            'total' => $employees->count(),
            'data' => $employees
        ], 200);
    }
}
