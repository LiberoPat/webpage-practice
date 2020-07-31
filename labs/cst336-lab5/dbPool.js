const mysql = require('mysql');

const pool  = mysql.createPool({
    connectionLimit: 10,
    host: "127.0.0.1",
    user: "root",
    password: "",
    database: "cst363SP2020"
});

module.exports = pool;
