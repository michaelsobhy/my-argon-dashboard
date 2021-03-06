@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="table-responsive">
        <div>
            <table class="table align-items-center">
                <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort" data-sort="like_id">like_id</th>
                    <th scope="col" class="sort" data-sort="user_id">user_id</th>
                    <th scope="col" class="sort" data-sort="username">username</th>
                    <th scope="col" class="sort" data-sort="post_id">post_id</th>
                    <th scope="col" class="sort" data-sort="deleted_at">deleted_at</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @if($likes -> count())
                    @foreach($likes as $like)
                        <tr>
                            <td class="like_id">
                                {{ $like->id }}
                            </td>

                            <td class="user_id">
                                {{ $like->user->id }}
                            </td>

                            <td class="username">
                                {{ $like->user->username }}
                            </td>

                            <td class="post_id">
                                {{ $like->post_id }}
                            </td>

                            <td class="deleted_at">
                                {{ $like->deleted_at }}
                            </td>

                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                       data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        @if(! $like->trashed())
                                            <form action="{{ route('likes.unpublish', $like) }}" method="post"
                                                  class="p-3 inline">
                                                @csrf
                                                <button class="dropdown-item" type="submit">unpublish</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('likes.delete', $like->id) }}" method="post"
                                              class="p-3 inline">
                                            @csrf
                                            <button class="dropdown-item" type="submit">delete</button>
                                        </form>
                                        {{--                                        <a class="dropdown-item" href="#">Action</a>--}}
                                        {{--                                        <a class="dropdown-item" href="#">Another action</a>--}}
                                        {{--                                        <a class="dropdown-item" href="#">Something else here</a>--}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $likes->links() !!}
            </div>
        </div>

    </div>
    @include('layouts.footers.auth')
    </div>
@endsection
