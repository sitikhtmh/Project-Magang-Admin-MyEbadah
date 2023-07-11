@extends('layout.index')

@section('title', '')

@section('content')



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
<form action="/mahasiswa" method="get">
  <div class="form-group row">
    <div class="col-md-1">
      <label style="vertical-align: baseline;" class="col-form-label">Nama Prodi</label>
    </div>
    <div >
      <select name="prodi_id" id="prodi" class="form-control" onchange="this.form.submit()">
        <option value="1" id="pilih" onload="check()">Pilih Program Studi</option>
          @foreach ($prodi as $pid )
            <option  id="pilihan"  value="{{$pid->DEPARTMENT_ID}}" <?php if ($prodi_id == $pid->DEPARTMENT_ID) { echo 'selected'; } ?>>
              {{ $pid->NAME_OF_DEPARTMENT }}
            </option>
          @endforeach
      </select>
        <script type="text/javascript">
          function check() {
            if(document.getElementById("pilih").selectedIndex = 1)
            {
              document.getElementById("pipi").disabled = true;

            }
            else
            {
              document.getElementById("pipi").disabled = false;

            }

          }
            
        </script>
    </div>
  </div>
</form>
<br>
<div>
  <table id="pipi" class="table">
    <thead class="thead-white" style="background-color:#C0C0C0;">
      <tr>
        <th scope="col">Nim</th>
        <th scope="col">Nama</th>
        <th scope="col">Gender</th>
        <th scope="col">Teanggal Lahir</th>
        <th scope="col">Tanggal Gabung</th>
        <th scope="co1">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($mahasiswa as $mhs)
        <tr>
          <td>{{$mhs->Nim}}</td>
          <td>{{$mhs->Nama_Lengkap}}</td>
          <td>{{$mhs->Gender_Code}}</td>
          <td>{{$mhs->Tanggal_Lahir}}</td>
          <td>{{$mhs->Created_Date}}</td>
          
          <td>
            <a href="/mahasiswahistory/{{$mhs->Student_Id}}" class="btn btn-success btn-sm">History</a>
          </td>
        </tr>
      @endforeach
    </tbody>           
  </table>
</div>
<script>

</script>
@endsection

