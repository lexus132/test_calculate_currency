@extends('layouts.app')

@section('content')

    <script>
        let apis = {!! json_encode($data['apiList'], JSON_UNESCAPED_UNICODE) !!};
    </script>

    @if(!empty($data['apiList']))
        <div class="row" id="source">

            <div class="col-lg-12 mb-12 form-group copyable bg-primary h-100 d-flex" style="border-radius: 5px;padding: 25px 0px;">
                    <label class="col-md-2 col-form-label form-control-label">Select source: </label>
                    <div class="col-md-8">
                        <select class="form-control" name="source">
                            <option></option>
                            @foreach($data['apiList'] as $item)
                                <option value="{{ $item['title'] }}">{{ $item['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>

            <div class="col-md-12">
                <div class="form-group row copyable">

                </div>
            </div>
        </div>
    @endif

    <div class="row" id="convert">

        <div class="col-md-12">
            <div class="form-group row copyable">
                <label class="col-md-2 col-form-label form-control-label text-muted">From: </label>
                <div class="col-md-4">
                    <select class="form-control" name="cur_from" id="cur_from">
                    </select>
                </div>
                <label class=" offset-md-1 col-md-1 col-form-label form-control-label text-muted">To:</label>
                <div class="col-md-4">
                    <select class="form-control" name="cur_to" id="cur_to">
                    </select>
                </div>

            </div>
            <div class="form-group row copyable">
                <label class="col-lg-2 col-form-label form-control-label text-muted">Value: </label>
                <div class="col-md-4">
                    <input class="form-control" type="text" placeholder="" name="cur_val">
                </div>
                <input type="button" class="btn btn-primary mr-2 copyable offset-md-4" value="Calculate"></a>
            </div>
        </div>

    </div>
    <br>
    <div class="row"  id="rezult">
        <div class="col-lg-12 mb-12">
            <div class="card border-primary h-100 copyable">
                <div class="card-body d-flex flex-column align-items-start">
                    <h4 class="card-title text-primary">Rezult:</h4>
                    <h1 class="text-warning text-center"></h1>
                </div>
            </div>
        </div>
    </div>


@endsection
