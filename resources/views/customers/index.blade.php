@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-12">

            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            <h1 class="display-3">{{__('Customers')}}</h1>
                <div>
                    <a style="margin: 19px;" href="{{ route('customers.create')}}" class="btn btn-primary">{{__('New Customer')}}</a>
                </div>

                <table class="table table-striped">
                <thead>
                <tr>
                    <td>{{__('id')}}</td>
                    <td>{{__('Name')}}</td>
                    <td>{{__('Phone')}}</td>
                    <td>{{__('Code')}}</td>
                    <td colspan = 2>{{__('Actions')}}</td>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{$customer->id}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->code}}</td>
                        <td>
                            <a href="{{ route('customers.edit',$customer->id)}}" class="btn btn-primary">{{__('Edit')}}</a>
                        </td>
                        <td>
                            <form action="{{ route('customers.destroy', $customer->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">{{__('Delete')}}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
            </div>
@endsection
