const express = require("express");
const app = express();

const PORT = process.env.PORT || 5000;

// app.get("/", (req, res) => {
//   console.log("Response ");
// });

app.listen(PORT, () => console.log("Server is up and running ?"));

// console.log(app);
