@extends('layouts.backendapp')

@push('customCss')
<style>

</style>
@endpush

@section('backendContent')

<div class="card">
    <div class="card-header">Add Post</div>
    <div class="card-body " style="padding: 20px 40px">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="text" name="title" placeholder="Post Title" class="form-control">
            </div>
            <div class="row">

                <select name="category_id" id="" class="form-control" style="width: 33.33%; margin: 10px 0;">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <select name="subCategory_id" id="" class="form-control" style="width: 33.33%; margin: 10px 0;">
                    @foreach ($subCategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                    @endforeach
                </select>
                <select name="type"  class="form-control" style="width: 33.33%; margin: 10px 0;">
                    <option value="trending">Trending</option>
                    <option value="hot">Hot Topic</option>
                </select>


            </div>

            <div class="row">
                <label for="">
                    Featured Image
                    <input type="file" name="featured" class="form-control">
                    @error('featured')
                    <span style="color:red">{{ $message }}</span>
                    @enderror
                </label>
            </div>



            <div class="editor" style="margin: 20px 0">
                <textarea name="content" id="content" class="form-control"
                    placeholder="Editor or Content Here"></textarea>
            </div>

            <div class="row">
                <input type="text" name="hash_tag" class="form-control" placeholder="Hash Tags">
            </div>

            <button class="btn-primary btn" style="width:100%;margin:20px 0;">Submit</button>

        </form>
    </div>
</div>

@endsection

@push('customJs')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#content' ) )
    .catch( error => {
    console.error( error );
    } );
</script>
@endpush