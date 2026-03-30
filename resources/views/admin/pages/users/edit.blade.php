<div>
    @push('breadcrumb')
        @include('admin.partials.breadcrumb', [
            'title' => 'Edit User',
            'list' => [
                [
                    'name' => 'Edit User',
                    'current' => true
                ]
            ]
        ])
    @endpush

    <div class="row row-cols-1 row-cols-md-2">
        <div class="col">
            <div class="row row-cols-1 mt-0 g-4">
                <div class="col">
                    <div class="card card-form">
                        <div class="card-body text-center">
                            <div class="card-bg"></div>
                            <div class="card-info">
                                <form action="" method="post">
                                    @csrf
                                    <label>
                                        <div class="avatar-block"><span class="icon"><i class="bi bi-person"></i></span></div>
                                        <input type="file" name="image">
                                    </label>
                                </form>
                                <p class="member-name">{{ $item->full_name }}</p>
                                <p class="member-type">{{ $user_role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang('admin.account')</h5>
                            <p class="card-subtitle">Here you can change user account information</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.users.update', ['user' => $item->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <label for="first_name" class="form-label">@lang('admin.first_name')</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="@lang('admin.first_name')" value="{{ old('first_name', $item->first_name) }}">
                                            <label for="first_name">@lang('admin.first_name')</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="last_name" class="form-label">@lang('admin.last_name')</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="@lang('admin.last_name')" value="{{ old('last_name', $item->last_name) }}">
                                            <label for="last_name">@lang('admin.last_name')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col">
                                        <label for="email" class="form-label">@lang('admin.email')</label>
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="@lang('admin.email')" value="{{ old('email', $item->email) }}">
                                            <label for="email">@lang('admin.email')</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="phone" class="form-label">@lang('admin.phone')</label>
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="@lang('admin.phone')" value="{{ old('phone', $item->phone) }}">
                                            <label for="phone">@lang('admin.phone')</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <label for="role" class="form-label">@lang('admin.role')</label>
                                    <div class="form-floating">
                                        <select class="form-select custom-select" id="role" name="role" aria-label="Floating label select example">
                                            <option selected>@lang('admin.select')</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}" @selected(old('role', $user_role) === $role)>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        <label for="role">@lang('admin.role')</label>
                                    </div>
                                </div>
                                <div class="row row-cols-3 mb-3">
                                    <div class="col">
                                        <label for="is_active" class="form-label">@lang('admin.status')</label>
                                        <div class="custom-switch">
                                            <input type="checkbox" name="is_active" id="is_active" value="on" @checked(old('is_active', $item->is_active))>
                                            <label for="is_active">
                                                <div class="custom-switch-ball"><i class="bi bi-check2"></i></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <label for="about" class="form-label">@lang('admin.about')</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="about" name="about" style="height: 100px">{{ old('about', $item->about) }}</textarea>
                                        <label for="about">@lang('admin.about')</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-submit">@lang('admin.save')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row row-cols-1 mt-0 g-4">
                <div class="col">
                    <div class="card card-form">
                        <div class="card-header">
                            <h5 class="card-title">@lang('admin.change_pass')</h5>
                            <p class="card-subtitle">Here you can set your new password</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.users.update_pass', ['user' => $item->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col mb-3">
                                    <label for="current_password" class="form-label">@lang('admin.old_pass')</label>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="@lang('admin.old_pass')">
                                        <label for="current_password">@lang('admin.old_pass')</label>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <label for="password" class="form-label">@lang('admin.pass')</label>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="@lang('admin.pass')">
                                        <label for="password">@lang('admin.pass')</label>
                                    </div>
                                </div>
                                <div class="col mb-4">
                                    <label for="password_confirmation" class="form-label">@lang('admin.confirm_pass')</label>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="@lang('admin.confirm_pass')">
                                        <label for="password_confirmation">@lang('admin.confirm_pass')</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-submit">@lang('admin.save')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
