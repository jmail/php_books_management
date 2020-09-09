<div class="modal fade" id="createBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('books.store')}}" id="bookCreate">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="exampleFormControlInput1" placeholder="Book Name" name="name"
                               value="{{old('name')}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Category</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="exampleFormControlSelect1">
                            <option>please Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                    {{$category->id == old('category_id') ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="bookCreate" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
