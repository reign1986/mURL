<form role="form" method="POST" action="{{ $action }}">
    {{ method_field($method) }}
    {{ csrf_field() }}

    <input name="id" type="hidden" value="{{ old('id', $link->id) }}">

    @if($link->exists)
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group{{ $errors->has('murl') ? ' has-error' : '' }}">
                    <label for="murl" class="control-label">mURL</label>
                    <input type="text" class="form-control" name="murl" id="murl" value="{{ old('murl', $link->murl) }}"
                           required>
                    @if ($errors->has('murl'))
                        <span class="help-block">
                        <strong>{{ $errors->first('murl') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="url" class="control-label">URL</label>
                    <input type="text" class="form-control" name="url" id="url" value="{{ old('url', $link->url) }}"
                           required>
                    @if ($errors->has('url'))
                        <span class="help-block">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

    <hr/>
    <div class="row">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-success" id="submit-link">
                @if($link->exists)
                    Update
                @else
                    Minify
                @endif
            </button>
        </div>
    </div>
</form>
