@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="table-responsive">
        <div>
            <table class="table align-items-center">
                <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort" data-sort="post_id">user_id</th>
                    <th scope="col" class="sort" data-sort="username">username</th>
                    <th scope="col" class="sort" data-sort="email">email</th>
                    <th scope="col" class="sort" data-sort="password">password</th>
                    <th scope="col" class="sort" data-sort="deleted_at">deleted_at</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @if($users -> count())
                    @foreach($users as $user)
                        <tr>
                            <td class="user_id">
                                {{ $user->id }}
                            </td>

                            <td class="username">
                                {{ $user->username }}
                            </td>

                            <td class="email">
                                {{ $user->email }}
                            </td>

                            <td class="password">
                                {{ $user->password }}
                            </td>

                            <td class="deleted_at">
                                {{ $user->deleted_at }}
                            </td>

                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                       data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        @if(! $user->trashed())
                                            <form action="{{ route('users.unpublish', $user) }}" method="post"
                                                  class="p-3 inline">
                                                @csrf
                                                <button class="dropdown-item" type="submit">unpublish</button>
                                            </form>
                                        @else
                                            <form action="{{ route('users.publish', $user->id) }}" method="post"
                                                  class="p-3 inline">
                                                @csrf
                                                <button class="dropdown-item" type="submit">publish</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('users.delete', $user->id) }}" method="post"
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
                {!! $users->links() !!}
            </div>
        </div>

    </div>
    @include('layouts.footers.auth')
    </div>
@endsection
