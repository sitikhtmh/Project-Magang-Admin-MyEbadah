@extends('layout.index')

@section('title', '')

@section('content')

<div style="padding-top:0px;">
    <a href="/pegawaihistory/{{$stdid}}" type="button">
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
            <th scope="col">Sub Bab</th>
            <th scope="col">Mulai Belajar</th>
            <th scope="col">Mulai Tes</th>
            <th scope="col">Selesai Tes</th>
            <th scope="col">Score Tes</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pegawaidetail as $pegdet)
        <tr>
            <td>{{$pegdet->Deskripsi}}</td>
            <td>{{$pegdet->Mulai_Belajar}}</td>
            <td>{{$pegdet->Mulai_Tes}}</td>
            <td>{{$pegdet->Selesai_Tes}}</td>
            <td>{{$pegdet->Score_Tes}}</td>
        </tr>
      @endforeach
    </tbody>           
  </table>
</div>

@endsection

