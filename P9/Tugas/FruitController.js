// FruitController.js

/**
 * TODO 3:
 * - Import fruits dari data/fruits.js
 * - Refactor variabel ke ES6 variable
 */

const fruits = require('./fruits');

// TODO 4: Buat method index
const index = () => {
   for (const fruit of fruits) {
    console.log(fruit);
   }
};

// TODO 5: Buat method store
const store = (name) => {
    console.log(`\nMethod store - Menambahkan buah ${name}`);
    fruits.push(name);
    index();
};

// TODO 6: Buat method update
const update = (position, name) => {
    console.log(`\nMethod update - Update data ${position} menjadi ${name}`);
    if (position >= 0 && position < fruits.length) {
      fruits[position] = name;
      index();
    } else {
      console.log("Invalid position. Update failed.");
    }
};


// TODO 7: Buat method destroy
const destroy = (position) => {
    console.log(`\nMethod destroy - Menghapus data ${position}`);
    if (position >= 0 && position < fruits.length) {
      fruits.splice(position, 1);
      index();
    } else {
      console.log("Invalid position. Delete failed.");
    }
};


// TODO 8: export semua method
module.exports = { index, store, update, destroy};
