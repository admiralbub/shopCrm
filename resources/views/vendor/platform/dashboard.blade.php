@extends(config('platform.workspace', 'platform::workspace.compact'))

@section('aside')
    <div class="aside col-xs-12 col-xxl-2 bg-dark d-flex flex-column me-auto" data-controller="menu">
        <header class="d-xl-block p-3 mt-xl-4 w-100 d-flex align-items-center">
            <a href="#" class="header-toggler d-xl-none me-auto order-first d-flex align-items-center lh-1"
               data-action="click->menu#toggle">
                <x-orchid-icon path="bs.three-dots-vertical" class="icon-menu"/>

                <span class="ms-2">@yield('title')</span>
            </a>

            <a class="header-brand order-last" href="{{ route(config('platform.index')) }}">
                @includeFirst([config('platform.template.header'), 'platform::header'])
            </a>
        </header>

        <nav class="aside-collapse w-100 d-xl-flex flex-column collapse-horizontal" id="headerMenuCollapse">

            @include('platform::partials.search')


            @if(!empty(config('langue-orchid.languages')))
                <div
                    id="localization"
                    class="col-xs-12 d-flex justify-content-start px-3 align-items-center pb-4"
                >
                    <x-orchid-icon
                        class="w-1x"
                        path="bs.globe"
                    />

                    <select
                        id="localization-switch"
                    >
                        @foreach(config('langue-orchid.languages') as $code => $lang)
                            <option
                                @if(app()->getLocale() === $code)
                                    selected
                                @endif
                                value="{{ $code }}"
                            >
                                {{ $lang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @push('stylesheets')
                    <style lang="scss">
                        #localization {
                            select {
                                padding: 0 5px;
                                background: var(--bs-link-color);
                                color: var(--bs-nav-link-color);
                                border: 1px solid var(--bs-link-color);
                            }
                        }
                    </style>
                @endpush

                @push('scripts')
                    <script type="text/javascript">
                        document.addEventListener("turbo:load", () => {
                            const selectElement = document.getElementById("localization-switch");

                            selectElement.addEventListener("change", (event) => {
                                window.location.href = `{{ Dashboard::prefix('/orchid-language-switch') }}/${ event.target.value }`;
                            });
                        });
                    </script>
                @endpush
            @endif




            <ul class="nav flex-column mb-md-1 mb-auto ps-0">
                {!! Dashboard::renderMenu() !!}
            </ul>

            <div class="h-100 w-100 position-relative to-top cursor d-none d-md-flex mt-md-5"
                 data-action="click->html-load#goToTop"
                 title="{{ __('Scroll to top') }}">
                <div class="bottom-left w-100 mb-2 ps-3 overflow-hidden">
                    <small data-controller="viewport-entrance-toggle"
                           class="scroll-to-top"
                           data-viewport-entrance-toggle-class="show">
                        <x-orchid-icon path="bs.chevron-up" class="me-2"/>
                        {{ __('Scroll to top') }}
                    </small>
                </div>
            </div>

            <footer class="position-sticky bottom-0">
                <div class="bg-dark position-relative overflow-hidden" style="padding-bottom: 10px;">
                    @includeWhen(Auth::check(), 'platform::partials.profile')
                </div>


                {{--
                <div class="mt-3">
                    @includeFirst([config('platform.template.footer'), 'platform::footer'])
                </div>

                --}}

            </footer>
        </nav>
    </div>
@endsection

@section('workspace')
    @if(Breadcrumbs::has())
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb px-4 mb-2">
                <x-tabuna-breadcrumbs
                    class="breadcrumb-item"
                    active="active"
                />
            </ol>
        </nav>
    @endif

    <div class="order-last order-md-0 command-bar-wrapper">
        <div class="@hasSection('navbar') @else d-none d-md-block @endif layout d-md-flex align-items-center">
            <header class="d-none d-md-block col-xs-12 col-md p-0 me-3">
                <h1 class="m-0 fw-light h3 text-black">@yield('title')</h1>
                <small class="text-muted" title="@yield('description')">@yield('description')</small>
            </header>
            <nav class="col-xs-12 col-md-auto ms-md-auto p-0">
                <ul class="nav command-bar justify-content-sm-end justify-content-start d-flex align-items-center gap-2 flex-wrap-reverse flex-sm-nowrap">
                    @yield('navbar')
                </ul>
            </nav>
        </div>
    </div>

    @include('platform::partials.alert')
    @yield('content')
@endsection
