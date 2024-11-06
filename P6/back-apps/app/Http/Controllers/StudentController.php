<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // GET - Menampilkan semua data mahasiswa
    public function index(){
        $student = Student::all();

        if ($student->isEmpty()) {
            return response()->json([
                'message' => 'Student data not found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Successfully accessed data',
            'data' => $student
        ], 200);
    }

    // POST - Menambahkan data mahasiswa
    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string|unique:students,nim',
            'email' => 'required|email|unique:students,email',
            'jurusan' => 'required|string'
        ]);

        $student = Student::create($validatedData);

        return response()->json([
            'message' => 'Data successfully added',
            'data' => $student
        ], 201);
    }

    // PUT - Memperbarui data mahasiswa
    public function update(Request $request, $id) {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                "message" => 'Student not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'nama' => 'sometimes|required|string',
            'nim' => 'sometimes|required|string|unique:students,nim,' . $student->id,
            'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
            'jurusan' => 'sometimes|required|string',
        ]);

        $student->update($validatedData);

        return response()->json([
            'message' => 'Student is updated',
            'data' => $student
        ], 200);
    }

    // DELETE - Menghapus data mahasiswa
    public function destroy($id) {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                "message" => 'Student not found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student is deleted'
        ], 200);
    }

    // GET (Show) - Menampilkan detail data mahasiswa
    public function show($id) {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Get detail student',
            'data' => $student
        ], 200);
    }
}
