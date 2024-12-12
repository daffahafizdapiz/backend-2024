const persiapan = () => {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve("Menyiapkan Bahan ....");
        }, 3000);
    });
};

const rebusAir = () => {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve("Merebus Air ....");
        }, 7000);
    });
};

const masak = () => {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve("Masak Mie ....");
        }, 5000);
    });
};

module.exports = {persiapan, rebusAir, masak};


