  <table>
    <thead>
      <tr>
        <td><a href="#" wire:click="orderBy('name')">name</a></td>
        <td><a href="#" wire:click="orderBy('email')">Email</a></td>
        <td><a href="#" wire:click="orderBy('birthdate')">Birthdate</a></td>
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
    {{ $contacts->links() }}
  </div>
