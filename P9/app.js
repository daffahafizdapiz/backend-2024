// app.js

/**
 * TODO 9:
 * - Import semua method FruitController
 * - Refactor variable ke ES6 Variable
 */

const { index, store, update, destroy } = require('./FruitController');

/**
 * NOTES:
 * - Fungsi main tidak perlu diubah
 * - Jalankan program: nodejs app.js
 */

const main = () => {
    console.log('Index:', index());
    console.log('Store:', store('pineapple'));
    console.log('Update:', update(1, 'strawberry'));
    console.log('Destroy:', destroy(0));
};

main();
