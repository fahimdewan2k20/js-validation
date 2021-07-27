var fname = lname = gender = dob = religion = present = permanent = tel = email = weblink = username = password = verify_password = "";
var flag = false;

// function validateEmail(email) {
//   let res = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
//   return res.test(email);
// }

document.querySelector('#regForm').onsubmit = () => {
  fname = document.forms["regForm"]["fname"].value;
  lname = document.forms["regForm"]["lname"].value;
  gender = document.forms["regForm"]["gender"].value;
  dob = document.forms["regForm"]["dob"].value;
  religion = document.forms["regForm"]["religion"].value;
  present = document.forms["regForm"]["present"].value;
  permanent = document.forms["regForm"]["permanent"].value;
  tel = document.forms["regForm"]["tel"].value;
  email = document.forms["regForm"]["email"].value;
  weblink = document.forms["regForm"]["weblink"].value;
  username = document.forms["regForm"]["username"].value;
  password = document.forms["regForm"]["password"].value;
  verify_password = document.forms["regForm"]["verify_password"].value;

  if (fname == "" || lname == "" || gender == "" || dob == "" || religion == "" || email == "" || username == "" || password == "" || verify_password == "") {
    flag = true;
  }
  // else if (!validateEmail(email)) {
  //   document.querySelector("#emailErr").removeAttribute("hidden");
  //   flag = true;
  // }
  else if(password != verify_password) {
    document.querySelector("#passErr").removeAttribute("hidden");
    flag = true;
  }
  else {
    document.querySelector("#emailErr").setAttribute("hidden", false);
    document.querySelector("#passErr").setAttribute("hidden", false);
    flag = false;
  }

  flag = false;

  if (flag) {
    document.querySelector("#regErr").removeAttribute("hidden");
  }
  else {
    document.querySelector("#regErr").setAttribute("hidden", false);

    let request = new XMLHttpRequest();
    request.onload = () => {
      console.log(this.responseText);
      const data = JSON.parse(this.responseText);

      if (data.status == "success") {
        console.log("success");
        window.open("http://localhost:8888/Web%20tech%20works/js-validation/templates/login.html");
      }
      else {
        console.log("error");
        // document.querySelector("#regErr").removeAttribute("hidden");
      }
    }

    request.open("POST", "./../registration.php", true);
    request.send(`fname=${fname}&lname=${lname}&gender=${gender}&dob=${dob}&religion=${religion}&present=${present}&permanent=${permanent}&tel=${tel}&email=${email}&weblink=${weblink}&username=${username}&password=${password}&veverify_password=${verify_password}`);
  }

  return false;
}
