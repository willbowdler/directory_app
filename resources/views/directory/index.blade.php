@props(['users'])

<x-layout>


  <div class="dashboard">

    <x-directory :users='$users' />

    <x-dir-user-selected :users='$users' />

  </div>

</x-layout>