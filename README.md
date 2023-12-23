# Presensi Kehadiran (CodeIgniter 4 Application)

## What is e_presensi2

adalah aplikasi web absensi kehadiran dengan menggunakan Codeigniter 4, aplikasi ini diperunutukan bagi Kantor yang mempunyai banyak lokasi kantor,

Studi kasus pada Aplikasi ini adalah pada Kantor Pemerintahan di bidang Pajak Daerah

Kantor ini memiliki berbagai tempat untuk karyawannya bekerja sehingga membutuhkan Absen yang memastikan karyawan benar-benar telah berada di Kantor (Kantor A (sebagai kantor utama, Kantor B, Kantor C dan sebagainya))

etc:
saat karyawan melakukan absensi dan ia terdaftar pada kantor A sedangkan dia tidak berada dilokasi Kantor A, maka karyawan tersebut tidak dapat melakukan absensi kecuali ia berada di radius lokasi Kantor A (radius 100m).

Dan juga jika Karyawan yang terdaftar di Kantor B dan sedang berada di lokasi kantor A, karyawan tidak dapat melakukan absensi di lokasi kantor A, karena karyawan tersebut terdaftar di lokasi kantor B.

Semua karyawan tidak dapat melakukan absensi jika tidak berada di Lokasi Kantor tempat ia terdaftar. Artinya, Karyawan hanya dapat absensi di lokasi kantornya masing-masing.

Aplikasi ini dapat melakukan absensi dengan menampilkan Lokasi peta serta mengambil foto karyawan secara realtime dengan wajib mengaktifkan kamera dan lokasi perangkatnya.

created by: Meaghito & Rahmat
