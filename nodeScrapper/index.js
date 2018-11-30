const express = require('express');
const os = require('os');
const router = express.Router();

const app = express();

const fly4free = require('./fly4freeScrapper');

app.use(express.static('dist'));
app.listen(8080, () => console.log('Listening on port 8080!'));