@extends("admin.layouts.app")
@section('title', $textBox->id ? 'Edit' : 'Add' . ' Text Box')
@section("content")

    @php
        use App\Enums\UserStatus;
    @endphp

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">{{ $textBox->id ? 'Edit' : 'Add' }} Text Box</h1>
        
        <form method="POST" action="{{ $textBox->id ? route('admin.text-boxes.update',$textBox) : route('admin.text-boxes.store') }}" enctype="multipart/form-data">
        @csrf
        {{ $textBox->id ? method_field('PUT') : '' }}
        <div class="card shadow mb-4">
            <div class="card-body">
                
                <h3 class="font-size-lg text-dark font-weight-bold mb-3">Text Box</h3>
                <div class="row">
                    <div class="form-group col-6">
                        <b><label>Label* :</label></b>
                        <input type="text" class="form-control" name="label" value="{{old('label', ($textBox->label ? $textBox->label : '' ))}}">
                        @error("label")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <b><label>Value* :</label></b>
                        <input type="text" class="form-control" name="value" value="{{old('value', ($textBox->value ? $textBox->value : '' ))}}">
                        @error("value")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <b><label for="clients" class="" style="">Clients* :</label></b>
                        <select class="form-control" id="clients" name="clients[]" multiple>
                            @foreach(getClients() as $id => $name)
                                <option value="{{ $id }}" {{ in_array($id, old('clients', $selectedClients ?? [])) ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error("clients")
                            <p style="color:red">{{ $message }}</p>
                        @enderror
                    </div>
                </div>   
            </div>
            
            <div class="card-footer">
                <div class="row">
                    <div class="form-group col-6">
                    <button type="submit" class="btn btn-success mr-3">Save</button>
                    <a class="btn btn-secondary ml-3" href="{{ route('admin.text-boxes.index') }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
        
        
    </div>
    <!-- /.container-fluid -->
@endsection

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#clients').select2({
                placeholder: "Select clients",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    
@endpush