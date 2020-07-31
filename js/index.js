const loginAction = "/actions/login.php";
const registrationAction = "/actions/registration.php";
const exitAction = "/actions/exit.php";
const loginSelectors = {
  form: document.querySelector("#login-form"),
  login: document.querySelector("#login-form input[name='login']"),
  password: document.querySelector("#login-form input[name='password']"),
};

const registrationSelectors = {
  form: document.querySelector("#registration-form"),
  email: document.querySelector("#registration-form input[name='email']"),
  login: document.querySelector("#registration-form input[name='login']"),
  password: document.querySelector("#registration-form input[name='password']"),
};

const loginButton = document.querySelector("#loginButton");
const registrationButton = document.querySelector("#registrationButton");
const exitButton = document.querySelector("#exitButton");

if (loginButton) {
  loginButton.addEventListener("click", (e) => {
    e.preventDefault();
    login(loginAction, loginSelectors);
  });
}

if (registrationButton) {
  registrationButton.addEventListener("click", (e) => {
    e.preventDefault();
    registration(registrationAction, registrationSelectors);
  });
}

if (exitButton) {
  exitButton.addEventListener("click", (e) => {
    e.preventDefault();
    exit(exitAction);
  });
}
