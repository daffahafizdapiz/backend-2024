const download = () => {
  return new Promise((resolve, reject) => {
    const status = true;

    setTimeout(() => {
      if (status) {
        resolve("windows-10.exe"); // Hanya nama file sebagai hasil
      } else {
        reject("Download Gagal. Terjadi kesalahan jaringan.");
      }
    }, 3000); // Simulasi delay 5 detik
  });
};

// Memanggil fungsi dengan Promise
download()
  .then((res) => {
    console.log("Download selesai"); // Menampilkan pesan sukses
    console.log(`Hasil Download: ${res}`); // Menampilkan hasil download
  })
  .catch((err) => {
    console.error(err); // Menampilkan pesan error jika gagal
  });

// Refactor menggunakan Async/Await
const downloadAsync = async () => {
  try {
    const result = await download(); // Menunggu hasil Promise
    console.log("Download selesai"); // Menampilkan pesan sukses
    console.log(`Hasil Download: ${result}`); // Menampilkan hasil download
  } catch (error) {
    console.error(error); // Menampilkan pesan error jika gagal
  }
};

// Memanggil fungsi async
downloadAsync();

