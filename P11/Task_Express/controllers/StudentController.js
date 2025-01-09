// TODO 3: Import data students dari folder data/students.js
const students = require("../data/students");

// membuat Class StudentController
class StudentController {
    index(req, res) {
      // TODO 4: Tampilkan data students
      const responseData = {
        message: "Menampilkan seluruh data students",
        data: students
      };

      res.json(responseData);
    }

    store(req, res) {
        const { nama } = req.body;
    
        // Pastikan nama selalu berupa array, jika tidak jadikan array
        const studentNames = Array.isArray(nama) ? nama : [nama];
        students.push(...studentNames); // Gabungkan data nama baru ke array students

        const response = {
            message: `Berhasil menambahkan student: ${studentNames.join(", ")}`,
            data: students
        };

        res.json(response);
    }

    update(req, res) {
        // TODO 6: Update data students
        const { id } = req.params;
        const { nama } = req.body;
        
        const index = id - 1; // Penyesuaian indeks

        if (index >= 0 && index < students.length) {
            const previousName = students[index];
            students[index] = nama; // Perbarui data student

            const updatedData = {
                message: `Berhasil update student dengan ID ${id}: ${previousName} menjadi ${nama}`,
                data: students
            };

            res.json(updatedData);
        } else {
            res.status(404).json({ message: "Student dengan ID tersebut tidak ditemukan" });
        }
    }

    destroy(req, res) {
        // TODO 7: Hapus data students
        const { id } = req.params;

        const index = id - 1; // Penyesuaian indeks

        if (index >= 0 && index < students.length) {
            const deletedStudent = students.splice(index, 1); // Hapus berdasarkan ID

            const deleteResponse = {
                message: `Student dengan ID ${id} telah dihapus: ${deletedStudent}`,
                data: students
            };

            res.json(deleteResponse);
        } else {
            res.status(404).json({ message: "Student dengan ID tersebut tidak ditemukan" });
        }
    }
}

// membuat objek StudentController
const studentController = new StudentController();

// meng-export objek StudentController
module.exports = studentController;
