<script>
  var applicationId = '<?php echo $square_appid; ?>'; // <-- Add your application's ID here

  // You can delete this 'if' statement. It's here to notify you that you need
  // to provide your application ID.
  if (applicationId == '') {
    alert('You need to provide a value for the applicationId variable.');
  }

  // Initializes the payment form. See the documentation for descriptions of
  // each of these parameters.
  var paymentForm = new SqPaymentForm({
    applicationId: applicationId,
    inputClass: 'sq-input',
    inputStyles: [
      {
        fontSize: '12px'
      }
    ],
    cardNumber: {
      elementId: 'sq-card-number',
      placeholder: '•••• •••• •••• ••••'
    },
    cvv: {
      elementId: 'sq-cvv',
      placeholder: 'CVV (Security Code)'
    },
    expirationDate: {
      elementId: 'sq-expiration-date',
      placeholder: 'MM/YY'
    },
    postalCode: {
      elementId: 'sq-postal-code',
      placeholder: 'Postal Code'
    },
    callbacks: {

      // Called when the SqPaymentForm completes a request to generate a card
      // nonce, even if the request failed because of an error.
      cardNonceResponseReceived: function(errors, nonce, cardData) {
        if (errors) {
          console.log("Encountered errors:");

          // This logs all errors encountered during nonce generation to the
          // Javascript console.
          errors.forEach(function(error) {
            console.log('  ' + error.message);
          });

        // No errors occurred. Extract the card nonce.
        } else {

          // Delete this line and uncomment the lines below when you're ready
          // to start submitting nonces to your server.
          alert('Nonce received: ' + nonce);


          /*
            These lines assign the generated card nonce to a hidden input
            field, then submit that field to your server.
            Uncomment them when you're ready to test out submitting nonces.

            You'll also need to set the action attribute of the form element
            at the bottom of this sample, to correspond to the URL you want to
            submit the nonce to.
          */
          // document.getElementById('card-nonce').value = nonce;
          // document.getElementById('nonce-form').submit();

        }
      },

      unsupportedBrowserDetected: function() {
        // Fill in this callback to alert buyers when their browser is not supported.
      },

      // Fill in these cases to respond to various events that can occur while a
      // buyer is using the payment form.
      inputEventReceived: function(inputEvent) {
        switch (inputEvent.eventType) {
          case 'focusClassAdded':
            // Handle as desired
            break;
          case 'focusClassRemoved':
            // Handle as desired
            break;
          case 'errorClassAdded':
            // Handle as desired
            break;
          case 'errorClassRemoved':
            // Handle as desired
            break;
          case 'cardBrandChanged':
            // Handle as desired
            break;
          case 'postalCodeChanged':
            // Handle as desired
            break;
        }
      },

      paymentFormLoaded: function() {
        // Fill in this callback to perform actions after the payment form is
        // done loading (such as setting the postal code field programmatically).
        // paymentForm.setPostalCode('94103');
      }
    }
  });

  // This function is called when a buyer clicks the Submit button on the webpage
  // to charge their card.
  function requestCardNonce(event) {

    // This prevents the Submit button from submitting its associated form.
    // Instead, clicking the Submit button should tell the SqPaymentForm to generate
    // a card nonce, which the next line does.
    event.preventDefault();

    paymentForm.requestCardNonce();
  }
  </script>
<style type="text/css">
  .sq-input {
	border: 1px solid rgb(223, 223, 223);
	border-radius: 3px;
	outline-offset: -2px;
	font-size: 12px;
	padding: 6px;
	max-width: 85%;
	line-height: 1em;
  }
    .sq-input--focus {
      /* Indicates how form inputs should appear when they have focus */
      outline: 5px auto rgb(59, 153, 252);
    }
    .sq-input--error {
      /* Indicates how form inputs should appear when they contain invalid values */
      outline: 5px auto rgb(255, 97, 97);
    }
	.sq-label{
		font-size: 11px;
		color: #333;
		line-height: 1em;
		margin: 0px;
	}
  </style>
	<label class="sq-label">Card #</label>
  <div id="sq-card-number"></div>
	<label class="sq-label">CVV</label>
  <div id="sq-cvv"></div>
<label class="sq-label">Expiration Date</label>
<div id="sq-expiration-date"></div>
<label class="sq-label">Zip/Postal Code</label>
  <div id="sq-postal-code"></div>
  <div class="clear"></div>
  <!--
    After the SqPaymentForm generates a card nonce, *this* form POSTs the generated
    card nonce to your application's server.

    You should replace the action attribute of the form with the path of
    the URL you want to POST the nonce to (for example, "/process-card")
  -->
  <form id="nonce-form" novalidate action="REPLACE_ME" method="post">

    <!--
      Whenever a nonce is generated, it's assigned as the value of this hidden
      input field.
    -->
    <input type="hidden" id="card-nonce" name="nonce">

    <!--
      Clicking this Submit button kicks off the process to generate a card nonce
      from the buyer's card information.
    -->
    <input type="submit" onclick="requestCardNonce(event)">
  </form>
<br />