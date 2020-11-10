@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-12">

            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            <h1 class="display-3">{{__('Invoices')}}</h1>
                <div>
                    <a style="margin: 19px;" href="{{ route('invoices.create')}}" class="btn btn-primary">{{__('New Invoice')}}</a>
                </div>

                <table class="table table-striped">
                <thead>
                <tr>
                    <td>{{__('id')}}</td>
                    <td>{{__('Series')}}</td>
                    <td>{{__('Sequence')}}</td>
                    <td>{{__('Seller')}}</td>
                    <td>{{__('Buyer')}}</td>
                    <td>{{__('Date')}}</td>
                    <td colspan = 2>{{__('Actions')}}</td>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->series}}</td>
                        <td>{{$invoice->sequence}}</td>
                        <td>{{$invoice->seller->name}} - {{$invoice->seller->code}}</td>
                        <td>{{$invoice->buyer->name}} - {{$invoice->buyer->code}}</td>
                        <td>{{date('d-m-Y', strtotime($invoice->date)) }}</td>
                        <td>
                            <a href="{{ route('invoices.show',$invoice->id)}}" class="btn btn-primary">{{__('Show')}}</a>
                        </td>
                        <td>
                            <form action="{{ route('invoices.destroy', $invoice->id)}}" method="post">
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
