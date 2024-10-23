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

    
}
