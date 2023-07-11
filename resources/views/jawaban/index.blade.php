@extends('layout.index')

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jawaban</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    @section('content')
        <div style="padding-top:0px;">
            <a href="/soal/{{$quizId}}" type="button">
                <i class="fa fa-arrow-left">
                <span>Kembali</span>
                </i>
            </a>
        </div>
       
        <label for="pertanyaan" style="font-size:37px;">{{$pertanyaan}}</label>
        <hr>
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
                        <h5 class="modal-title" id="exampleModalLabel">Buat Jawaban</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form action="/jawaban/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">
                                <input type="hidden" class="form-control" id="Quiz_Detail_Id" value="{{$quizDetailId}}" name="Quiz_Detail_Id" readonly>
                                <div class="form-group row">
                                    <label for="Pertanyaan">Pertanyaan</label>
                                    <input type="text" class="form-control" id="Pertanyaan" value="{{$pertanyaan}}" name="Pertanyaan" readonly>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="Jawaban">Jawaban</label>
                                    <input type="text" class="form-control" id="Jawaban" placeholder="Masukkan Jawaban" name="Jawaban">
                                </div>
                        
                                <div class="form-group row">
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="Is_Jawaban">
                                            <input type="radio" class="form-check-input" name="optradio1">Benar
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="Is_Jawaban">
                                            <input type="radio" class="form-check-input" name="optradio2">Salah
                                        </label>
                                    </div>
                                </div>
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
                        <th>#</th>
                        <th scope="col">Pilihan Jawaban</th>
                        <th scope="col">Jawaban</th>
                        <th scope="co1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keySoal as $jawabanquiz)
                        <tr>
                            <td></td>
                            <td>{{$jawabanquiz->Jawaban}}</td>
                            <td>
                            @if($jawabanquiz->Is_Jawaban == 1)
                                <i class="fas fa-check" style="color: #2AE70C;"></i>
                            @else
                                <i class="fas fa-times" style="color: #E7230C;"></i>
                            @endif
                            </td>
                            <td>
                                <a href="#" method="post" class="btn btn-warning btn-sm"
                                    data-toggle="modal" 
                                    data-target="#editModal" 
                                    data-detail_id="{{$jawabanquiz->Jawaban_Id}}"
                                    data-jawaban="{{$jawabanquiz->Jawaban}}" 
                                    data-isjwbn="{{$jawabanquiz->Is_Jawaban}}">
                                    Edit
                                </a>
                                <a id="btn-delete" href="" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" class="btn btn-danger btn-sm" data-delete="{{$jawabanquiz->Jawaban_Id}}">Delete</a>
                            </td>
                        </tr> 
                    <!-- Delete -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Jawaban</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/jawaban/delete/{{$jawabanquiz->Jawaban_Id}}" id="#Group_Id_Delete" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                        <h7 class="modal-title" id="deleteModalLabel">Apakah anda yakin ingin menghapus data ini?</h7>
                                        <input type="text" hidden class="form-control" id="Jawaban_Id_Delete" value="{{$jawabanquiz->Jawaban_Id}}" name="Jawaban_Id_Delete">
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
                                    <form method="POST" action="/jawaban/update" id="#formEditGroup" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" class="form-control" id="Quiz_Detail_Id_Edit" value="{{$quizDetailId}}" name="Quiz_Detail_Id_Edit" readonly>
                                        <div class="form-group">
                                            <label for="Jawaban_Id_Edit" hidden>Jawaban Id</label>
                                            <input type="text" hidden class="form-control" id="Jawaban_Id_Edit" value="{{$jawabanquiz->Jawaban_Id}}" name="Jawaban_Id_Edit">
                                        </div>
                                        <div class="form-group">
                                            <label for="Pertanyaan">Pertanyaan</label>
                                            <input type="text" class="form-control" id="Pertanyaan" value="{{$pertanyaan}}" name="Pertanyaan" readonly>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="Jawaban">Jawaban</label>
                                            <input type="text" class="form-control" id="Jawaban_Edit" name="Jawaban_Edit" value="{{$jawabanquiz->Jawaban}}">
                                        </div>
                                
                                        <div class="form-group">
                                            <div class="form-check-inline">
                                                <label class="form-check-label" for="Is_Jawaban_Edit">
                                                    <input type="radio" class="form-check-input" name="optradio1">Benar
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label" for="Is_Jawaban_Edit">
                                                    <input type="radio" class="form-check-input" name="optradio2">Salah
                                                </label>
                                            </div>
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
        var jawaban_id=button.data('detail_id') // Extract info from data-* attributes
        var jwbn=button.data('jawaban')
        var is_jwbn=button.data('isjwbn')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    $('#Jawaban_Id_Edit').val(jawaban_id)
    $('#Jawaban_Edit').val(jwbn)
    $('#Is_Jawaban_Edit').val(is_jwbn)
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('delete')
        $('#Jawaban_Id_Delete').val(recipient)
                    
    });
</script>
    </body>
</html>
@endsection