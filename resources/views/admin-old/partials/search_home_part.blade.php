<form action="{{ url('admin/dashboard')}}" method="get"> 
            <div class="row mt-4 mb-4">
            <div class="col-sm-3">
              <label for="sortby_past">@lang('main.sortby_past')</label>
              <select name="sortby_past" id="sortby_past" class="form-select">
                <option value="">@lang('main.filter')</option>
                <option value="day" @if(request()->sortby_past == 'day') selected @endif>@lang('main.day')</option>
                <option value="week" @if(request()->sortby_past == 'week') selected @endif>@lang('main.week')</option>
                <option value="month" @if(request()->sortby_past == 'month') selected @endif>@lang('main.month')</option>
                <option value="year" @if(request()->sortby_past == 'year') selected @endif>@lang('main.year')</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="sortby_order_status">@lang('main.sortby_order_status')</label>
              <select name="sortby_order_status" id="sortby_order_status" class="form-select">
                <option value="">@lang('main.filter')</option>
                <option value="opened" @if(request()->sortby_order_status == 'opened') selected @endif>@lang('main.opened')</option>
                <option value="in_discuss" @if(request()->sortby_order_status == 'in_discuss') selected @endif>@lang('main.in_discuss')</option>
                <option value="closed" @if(request()->sortby_order_status == 'closed') selected @endif>@lang('main.closed')</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="sortby_from_date">@lang('main.sortby_from_date')</label>
              <input type="date" id="sortby_from_date" name="sortby_from_date" value="{{ request()->sortby_from_date }}" class="form-select">
            </div>
            <div class="col-sm-2">
              <label for="sortby_to_date">@lang('main.sortby_to_date')</label>
              <input type="date" id="sortby_to_date" name="sortby_to_date" value="{{ request()->sortby_to_date }}" class="form-select">
            </div>
            <div class="col-sm-2" style="margin-top: 28px;">
              <button type="submit" class="btn btn-success">
                <li class="fa fa-search"></li> @lang('main.search')
              </button>
            </div>
            </div>
            </form>