// FruitController.js

/**
 * TODO 3:
 * - Import fruits dari data/fruits.js
 * - Refactor variabel ke ES6 variable
 */

const fruits = require('./data.js');

// TODO 4: Buat method index
const index = () => {
   for (const fruit of fruits) {
    console.log(fruit);
   }
};

// TODO 5: Buat method store
const store = (name) => {
    fruits.push(name);
    index();
}; 



// TODO 8: export semua method
module.exports = { index, store};
