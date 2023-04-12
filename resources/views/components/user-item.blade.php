@props(['user'])

<div class="dir_item">
  <div class="user_profile_poc">
    <img class="item_img" src="{{$user->image_URL}}" alt="">
  </div>
  <div class="user_title">
    <div class="user_name">
      {{$user->name}}
    </div>
    <div class="user_email">
      {{$user->email}}
    </div>
    <div class="user_number">
      {{$user->phone_number}}
    </div>
  </div>
</div>