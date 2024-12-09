// app.js

/**
 * TODO 9:
 * - Import semua method FruitController
 * - Refactor variable ke ES6 Variable
 */

const { index, store} = require('./FruitController');

/**
 * NOTES:
 * - Fungsi main tidak perlu diubah
 * - Jalankan program: nodejs app.js
 */

const main = () => {
    index();
    store("durian");
};

main();
