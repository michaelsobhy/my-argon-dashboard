@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="table-responsive">
        <div>
            <table class="table align-items-center">
                <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort" data-sort="comment_id">comment_id</th>
                    <th scope="col" class="sort" data-sort="user_id">user_id</th>
                    <th scope="col" class="sort" data-sort="username">username</th>
                    <th scope="col" class="sort" data-sort="post_id">post_id</th>
                    <th scope="col" class="sort" data-sort="body">body</th>
                    <th scope="col" class="sort" data-sort="deleted_at">deleted_at</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @if($comments -> count())
                    @foreach($comments as $comment)
                        <tr>
                            <td class="comment_id">
                                {{ $comment->id }}
                            </td>

                            <td class="user_id">
                                {{ $comment->user->id }}
                            </td>

                            <td class="username">
                                {{ $comment->user->username }}
                            </td>

                            <td class="post_id">
                                {{ $comment->post_id }}
                            </td>

                            <td class="body">
                                {{ $comment->body }}
                            </td>

                            <td class="deleted_at">
                                {{ $comment->deleted_at }}
                            </td>

                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                       data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        @if(! $comment->trashed())
                                            <form action="{{ route('comments.unpublish', $comment) }}" method="post"
                                                  class="p-3 inline">
                                                @csrf
                                                <button class="dropdown-item" type="submit">unpublish</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('comments.delete', $comment->id) }}" method="post"
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
                {!! $comments->links() !!}
            </div>
        </div>

    </div>
    @include('layouts.footers.auth')
    </div>
@endsection
