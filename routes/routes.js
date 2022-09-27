const express = require("express");
const router = express.Router();
const singUpTemplateCopy = require("../models/SignUpModels");

router.post("/signup", (request, response) => {
  const singedUpUser = new singUpTemplateCopy({
    fullName: request.body.fullName,
    username: request.body.username,
    email: request.body.email,
    password: request.body.password,
  });
  singedUpUser
    .save()
    .then((data) => {
      response.json(data);
    })
    .catch((error) => {
      response.json(error);
    });
});

module.exports = router;
