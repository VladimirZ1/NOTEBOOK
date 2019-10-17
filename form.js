;let formReg = (function() {

	let createElem = function (name,attributes) {
	  	  let el = document.createElement(name);

		  if (typeof attributes == 'object') {
		      for (let i in attributes) {
		       el.setAttribute(i, attributes[i]);
		      }
		    }

		   for (let i = 2; i < arguments.length; i++) {
		      let val = arguments[i];

		      if (typeof val == 'string') { 
		        val = document.createTextNode(val);
		      }
		      
		      el.append(val);
		    }
	  
	    return el;
	  }

    return {

  	   createElem : createElem
	  
    } 


})();