@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">{{__('Add a customer')}}</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{__('Name:')}}</label>
                        <input type="text" class="form-control" name="name"/>
                    </div>

                    <div class="form-group">
                        <label for="phone">{{__('Phone:')}}</label>
                        <input type="text" class="form-control" name="phone"/>
                    </div>

                    <div class="form-group">
                        <label for="code">{{__('Code:')}}</label>
                        <input type="text" class="form-control" name="code"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Add customer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
