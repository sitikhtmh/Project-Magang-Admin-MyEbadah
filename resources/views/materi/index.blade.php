@extends('layout.index')

@section('Materi')
<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Materi</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.3.5/sweetalert2.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.3.5/sweetalert2.min.js"></script>
    </head>
    <body>
    @section('content')
        <label for="Materi_Nama" style="font-size:37px;">Materi</label>
        <hr>
        <button type="button" class="button button2" data-toggle="modal" data-target="#exampleModal">+ Tambah</button>
        <br>
        @if (session('status'))
        <div class="alert alert-success"> 
        {{ session('status')}} 
            <button type="button" class="close" data-dismiss="alert">×</button> 
        </div> 
        @endif
        <!-- Create Materi Popup -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Materi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="/materi/store" style="width:100%;" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Urut">Urut</label>
                            <input type="text" class="form-control" id="Urut" placeholder="Masukkan Urut" name="Urut">
                        </div>
                        <div class="form-group">
                            <label for="Kode_Materi">Kode Materi</label>
                            <input type="text" class="form-control" id="Kode_Materi" placeholder="Masukkan Kode Materi" name="Kode_Materi">
                        </div>
                        <div class="form-group">
                            <label for="Nama_Materi">Judul Materi</label>
                            <input type="text" class="form-control" id="Nama_Materi" placeholder="Masukkan Judul Materi" name="Nama_Materi">
                        </div>
                        <div class="form-group">
                            <label for="Deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" id="Deskripsi" placeholder="Masukkan Deskripsi" name="Deskripsi">
                        </div>
                            <div class="form-group">
                                <label for="Thumbnail">Upload Thumbnail</label>
                                <input type="file" class="form-control-file" name="Thumbnail">
                            </div>
                    </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>

        <!-- tabel -->
        <div class="table-hover table-responsive-sm">
            <table class="table">
                <thead class="thead-white" style="background-color:#C0C0C0;">
                    <tr>
                        <th scope="col">Urut</th>
                        <th scope="col">Kode Materi</th>
                        <th scope="col">Materi</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="co1">Tes</th>
                        <th scope="co1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materi as $mtr)
                        <tr>
                            <td hidden>{{$mtr->Materi_Id}}</td>
                            <td>{{$mtr->Urut}}</td>
                            <td>{{$mtr->Kode_Materi}}</td>
                            <td>{{$mtr->Nama_Materi}}</td>
                            <td>{{$mtr->Deskripsi}}</td>
                            <td>
                                <a href="/materi/{{$mtr->Materi_Id}}/Thumbnail">{{$mtr->Thumbnail}}</a>
                                
                            </td>
                            <td>
                                <a href="/tesawal/{{ $mtr->Materi_Id }}" method="post" class="btn btn-link btn-sm">Tes Awal</a>
                                <a href="/tesakhir/{{ $mtr->Materi_Id }}" method="post" class="btn btn-link btn-sm">Tes Akhir</a>
                            </td>
                            <td>
                                <a href="/subbab/{{$mtr->Materi_Id}}/index" class="btn btn-success btn-sm">Sub Bab</a>
                                <a href="#" method="POST" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="{{$mtr->Materi_Id}}" data-kode="{{$mtr->Kode_Materi}}"  data-urut="{{$mtr->Urut}}" 
                                    data-nama="{{$mtr->Nama_Materi}}" data-deskripsi="{{$mtr->Deskripsi}}"  data-thumbnail="{{$mtr->Thumbnail}}">Edit</a>
                                <a id="btn-delete" href=""  data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" data-delete="{{$mtr->Materi_Id}}">Delete</a>
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
                                    <div style="width:100%;" class="modal-body">
                                        <form method="POST" action="/materi/delete" id="#Group_Id_Delete" enctype="multipart/form-data">
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
                                        <h5 class="modal-title" id="editModalLabel">Edit Materi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form style="width:100%;" method="POST" action="/materi/update" id="#formEditGroup" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="Materi_Id_Edit" hidden>Materi Id</label>
                                            <input type="text" hidden class="form-control" id="Materi_Id_Edit"  name="Materi_Id_Edit">
                                        </div>
                                        <div class="form-group">
                                            <label for="Urut_Edit">Urut</label>
                                            <input type="text" class="form-control" id="Urut_Edit" placeholder="Masukkan Urut" name="Urut_Edit" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="Kode_Materi_Edit">Kode Materi</label>
                                            <input type="text" class="form-control" id="Kode_Materi_Edit" placeholder="Masukkan Kode Materi" name="Kode_Materi_Edit">
                                        </div>
                                        <div class="form-group">
                                            <label for="Nama_Materi_Edit">Judul Materi</label>
                                            <input type="text" class="form-control" id="Nama_Materi_Edit" placeholder="Masukkan Judul Materi" name="Nama_Materi_Edit">
                                        </div>
                                        <div class="form-group">
                                            <label for="Deskripsi_Edit">Deskripsi</label>
                                            <input type="text" class="form-control" id="Deskripsi_Edit" placeholder="masukkan Deskripsi" name="Deskripsi_Edit" >
                                        </div>
                                        <div class="form-group">
                                            <label for="Thumbnail">Upload Thumbnail</label>
                                            <input type="file" class="form-control-file" id="Thumbnail_Edit" name="Thumbnail_Edit">
                                        </div>
                                        <div class="form-group">
                                            <label for="Thumbnail" hidden>Thumbnail Save</label>
                                            <input type="text" class="form-control-file" id="Thumbnail_Save" name="Thumbnail_Save" hidden>
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
      var Id = button.data('id') // Extract info from data-* attributes
      var urutt = button.data('urut')
      var kode_materi=button.data('kode')
      var nama_materi=button.data('nama')
      var deskripsi=button.data('deskripsi')
      var thumbnail=button.data('thumbnail')

      $('#Materi_Id_Edit').val(Id)
      $('#Urut_Edit').val(urutt)
      $('#Kode_Materi_Edit').val(kode_materi)
      $('#Nama_Materi_Edit').val(nama_materi)
      $('#Deskripsi_Edit').val(deskripsi)
      $('#Thumbnail_Save').val(thumbnail)
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('delete') // Extract info from data-* attributes

        $('#Materi_Id_Delete').val(recipient)
        
    });


</script>

</body>
</html>
@endsection