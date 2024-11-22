const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const path = require('path');

const app = express();

app.use(bodyParser.urlencoded({ extended: false }));
app.use(express.static(path.join(__dirname, 'public')));

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root', 
    password: '', 
    database: 'lestari', 
});

db.connect((err) => {
    if (err) {
        console.error('Gagal koneksi ke database:', err.stack);
        return;
    }
    console.log('Berhasil terkoneksi ke MySQL');
});

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

app.get('/login', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'login.html'));
});

app.post('/register', (req, res) => {
    const { nama_lengkap, email, password, alamat, nomor_hp } = req.body;

    const query = `
        INSERT INTO users (name, email, password, address, phone) 
        VALUES (?, ?, ?, ?, ?)
    `;
    
    db.query(query, [nama_lengkap, email, password, alamat, nomor_hp], (err) => {
        if (err) {
            console.error('Error saat menyimpan ke database:', err);
            return res.status(500).send('Gagal mendaftarkan pengguna.');
        }
        res.redirect('/login');
    });
});

app.post('/login', (req, res) => {
    const { email, password } = req.body;

    const query = `
        SELECT * FROM users WHERE email = ? AND password = ?
    `;

    db.query(query, [email, password], (err, results) => {
        if (err) {
            console.error('Error saat memeriksa database:', err);
            return res.status(500).send('Error saat login.');
        }

        if (results.length > 0) {
            res.status(200).send(`Login berhasil! Selamat datang, ${results[0].name}.`);
        } else {
            res.status(401).send('Email atau password salah, atau belum terdaftar.');
        }
    });
});

const PORT = 3002;
app.listen(PORT, () => {
    console.log(`Server berjalan di http://localhost:${PORT}`);
});
