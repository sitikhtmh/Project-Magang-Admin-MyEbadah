@extends('layout.index')

@section('Sub Bab')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sub Bab</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>

    <body>
    @section('content')
            <label for="Materi_Nama" style="font-size:37px;">{{$materiNama}}</label>
            <hr>
            <button type="button" class="button button2" data-toggle="modal" data-target="#exampleModal">+ Tambah</button>
            <br>

            @if (session('status')) 
            <br>
                <div class="alert alert-success"> 
                {{ session('status')}} 
                </div> 
            @endif
           
            <!-- Create -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Sub Bab</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/subbab/store" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                            @csrf
                                <div class="form-group">
                                    <label for="Urut">Urut</label>
                                    <input type="text" class="form-control" id="Urut" placeholder="Masukkan Urut" name="Urut">
                                </div>

                                <input type="hidden" class="form-control" id="Materi_Id" value="{{$materiId}}" name="Materi_Id" readonly>
                                <div class="form-group">
                                    <label for="Materi_Nama">Materi</label>
                                    <br>
                                    <input type="text" class="form-control" id="Materi_Nama" value="{{$materiNama}}" name="Materi_Nama" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="Deskripsi">Deskripsi</label>
                                    <input type="text" class="form-control" id="Deskripsi" placeholder="masukkan Deskripsi" name="Deskripsi">
                                </div>

                                <div class="form-group">
                                    <label for="File_Upload">Upload File</label>
                                    <input type="file" class="form-control-file" name="File_Upload" id="File_Upload">
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
          
            <!-- Tabel -->
            <br>
            <div>
                <table class="table" id="datatable">
                    <thead class="thead-white" style="background-color:#C0C0C0;">
                        <tr>
                        <th scope="col">Urut</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">File</th>
                        <th scope="co1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($subbab as $bab)
                    <tr>
                        <tr>
                            <td hidden>{{$bab->Materi_Detail_Id}}</td>
                            <td>{{$bab->Urut}}</td>
                            <td>{{$bab->Deskripsi}}</td>
                            <td>
                                <a href="/subbab/{{$bab->Materi_Detail_Id}}/file_upload">{{$bab->File_Upload}}</a>
                            </td>
                            <td>
                                <a href="/soal/{{ $bab->Materi_Id }}" class="btn btn-success btn-sm">Quiz</a>

                                <a href="#" method="POST" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="{{$bab->Materi_Id}}" 
                                        data-detail="{{$bab->Materi_Detail_Id}}" data-urutt="{{$bab->Urut}}" data-nama="{{$bab->Nama_Materi}}" 
                                        data-deskripsi="{{$bab->Deskripsi}}" data-fileupload="{{$bab->File_Upload}}">Edit</a>
                                        
                                <a id="btn-delete" href="" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" class="btn btn-danger btn-sm" data-delete="{{$bab->Materi_Detail_Id}}">Delete</a>
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
                                        <form method="POST" action="/subbab/delete/{{$bab->Materi_Id}}" id="#Group_Id_Delete" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                            <h7 class="modal-title" id="deleteModalLabel">Apakah anda yakin ingin menghapus data ini?</h7>
                                            <input type="text" hidden class="form-control" id="Materi_Id_Delete"  name="Materi_Id_Delete">
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
                                        <h5 class="modal-title" id="editModalLabel">Edit SubBab</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="/subbab/update" id="formEditGroup" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="Materi_Id_Edit" hidden>Materi Id</label>
                                            <input type="text" hidden class="form-control" id="Materi_Id_Edit"  name="Materi_Id_Edit" value="{{$bab->Materi_Id}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="Materi_Detail_Id_Edit" hidden>Materi Detail Id</label>
                                            <input type="text" hidden class="form-control" id="Materi_Detail_Id_Edit"  name="Materi_Detail_Id_Edit" value="{{$bab->Materi_Detail_Id}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="Urut_Edit">Urut</label>
                                            <input type="text" class="form-control" id="Urut_Edit" placeholder="Masukkan Urut" name="Urut_Edit" value="{{$bab->Urut}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama_Materi_Edit">Nama Materi</label>
                                            <input type="text" class="form-control" id="Nama_Materi_Edit" placeholder="Masukkan Judul Materi" name="Nama_Materi_Edit" value="{{$bab->Nama_Materi}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="Deskripsi">Deskripsi</label>
                                            <input type="text" class="form-control" id="Deskripsi_Edit" placeholder="masukkan Deskripsi" name="Deskripsi_Edit" value="{{$bab->Deskripsi}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="fileuplod">Upload File</label>
                                            <input type="file" class="form-control-file" id="fileuplod_Edit" name="fileuplod_Edit">
                                        </div>
                                        <div class="form-group">
                                            <label for="Thumbnail" hidden>Thumbnail Save</label>
                                            <input type="text" hidden class="form-control-file" id="File_Upload_Save" name="File_Upload_Save">
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
                var id = button.data('id') // Extract info from data-* attributes
                var urut =button.data('urutt')
                var detailId =button.data('detail')
                var nama_materi=button.data('nama')
                var deskripsi=button.data('deskripsi')
                var fileupload=button.data('fileupload')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                $('#Materi_Id_Edit').val(id)
                $('#Urut_Edit').val(urut)
                $('#Materi_Detail_Id_Edit').val(detailId)
                $('#Nama_Materi_Edit').val(nama_materi)
                $('#Deskripsi_Edit').val(deskripsi)
                $('#File_Upload_Save').val(fileupload)
                });

                $('#deleteModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget)
                    var recipient = button.data('delete')
                    $('#Materi_Id_Delete').val(recipient)
                    
                });

            </script>
    </body>
</html>
@endsection