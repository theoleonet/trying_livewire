<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="grid gap-7 p-10">
  <form action="/">
    <label for="per-page">Choose the pagination count</label>
    <select id="per-page" name="per-page">
      <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
      <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
      <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
    </select>
    @foreach ($qp as $name => $value)
      @if ($name !== 'perPage')
        <input type="hidden" name="{{ $name }}" value={{ $value }}>
      @endif
    @endforeach
    <button type="submit">Change pagination</button>
  </form>
  <form action="/">
    <label for="search-term">Enter a part of the email or the name</label>
    <input type="search" id="search-term" name="search-term">
    @foreach ($qp as $name => $value)
      @if ($name !== 'search-term' && $name !== 'page')
        <input type="hidden" name="{{ $name }}" value={{ $value }}>
      @endif
    @endforeach
    <input type="hidden" name="page" value="1">
    <button type="submit">Filter contact list</button>
  </form>

  {{-- {{ dd($qp) }} --}}
  <table>
    <thead>
      <tr>
        <td><a href="{!! '/?sort-field=name&' . preg_replace("/sort-field=([^&]+).*$/", '', http_build_query($qp)) !!}">name</a></td>
        <td><a href="{!! '/?sort-field=email&' . preg_replace("/sort-field=([^&]+).*$/", '', http_build_query($qp)) !!}">Email</a></td>
        <td><a href="{!! '/?sort-field=birthdate&' . preg_replace("/sort-field=([^&]+).*$/", '', http_build_query($qp)) !!}">Birthdate</a></td>
      </tr>
    </thead>

    <tbody>
      @foreach ($contacts as $contact)
        <tr>
          <td>{{ $contact->name }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->birthdate->toFormattedDateString() }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div>
    {{ $contacts->appends($qp)->links() }}
  </div>
</body>

</html>
