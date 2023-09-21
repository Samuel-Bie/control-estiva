@extends('adminlte::page')

@section('title', 'Client creation')


@section('content')
<form method="POST" role="form" action="{{ URL::route("clients.store") }}"  id="create-customer">
    @method("POST")
    @csrf

    <div class="row">
      <div class="form-group col-sm-6">
        <label for="name">@lang('Name')</label>
        <input
        required
        type="text" name="name" class="form-control" id="name" placeholder="@lang('Januário Bambo')">
      </div>


      <div class="form-group col-sm-6">
          <label for="gender">@lang('Gender')</label>
          <select required class="selectpicker form-control" data-style="btn-outline-primary" name="gender">
              <option value="Male" data-tokens="">
                  Male
              </option>

              <option value="Female" data-tokens="">
                Female
            </option>
          </select>
      </div>

      <div class="form-group col-sm-3">
        <label for="id_number">@lang('ID Number')</label>
        <input required type="text" name="id_number" class="form-control" id="id_number" placeholder="080 100 650 308 A">
      </div>


      <div class="form-group col-sm-3">
        <label for="birthdate">@lang('Birthdate')</label>
        <input required type="date" name="birthdate" class="form-control" id="birthdate" placeholder="080 100 650 308 A">
      </div>
      <div class="form-group col-sm-6">
        <label for="phone">@lang('Telefone')</label>
        <input type="text" name="phone" class="form-control" id="phone" placeholder="820011333">
      </div>

      <div class="form-group col-sm-6">
        <label for="company">@lang('Company')</label>
        <input required type="text" name="company" class="form-control" id="company" placeholder="CSC ">
      </div>

      <div class="form-group col-sm-6">
        <label for="role">@lang('Role')</label>
        <select required class="selectpicker form-control" data-style="btn-outline-primary" name="role">
            <option value="Estivador" data-tokens="">
                Estivador
            </option>

            <option value="Operario" data-tokens="">
              Operario
          </option>
        </select>
    </div>

      <div class="form-group col-sm-12">
        <label for="address">@lang('Address')</label>
        <input  type="text" name="address" class="form-control" id="address" placeholder="@lang('Av Acordos de Lusaka')">
      </div>




    </div>

    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-sm btn-outline-primary save">@lang('Salvar')</button>
      </div>
    </div>
  </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
