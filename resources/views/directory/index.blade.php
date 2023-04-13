@props(['users'])

<x-layout>

  <div class="dashboard">

    <x-directory :users='$users' />

    <x-dir-user-selected />

  </div>
</x-layout>