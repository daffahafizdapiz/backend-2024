const mysql = require('mysql');
require('dotenv').config(); // Menggunakan dotenv untuk membaca variabel lingkungan

// Membuat koneksi ke database MySQL
const connection = mysql.createConnection({
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'alumni_db',
});

// Menghubungkan ke database
connection.connect((err) => {
  if (err) {
    console.error('Error connecting: ' + err.stack);
    return;
  }
  console.log('Connected as id ' + connection.threadId);
});

// Menyediakan koneksi untuk digunakan di tempat lain
module.exports = connection;
