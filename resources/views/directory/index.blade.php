<x-layout>

  <div class="directory">
    <x-search-members />
    @foreach ($users as $user)

    <x-user-item :user='$user' />

    @endforeach
  </div>

</x-layout>