@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Ask Question Questions</h2>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back To All Question
                                    </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{route('questions.store')}}" method="post">
                           @include('questions.form',['btnText'=>'Ask Question'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
