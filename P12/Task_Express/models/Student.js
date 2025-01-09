const db = require('../config/database');

class Student {
    // Helper untuk mengeksekusi query
    static executeQuery(sql, params) {
        return new Promise((resolve, reject) => {
            db.query(sql, params, (err, result) => {
                if (err) {
                    reject(err); // Menangani error jika ada
                } else {
                    resolve(result); // Mengembalikan hasil query
                }
            });
        });
    }

    // Menampilkan semua student
    static all() {
        return this.executeQuery('SELECT * FROM students', []);
    }

    // Membuat student baru
    static async create(data) {
        try {
            // Melakukan insert data ke database
            const { insertId } = await this.executeQuery('INSERT INTO students SET ?', data);
            
            // Mengambil data student setelah insert berhasil
            const [student] = await this.executeQuery('SELECT * FROM students WHERE id = ?', [insertId]);
            return student; // Mengembalikan data student yang baru ditambahkan
        } catch (error) {
            throw new Error('Gagal menambahkan student: ' + error.message);
        }
    }

    // Menemukan student berdasarkan id
    static find(id) {
        return this.executeQuery('SELECT * FROM students WHERE id = ?', [id]);
    }

    // Memperbarui data student berdasarkan id
    static async update(id, data) {
        try {
            // Melakukan update data berdasarkan id
            await this.executeQuery('UPDATE students SET ? WHERE id = ?', [data, id]);
            return { message: `Student dengan id ${id} berhasil diperbarui` };
        } catch (error) {
            throw new Error('Gagal memperbarui data student: ' + error.message);
        }
    }

    // Menghapus student berdasarkan id
    static delete(id) {
        return this.executeQuery('DELETE FROM students WHERE id = ?', [id]);
    }
}

module.exports = Student;
