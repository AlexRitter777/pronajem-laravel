
<x-mail::message>
# {{ __('Welcome, :name!', ['name' => $user->name]) }}

{!! __("We're happy to have you on board at :app!", ['app' => config('app.name')]) !!}

{{ __('Your account has been successfully created, and you can now start exploring all features of the platform.') }}

<x-mail::button :url="$dashboardUrl">
    {{ __('Open Dashboard') }}
</x-mail::button>

@if (! $user->hasVerifiedEmail())
---

### {{ __('Next step') }}

{{ __('To unlock all features, please verify your email address when you’re ready.') }}
{{ __('You can do it anytime from your dashboard.') }}

@endif

---

{{ __('If you have any questions, feel free to reply to this email — we’re here to help.') }}

{{ __('Best regards,') }}
**{{ config('app.name') }}**

</x-mail::message>




