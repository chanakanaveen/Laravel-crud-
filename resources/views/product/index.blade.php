<x-app-layout>

      <div class="card">
        <div class="card-header">
            <div class="float-left"> My Product</div>
            <div class="float-right">
                <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Add Product</a>
            </div>
        </div>
        <div class="card-body">
            @if (Session::has('messages'))
                <div class="alert alert-primary" role="alert">
                    {{ Session::get('messages') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <th scope="row"><img src="{{ asset('images') }}/{{ $product->image_path }}" alt="" style="width: 50px"></th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                        <a href="{{ route('product.show',$product->slug) }}" class="btn btn-sm btn-warning">View</i></a>
                        <a href="{{ route('product.edit',$product->slug) }}" class="btn btn-sm btn-success">Edit</i></a>
                        <a href="{{ route('product.delete',$product->id) }}" class="btn btn-sm btn-danger">Delete</i></a>
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
        </div>
      </div>
</x-app-layout>
