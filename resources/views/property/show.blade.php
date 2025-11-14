<h1>{{ $property->address }}</h1>
<h2> {{ $property->landlord?->name }}</h2>
<h2> {{ $property->tenant?->name }}</h2>
<h2> {{ $property->buildingManager?->name }}</h2>
<h2> {{ $property->electricitySupplier?->name }}</h2>
