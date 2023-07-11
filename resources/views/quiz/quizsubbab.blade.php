@extends('layout.index')

<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$jenisQuiz}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
@section('content')
    <div style="padding-top:0px;">
        <a href="/subbab/{{$materi}}/index" type="button">
            <i class="fa fa-arrow-left">
            <span>Kembali</span>
            </i>
        </a>
    </div>
    <label for="" style="font-size:37px;">{{$jenisQuiz}}</label>

    <hr> 
    
    @if (session('status')) 
        <div class="alert alert-success"> 
        {{ session('status')}} 
        </div> 
    @endif

    @if ($quizbab->count() > 0)
    <button type="button" class="button button2" hidden>+ Buat</button>
    @else
    <button type="button" class="button button2" data-toggle="modal" data-target="#exampleModal">+ Buat</button>
    <br>
    @endif

    <!-- Create Materi Popup -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Quiz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            
            <form action="/quizsubbab/store" method="POST" >
            @csrf
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="Materi_Detail_Id" value="{{$materiId}}" name="Materi_Detail_Id" readonly>

                    <input type="hidden" class="form-control" id="Jenis_Quiz_Id" value="{{$jenisQuizId}}" name="Jenis_Quiz_Id" readonly>
                    
                    <div class="form-group">
                        <label for="Kode_Quiz">Kode Quiz</label>
                        <input type="text" class="form-control" id="Kode_Quiz" placeholder="Masukkan Kode Quiz" name="Kode_Quiz">
                    </div>

                    <div class="form-group">
                        <label for="Nama_Quiz">Nama Quiz</label>
                        <input type="text" class="form-control" id="Nama_Quiz" placeholder="Masukkan Nama Quiz" name="Nama_Quiz">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
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
                    <th scope="col" style="width: 120px;">Kode Tes</th>
                    <th scope="col">Nama Tes</th>
                    <!-- <th scope="col">Gambar</th> -->
                    <th scope="co1" style="width: 250px;">Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach($quizbab as $quiz2)
                <tr>
                    <td>{{$quiz2->Kode_Quiz}}</td>
                    <td>{{$quiz2->Nama_Quiz}}</td>
                    <td>
                        <a href="/soal/{{$quiz2->Quiz_Id}}" method="post" class="btn btn-success btn-sm">Lihat Soal</a>
                        <a href="#" method="POST" class="btn btn-warning btn-sm" 
                            data-toggle="modal" 
                            data-target="#editModal" 
                            data-detail_id="{{$quiz2->Materi_Detail_Id}}" 
                            data-kode="{{$quiz2->Kode_Quiz}}" 
                            data-nama="{{$quiz2->Nama_Quiz}}">
                            Edit
                        </a>
                        <a id="btn-delete" href="" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" data-delete="{{$quiz2->Quiz_Id}}">Delete</a>
                        
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
                            <form method="POST" action="/quizsubbab/delete/{{$quiz2->Quiz_Id}}" id="#Group_Id_Delete" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <h7 class="modal-title" id="deleteModalLabel">Apakah anda yakin ingin menghapus data ini?</h7>
                                <input type="text" hidden class="form-control" id="Quiz_Id_Delete"  name="Quiz_Id_Delete">
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
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/quizsubbab/update" id="#formEditGroup" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="Materi_Detail_Id_Edit" hidden>Materi Detail Id</label>
                                    <input type="text" hidden class="form-control" id="Materi_Detail_Id_Edit" name="Materi_Detail_Id_Edit">
                                </div>
                                <div class="form-group">
                                    <label for="Kode_Quiz_Edit">Kode Quiz</label>
                                    <input type="text" class="form-control" id="Kode_Quiz_Edit" placeholder="Masukkan Kode Materi" name="Kode_Quiz_Edit" value="{{$quiz2->Kode_Quiz}}">
                                </div>
                                <div class="form-group">
                                    <label for="Nama_Quiz_Edit">Nama Quiz</label>
                                    <input type="text" class="form-control" id="Nama_Quiz_Edit" placeholder="Masukkan Nama Quiz" name="Nama_Quiz_Edit" value="{{$quiz2->Nama_Quiz}}">
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
        var materi_detail_id=button.data('detail_id') // Extract info from data-* attributes
        var kode_quiz=button.data('kode')
        var nama_quiz=button.data('nama')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    $('#Materi_Detail_Id_Edit').val(materi_detail_id)
    $('#Kode_Quiz_Edit').val(kode_quiz)
    $('#Nama_Quiz_Edit').val(nama_quiz)
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('delete')
        $('#Quiz_Id_Delete').val(recipient)
                    
    });
</script>

</body>
</html>
@endsection