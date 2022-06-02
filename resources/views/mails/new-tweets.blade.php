@component('mail::message')
<div>
    Hey, {{ $user->name }}!
</div>
<br>
<div>
    Checkout new tweets from people you follow:
    <br>
    <ul>
        @foreach($tweets as $tweet)
        <li>
            <i><a href="{{ route('profile', $tweet->user->slug) }}">{{ $tweet->user->name }}</a>'s <a href="{{ route('specific.tweet', $tweet->id) }}">tweet</a>:</i>
            <p>{!! $tweet->content !!}</p>
        </li>
        @endforeach
    </ul>
</div>
<br>
<div>
    Regards,<br>
    {{ config('app.name') }}
</div>
@endcomponent