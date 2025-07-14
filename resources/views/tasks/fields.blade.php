<div class="row">
    <div class="form-group col-sm-6">
        <label for="due_date">{{ __('due_date').":" }}</label>

        <div class="form-group input-group datetimepicker" id="datetimepicker_due_date" data-target-input="nearest">
            <input type="text" id="due_date" name="due_date" value="{{ old('due_date') }}" required class="form-control datetimepicker-input date_time" data-target="#datetimepicker_due_date">
            <div class="input-group-append" data-target="#datetimepicker_due_date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        {!! \Form::label("status", __('status').":") !!}
        {!! \Form::select("status", ['' => 'Backlog'] + \App\Models\Task::$select_status, old('status'), ["class" => "form-control select2"]) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! \Form::label("priority", __('priority').":") !!}
        {!! \Form::select("priority", \App\Models\Task::$select_priority, old('priority'), ["class" => "form-control select2", "required" => true]) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12">
        {!! \Form::label("description", __('description').":") !!}
        {!! \Form::textarea("description", old('description'), ["class" => "form-control", "required" => true]) !!}
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        {!! \Form::submit(__('Salvar'), ["class" => "btn btn-success"]) !!}
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
    </div>
</div>