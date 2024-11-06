<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // GET /students - Menampilkan semua data mahasiswa
    public function index(){
        $students = Student::all();

        if ($students->isEmpty()) {
            return response()->json([
                'message' => 'Data mahasiswa tidak ditemukan',
                'data' => []
            ], 404);
        }

        return response()->json([
            'message' => 'Berhasil akses data',
            'data' => $students
        ], 200);
    }

    // POST /students - Menambahkan data mahasiswa
    public function store(Request $request) {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string|unique:students,nim',
            'email' => 'required|email|unique:students,email',
            'jurusan' => 'required|string'
        ]);

        $student = Student::create($validatedData);

        return response()->json([
            'message' => 'Data berhasil ditambah',
            'data' => $student
        ], 201);
    }

    // PUT /students/{id} - Memperbarui data mahasiswa
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

    // DELETE /students/{id} - Menghapus data mahasiswa
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

    // GET /students/{id} - Menampilkan detail data mahasiswa
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
