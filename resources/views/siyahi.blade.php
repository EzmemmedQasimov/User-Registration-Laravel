@extends('layout.layout')
@section('title','Siyahı')

@section('content')
    <h4 class="display-4 text-center">Siyahı!</h4>
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
    @endif
    <div style="margin: auto" class="col-md-12 ">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Şəkil</th>
                <th scope="col">Ad Soyad</th>
                <th scope="col">Vəzifə</th>
                <th scope="col">Maaş</th>
                <th scope="col">Av</th>
                <th scope="col">Qey/Tarixi</th>
                <th scope="col">Müq/Tarixi</th>
                <th scope="col">Əməliyyatlar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">1</th>
                    <td>....</td>
                    <td>{{ $user->adsoyad }}</td>
                    <td>{{ $user->vezife }}</td>
                    <td>{{ $user->maas }} AZN</td>
                    <td>{{ $user->av ? "Evli" : "Subay" }}</td>
                    <td>{{ $user->qeytarixi }}</td>
                    <td>{{ $user->muqmuddeti }}</td>
                    <td>
                        <button data-toggle="modal" data-target="#exampleModal" onclick="Edit({{ $user->id }})" class="btn btn-outline-info">Redaktə</button>
                        <button onclick="Delete({{ $user->id }})" class="btn btn-outline-danger">Sil</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">İstifadəçi redaktə</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('UserEdit') }}">
                        @csrf
                        <input type="hidden" name="id" value="" id="editid" />
                        <div class="form-group">
                            <label for="adsoyad" class="col-form-label">Ad Soyad:</label>
                            <input type="text" class="form-control" name="adsoyad" id="adsoyad">
                        </div>
                        <div class="form-group">
                            <label for="vezife" class="col-form-label">Vəzifə:</label>
                            <input type="text" class="form-control" name="vezife" id="vezife">
                        </div>
                        <div class="form-group">
                            <label for="maas" class="col-form-label">Maaş:</label>
                            <input type="number" step="0.01" class="form-control" name="maas" id="maas">
                        </div>
                        <div class="form-group">
                            <label for="av">Ailə Vəziyyəti</label>
                            <select required="required" class="form-control" name="av" id="av">
                                <option value="" selected>Ailə Vəziyyətini seçin</option>
                                <option value="1">Evli</option>
                                <option value="0">Subay</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="muqmuddeti" class="col-form-label">Müqavilə Müddəti:</label>
                            <input type="date"  class="form-control" name="muqmuddeti" id="muqmuddeti">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                            <button  class="btn btn-primary">Redaktə Et</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function Edit(id) {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "user-edit-view",
                data: { _token: CSRF_TOKEN, id: id },
                method: "POST",
                success: function (data) {
                    data = JSON.parse(data);
                    document.getElementById("editid").value = id;
                    document.getElementById("adsoyad").value  = data[0].adsoyad;
                    document.getElementById("vezife").value  = data[0].vezife;
                    document.getElementById("maas").value  = data[0].maas;
                    document.getElementById("av").value = data[0].av;
                    document.getElementById("muqmuddeti").value = data[0].muqmuddeti.substr(0,10);

                },

                error: function (x, sts) {
                    console.log("Error...");
                },
            });
        }

        function Delete(id) {
           let dlt =  confirm("İşçinin informasiyalarını silməyə əminsinizmi?");
           if(dlt){
                location.href = "user-delete/"+id;
           }
           else{
               alert("İmtina edildi!");
           }

        }
    </script>
@endsection

