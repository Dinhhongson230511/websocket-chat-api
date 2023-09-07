<div class="card_custom" class="classCustom">
    <div name="collapse" mode="in-out">
        <div class="card_custom--title">
            <div class="card_custom--title-left">
                @if(isset($srcIcon))
                    <img src="{{ $srcIcon }}" alt="logo"/>
                @endif
                <p class="title_card">{{ $title ?? '' }}</p>
            </div>
            <div class="card_custom--title-right">
                <img src="{{ asset('assets/images/icon/btn_up.svg') }}" alt="btnUp"
                     :class="{ 'transform-rotate-180': viewContent }"/>
            </div>
        </div>
        <div class="card_custom--content">
            {{ $slot }}
        </div>
    </div>
</div>
