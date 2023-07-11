@extends('layout.index')
<head>
  <title>History</title>
</head>
@section('content')
<div style="padding-top:0px;">
    <a href="/mahasiswa" type="button">
        <i class="fa fa-arrow-left">
        <span>Kembali</span>
        </i>
    </a>
</div>

<nav class="navbar navbar-expand-sm bg-light">
  <div class="acc2">
  <ul class="navbar-nav">
    <li class="nav-item li2" style="background-color:#B22222;">
      <a style="color:#fff; display: inline-block; font-size: 18px;" class="nav-link" href="/mahasiswa">Mahasiswa</a>
    </li>
    <li class="nav-item li2" style="background-color:#B22222;">
      <a style="color:#fff; display: inline-block; font-size: 18px;" class="nav-link" href="/pegawai">Pegawai</a>
    </li>
    <li class="nav-item li2" style="background-color:#B22222;">
      <a style="color:#fff; display: inline-block; font-size: 18px;" class="nav-link" href="/umum">Umum</a>
    </li>
    <img class ="acc "src="{{asset('assets/images/accessories-2.png')}}">
  </ul>
</div>
</nav>

<label for="Nama_Lengkap" style="font-size:37px;">{{$mahasiswaNama}}</label>
<br>

<div>
  <table class="table">
    <thead class="thead-white" style="background-color:#C0C0C0;">
      <tr>
        <th scope="col">Nama Materi</th>
        <th scope="col">Mulai Tes Awal</th>
        <th scope="col">Selesai Tes Awal</th>
        <th scope="col">Mulai Tes Akhir</th>
        <th scope="col">Selesai Tes Akhir</th>
        <th scope="col">Score Tes Awal</th>
        <th scope="col">Score Tes Akhir</th>
        <th scope="co1">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($mahasiswahistory as $mhshis)
        <tr>
          <td>{{$mhshis->Nama_Materi}}</td>
          <td>{{$mhshis->Mulai_Tes_Awal}}</td>
          <td>{{$mhshis->Selesai_Tes_Awal}}</td>
          <td>{{$mhshis->Mulai_Tes_Akhir}}</td>
          <td>{{$mhshis->Selesai_Tes_Akhir}}</td>
          <td>{{$mhshis->Score_Tes_Awal}}</td>
          <td>{{$mhshis->Score_Tes_Akhir}}</td>
          <td>
            <a href="/mahasiswadetail/{{$mhshis->Student_Id}}/{{$mhshis->Materi_Id}}" class="btn btn-success btn-sm">Detail</a>
          </td>
        </tr>
      @endforeach
    </tbody>           
  </table>
</div>

@endsection

