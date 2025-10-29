
@session('error')
    <x-alerts.simple-error>{{ session('error') }}</x-alerts.simple-error>
@endsession
@session('warning')
    <x-alerts.simple-warning>{{ session('warning') }}</x-alerts.simple-warning>
@endsession
@session('success')
    <x-alerts.simple-success>{{ session('success') }}</x-alerts.simple-success>
@endsession
