<button class="btn btn-info" data-toggle="modal" data-target="#editBook{{$book->id}}"><i class="fa fa-edit"></i>edit</button>
@include('books.edit')
<button class="btn btn-danger"  onclick="confirmDelete('{{$book->id}}')" href="#"><i class="fa fa-trash"></i>delete</button>
<form id="delete_form-{{$book->id}}" action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST" style="display: none;">
    @csrf
    @method('delete')
</form>
