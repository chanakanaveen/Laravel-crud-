<x-app-layout>

    <div class="card">
        <div class="card-header">
            <div class="float-left"> Product Update</div>
            <div class="float-right">
                <a href="/index" class="btn btn-sm btn-primary">My Product</a>
            </div>
        </div>
        <div class="card-body">
            @if (Session::has('messages'))
                <div class="alert alert-primary" role="alert">
                    {{ Session::get('messages') }}
                </div>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-primary" role="alert">
                    {{$error}}
                </div>
                @endforeach
            @endif

            <form action="{{ route('product.update',$product->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}"  id="exampleFormControlInput1">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Price</label>
                    <input type="text" name="price" class="form-control" value="{{ $product->price }}" id="exampleFormControlInput1">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Status</label>
                    <input type="text" name="status" class="form-control" value="{{ $product->status }}" id="exampleFormControlInput1">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">choose Image</label>
                    <img src="{{ asset('images') }}/{{ $product->image_path }}" alt="" style="width: 300px">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">choose Image</label>
                    <input type="file" name="image" class="form-control" id="exampleFormControlInput1">
                </div>
                <button type="submit" class="btn btn-sm btn-success active float-right">Product Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
