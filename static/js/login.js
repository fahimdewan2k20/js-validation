function getCookie(name) {
    var cArr = document.cookie.split(";");

    for(var i = 0; i < cArr.length; i++) {
        var cPair = cArr[i].split("=");
        if(name == cPair[0].trim()) {
            return cPair[1];
        }
    }
    return null;
}

if (getCookie("username")) {
  document.forms["loginForm"]["username"].value = getCookie("username");
}

document.querySelector('#loginForm').onsubmit = () => {
  let username = document.forms["loginForm"]["username"].value || "";
  let password = document.forms["loginForm"]["password"].value || "";


  if (username != "" && password != "") {
    let request = new XMLHttpRequest();
    request.onload = () => {
      console.log(request.responseText);
      if (request.responseText == "success") {
        console.log("success");
        window.location.href = "http://localhost:8888/Web%20tech%20works/ajax/welcome.php";
      }
      else {
        console.log("error");
        document.querySelector("#regErr").removeAttribute("hidden");
      }
    }

    request.open("POST", "./../login.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("username=" + username + "&password=" + password);
  }

  return false;
}
