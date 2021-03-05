@extends('layout.layout')
@section('title','Qeydiyyat Bölməsi')

@section('content')
    <h4 class="display-4 text-center">Qeydiyyat!</h4>
    <div style="margin: auto" class="col-md-4 ">
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
        @endif
        <form method="POST" action="{{ route('qeydiyyat') }}">
            @csrf
            <div class="form-group">
                <label for="sekil">Şəkil</label>
                <input type="file" class="form-control" required="required" name="sekil" id="sekil" >
            </div>
            <div class="form-group">
                <label for="adsoyad">Ad Soyad</label>
                <input type="text" class="form-control" required="required" name="adsoyad" id="adsoyad" >
            </div>
            <div class="form-group">
                <label for="vezife">Vəzifə</label>
                <input type="text" class="form-control" required="required" name="vezife" id="vezife" >
            </div>
            <div class="form-group">
                <label for="maas">Maaş</label>
                <input type="number" step="0.01" required="required" class="form-control" name="maas" id="maas" >
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email"  onkeyup="EmailCheck(this.value)" class="form-control" required="required" name="email" id="email" >
                <span class="msg" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label for="av">Ailə Vəziyyəti</label>
                <select required="required" class="form-control" name="av" id="av">
                    <option value="" selected>Ailə Vəziyyətini seçin</option>
                    <option value="1">Evli</option>
                    <option value="0">Subay</option>
                </select>
            </div>
            <button class="btn btn-outline-info btn-block">Submit</button>
        </form>
    </div>
@endsection
@section('js')
    <script>
        function EmailCheck(email) {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "qeydiyyat-email-yoxla",
                data: { _token: CSRF_TOKEN, email: email },
                method: "POST",
                success: function (data) {
                   if(data.length > 0){
                       console.log(1);
                       document.getElementsByClassName("msg")[0].innerHTML = "Email artıq istifadədir!";
                       document.getElementsByClassName("btn")[0].disabled = true;
                   }
                   else{
                       console.log(0);
                       document.getElementsByClassName("msg")[0].innerHTML = "";
                       document.getElementsByClassName("btn")[0].disabled = false;
                   }
                },

                error: function (x, sts) {
                    console.log("Error...");
                },
            });
        }
    </script>
@endsection
