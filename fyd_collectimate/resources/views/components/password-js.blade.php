const toggle{{ucfirst($name)}} = document.querySelector("#toggle{{ucfirst($name)}}");
const {{$name}} = document.querySelector("#{{$name}}");

toggle{{ucfirst($name)}}.addEventListener("click", function () {

  // toggle the type attribute
  const type = {{$name}}.getAttribute("type") === "password" ? "text" : "password";
  {{$name}}.setAttribute("type", type);
  // toggle the eye icon
  this.classList.toggle('fa-eye');
  this.classList.toggle('fa-eye-slash');
});
