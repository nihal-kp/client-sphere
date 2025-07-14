@extends("admin.layouts.app")
@section('title', $client->id ? 'Edit' : 'Add' . ' Client')
@section("content")

    @php
        use App\Enums\UserStatus;
    @endphp

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">{{ $client->id ? 'Edit' : 'Add' }} Client</h1>
        
        <form method="POST" action="{{ $client->id ? route('admin.clients.update',$client->id) : route('admin.clients.store') }}" enctype="multipart/form-data">
        @csrf
        {{ $client->id ? method_field('PUT') : '' }}
        <div class="card shadow mb-4">
            <div class="card-body">
                
                <h3 class="font-size-lg text-dark font-weight-bold mb-3">Client</h3>
                <div class="row">
                    <div class="form-group col-6">
                        <b><label>Name* :</label></b>
                        <input type="text" class="form-control" name="name" value="{{old('name', ($client->name ? $client->name : '' ))}}">
                        @error("name")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <b><label>Email* :</label></b>
                        <input type="text" class="form-control" name="email" value="{{old('email', ($client->email ? $client->email : '' ))}}">
                        @error("email")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <b><label>Phone* :</label></b>
                        <input type="text" class="form-control" name="phone" value="{{old('phone', ($client->phone ? $client->phone : '' ))}}">
                        @error("phone")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <b><label>Image (500 x 500 px){{ !$client->id ? '*' : '' }} :</label></b>
                        <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" onchange="document.getElementById('uploaded_img').src = window.URL.createObjectURL(this.files[0])" title="">
                        <label class="custom-file-label" for="customFile">{{ $client->image ? $client->image : 'Choose file' }}</label>
                        <img id="uploaded_img" alt="Image" width="130" height="100" src="{{ $client->image ? asset('uploads/clients/'.$client->image) : asset('img/upload_image.png') }}" />
                        </div>
                        @error("image")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <b><label>Password{{ !$client->id ? '*' : '(leave blank to keep current)' }} :</label></b>
                        <input type="password" class="form-control" name="password">
                        @error("password")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <b><label>Confirm Password{{ !$client->id ? '*' : '' }} :</label></b>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error("password_confirmation")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <b><label class="" style="">Status* :</label></b>
                        <select class="form-control" name="status">
                            @foreach(UserStatus::cases() as $status)
                                <option value="{{ $status->value }}" {{ old('status', $client->status ? $client->status->value : '') == $status->value ? 'selected' : '' }}>
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error("status")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                </div>   
            </div>
            
            <div class="card-footer">
                <div class="row">
                    <div class="form-group col-6">
                    <button type="submit" class="btn btn-success mr-3">Save</button>
                    <a class="btn btn-secondary ml-3" href="{{ route('admin.clients.index') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
        
        
    </div>
    <!-- /.container-fluid -->
@endsection

@push('style')

@endpush

@push('script')
    <script type="text/javascript">
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endpush