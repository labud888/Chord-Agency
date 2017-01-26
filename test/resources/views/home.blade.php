@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <form class="form-horizontal" id="#myForm>
                        {{ csrf_field() }}
                      <select id="done" class="selectpicker" name="data">
                                 @foreach ($group as $key => $values)
                                    <optgroup label="{{$key}}">
                                    @foreach ($values as $key => $value)
                                    <option class="heading-opt" disabled>{{$key}}</option>
                                        @foreach ($value as $v)
                                         <option value="{{$v->id}}">Group {{$v->groups_id}} - {{ $v->postcode }}</option>
                                         @endforeach
                                    @endforeach
                                    </optgroup>
                               @endforeach
                      </select>
                      </form>
                          <h2>Bordered Table</h2>
                          <p>The .table-bordered class adds borders to a table:</p>
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>5 Closest bus stops</th>
                                <th>Schools in 20km radius</th>
                                <th>Addresses in that postcode</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                              <td id="bus"></td>
                              <td id="school"></td>
                              <td id="address"></td>
                              </tr>
                            </tbody>
                          </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ elixir('/js/form.js')}}"></script>
@endpush
