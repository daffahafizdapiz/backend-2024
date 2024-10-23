<?php

class Animal {
    // Properti untuk menyimpan daftar hewan
    public $animals;

    // Constructor untuk mengisi data awal
    public function __construct() {
        $this->animals = ['Monyet', 'Kuda'];
    }

    // Method untuk menampilkan semua hewan
    public function index() {
        foreach ($this->animals as $animal) {
            echo $animal . "<br>";
        }
    }

    // Method untuk menambahkan hewan baru
    public function store($animal) {
        $this->animals[] = $animal; // Cara sederhana untuk menambah elemen ke array
        echo "Hewan '$animal' berhasil ditambahkan.<br>";
    }

    // Method untuk update hewan di posisi tertentu
    public function update($index, $animal) {
        if (isset($this->animals[$index])) { // Mengecek jika index ada menggunakan isset
            $this->animals[$index] = $animal;
            echo "Hewan di index $index berhasil diupdate jadi '$animal'.<br>";
        } else {
            echo "Index tidak ditemukan.<br>";
        }
    }

    // Method untuk menghapus hewan di posisi tertentu
    public function destroy($index) {
        if (isset($this->animals[$index])) { // Mengecek jika index ada menggunakan isset
            unset($this->animals[$index]);
            echo "Hewan di index $index berhasil dihapus.<br>";
        } else {
            echo "Index tidak ditemukan.<br>";
        }
    }
}

// Membuat object dari class Animal
$animal = new Animal();

// Menampilkan semua hewan
echo 'Index - Menampilkan semua hewan<br>';
$animal->index();
echo '<br>';

// Menambahkan hewan baru
echo 'Store - Menambahkan hewan baru (Gorila)<br>';
$animal->store('Gorila');
$animal->index();
echo '<br>';

// Update hewan di index ke-0
echo 'Update - Mengubah hewan<br>';
$animal->update(0, 'Buaya');
$animal->index();
echo '<br>';

// Hapus hewan di index ke-1
echo 'Destroy - Menghapus hewan<br>';
$animal->destroy(1);
$animal->index();
echo '<br>';

?>
