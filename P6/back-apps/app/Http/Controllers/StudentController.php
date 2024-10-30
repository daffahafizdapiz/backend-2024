<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;


class StudentController extends Controller
{
    // GET
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
    // POST
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

    // PUT
    public function update(Request $request, $id){
    //Mencari Student id
        $student = Student::find($id);

        if ($student) {
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan,    
            ];

            $student->update($input);

            $data = [
                'message' => 'Student is update',
                'data' => $student
            ];

            return response()->json($data,200);
        }
        else {
            $data = [
                "message" => 'Student not found'
            ];
        
            return response()->json($data,404);
        }
    
     }
     // DELETE
    public function destroy($id){

        $student = Student::find($id);

        if ($student) {
            $student->delete();
        
            $data = [
                'message' => 'Student is Delete '
            ];
            return response()->json($data,200);
        }
        else {
            $data = [
                "message" => 'Student not found'
            ];
        
            return response()->json($data,404);
        }
    
    }
     //Show
    public function show($id){

        $student = Student::find($id);

        if($student){
            $data = [
                'message' => 'Get detail student',
                'data' => $student,
            ];

            return response()->json($data,200);
        }
        else {
            $data =[
                'message' => 'Student not found'
            ];
            return response()->json($data,404);
        }
    }
    
}
