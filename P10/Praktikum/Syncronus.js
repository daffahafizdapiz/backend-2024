const {persiapan, rebusAir, masak} = require("./Persiapan.js");
const main = () => {
    persiapan()
        .then((res) => {
            console.log(res); // Output: Menyiapkan Bahan ...
            return rebusAir();
        })
        .then((res) => {
            console.log(res); // Output: Merebus Air ...
            return masak();
        })
        .then((res) => {
            console.log(res); // Output: Masak Mie ...
            console.log("Semua proses selesai!"); // Output Selesai
        });
};
main();