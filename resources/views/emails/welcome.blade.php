
<x-mail::message>
# {{ __('mails.welcome', ['name' => $user->name]) }}

{!! __("mails.happy-to-have", ['app' => config('app.name')]) !!}

{{ __('mails.account-created') }}

<x-mail::button :url="$dashboardUrl" color="indigo">
    {{ __('mails.open-dashboard') }}
</x-mail::button>

@if (! $user->hasVerifiedEmail())
---

### {{ __('mails.next-step') }}

{{ __('mails.verify-info') }}
{{ __('mails.verify-anytime') }}

@endif

---

{{ __('mails.help') }}

{{ __('mails.regards') }}
**{{ config('app.name') }}**

</x-mail::message>




