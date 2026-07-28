<form action="{{ $route }}" method="get">
    <div class="input-group">
        @if(request()->segment(2) == 'users')
        <input type="hidden" name="account_type" value="{{request('account_type')}}">
        @endif
        
        @if(request()->segment(2) == 'categorys')
        <div class="p-1">
            <select name="parent" class="form-select">
                <option value="">@lang('main.filterByCategoryType')</option>
                <option value="parent" @if(old('parent', request('parent')) == 'parent') selected @endif>@lang('main.parent')</option>
                <option value="sub" @if(old('parent', request('parent')) == 'sub') selected @endif>@lang('main.sub')</option>
            </select>
        </div>
        @endif
        @if(request()->segment(2) != 'members' && request()->segment(2) != 'reports')
        <div class="p-1">
            <input type="text" name="search" value="{{ request()->search }}" class="form-control"
                placeholder="@if(request()->segment(2) == 'users') @lang('main.search by name or email or mobile') @else @lang('main.search') @endif">
        </div>
        @endif
        @if(request()->segment(2) == 'orders')
        <div class="p-1">
            <select name="resturant_id" class="form-select">
                <option value="">@lang('main.filterByResturants')</option>
                @foreach(\App\Models\Resturant::get() as $resturant)
                <option value="{{$resturant->id}}" @if(old('resturant_id', request('resturant_id')) == $resturant->id) selected @endif>{{$resturant->name}} / {{$resturant->area?->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="p-1">
            <input type="text" name="order_no" value="{{ request()->order_no }}" class="form-control"
                placeholder="@lang('main.search by order no')">
        </div>
        @endif
        @if(request()->segment(2) == 'pending_vendors')
        <div class="p-1">
            <select name="type" class="form-select">
                <option value="">@lang('main.filterByType')</option>
                <option value="vendor" @if(old('type') == 'vendor' || request('type') == 'vendor') selected @endif>@lang('main.vendor')</option>
                <option value="delegate" @if(old('type') == 'delegate' || request('type') == 'delegate') selected @endif>@lang('main.delegate')</option>
            </select>
        </div>
        @endif
        @if(request()->segment(2) == 'products')
        <div class="p-1">
            <select name="category" class="form-select">
                <option value="">@lang('main.filterByCategoryId')</option>
                @foreach(\App\Models\Category::whereNull('parent_id')->get() as $value)
                    <option value="{{$value->id}}" @if(old('category') == $value->id || request('category') == $value->id) selected @endif>{{$value->name}}</option>
                @endforeach
            </select>
        </div>
        @endif

        @if(request()->segment(2) == 'services')
        <div class="p-1">
            <select name="type" class="form-select">
                <option value="">@lang('main.filterByType')</option>
                <option value="normal" @if(request('type') == 'normal') selected @endif>@lang('main.normal')</option>
                <option value="disability" @if(request('type') == 'disability') selected @endif>@lang('main.disability')</option>
            </select>
        </div>
        @endif

        @if(request()->segment(2) == 'reports')
           @if(request()->segment(3) != 'valet-trackers')
            <div class="p-1">
                <input type="date" name="from_date" value="{{ (request()->from_date)?? date('Y-m-d') }}" class="form-control">
            </div>
            @endif
          @if(request()->segment(3) == 'valet-trackers')
        
            <div class="p-1">
                <select name="valet" class="form-select">
                    <option value="">@lang('main.choose valet')</option>
                    @foreach(\App\Models\User::where('account_type','valet')->get() as $user)
                    <option value="{{$user->id}}" @if(request('valet') == $user->id) selected @endif>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
          @endif
        @else
        <div class="p-1">
            <input type="date" name="from_date" value="{{ request()->from_date }}" class="form-control" placeholder="@lang('main.from_date')">
        </div>
        <div class="p-1">
            <input type="date" name="to_date" value="{{ request()->to_date }}" class="form-control" placeholder="@lang('main.to_date')">
        </div>
        @endif
        <div class="p-1">
            <button type="submit" class="btn btn-success">
                <li class="fa fa-search"></li> @lang('main.search')
            </button>
        </div>
    </div>
</form>
