const { json } = require('express');
const students = require('../data/students');

class StudentController {
  // Menampilkan data students
  index(req, res) {
    const data = {
      message: 'Menampilkan semua students',
      data: students,
    };
    res.json(data);
  }

  // Menambahkan data students
  store(req, res) {
    const { name } = req.body;
    students.push(name);
    const data = {
      message: `Menambahkan student baru: ${name}`,
      data: students,
    };
    res.json(data);
  }

  // Mengupdate data students
  update(req, res) {
    const { id } = req.params;
    const { name } = req.body;
    students[`${id}`] = `${name}`;
    const data = {
      message: `Mengubah student dengan id: ${id}`,
      data: students,
    };
    res.json(data);
  }

  // Menghapus data students
  destroy(req, res) {
    const { id } = req.params;
    students.splice(id, 1);
    const data = {
      message: `Menghapus student dengan id: ${id}`,
      data: students,
    };
    res.json(data);
  }
}

// Membuat objek dari StudentController
const object = new StudentController();

// Mengekspor objek menggunakan module.exports
module.exports = object;
