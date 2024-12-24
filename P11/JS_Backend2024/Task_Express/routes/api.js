// Import Student Controller
const StudentController = require('../controllers/StudentController');

const express = require("express");
const router = express.Router();

router.get("/", (req, res) => {
    res.send("Hello Express");
});


// Route untuk students
router.get("/students", StudentController.index); // Tampilkan semua data
router.post("/students", StudentController.store); // Tambahkan data
router.put("/students/:id", StudentController.update); // Update data
router.delete("/students/:id", StudentController.destroy); // Hapus data

// Export router
module.exports = router;
