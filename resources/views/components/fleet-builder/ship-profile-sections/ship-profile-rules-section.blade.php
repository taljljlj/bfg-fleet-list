<ul class="ship-specials-container">
    @foreach($rules as $rule)
    <li class="ship-special" data-special-type="rules">{{ $rule->text }}<span class="tooltip">{{ $rule->text_long }}</span></li>

    @endforeach
</ul>
