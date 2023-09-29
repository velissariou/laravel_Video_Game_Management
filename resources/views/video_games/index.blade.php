@extends('video_games.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>
                </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('dashboard') }}"> Dashboard</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('video_games.create') }}"> Create New Video Game</a>
            </div>
            <form method="GET" action="{{ route('video_games.index') }}">
                <div class="form-group">
                    <label for="genre">Filter by Genre:</label>
                    <select name="genre" id="genre" class="form-control">
                        <option value="">All Genres</option>
                        @foreach ($genres as $genre)
                        <option value="">{{ $genre }}</option>
                        @endforeach
                        <!-- Add more genre options as needed -->
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </form>
        
            <!-- Sorting Links -->
            <div class="mt-3">
                <strong>Sort By:</strong>
                <a href="{{ route('video_games.index', ['sort' => 'asc']) }}">Release Date (Ascending)</a> |
                <a href="{{ route('video_games.index', ['sort' => 'desc']) }}">Release Date (Descending)</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Genre</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($videoGames as $videoGame)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $videoGame->title }}</td>
            <td>{{ $videoGame->description }}</td>
            <td>{{ $videoGame->release_date }}</td>
            <td>{{ $videoGame->genre }}</td>
            <td>
                <form action="{{ route('video_games.destroy',$videoGame->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('video_games.show',$videoGame->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('video_games.edit',$videoGame->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $videoGames->links() !!}
@endsection