@extends('adminlte::page')

@section('title', 'Client creation')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                                aria-selected="false">@lang('Detalhes')</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link " id="custom-tabs-three-profile-tab" data-toggle="pill"
                                href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                                aria-selected="true">@lang('Editar')</a>
                        </li>




                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                            aria-labelledby="custom-tabs-three-home-tab">

                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <dl class="row">
                                                <dt class="col-sm-4">@lang('Name')</dt>
                                                <dd class="col-sm-8">{{ $client->name }}</dd>

                                                <dt class="col-sm-4">@lang('ID Number')</dt>
                                                <dd class="col-sm-8">{{ $client->id_number }}</dd>

                                                <dt class="col-sm-4">@lang('Birthdate')</dt>
                                                <dd class="col-sm-8">{{ $client->birthdate }}</dd>

                                                <dt class="col-sm-4">@lang('Role')</dt>
                                                <dd class="col-sm-8">{{ $client->role }}</dd>

                                                <dt class="col-sm-4">@lang('Phone')</dt>
                                                <dd class="col-sm-8">{{ $client->phone }}</dd>

                                                <dt class="col-sm-4">@lang('Address')</dt>
                                                <dd class="col-sm-8">{{ $client->address }}</dd>

                                                <dt class="col-sm-4">@lang('Gender')</dt>
                                                <dd class="col-sm-8">{{ $client->gender }}</dd>
                                                <dt class="col-sm-4">@lang('Company')</dt>
                                                <dd class="col-sm-8">{{ $client->company }}</dd>



                                                <br>



                                            </dl>
                                        </div>



                                    </div>
                                    <form role="form" method="POST"
                                    action="{{ URL::route("clients.destroy", ['client' => $client->id]) }}" class="" id="delete-customers">

                                        @csrf
                                        @method("DELETE")

                                      <div class="row">
                                            <div class="col-12">



                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger save">@lang('Apagar')</button>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-success d-none saved">@lang('Apagado')</button>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-warning d-none saving"><i
                                                        class=" fas ion-ios-loop fa-spin"
                                                        aria-hidden="true"></i>@lang('Apagando')</button>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger d-none error">@lang('Erro')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-3">

                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('user-'.$client->id.'-user', 'QRCODE', 8,8) }}"
                                        alt="qrcode" width="150" style="object-fit: scale-down;" />
                                </div>
                            </div>
                        </div>





                        <div class="tab-pane fade " id="custom-tabs-three-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-three-profile-tab">

                            <form method="POST" role="form" action="{{ URL::route("clients.update", ['client' => $client->id]) }}"
                                id="create-customer">
                                @method("PUT")
                                @csrf

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="name">@lang('Name')</label>
                                        <input required type="text" name="name"
                                        value="{{ $client->name }}"

                                        class="form-control" id="name"
                                            placeholder="@lang('Januário Bambo')">
                                    </div>


                                    <div class="form-group col-sm-6">
                                        <label for="gender">@lang('Gender')</label>
                                        <select required class="selectpicker form-control"
                                            data-style="btn-outline-primary" name="gender">
                                            <option value="Male" @if($client->gender == "Male") selected @endif data-tokens="">
                                                Male
                                            </option>

                                            <option value="Female" @if($client->gender == "Female") selected @endif data-tokens="">
                                                Female
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <label for="id_number">@lang('ID Number')</label>
                                        <input required type="text" name="id_number" class="form-control" id="id_number"

                                        value="{{ $client->id_number }}"
                                            placeholder="080 100 650 308 A">
                                    </div>


                                    <div class="form-group col-sm-3">
                                        <label for="birthdate">@lang('Birthdate')</label>
                                        <input required type="date"
                                        value="{{ $client->birthdate }}"

                                        name="birthdate" class="form-control" id="birthdate"
                                            placeholder="080 100 650 308 A">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="phone">@lang('Telefone')</label>
                                        <input type="text" name="phone"
                                        value="{{ $client->phone }}"
                                        class="form-control" id="phone"
                                            placeholder="820011333">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="company">@lang('Company')</label>
                                        <input required type="text"
                                        value="{{ $client->company }}"

                                        name="company" class="form-control" id="company"
                                            placeholder="CSC ">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="role">@lang('Role')</label>
                                        <select required class="selectpicker form-control"
                                            data-style="btn-outline-primary" name="role">
                                            <option value="Estivador" @if($client->role == "Estivador") selected @endif data-tokens="">
                                                Estivador
                                            </option>

                                            <option value="Operario" @if($client->role == "Operario") selected @endif data-tokens="">
                                                Operario
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="address">@lang('Address')</label>
                                        <input type="text" name="address"
                                        value="{{ $client->address }}"

                                        class="form-control" id="address"
                                            placeholder="@lang('Av Acordos de Lusaka')">
                                    </div>




                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-primary save">@lang('Salvar')</button>
                                    </div>
                                </div>
                            </form>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
