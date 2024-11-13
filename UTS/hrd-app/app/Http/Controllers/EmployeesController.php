<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    // GET - Menampilkan semua data pegawai
    public function index()
    {
        $employees = Employees::all();

        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'Employees data not found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully accessed data',
            'data' => $employees
        ], 200);
    }

    // POST - Menambahkan data pegawai
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:m,f',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'status' => 'required|in:active,inactive,terminated',
            'hired_on' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'error' => $validator->errors()
            ], 204);
        }

        $input = $validator->validated();
        $employees = Employees::create($input);

        return response()->json([
            'message' => 'Employees is created successfully',
            'data' => $employees,
        ], 201);
    }

    // PUT - Memperbarui data pegawai
    public function update(Request $request, $id)
    {
        $employees = Employees::find($id);

        if (!$employees) {
            return response()->json([
                'message' => 'Employees not found'
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'gender' => 'sometimes|required|in:m,f',
            'phone' => 'sometimes|required|string|max:20',
            'address' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:employees,email,' . $id,
            'status' => 'sometimes|required|in:active,inactive,terminated',
            'hired_on' => 'sometimes|required|date',
        ]);

        $employees->update($request->all());

        return response()->json([
            'message' => 'Employees is updated successfully',
            'data' => $employees
        ], 200);
    }

    // DELETE - Menghapus data pegawai
    public function destroy($id)
    {
        $employees = Employees::find($id);

        if (!$employees) {
            return response()->json([
                'message' => 'Employees not found'
            ], 404);
        }

        $employees->delete();

        return response()->json([
            'message' => 'Employees is deleted successfully'
        ], 200);
    }

    // GET (Show) - Menampilkan detail data pegawai
    public function show($id)
    {
        $employees = Employees::find($id);

        if (!$employees) {
            return response()->json([
                'message' => 'Employees not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Get employees details',
            'data' => $employees
        ], 200);
    }

    // GET - Menampilkan pegawai dengan status aktif
    public function getActive() {
        $employees = Employees::where('status', 'active')->get();

        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'No active employees found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully retrieved active employees',
            'data' => $employees
        ], 200);
    }

    // GET - Menampilkan pegawai dengan status non-aktif
    public function getInactive(){
        $employees = Employees::where('status', 'inactive')->get();

        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'No inactive employees found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully retrieved inactive employees',
            'data' => $employees
        ], 200);
    }

    // GET - Menampilkan pegawai dengan status terminated
    public function getTerminated() {
        $employees = Employees::where('status', 'terminated')->get();

        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'No terminated employees found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully retrieved terminated employees',
            'data' => $employees
        ], 200);
    }

    // GET - Mencari pegawai berdasarkan nama
    public function search($name) {
        $employees = Employees::where('name', 'like', "%{$name}%")->get();

        if ($employees->isEmpty()) {
            return response()->json([
                'message' => 'No employees found with that name',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully retrieved employees by name',
            'data' => $employees
        ], 200);
    }

}
