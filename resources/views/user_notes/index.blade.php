<x-layout>
  <div class="notes_container">
    <h1 class="note_for">{{$user->name}}</h1>

    @if ($user->user_notes)
    @foreach ($user->user_notes as $note)
    <div class="note">

      <div class="note_info">
        <div>{{$note->created_by}}</div>
        <div>{{$note->created_date}}</div>
      </div>
      <div class="note_body">
        <div>
          <h2>{{$note->title}}</h2>
          <p>{{$note->note}}</p>
        </div>
        <form action="/users/{{$note->id}}/notes/destroy">
          @csrf

          <button class="note_delete">x</button>
        </form>
      </div>

    </div>
    @endforeach
    @else
    <p>No notes saved.</p>
    @endif



    <form class="note_form" action="/users/{{$user->id}}/notes/create" method="POST">
      @csrf
      <input type="text" name="title" placeholder="Note Title">
      <textarea name="note" id="" cols="30" rows="10" placeholder="Type your note here."></textarea>
      <div class="float_right">
        <button type="submit">Save</button>
      </div>
    </form>
  </div>

  <div class="go_back">
    <a href="/" class="link">Back to Dashboard</a>
  </div>
</x-layout>