@foreach($breadcrumbs as $name=>$link)
<li class="m-nav__separator">-</li>
<li class="m-nav__item">
    <a href="{!!$link!!}" class="m-nav__link">
        <span class="m-nav__link-text">{!!$name!!}</span>
    </a>
</li>
@endforeach
