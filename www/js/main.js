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

      document.getElementById('cartCountItems').innerText = data.countItems;

      document.getElementById(`addCart_${itemId}`).classList.add('hide-me');

      document.getElementById(`removeCart_${itemId}`).classList.remove('hide-me');
    })
    .catch((err) => {
      console.error('Ошибка:', err);
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

      document.getElementById('cartCountItems').innerText = data.countItems;

      document.getElementById(`removeCart_${itemId}`).classList.add('hide-me');

      document.getElementById(`addCart_${itemId}`).classList.remove('hide-me');
    })
    .catch((err) => {
      console.error('Ошибка:', err);
    });
}

function conversionPrice(itemId) {
  const newCount = document.getElementById(`itemCount_${itemId}`).value;
  const itemPrice = document.getElementById(`itemPrice_${itemId}`).innerText;

  const itemTotalPrice = newCount * itemPrice;
  document.getElementById(`itemTotalPrice_${itemId}`).innerText = itemTotalPrice.toFixed(2);
}

function showLoggedInUserLayout(data) {
  document.getElementById('registerBox').classList.add('hide-me');
  document.getElementById('loginBox').classList.add('hide-me');

  document.getElementById('userBox').classList.remove('hide-me');

  const userLink = document.getElementById('userLink');
  userLink.innerHTML = data.username;
  userLink.href = '/user/';
}

function registerNewUser(body) {
  const url = '/user/register/';
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(body),
  })
    .then((res) => res.json())
    .then((data) => {
      if (!data.success) {
        alert(data.message);
        return;
      }

      showLoggedInUserLayout(data);

      // document.getElementById('btnSaveOrder').classList.remove('hide-me');

      alert(data.message);
    })
    .catch((err) => {
      console.error('Ошибка:', err);
    });
}

function loginUser(body) {
  const url = '/user/login/';
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(body),
  })
    .then((res) => res.json())
    .then((data) => {
      if (!data.success) {
        alert(data.message);
        return;
      }
      showLoggedInUserLayout(data);
    })
    .catch((err) => {
      console.error('Ошибка:', err);
    });;
}

function updateUser(body) {
  const url = '/user/update/';
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(body),
  })
    .then((res) => res.json())
    .then((data) => {
      alert(data.message);
    })
    .catch((err) => {
      console.error('Ошибка:', err);
    });
}

document.getElementById('registerForm')?.addEventListener('submit', (ev) => {
  ev.preventDefault();
  let body = {};

  Object.keys(ev.target.elements).forEach((key) => {
    let element = ev.target.elements[key];
    if (element.type !== "submit") {
      body[element.name] = element.value;
    }
  });

  registerNewUser(body);
});


document.getElementById('loginForm')?.addEventListener('submit', (ev) => {
  ev.preventDefault();

  const email = document.getElementById('loginEmail').value;
  const password = document.getElementById('loginPassword').value;

  loginUser({ email, password });
});

document.querySelector('#registerBox>.menu-caption')?.addEventListener('click', () => {
  document.getElementById('registerForm').classList.toggle('hide-me');
});

document.getElementById('updateForm')?.addEventListener('submit', (ev) => {
  ev.preventDefault();
  let body = {};

  Object.keys(ev.target.elements).forEach((key) => {
    let element = ev.target.elements[key];
    if (element.type !== "submit") {
      body[element.name] = element.value;
    }
  });

  updateUser(body);
});