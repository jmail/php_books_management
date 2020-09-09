<div class="modal fade" id="editBook{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">update: {{$book->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('books.update', ['id' => $book->id])}}" id="bookUpdate">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Book Name" id="exampleFormControlInput1" name="name" value="{{$book->name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Category</label>
                        <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{$book->category_id === $category->id
                                 ? 'selected' : ''}}>{{$category->name}}</option>
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
                <button type="submit" form="bookUpdate" class="btn btn-primary">update</button>
            </div>
        </div>
    </div>
</div>
{{--@section('js')--}}
{{--    <script>--}}
{{--        @if(count($errors))--}}
{{--        $('#editBook{{$book->id}}').modal('show');--}}
{{--        @endif--}}
{{--    </script>--}}
{{--@endsection--}}
