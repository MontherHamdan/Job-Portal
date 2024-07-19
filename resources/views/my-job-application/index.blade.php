<x-layout>
    <x-breadcrumbs :links="['My Job Application' => '#']" />

    @forelse ($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex items-center justify-between text-sm text-slate-500">
                <div>
                    <div>
                        Applied {{ $application->created_at->diffForHumans() }}
                    </div>
                    <div>
                        Other {{ Str::plural('applicant', $application->job->job_applications_count - 1) }}
                        {{ $application->job->job_applications_count - 1 }}
                    </div>
                    <div>
                        Your expected salary ${{ $application->expected_salary }}
                    </div>
                    <div>
                        Average expected salary
                        {{ number_format($application->job->job_applications_avg_expected_salary) }}
                    </div>
                </div>

                <div>
                    <form method="POST" action="{{ route('my-job-applications.destroy', $application) }}">
                        @csrf
                        @method('DELETE')
                        <x-button>Cancel</x-button>
                    </form>
                </div>

            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8 mt-4">
            <div class="text-center font-medium">
                No Job application yet
            </div>
            <div class="text-center">
                Go find some jobs <a class="text-indigo-500 hover:underline" href="{{ route('jobs.index') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
