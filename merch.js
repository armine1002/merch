
//const credit_text = document.getElementById('credit-value').textContent;
//let credit = parseFloat(credit_text.split(':')[1].trim().replace(',', ''));
const prices = [100, 13, 16.20, 10.05];
const spans = document.getElementsByTagName('span');
const images = document.getElementsByTagName('img');
const inputElements = document.getElementsByTagName('input');
const checkboxes = [];

for (let i = 0; i < inputElements.length; i++) {
    if (inputElements[i].type === 'checkbox') {
        checkboxes.push(inputElements[i]);
    }
}

const checkout_btn = document.getElementById('checkout');
const credit_para = document.getElementById('credit-value');
const coupon_box = document.getElementById('coupon');

const creditText = credit_para.textContent;
credit = parseFloat(creditText.split('$')[1].trim().replace(',', ''));
//let credit = parseFloat(creditText.split('$')[1].trim().replace(',', '')) || initialCredit;
//let credit_str = credit_para.innerText;
//credit = parseFloat(credit_str.replace('$', '')); 
//console.log('Current User:', username);
 //console.log('Initial Credit:', credit);



// Put the prices in the spans
for (let i = 0; i < prices.length; i++) {
  spans[i].textContent = `$${prices[i].toFixed(2)}`;
}

// Event listener for the Checkout button
checkout_btn.addEventListener('click', function () {
  validate_coupon_code(coupon_box.value);
  sales_total(prices);
  
});


let checkoutClicked = false;

function handleImageClick(i) {
  return function() {
    
    if (!checkoutClicked) {
      
      checkboxes[i].checked = !checkboxes[i].checked;
    }
  };
}


for (let i = 0; i < images.length; i++) {
  images[i].addEventListener('click', handleImageClick(i));
}


// Event listener for the coupon box on "Enter" key 
coupon_box.addEventListener('keydown', function (event) {
  if (event.key === 'Enter') {
    validate_coupon_code(coupon_box.value);
    sales_total(prices);
  }
});


function update_credit() {
  //console.log("Before," + username);
  //console.log("Before," + credit);
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
        // Update the credit displayed on the merch page
         
        credit_para.innerHTML = `Credit: $${credit.toFixed(2)}`;
        //console.log(username);
        //console.log(credit);
        
    }
};
  xhr.open('POST', 'money.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Send the username and credit as data
  let data = 'username=' + username + '&credit=' + credit;
  //const data = 'username=' + encodeURIComponent(username) + '&credit=' + encodeURIComponent(credit);
  
  xhr.send(data);


 
  
}


function validate_coupon_code(code) {
  
  if (code === 'COUPON5') {
    credit += 5;
    coupon_box.value = '';
    //update_credit();
    
  } else if (code === 'COUPON10') {
    credit += 10;
    coupon_box.value = '';
    //update_credit();
    
  } else if (code === 'COUPON20') {
    credit += 20;
    coupon_box.value = '';
    //update_credit();
    
   } else if ( code==='') {
    //update_credit();
    
  } else {
    
   
    coupon_box.value = '';
    alert('coupon not valid');
    
}
}


function sales_total(arr) {
 
  let total = 0;

  for (let i = 0; i < arr.length; i++) {
    if (checkboxes[i].checked) {
      total += prices[i];
    }
  }

    
  tax = (total* 0.0725);
    
    const cent_value = Math.round(tax * 100) % 10;
      if (cent_value === 5) {
          if (Math.floor(tax) % 2 === 0) {
              tax = Math.floor(tax);
          } else {
              tax = parseFloat(tax.toFixed(2));
          }
      } else {
          tax = parseFloat(tax.toFixed(2));
      }

      const totalAfterTax = (total + tax);

  if (totalAfterTax > credit) {
    alert('You do not have sufficient credit for this purchase.');
    document.getElementById('message').innerHTML = '';
    update_credit();
    for (let i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
          checkboxes[i].checked = false; 
         
      }
      
  }
  }
  else if (totalAfterTax===0)  {
    document.getElementById('message').innerHTML = '';
    update_credit();
    
  }
   else {
    credit -= totalAfterTax;
    update_credit();

    for (let i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
          checkboxes[i].checked = false; 
          checkboxes[i].disabled = true;  
      }
      
  }

  const salesMessage = ` $${total.toFixed(2)}\n+  $${tax.toFixed(2)} (7.25%) \n= $${totalAfterTax.toFixed(2)} `;
 
  document.getElementById('message').innerHTML = salesMessage;
    
  }
  
 
}