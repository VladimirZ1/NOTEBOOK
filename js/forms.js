;let forms = (function() {

  let bodyOnLoad = function () {
    document.querySelector('form').addEventListener('input', removeError);
    btnReg.onclick = function (event) {
      onClickBtnReg(event);
    };
    btnLogin.onclick = function (event) {
      onClickBtnLogin(event);
    };
  
  };

	let createElem = function (name,attributes) {
	  let el = document.createElement(name);

		if (typeof attributes === 'object') {

      for (let key in attributes) {
        el.setAttribute(key, attributes[key]);
      }

    }
            
		for (let i = 2; i < arguments.length; i++) {
		  let val = arguments[i];
		      
		  el.append(val);
		}
	  
	   return el;
	};

    
  let onClickBtnReg = function (event){
    let newRegForm = createElem("form", {id    : "regForm",class : "form-group row justify-content-center"},
                        createElem("div", {class : "col-8 col-sm-6 col-md-4 col-lg-3"},
                          createElem("input", {class : "form-control", id : "login", name : "login", placeholder : "Логин"}),
                          createElem("input", {class : "form-control mt-1", id : "pass1", name : "pass1", placeholder : "Пароль", type : "password"}),
                          createElem("input", {class : "form-control mt-1", id : "pass2", name : "pass2", placeholder : "Повтор пароля", type : "password"}),
                          createElem("input", {class : "form-control mt-1", id : "email", name : "email", placeholder : "Email", type : "email"}),
                          createElem("button", {class : "btn btn-success btn-block mt-2", id : "btnReg2", onclick : "forms.reg(event);",type : "submit"})
                        )
                       );

    document.getElementById("loginForm").remove(); 
    document.getElementsByTagName("main")[0].prepend(newRegForm);
    document.getElementById("btnReg2").innerHTML = "ЗАРЕГИСТРИРОВАТЬСЯ";
    document.querySelector('form').addEventListener('input', removeError);

  }; 

  let removeError = function (event) {
    let idError = event.target.id+"Error";

    event.target.classList.remove("is-invalid");
    elem = document.getElementById(idError);

    if (elem) {
      elem.remove();
    }

  };

  let onClickBtnLogin = async (event) => {
    event.preventDefault();

    document.querySelectorAll('.invalid-feedback').forEach(function(element){ element.remove(); });

    let response = await fetch('login.php', { 
      method  : 'POST',
      body    : new FormData(loginForm)
    });

    if (response.ok) {
      let json = await response.json();

      if (json['OK']) {
        location.replace("/notebook/private.php");
      } else {
      
        for (let key in json){
          addError(key,json[key]);
        }

      }
        

    } else {
      alert("Ошибка HTTP: " + response.status);
    }

  };

  let reg = async  function  (event) {
    event.preventDefault();
    document.querySelectorAll('.invalid-feedback').forEach(function(element){ element.remove(); });
  
    let response = await fetch('registr.php', { 
      method  : 'POST',
      body    : new FormData(regForm)
    });

    if (response.ok) {
      let json = await response.json();
      
      if (json['OK']) {
        alert("Логин успешно создан!");
        location.replace("/notebook/private.php");
      } else {
      
        for (let key in json){
          addError(key,json[key]);
        }

      }

    } else {
      alert("Ошибка HTTP: " + response.status);
    }
  };

  let addError = function(id,text) {
     let elem = document.getElementById(id),
         idErrr = id+"Error";

     elem.classList.add('is-invalid');
     elem.after( createElem('div',{class : "invalid-feedback", id : idErrr, style : "display : flex;"}) );
     document.getElementById(idErrr).textContent = text;
  };

  return {

  	createElem      : createElem,
  	onClickBtnReg   : onClickBtnReg,
    bodyOnLoad      : bodyOnLoad,
    onClickBtnLogin : onClickBtnLogin,
    reg             : reg
	  
  };

})();