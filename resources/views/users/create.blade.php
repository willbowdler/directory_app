<x-layout>

  <div class="cont_center">
    <form class="form register_form" action="/users/create" method="POST">
      @csrf

      <div class="register_inputs_container">
        <h1>Create a User</h1>

        <div class="inputs">
          <label for="name">
            Name
          </label>
          <input name="name" type="text">
        </div>

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

        <div class="inputs">
          <label for="phone_number">
            Phone Number
          </label>
          <input name="phone_number" type="text">
        </div>

        <div class="inputs">
          <label for="address">
            Address
          </label>
          <input name="address" type="text">
        </div>

        <div class="inputs">
          <label for="gender">
            Gender
          </label>
          <input name="gender" type="text">
        </div>

        <div class="inputs">
          <label for="marital_status">
            Marital Status
          </label>
          <input name="marital_status" type="text">
        </div>

        <div class="inputs">
          <label for="birthday">
            Birthday
          </label>
          <input name="birthday" type="date">
        </div>
      </div>

      <button class="register_submit" type="submit">Create User</button>
    </form>
  </div>
</x-layout>