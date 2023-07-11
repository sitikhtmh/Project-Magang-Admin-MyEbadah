@extends('layout.index')

<!DOCTYPE html>
<html lang="en">
<head>
<title>{{$quizNama}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
@section('content')

    <div style="padding-top:0px;">
    @if ($jenisQuiz == 2)
        <a for="Materi_Detail_Id" href="/quizsubbab/{{$mtrdetailId}}" type="button">
            <i class="fa fa-arrow-left">
            <span>Kembali</span>
            </i>
        </a>
    @elseif ($jenisQuiz == 3)
        <a for="Materi_Id" href="/tesakhir/{{$mtrId}}" type="button">
            <i class="fa fa-arrow-left">
            <span>Kembali</span>
            </i>
        </a>
    @else
    <a for="Materi_Id" href="/tesawal/{{$mtrId}}" type="button">
            <i class="fa fa-arrow-left">
            <span>Kembali</span>
            </i>
        </a>
    @endif
    </div>

    <label for="Nama_Quiz" style="font-size:37px;">{{$quizNama}}</label>
    <hr>
    <!-- <div class="container"> -->
    <button type="button" class="button button2" data-toggle="modal" data-target="#exampleModal">+ Tambah</button>
    <br>

    @if (session('status')) 
    <br>
        <div class="alert alert-success"> 
        {{ session('status')}} 
        </div> 
    @endif

    <!-- Create Materi Popup -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            
                <form action="/soal/store" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                    @csrf
                        <input type="hidden" class="form-control" id="Quiz_Id" value="{{$quizId}}" name="Quiz_Id" readonly>
                        <div class="form-group">
                            <label for="Nama_Quiz">Quiz</label>
                            <br>
                            <input type="text" class="form-control" id="Nama_Quiz" value="{{$quizNama}}" name="Nama_Quiz" readonly>
                        </div>

                        <div class="form-group">
                            <label for="Pertanyaan">Pertanyaan</label>
                            <input type="text" class="form-control" id="Pertanyaan" placeholder="Masukkan Pertanyaan" name="Pertanyaan">
                        </div>

                        <div class="form-group">
                            <label for="Gambar">Upload File</label>
                            <input type="file" class="form-control-file" name="Gambar" id="Gambar">
                        </div>

                        <div class="modal-footer">
                            <button type="button"class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    

<!-- tabel -->
<div class="table-hover table-responsive-sm">
    <table class="table">
        <thead class="thead-white" style="background-color:#C0C0C0;">
            <tr>
            <!-- <th scope="col" style="width: 25px;">Kode Quiz</th> -->
            <th scope="col" style="width:10px;">No.</th>
            <th scope="col">Pertanyaan</th>
            <th scope="col">Gambar</th>
            <th scope="co1" style="width: 250px;">Action</th>
            </tr>
        </thead>

        <tbody>
        @php
        $no=1;
        @endphp
        @foreach ($quizSubbab as $soal)
            @php 
            $no++;
            @endphp
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$soal->Pertanyaan}}</td>
                <td>
                    <a href="/soal/{{$soal->Quiz_Detail_Id}}/Gambar">{{$soal->Gambar}}</a>
                </td>
                <td>
                    <a href="/jawaban/{{$soal->Quiz_Detail_Id}}/index" method="post" class="btn btn-success btn-sm">Jawaban</a>
                    <a href="#" class="btn btn-warning btn-sm" 
                        data-toggle="modal" 
                        data-target="#editModal{{$no}}" 
                        data-id="{{$soal->Quiz_Id}}"
                        data-detailid="{{$soal->Quiz_Detail_Id}}" 
                        data-soalquiz="{{$soal->Pertanyaan}}"
                        data-gambarsoal="{{$soal->Gambar}}">
                        Edit
                    </a>
                    <a id="btn-delete" href="" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" class="btn btn-danger btn-sm" data-delete="{{$soal->Quiz_Detail_Id}}">Delete</a>
                    
                </td>
            </tr>
        <!-- Delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Materi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/soal/delete/{{$soal->Quiz_Detail_Id}}" id="#Group_Id_Delete" enctype="multipart/form-data">
                        {{csrf_field()}}
                            <h7 class="modal-title" id="deleteModalLabel">Apakah anda yakin ingin menghapus data ini?</h7>
                            <input type="text" hidden class="form-control" id="Quiz_Detail_Id_Delete"  name="Quiz_Detail_Id_Delete">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-primary" onclick="DeleteSubmit()">Yes</button>
                                <script>
                                    function DeleteSubmit(){
                                        $('#Group_Id_Delete').submit();
                                    }
                                </script>
                            </div>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
        <!-- EDIT MODAL -->
        <div class="modal fade" id="editModal{{$no}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">Edit</h5>    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <form action="/soal/update/{{$soal->Quiz_Detail_Id}}" id="formEditGroup" method="POST" enctype="multipart/form-data">

                        {{csrf_field()}}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="Quiz_Id_Edit" hidden>Quiz Id</label>
                                    <input type="text" hidden class="form-control" id="Quiz_Id_Edit" value="{{$soal->Quiz_Id}}" name="Quiz_Id_Edit">
                                </div>
                                <div class="form-group">
                                    <label for="Quiz_Detail_Id_Edit" hidden>Quiz Detail Id</label>
                                    <input type="text" hidden class="form-control" id="Quiz_Detail_Id_Edit" value="{{$soal->Quiz_Detail_Id}}" name="Quiz_Detail_Id_Edit">
                                </div>
                                <div class="form-group">
                                    <label for="Nama_Quiz">Quiz</label>
                                    <br>
                                    <input type="text" class="form-control" id="Nama_Quiz" value="{{$quizNama}}" name="Nama_Quiz" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Pertanyaan_Edit">Pertanyaan</label>
                                    <input type="text" class="form-control" id="Pertanyaan_Edit" placeholder="Masukkan Pertanyaan" name="Pertanyaan_Edit" value="{{$soal->Pertanyaan}}">
                                </div>   
                                <div class="form-group">
                                    <label for="Gambar_Edit">Upload Gambar</label>
                                    <input type="file" class="form-control-file" id="Gambar_Edit" name="Gambar_Edit">
                                </div>
                                <div class="form-group">
                                    <label for="Gambar_Save" hidden>Upload Save</label>
                                    <input type="text" hidden class="form-control-file" id="Gambar_Save" name="Gambar_Save">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" onclick="formEditSubmit()">Simpan</button>
                                    <script>
                                        function formEditSubmit(){
                                            $('#formEditGroup').submit();
                                        }
                                    </script>
                                </div>
                            </div>
                        </form>
                    </div>        
                </div>
            </div>
        </div>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var quiz_id=button.data('detailid')
        var pertanyaan=button.data('soalquiz')
        var gambarsoal=button.data('gambarsoal')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    $('#Quiz_Id_Edit').val(id)
    $('#Quiz_Detail_Id_Edit').val(quiz_id)
    $('#Pertanyaan_Edit').val(pertanyaan)
    $('#Gambar_Save').val(gambarsoal)
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('delete')
        $('#Quiz_Detail_Id_Delete').val(recipient)
                    
    });
</script>
</body>
</html>
@endsection