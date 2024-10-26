const button = document.getElementById("vote-button");
const can = document.getElementById("can");

button.onclick = function btn() {
  can.textContent = "Thank you for voting!!";
};
