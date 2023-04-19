<x-layout>
  <div class="cont_center">
    <form class="payment_form" action="/payments/charge" method="POST">
      @csrf
      <h1>Giving</h1>
      <input class="currency_input" name="amount" type="text" inputmode="numeric" dir="rtl" placeholder="$0.00">

      <div id="card-element">
        <!-- Elements will create form elements here -->
      </div>
      <div class="float_right">
        <button type="submit">Submit</button>
      </div>
      <input class="signed-in-user" type="hidden" name="name" value="{{$user->name}}">
    </form>











  </div>
  <script>
    const input = document.querySelector('.currency_input');
    const paymentForm = document.querySelector('.payment_form')

    input.addEventListener('input', (e) => {
      const value = e.target.value.replace(/\D/g, '');
      const formattedValue = (value / 100).toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
      e.target.value = formattedValue;
    });


    const stripe = Stripe("{{env('STRIPE_PUBLIC')}}");

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const usersName = document.querySelector('.signed-in-user').value

    paymentForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const {
        paymentMethod,
        error
      } = await stripe.createPaymentMethod(
        'card', cardElement, {
          billing_details: {
            name: usersName
          }
        }
      );

      stripe.createToken(cardElement).then(function(result) {
        if (result.error) {
          console.log(result.error)
        } else {
          stripeTokenHandler(result.token);
        }
      });
    });

    function stripeTokenHandler(token) {
      const tokenInput = document.createElement('input');
      tokenInput.setAttribute('type', 'hidden');
      tokenInput.setAttribute('name', 'stripeToken');
      tokenInput.setAttribute('value', token.id);
      paymentForm.appendChild(tokenInput);

      paymentForm.submit();
    }
  </script>

</x-layout>