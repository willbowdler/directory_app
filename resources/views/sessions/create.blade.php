<x-layout>

  <div class="cont_center">
    <form class="form session_form" action="/sessions/create" method="POST">
      @csrf

      <div class="register_inputs_container">
        <h1>Login</h1>


        <div class="inputs">
          <label for="email">
            Email
          </label>
          <input name="email" type="email">
        </div>

        <div class="inputs">
          <label for="password">
            Password
          </label>
          <input name="password" type="password">
        </div>

      </div>

      <button class="register_submit" type="submit">Login</button>
    </form>
  </div>
</x-layout>