const nama = "Daffa Hafiz";
const umur = 19;
const jurusan = "Kedokteran";

console.log(nama, umur, jurusan);
console.log(`====================`);

const nilai = 91;
let grade = "";

if (nilai > 90) {
    grade = "A";
}
else if (nilai > 80) {
    grade = "B";
}
else {
    grade = "C";
}
console.log(`Nilai anda: ${grade}`);
console.log(`====================`);

console.log(`Contoh Object`);

const user = {
    name: "Daffa",
    addres: "Bogor",
    age: 19,
    isMarried: true,
};

//didalam object ada dua bagian
//yaitu key dan value
//contoh key => name, addres, age
// contoh value => "Daffa"
//console.log(user.name);
const {name, addres, age, isMarried} = user;
console.log(name, addres, age, isMarried);