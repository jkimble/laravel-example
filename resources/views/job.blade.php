<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>
    <h2 class="font-bold">{{ $job['title'] }}</h2>
    Salary: {{ $job['salary'] }}
</x-layout>