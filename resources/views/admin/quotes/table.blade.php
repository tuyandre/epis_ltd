<table>
  <thead><tr><th>Date</th><th>Name</th><th>Contact</th><th>Service</th><th>Status</th></tr></thead>
  <tbody>
  @forelse($quotes as $q)
    <tr>
      <td>{{ $q->created_at->format('d M Y H:i') }}</td>
      <td><a href="{{ route('admin.quotes.show', $q) }}">{{ $q->name }}</a></td>
      <td>{{ $q->contact }}</td><td>{{ $q->service }}</td>
      <td><span class="badge {{ $q->status }}">{{ $q->status }}</span></td>
    </tr>
  @empty
    <tr><td colspan="5">No requests yet.</td></tr>
  @endforelse
  </tbody>
</table>
