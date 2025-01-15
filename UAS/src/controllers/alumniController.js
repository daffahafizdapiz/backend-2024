const db = require('../config/database'); // Mengimpor koneksi database

class AlumniController {
  // Mendapatkan semua alumni ( GET )
  static async index(req, res) {
    try {
      db.query('SELECT * FROM alumni', (err, results) => {
        if (err) {
          console.error(err);
          return res.status(500).json({ message: 'Failed to fetch alumni', error: err });
        }
        return res.status(200).json({ message: 'Fetched all alumni', data: results });
      });
    } catch (err) {
      console.error(err);
      return res.status(500).json({ message: 'Server error', error: err });
    }
  }

  // Menambahkan alumni baru ( POST )
  static async store(req, res) {
    const { name, phone, address, graduation_year, status, company_name, position } = req.body;

    // Validasi input
    if (!name || !phone || !address || !graduation_year || !status) {
      return res.status(422).json({ message: 'All fields must be filled correctly' });
    }

    try {
      const query = 'INSERT INTO alumni (name, phone, address, graduation_year, status, company_name, position) VALUES (?, ?, ?, ?, ?, ?, ?)';
      const values = [name, phone, address, graduation_year, status, company_name, position];

      db.query(query, values, (err, results) => {
        if (err) {
          console.error(err);
          return res.status(500).json({ message: 'Failed to add alumni', error: err });
        }
        return res.status(201).json({ message: 'Alumni added successfully', data: results });
      });
    } catch (err) {
      console.error(err);
      return res.status(500).json({ message: 'Server error', error: err });
    }
  }

  // Menampilkan alumni berdasarkan ID ( SHOW )
  static async show(req, res) {
    const { id } = req.params;

    try {
      db.query('SELECT * FROM alumni WHERE id = ?', [id], (err, results) => {
        if (err) {
          console.error(err);
          return res.status(500).json({ message: 'Failed to fetch alumni', error: err });
        }
        if (results.length === 0) {
          return res.status(404).json({ message: 'Alumni not found' });
        }
        return res.status(200).json({ message: 'Fetched alumni', data: results[0] });
      });
    } catch (err) {
      console.error(err);
      return res.status(500).json({ message: 'Server error', error: err });
    }
  }

  // Mengupdate alumni berdasarkan ID ( UPDATE )
  static async update(req, res) {
    const { id } = req.params;
    const { name, phone, address, graduation_year, status, company_name, position } = req.body;

    // Validasi input
    if (!name || !phone || !address || !graduation_year || !status) {
      return res.status(422).json({ message: 'All fields must be filled correctly' });
    }

    try {
      db.query(
        'UPDATE alumni SET name = ?, phone = ?, address = ?, graduation_year = ?, status = ?, company_name = ?, position = ? WHERE id = ?',
        [name, phone, address, graduation_year, status, company_name, position, id],
        (err, results) => {
          if (err) {
            console.error(err);
            return res.status(500).json({ message: 'Failed to update alumni', error: err });
          }
          if (results.affectedRows === 0) {
            return res.status(404).json({ message: 'Alumni not found' });
          }
          return res.status(200).json({ message: 'Alumni updated successfully', data: results });
        }
      );
    } catch (err) {
      console.error(err);
      return res.status(500).json({ message: 'Server error', error: err });
    }
  }

  // Menghapus alumni berdasarkan ID ( DELETE )
  static async destroy(req, res) {
    const { id } = req.params;

    try {
      db.query('DELETE FROM alumni WHERE id = ?', [id], (err, results) => {
        if (err) {
          console.error(err);
          return res.status(500).json({ message: 'Failed to delete alumni', error: err });
        }
        if (results.affectedRows === 0) {
          return res.status(404).json({ message: 'Alumni not found' });
        }
        return res.status(200).json({ message: 'Alumni deleted successfully' });
      });
    } catch (err) {
      console.error(err);
      return res.status(500).json({ message: 'Server error', error: err });
    }
  }
}

module.exports = AlumniController;
