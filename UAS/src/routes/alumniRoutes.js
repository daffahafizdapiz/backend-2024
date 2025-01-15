const express = require('express');
const router = express.Router();
const AlumniController = require('../controllers/alumniController');

// Route untuk mendapatkan semua alumni
router.get('/alumni', AlumniController.index);

// Route untuk menambahkan alumni baru
router.post('/alumni', AlumniController.store);

// Route untuk menampilkan alumni berdasarkan ID
router.get('/alumni/:id', AlumniController.show);

// Route untuk mengupdate alumni berdasarkan ID
router.put('/alumni/:id', AlumniController.update);

// Route untuk menghapus alumni berdasarkan ID
router.delete('/alumni/:id', AlumniController.destroy);

module.exports = router;
