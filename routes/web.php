<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', 'LoginController@getlogin');
Route::post('/login/success', 'LoginController@postlogin');


Route::get('/logout', 'LoginController@logout');


Route::get('/dashboard', function () {
    return view('welcome');
});

// Materi
Route::get('/materi','MateriController@index');
Route::post('/materi/store', 'MateriController@store');
Route::get('/materi/create', 'MateriController@create'); 
Route::post('/materi/update', 'MateriController@update');
Route::get('/materi/{mtr}/Thumbnail','MateriController@show_thumbnail');
Route::post('/materi/delete','MateriController@delete');


// Subbab
Route::get('/subbab/{mtr}/index','SubbabController@index');
Route::post('/subbab/store', 'SubbabController@store');
Route::get('/subbab/create', 'SubbabController@create'); 
Route::post('/subbab/update', 'SubbabController@update');
Route::get('/subbab/{bab}/file_upload','SubbabController@show_file_upload');
Route::post('/subbab/delete/{mtrdid}','SubbabController@delete');

// Soal
Route::get('/soal/{quizId}','SoalController@index');
Route::post('/soal/store', 'SoalController@store');
Route::post('/soal/update/{Quiz_Detail_Id}', 'SoalController@update');
Route::get('/soal/{Quiz_Detail_Id}/Gambar','SoalController@show_Gambar');
Route::post('/soal/delete/{quizSubbab}','SoalController@delete');

//Jawaban
Route::get('/jawaban/{quizDetailId}/index', 'JawabanController@index');
Route::post('/jawaban/store', 'JawabanController@store');
Route::post('/jawaban/update', 'JawabanController@update');
Route::post('/jawaban/delete/{quizDetailId}','JawabanController@delete');

// Quiz Akhir
Route::get('/quizakhir/{materiId}','QuizakhirController@index');
Route::post('/quizakhir/store', 'QuizakhirController@store');
Route::get('/quizakhir/create', 'QuizakhirController@create');
Route::get('/quizakhir/{mtr}/Gambar','QuizakhirController@show_Gambar');

Route::get('/jawabanakhir/{quizDetailId}/index','JawabanakhirController@index');

// Tes Akhir
Route::get('/tesakhir/{materiId}','TesakhirController@index');
Route::post('/tesakhir/store', 'TesakhirController@store');
Route::get('/tesakhir/create', 'TesakhirController@create');
Route::post('/tesakhir/update', 'TesakhirController@update');
Route::post('/tesakhir/delete/{tesakhir}', 'TesakhirController@delete');

// Tes Awal
Route::get('/tesawal/{materiId}','TesawalController@index');
Route::post('/tesawal/store', 'TesawalController@store');
Route::get('/tesawal/create', 'TesawalController@create');
Route::post('/tesawal/update', 'TesawalController@update');
Route::post('/tesawal/delete/{tesawal}', 'TesawalController@delete');

//Quiz Subbab
Route::get('/quizsubbab/{materiId}','QuizsubbabController@index');
Route::post('/quizsubbab/store', 'QuizsubbabController@store');
Route::get('/quizsubbab/create', 'QuizsubbabController@create');
Route::post('/quizsubbab/update', 'QuizsubbabController@update');
Route::post('/quizsubbab/delete/{quizbab}','QuizSubbabController@delete');

//Laporan Mahasiswa
Route::get('/mahasiswa','MahasiswaController@index');
Route::get('/mahasiswahistory/{studentid}', 'MahasiswaController@show');
Route::get('/mahasiswadetail/{studentdet}/{Materi_Id}', 'MahasiswaController@detail');
Route::get('/mahasiswa/filter', 'MahasiswaController@filter');
    

//Laporan Umum
Route::get('/umum','UmumController@index');
Route::get('/umumhistory/{umumhis}', 'UmumController@show');
Route::get('/umumdetail/{umumdet}/{Materi_Id}', 'UmumController@detail');

//Laporan Pegawai
Route::get('/pegawai','PegawaiController@index');
Route::get('/pegawaihistory/{pegawaihis}', 'PegawaiController@show');
Route::get('/pegawaidetail/{pegawaidet}/{Materi_Id}', 'PegawaiController@detail');
