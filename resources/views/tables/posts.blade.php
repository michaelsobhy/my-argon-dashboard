@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="table-responsive">
        <div>
            <table class="table align-items-center">
                <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort" data-sort="post_id">post_id</th>
                    <th scope="col" class="sort" data-sort="user_id">user_id</th>
                    <th scope="col" class="sort" data-sort="username">username</th>
                    <th scope="col" class="sort" data-sort="body">body</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @if($posts -> count())
                    @foreach($posts as $post)
                        <tr>
                            <td class="post_id">
                                {{ $post->id }}
                            </td>

                            <td class="user_id">
                                {{ $post->user->id }}
                            </td>

                            <td class="post_id">
                                {{ $post->user->username }}
                            </td>

                            <td class="user_id">
                                {{ $post->body }}
                            </td>

                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <form action="{{ route('posts.delete', $post) }}" method="post" class="p-3 inline">
                                            @csrf
                                            <button type="submit">delete</button>
                                        </form>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif



                </tbody>
            </table>
        </div>

    </div>
    @include('layouts.footers.auth')
    </div>
@endsection
