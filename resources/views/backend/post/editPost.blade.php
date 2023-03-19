@extends('layouts.backendapp')

@push('customCss')
    <style>

    </style>
@endpush

@section('backendContent')
    <div class="card">
        <div class="card-header">Add Post</div>
        <div class="card-body " style="padding: 20px 40px">
            <form action="{{ route('post.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row">
                    <input type="text" name="title" placeholder="Post Title" class="form-control"
                        value="{{ $post->title }}" style=" margin: 10px 0;">
                    @error('title')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">

                    <div class="col">
                        <select name="category_id" id="" class="form-control flex-grow-1" style=" margin: 10px 0;">
                            <option selected disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option class="category" value="{{ $category->id }}"
                                    {{ $category->id === $post->category_id ? 'selected' : '' }}>{{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <select name="sub_category_id" id="" class="form-control flex-grow-1"
                            style=" margin: 10px 0;">
                            <option selected disabled>Select SubCategory</option>
                            @foreach ($subCategories as $subcategory)
                                <option class="subs-{{ $subcategory->category_id }}"
                                    id="sub-{{ $subcategory->category_id }}" value="{{ $subcategory->id }}"
                                    {{ $subcategory->id === $post->sub_category_id ? 'selected' : '' }}>
                                    {{ $subcategory->title }}</option>
                            @endforeach
                        </select>
                        @error('sub_category_id')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col">
                        <select name="type" class="form-control" style=" margin: 10px 0;">
                            <option disabled>Select Type</option>
                            <option value="trending" {{ $post->type === 'trending' ? 'selected' : '' }}>Trending</option>
                            <option value="hot" {{ $post->type === 'hot' ? 'selected' : '' }}>Hot Topic</option>
                        </select>
                        @error('type')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>


                </div>

                <div class="row">
                    <label for="">
                        Featured Image
                        <input type="file" name="featured_img" class="form-control">
                        @error('featured_img')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </label>
                </div>



                <div class="editor" style="margin: 20px 0">
                    <textarea name="content" id="content" class="form-control" placeholder="Editor or Content Here">
                        {{ $post->content }}
                    </textarea>
                    @error('content')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>

                {{-- <div class="row">
                    <input type="text" name="tags" class="form-control" placeholder="Hash Tags">
                </div> --}}

                <button class="btn-primary btn" style="width:100%;margin:20px 0;">Submit</button>

            </form>
        </div>
    </div>
@endsection

@push('customJs')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

        //hide subcategories when selected category
        const category = $("[name='category_id']");
        category.change(function(e) {
            $("[class*='subs-']").show() //show every options
            console.log('changed');
            const sub = $("[class*='subs-']").not(
                `.subs-${e.target.value}`); //select options that is not related to the category
            sub.hide() //hide them

        })
    </script>
@endpush
