const mongoose = require("mongoose");
const { createClient } = require("redis");
require("dotenv").config();

const connection = mongoose.connect(process.env.MONGODB_URI, {
  useNewUrlParser: true,
  useUnifiedTopology: true
});

const client = createClient({ url: process.env.REDIS_URI });

module.exports = {
  connection,
  client
}
