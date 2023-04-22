<x-layout>
  <div class="cont_center">
    <form class="payment_form" method="POST">
      @csrf
      <h1>Giving</h1>
      <input class="currency_input" name="amount" type="text" inputmode="numeric" dir="rtl" placeholder="$0.00">

      <div id="card-element">
        <!-- Elements will create form elements here -->
      </div>
      <div class="payment_methods">
        @if ($user->hasPaymentMethod())
        <p>Choose a Payment Method</p>
        @foreach ($payment_methods as $payment_method)
        <div>
          <input type="checkbox" class="payment_selection" value="{{$payment_method->id}}" name="payment_selection" id="payment_method_{{$payment_method->id}}">
          <label for="payment_method_{{$payment_method->id}}">
            •••• •••• •••• {{$payment_method->card->last4}}
          </label>
        </div>
        @endforeach
        @endif

        @if ($user->subscribed('default'))
        <p>Recurring Giving</p>
        @foreach ($prices as $price)
        <p>Monthly Giving for {{$price}}</p>
        @endforeach
        @endif
      </div>
      <div class="float_right payment_btn_cont">
        <button class="payment_button payment_once_button" type="submit" data-action="/payments/charge">Give Once</button>
        <button class="payment_button subscription_button" type="submit" data-action="/payments/subscription/create">Give Monthly</button>
      </div>
      <input class="signed-in-user" type="hidden" name="name" value="{{$user->name}}">
    </form>











  </div>




  <script>
    const input = document.querySelector('.currency_input');
    const paymentForm = document.querySelector('.payment_form')
    const paymentButtons = document.querySelectorAll('.payment_button')
    const paymentSelections = document.querySelectorAll('.payment_selection')

    const stripe = Stripe("{{env('STRIPE_PUBLIC')}}");
    const elements = stripe.elements();
    const cardElement = elements.create('card');

    let selectedPaymentMethod

    paymentSelections.forEach((sel) => {
      sel.addEventListener('change', () => {
        if (selectedPaymentMethod) selectedPaymentMethod.checked = false

        selectedPaymentMethod = document.querySelector('input[type="checkbox"][name="payment_selection"]:checked')

        if (selectedPaymentMethod) {
          cardElement.unmount()
        } else {
          cardElement.mount('#card-element')
        }
      })
    })

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

    try {
      cardElement.mount('#card-element');

      const usersName = document.querySelector('.signed-in-user').value

      paymentButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
          e.preventDefault();

          const action = button.dataset.action
          paymentForm.action = action

          if (selectedPaymentMethod) paymentForm.submit()

          const {
            paymentMethod,
          } = await stripe.createPaymentMethod(
            'card', cardElement, {
              billing_details: {
                name: usersName
              }
            }
          );

          const token = await stripe.createToken(cardElement)
          stripeTokenHandler(token, paymentMethod);
        });

        const stripeTokenHandler = (token, paymentMethod) => {
          const tokenInput = document.createElement('input');
          createHiddenInput('stripeToken', token.id)
          createHiddenInput('paymentMethodId', paymentMethod.id)

          paymentForm.submit();
        }

        const createHiddenInput = (name, value) => {
          const hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', name);
          hiddenInput.setAttribute('value', value);
          paymentForm.appendChild(hiddenInput);
        }
      })
    } catch (error) {
      console.log(error)
    }
  </script>

</x-layout>