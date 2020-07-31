function success(res, errBlock, form) {
    form.classList.add("display-none")
    errBlock.innerHTML = '';
    errBlock.classList.add("display-none");
    reload();
}


function error(err, errBlock) {
    errBlock.classList.remove("display-none");
    let errorText = '';
    let errors = err.responseJSON.errors;
    for (let key in errors) {
        errorText += "<div class='error-text'>"+ errors[key] +"</div>";
    }
    errBlock.innerHTML = errorText;
    console.log("Error");
}

function exit(url) {
    const settings = {
        url: url,
        method: "POST",
        success: (res) => reload(),
        error: (err) => error(err)
    };
    this.ajaxRequest(settings);
}

function reload() {
    document.location.reload(true);
}

function beforeLogin(selectors) {
    const login = selectors.login.value;
    const password = selectors.password.value;
    return data = { login, password };
  }

function beforeRegistration(selectors) {
    const login = selectors.login.value;
    const email = selectors.email.value;
    const password = selectors.password.value;
    return data = { login, email, password };
}

function login(url ,selectors) {
    let data = this.beforeLogin(selectors);
    const errorBlock = document.querySelector('.login-errors');
    const settings = {
      url: url,
      dataType: "json",
      method: "POST",
      data: data,
      success: (res) => success(res, errorBlock, selectors.form),
      error: (err) => error(err, errorBlock)
    };
   this.ajaxRequest(settings);
}

function registration(url ,selectors) {
    let data = this.beforeRegistration(selectors);
    const errorBlock = document.querySelector('.registration-errors')
    const settings = {
        url: url,
        dataType: "json",
        method: "POST",
        data: data,
        success: (res) => success(res, errorBlock, selectors.form),
        error: (err) => error(err, errorBlock),
    };
     this.ajaxRequest(settings);
}

function ajaxRequest(settings) {
    $.ajax(settings);
  }


