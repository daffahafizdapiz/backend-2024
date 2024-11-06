<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use illuminate\Support\Facades\Validator;


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
        $validator = Validator::make($request->all(), [
            'nama'=> 'required',
            'nim'=> 'numeric|required',
            'email'=> 'email|required',
            'jurusan'=> 'required'
        ]);

        if($validator->fails()){
            return respons()->json([
                'message'=>'Validation errors',
                'error'=>$validator->errors()
            ], 422);
        }

        $student = Student::create($request->all());
        $data = [
            'message'=> 'Student is created successfully',
            'data'=> $student,
        ];

        return response()->json($data, 201);
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
