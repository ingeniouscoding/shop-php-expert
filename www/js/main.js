function addToCart(itemId) {
  const url = `/cart/addtocart/${itemId}/`;
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({}),
  })
    .then((res) => res.json())
    .then((data) => {
      if (!data.success) {
        return;
      }

      document.getElementById('cartCountItems')
        .innerText = data.countItems;

      document.getElementById(`addCart_${itemId}`)
        .classList.add('hide-me');

      document.getElementById(`removeCart_${itemId}`)
        .classList.remove('hide-me');
    })
    .catch((error) => {
      console.error('Error:', error);
    });
};

function removeFromCart(itemId) {
  const url = `/cart/removefromcart/${itemId}/`;
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({}),
  })
    .then((res) => res.json())
    .then((data) => {
      if (!data.success) {
        return;
      }

      document.getElementById('cartCountItems')
        .innerText = data.countItems;

      document.getElementById(`addCart_${itemId}`)
        .classList.remove('hide-me');

      document.getElementById(`removeCart_${itemId}`)
        .classList.add('hide-me');
    })
    .catch((error) => {
      console.error('Error:', error);
    });
}

function conversionPrice(itemId) {
  const newCount = document.getElementById(`itemCount_${itemId}`).value;
  const itemPrice = document.getElementById(`itemPrice_${itemId}`).innerText;

  const itemTotalPrice = newCount * itemPrice;
  document.getElementById(`itemTotalPrice_${itemId}`).innerText = itemTotalPrice.toFixed(2);
}