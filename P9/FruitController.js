// FruitController.js

/**
 * TODO 3:
 * - Import fruits dari data/fruits.js
 * - Refactor variabel ke ES6 variable
 */

const fruits = require('./fruits');

// TODO 4: Buat method index
const index = () => fruits;

// TODO 5: Buat method store
const store = (name) => {
    fruits.push(name);
    return fruits;
};

// TODO 6: Buat method update
const update = (position, name) => {
    if (position >= 0 && position < fruits.length) {
        fruits[position] = name;
        return fruits;
    }
    return 'Invalid position';
};

// TODO 7: Buat method destroy
const destroy = (position) => {
    if (position >= 0 && position < fruits.length) {
        fruits.splice(position, 1);
        return fruits;
    }
    return 'Invalid position';
};

// TODO 8: export semua method
module.exports = { index, store, update, destroy };
