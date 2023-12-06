import './plugins/datatables-bootstrap5';
import 'jquery-validation';
import axios from 'axios';
import toastr from 'toastr';
window.toastr = toastr;

window.jQuery(document).ready(function () {
  // Custom validation method for checking the file extension
  $.validator.addMethod(
    'extension',
    function (value, element, param) {
      param = typeof param === 'string' ? param.replace(/,/g, '|') : 'png|jpe?g|gif';
      return this.optional(element) || value.match(new RegExp('\\.(' + param + ')$', 'i'));
    },
    $.validator.format('Please enter a value with a valid extension.')
  );

  // Custom validation rule for multiple images
  $.validator.addMethod(
    'validateImages',
    function (value, element) {
      // You can add your custom logic here to validate multiple images
      // For example, check the number of selected images
      return element.files.length > 0;
    },
    'Please select at least one image.'
  );
  window.jQuery('.myform, .dropzone-multi-form').validate({
    rules: {
      name: { required: true },
      sku: { required: true },
      dimensions: { required: true },
      manufacturer: { required: true },
      upc: { required: true },
      ean: { required: true },
      weight: { required: true },
      brand: { required: true },
      mpn: { required: true },
      isbn: { required: true },
      selling_price: { required: true },
      account: { required: true },
      description: { required: true },
      cost_price: { required: true },
      purchase_account: { required: true },
      purchase_description: { required: true },
      preferred_vendor: { required: true },
      opening_stock: { required: true },
      opening_stock_rate_per_unit: { required: true },
      reorder_point: { required: true },
      'images[]': {
        validateImages: true,
        extension: 'png|jpg|jpeg|gif'
      },
      email: {
        required: true,
        email: true
      }
    },
    messages: {
      name: { required: 'Please enter your name' },
      sku: { required: 'Please enter your sku' },
      email: {
        required: 'Please enter your email address',
        email: 'Please enter a valid email address'
      },
      'images[]': {
        validateImages: 'Please select at least one image.',
        extension: 'Please select a valid image file (png, jpg, jpeg, gif).'
      }
    },
    errorPlacement: function (error, element) {
      // Check if the element is the image upload input
      if (element.attr('id') === 'inputGroupFile02') {
        // Place the error message after the custom-file input
        error.insertAfter(element.closest('.inputGroupFile02-error'));
      } else {
        // Use the default placement for other elements
        error.insertAfter(element);
      }
    },
    submitHandler: function (form) {
      // var formDataForm1 = window.jQuery('.myform').serialize();
      // var formDataForm2 = window.jQuery('#dropzone-multi')[0];

      // var formData = new FormData(formDataForm2);
      // console.log(formDataForm1, formData);

      // // Create FormData objects for each form
      // var imageFormData = new FormData(document.getElementById('dropzone-multi'));
      // var textInputFormData = new FormData(document.getElementById('myform'));

      // console.log(imageFormData, textInputFormData);

      // // Merge the FormData objects
      // var mergedFormData = new FormData();

      // // Append data from the image form
      // for (var pair of imageFormData.entries()) {
      //   mergedFormData.append(pair[0], pair[1]);
      // }

      // // Append data from the text input form
      // for (var pair of textInputFormData.entries()) {
      //   mergedFormData.append(pair[0], pair[1]);
      // }

      // console.log(document.getElementById('dropzone-multi'), mergedFormData);
      // return;

      formData.submit();
      return;
      // // Send form data to the backend using Axios
      let url = $(form).attr('action');
      axios
        .post(url, form)
        .then(function (response) {
          // Handle the response from the backend
          console.log('response.data', response.data);
          // Additional actions or redirection if needed
        })
        .catch(function (error) {
          // Handle the error response from the backend
          console.log(error.response.data);
          // Display error messages to the user
          if (error.response.data.errors) {
            $.each(error.response.data.errors, function (key, value) {
              $('#' + key).after('<div class="error-message">' + value + '</div>');
            });
          }
        });

      return;
    }
  });

  window.jQuery(document).on('click', '.submit-all', function (e) {
    e.preventDefault();
    window.jQuery('#myform-submit-btn').click();
  });
});
