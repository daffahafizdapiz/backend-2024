<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalsController extends Controller
{
    
    private $animals;

    public function __construct() {
        $this->animals = ['Monyet', 'Kuda'];
    }

    // GET: Menampilkan seluruh data animals
    public function index() {
        foreach ($this->animals as $animal) {
            echo $animal . "<br>";
        }
    }

    // POST: Menambahkan hewan baru
    public function store(Request $request)
    {
        $this->animals[] = $request->input('name');

        return response()->json($this->animals);
    }
    

    // PUT: Mengupdate data hewan berdasarkan ID
    public function update($index, $animal) {
        if (isset($this->animals[$index])) { // Mengecek jika index ada menggunakan isset
            $this->animals[$index] = $animal;
            echo "Hewan di index $index berhasil diupdate jadi '$animal'.<br>";
        } else {
            echo "Index tidak ditemukan.<br>";
        }
    }

    // DELETE: Menghapus data hewan berdasarkan ID
    public function destroy($index) {
        if (isset($this->animals[$index])) { // Mengecek jika index ada menggunakan isset
            unset($this->animals[$index]);
            echo "Hewan di index $index berhasil dihapus.<br>";
        } else {
            echo "Index tidak ditemukan.<br>";
        }
    }
}    
