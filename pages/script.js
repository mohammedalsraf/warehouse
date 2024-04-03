// function addItem() {
//     var newItem = document.getElementById('items').cloneNode(true);
//     var inputs = newItem.getElementsByTagName('input');
//     for (var i = 0; i < inputs.length; i++) {
//         inputs[i].value = '';
//     }
//     document.getElementById('items-container').appendChild(newItem);
// }

// function removeItem(btn) {
//     var itemRow = btn.parentNode.parentNode;
//     itemRow.parentNode.removeChild(itemRow);
// }


$(document).ready(function () {
  $("#insertform").validate({
    rules: {
      doc_number:
      {
        required: true,
        number: true,
        maxlength: 15
      },
      istlam_number:
      {
        required: true,
        // number: true,
        maxlength: 15
      },
      rlegna:
      {
        required: true,
     
      },
      'quantity[]': {
        required: true,
    },
      'singlePrice[]': {
        required: true,
    },
      'allPrice[]': {
        required: true,
    },


    },
    messages: {
      doc_number: {
        required: "حقل رقم المستند مطلوب",
        number: "يجب أن يكون رقما فقط",
        maxlength: "يجب أن يكون الرقم طوله حد أقصى 15 رقم"
      },
      istlam_number: {
        required: "حقل رقم كتاب الاستلام مطلوب",
        // number: "يجب أن يكون رقما فقط",
        maxlength: "يجب أن يكون الرقم طوله حد أقصى 15 رقم"
      },
      rlegna:{
        required: "حقل رئيس اللجنة مطلوب",
      
      },
      'quantity[]': {
        required: "حقل مطلوب",
    },
      'singlePrice[]': {
        required: "حقل مطلوب",
    },
      'allPrice[]': {
        required: "حقل مطلوب",
    },



    },
    errorClass: "custom-error",
    submitHandler: function (form) {
      // Your custom logic before form submission
      if (confirm("متاكد من حفظ سند الادخال")) {
        // Allow form submission
        form.submit();
      }
    }
  });
});
$(document).ready(function () {
  $("#takeoutform").validate({
    rules: {
      taghez_number:
      {
        required: true,
        number: true,
        maxlength: 15
      },
      kitab_number:
      {
        required: true,
        // number: true,
        maxlength: 15
      },
      'sn[]':
      {
        required: true,
     
      },
      'quantity[]': {
        required: true,
    },
      'singlePrice[]': {
        required: true,
    },
      'allPrice[]': {
        required: true,
    },


    },
    messages: {
      taghez_number: {
        required: "حقل رقم المستند مطلوب",
        number: "يجب أن يكون رقما فقط",
        maxlength: "يجب أن يكون الرقم طوله حد أقصى 15 رقم"
      },
      kitab_number: {
        required: "حقل رقم الكتاب  مطلوب",
        // number: "يجب أن يكون رقما فقط",
        maxlength: "يجب أن يكون الرقم طوله حد أقصى 15 رقم"
      },
      'sn[]':{
        required: "حقل  مطلوب",
      
      },
      'quantity[]': {
        required: "حقل مطلوب",
    },
      'singlePrice[]': {
        required: "حقل مطلوب",
    },
      'allPrice[]': {
        required: "حقل مطلوب",
    },



    },
    errorClass: "custom-error",
    submitHandler: function (form) {
      // Your custom logic before form submission
      if (confirm("متاكد من حفظ السند ")) {
        // Allow form submission
        form.submit();
      }
    }
  });
});
$(document).ready(function () {
  $("#thmamform").validate({
    rules: {
      taghez_number:
      {
        required: true,
        number: true,
        maxlength: 15
      },
      kitab_number:
      {
        required: true,
        number: true,
        maxlength: 15
      },
      'sn':
      {
        required: true,
     
      },
      'quantity': {
        required: true,
    },
      'singlePrice': {
        required: true,
    },
      'allPrice': {
        required: true,
    },


    },
    messages: {
      taghez_number: {
        required: "حقل رقم المستند مطلوب",
        number: "يجب أن يكون رقما فقط",
        maxlength: "يجب أن يكون الرقم طوله حد أقصى 15 رقم"
      },
      kitab_number: {
        required: "حقل رقم الكتاب  مطلوب",
        number: "يجب أن يكون رقما فقط",
        maxlength: "يجب أن يكون الرقم طوله حد أقصى 15 رقم"
      },
      'sn':{
        required: "حقل  مطلوب",
      
      },
      'quantity': {
        required: "حقل مطلوب",
    },
      'singlePrice': {
        required: "حقل مطلوب",
    },
      'allPrice': {
        required: "حقل مطلوب",
    },



    },
    errorClass: "custom-error",
    submitHandler: function (form) {
      // Your custom logic before form submission
      if (confirm("متاكد من حفظ السند ")) {
        // Allow form submission
        form.submit();
      }
    }
  });
});
$(document).ready(function () {
  $("#editthmam").validate({
    rules: {
      taghez_number:
      {
        required: true,
        number: true,
        maxlength: 15
      },
      kitab_number:
      {
        required: true,
        number: true,
        maxlength: 15
      },
      'sn':
      {
        required: true,
     
      },
      'quantity': {
        required: true,
    },
      'singlePrice': {
        required: true,
    },
      'allPrice': {
        required: true,
    },


    },
    messages: {
      taghez_number: {
        required: "حقل رقم المستند مطلوب",
        number: "يجب أن يكون رقما فقط",
        maxlength: "يجب أن يكون الرقم طوله حد أقصى 15 رقم"
      },
      kitab_number: {
        required: "حقل رقم الكتاب  مطلوب",
        number: "يجب أن يكون رقما فقط",
        maxlength: "يجب أن يكون الرقم طوله حد أقصى 15 رقم"
      },
      'sn':{
        required: "حقل  مطلوب",
      
      },
      'quantity': {
        required: "حقل مطلوب",
    },
      'singlePrice': {
        required: "حقل مطلوب",
    },
      'allPrice': {
        required: "حقل مطلوب",
    },



    },
    errorClass: "custom-error",
    submitHandler: function (form) {
      // Your custom logic before form submission
      if (confirm("متاكد من حفظ السند ")) {
        // Allow form submission
        form.submit();
      }
    }
  });
});
$(document).ready(function () {
  $("#edit_vendor").validate({
    rules: {
      vendorName:
      {
        required: true,
      
      }

    },
    messages: {
      vendorName: {
        required: "حقل مطلوب",
     
      },
    


    },
    errorClass: "custom-error",
    submitHandler: function (form) {
      // Your custom logic before form submission
      if (confirm("متاكد  حفظ  ")) {
        // Allow form submission
        form.submit();
      }
    }
  });
});
///////////////////////////////////////////////

function removeItem(button) {
  // Remove the parent container of the clicked button
  $(button).closest('.item').remove();
}

function cloneItem() {
  // Destroy Select2 instances before cloning
  $('.item select').each(function () {
    $(this).select2('destroy');
  });

  // Clone the first item and append it to the container
  var clonedItem = $('.item:first').clone();
  $('#items-container').append(clonedItem);

  // Reinitialize Select2 for the new select element
  initializeSelect2();
}

function initializeSelect2() {
  $('select').select2();
}

$(document).ready(function () {
  initializeSelect2();
});

function confirmDelete() {
  return confirm('هل أنت متأكد أنك تريد حذف هذا القيد؟');
}
