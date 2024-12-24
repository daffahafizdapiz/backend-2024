import express from "express";
import apiRoutes from "./routes/api.js";

const app = express();
const port = 3000;

// Middleware buat parsing JSON
app.use(express.json());

// Gunakan rute API
app.use("/api", apiRoutes);

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});
