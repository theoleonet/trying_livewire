<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title></title>
  @vite('resources/css/app.css')
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
      @if ($name !== 'per-page')
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

  <table>
    <thead>
      <tr>
        @php
          $qpf = array_filter($qp, static fn($p) => $p !== 'sort-field', ARRAY_FILTER_USE_KEY);
        @endphp
        <th scope="col"><a href="/?sort-field=name&amp;{{ http_build_query($qpf) }}">Name</a>
        </th>
        <th scope="col"><a href="/?sort-field=email&amp;{{ http_build_query($qpf) }}">Email</a></th>
        <th scope="col"><a href="/?sort-field=birthdate&amp;{{ http_build_query($qpf) }}">Birthdate</a>
        </th>
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
    {{ $contacts->appends($qp)->links('pagination::tailwind') }}
  </div>

  @vite('resources/js/app.ts')
</body>

</html>
