<h2>
    {{ $job->title }}
</h2>

<p>
    The job has been posted.
</p>

<p>
    <a href="{{ url('/jobs/' . $job->id) }}">View your listing.</a>
</p>