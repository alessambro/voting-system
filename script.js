function change() {
  const adminPanel = document.getElementById("btn2");
  if (adminPanel) {
    window.location.href = "admin.php";
  }
}

function changeTwo() {
  const userPanel = document.getElementById("btn3");
  if (userPanel) {
    window.location.href = "login.php";
  }
}
