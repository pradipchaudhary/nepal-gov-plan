<div class="letter_title">
    <h1> {{ config('constant.SITE_NAME') }}</h1>
    <h2>{{ config('constant.SITE_SUB_TYPE') }}</h2>
    <span>{{ config('constant.FULL_ADDRESS') }}</span>
    @if ($letter_title != '')
        <div class="letter_type">{{ $letter_title }}</div>
    @endif
</div>
