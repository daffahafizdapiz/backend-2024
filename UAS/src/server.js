// Mengimpor aplikasi Express yang telah dibuat
const app = require('./app');

// Mendefinisikan port yang akan digunakan oleh server, jika tidak ada variabel lingkungan PORT, maka default ke 3000
const PORT = process.env.PORT || 3000;

// Menghubungkan ke database dan menjalankan aplikasi jika berhasil
sequelize.sync().then(() => {
  console.log('Database connected successfully');  // Menampilkan pesan jika koneksi ke database berhasil

  // Menjalankan server di port yang telah ditentukan
  app.listen(PORT, () => console.log(`Server running on http://localhost:${PORT}`));  // Menampilkan pesan saat server berhasil berjalan
}).catch(err => console.error('Unable to connect to the database:', err));  // Menangani jika terjadi kesalahan saat menghubungkan ke database
