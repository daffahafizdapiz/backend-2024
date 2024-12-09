// app.js

/**
 * TODO 9:
 * - Import semua method FruitController
 * - Refactor variable ke ES6 Variable
 */

const { index, store, update, destroy} = require('./FruitController');

/**
 * NOTES:
 * - Fungsi main tidak perlu diubah
 * - Jalankan program: nodejs app.js
 */

const main = () => {
    index(); // Menampilkan buah awal

    store("Pisang"); // Menambahkan buah Pisang

    update(0, "Kelapa"); // Mengupdate buah posisi 0 menjadi Kelapa

    destroy(0); // Menghapus buah posisi 0
};

main();
