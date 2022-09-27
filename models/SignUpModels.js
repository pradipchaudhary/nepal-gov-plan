const mongoose = require("mon");
const singUpTemplate = new mongoose.Schema({
  fullName: {
    type: String,
    required: true,
  },
  username: {
    type: String,
    required: true,
  },
  email: {
    type: String,
    required: true,
  },
  password: {
    type: String,
    true: true,
  },
  date: {
    type: Date,
    default: Date.now,
  },
});

module.exports = mongoose.module("mytable", singUpTemplate);
