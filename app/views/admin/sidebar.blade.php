<ul>
    <li @if ($page=='display') class="active" @endif>
        {{ link_to_route('do/tokens', 'Tokens', null) }}
    </li>

    <li @if ($page=='users') class="active" @endif>
    {{ link_to_route('do/users', 'Users', null) }}
    </li>

    <li @if ($page=='analytics') class="active" @endif>
    {{ link_to_route('do/analytics', 'Analytics', null) }}
    </li>


</ul>