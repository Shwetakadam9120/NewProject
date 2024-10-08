const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// MySQL database connection
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',       // Replace with your DB username
  password: '',       // Replace with your DB password
  database: 'employees' // Replace with your DB name
});

db.connect(err => {
  if (err) {
    console.error('Database connection failed: ' + err.stack);
    return;
  }
  console.log('Connected to database.');
});

// Get all employees
app.get('/employees', (req, res) => {
  const sql = 'SELECT * FROM employees';
  db.query(sql, (err, result) => {
    if (err) throw err;
    res.json(result);
  });
});

// Add a new employee
app.post('/employees', (req, res) => {
  const { name, email, phone, department, status } = req.body;
  const sql = 'INSERT INTO employees (name, email, phone, department, status) VALUES (?, ?, ?, ?, ?)';
  db.query(sql, [name, email, phone, department, status], (err, result) => {
    if (err) throw err;
    res.json({ message: 'Employee added successfully', id: result.insertId });
  });
});

const PORT = 3000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
