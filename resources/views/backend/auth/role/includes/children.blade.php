<ul class="list-unstyled ml-4">
    @foreach($children as $permission)
        <li>
            <input type="checkbox" name="permissions[]" {{ in_array($permission->id, $usedPermissions ?? [], true) ? 'checked' : '' }} value="{{ $permission->id }}" id="{{ $permission->id }}" />
            <label for="{{ $permission->id }}" class="check-box"></label>
            <label for="{{ $permission->id }}" class="check-box-content">{{ $permission->description ?? $permission->name }}</label>

            @if($permission->children->count())
                @include('backend.auth.role.includes.children', ['children' => $permission->children])
            @endif
        </li>
    @endforeach
</ul>
