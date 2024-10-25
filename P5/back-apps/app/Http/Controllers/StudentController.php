<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;


class StudentController extends Controller
{
    //
    public function index(){
        //melihat data
        //query builder student = DB::table('student')->get();
        $student = Student::all(); //menggunakan eloquent
        $data = [
            'message' => 'Berhasil akses data',
            'data' => $student
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request){
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];

        $student = Student::create($input);
    $data = [
        'massage' => 'Data berhasil ditambah',
        'data' => $student
    ];
    return response()->json($data, 201);
    }

    public function update(Request $request, $id){
    $student = Student::find($id);

    if ($student) {
        $student->update($request->all());
        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $student
        ], 200);
    }

    return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    public function destroy($id){
    $student = Student::find($id);

    if ($student) {
        $student->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

    return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    


    
}
