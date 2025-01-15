const express = require('express');
const alumniRoutes = require('./routes/alumniRoutes');
const app = express();
require('dotenv').config(); 

// Middleware
app.use(express.json());

// Routes
app.use('/api', alumniRoutes);

// Route utama
app.get('/', (req, res) => {
  res.status(200).send('Welcome to the API!');
});

// Set port secara eksplisit menjadi 3000
const PORT = process.env.PORT || 3000; 
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});

module.exports = app;
