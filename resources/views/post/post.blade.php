<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex">
                        <div class="flex-1">
                            <form action="{{ route ('add.post')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3 ">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Post</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="form-control" id="inputEnterYourName"
                                            placeholder="Enter Title">
                                        <span style="color: red;"> @error('title') {{$message}} @enderror</span>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-4">
                                    <label for="inputAddress4" class="col-sm-3 col-form-label"> Content</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="content" id="editor1" rows="3"
                                            placeholder="content"></textarea>
                                        <span style="color: red;"> @error('content') {{$message}} @enderror</span>
                                    </div>
                                </div>
                                <div class="row  float-end">
                                    <div class="">
                                        <button type="submit" class="btn btn-primary px-5">Add Post</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="flex-1 ms-5">
                            @foreach($posts as $post)
                            <div class="d-flex">
                                <p>Post Title :<a href="#">{{$post->title}}</a><span class="ml-2  px-3 "><a
                                            href="{{route('edit.post',$post->id)}}" class="btn btn-success">Edit</a>
                                    </span></p>
                                <form action="{{route('delete.post')}}" method="POST" id="delete">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id}}">
                                    <button type="submit" class="btn btn-danger" title="Delete">Delete</button>
                                </form>
                            </div>
                            @endforeach


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</x-app-layout>