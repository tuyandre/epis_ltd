<p><strong>New quote request</strong></p>
<p>Name: {{ $quote->name }}<br>Contact: {{ $quote->contact }}<br>Service: {{ $quote->service }}</p>
<p>{!! nl2br(e($quote->message)) !!}</p>
