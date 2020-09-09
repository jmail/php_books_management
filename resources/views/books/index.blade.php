@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List Books
                    <button id="openModalAgain" style="float: right" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createBookModal">
                        <i class="fa fa-plus"></i>  Add New Book
                    </button>
                    </div>
                    <div class="card-body">
                        @if($books->count() > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $index=>$book)
                                    <tr>
                                        <th scope="row">{{$index +1}}</th>
                                        <td>{{$book->name}}</td>
                                        <td>{{optional($book->category)->name}}</td>
                                        <td>@include('books.partials.buttons')</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$books->links()}}
                        @else
                            <h4 style="text-align: center">No Data To View</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Modal create -->
@include('books.create')

