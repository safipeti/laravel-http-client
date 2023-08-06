@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mt-5 mb-5 text-center">Episodes</h1>
        <section class="search mb-5">
            @include('inc.searchform')
        </section>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">
                        <i class="fa-solid fa-users"></i>
                    </th>
                    <th scope="col">Episode</th>
                    <th scope="col">Name</th>
                    <th scope="col">Air Date</th>
                    <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody>
            @foreach($episodes as $episode)
                <tr>
                    <th scope="row">
                        <i
                            class="fa-solid fa-users"
                            data-bs-toggle="modal"
                            data-bs-target="#episodeModal_{{ $episode->episode }}"
                        ></i>
                        <div class="modal" tabindex="-1" id="episodeModal_{{ $episode->episode }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Characters of <span class="text-danger">{{ $episode->name }} - ({{ $episode->episode }})</span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                        @foreach($episode->characters as $chars)
                                            <li
                                                class="list-group-item character"
                                            >
                                                <img
                                                    src="{{ $chars->image }}"
                                                    class="inline-block mr-2 rounded"
                                                />{{ $chars->name }}
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </th>
                    <th scope="row"><span>{{ $episode->episode }}</span></th>
                    <td>{{ $episode->name }}</td>
                    <td>{{ (new DateTime($episode->air_date))->format("F j, Y") }}</td>
                    <td>{{ (new DateTime($episode->created))->format("F j, Y") }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-3 mb-3 mt-5 d-flex justify-center">
            {{ $episodes->onEachSide(5)->links() }}
        </div>
    </div>
@endsection
