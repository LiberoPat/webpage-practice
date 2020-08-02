const mysql = require('mysql');

const pool  = mysql.createPool({
    connectionLimit: 10,
    host: "g8mh6ge01lu2z3n1.cbetxkdyhwsb.us-east-1.rds.amazonaws.com",
    user: "rrxokxp75yyrqxdh",
    password: "x1fvf0hkvk0s72av",
    database: "kbjq7rrvr0280pms"
});

module.exports = pool;
